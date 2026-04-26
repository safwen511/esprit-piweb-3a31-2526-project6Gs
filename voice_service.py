import json
import os
import tempfile
import threading
from functools import lru_cache
from typing import Any, Dict

import numpy as np
import soundfile as sf
import torch
import torchaudio
from faster_whisper import WhisperModel
from fastapi import FastAPI, File, Form, HTTPException, UploadFile
from scipy.signal import resample_poly
from speechbrain.inference.speaker import EncoderClassifier, SpeakerRecognition

app = FastAPI(title="Local Voice Service")

TARGET_SAMPLE_RATE = 16000
MODEL_SOURCE = "speechbrain/spkrec-ecapa-voxceleb"
MODEL_CACHE_DIR = os.path.join(os.path.dirname(__file__), "var", "voice_models", "spkrec-ecapa-voxceleb")
TRANSCRIPTION_MODEL_SOURCE = os.getenv("VOICE_TRANSCRIPTION_MODEL", "base")
TRANSCRIPTION_MODEL_CACHE_DIR = os.path.join(
    os.path.dirname(__file__),
    "var",
    "voice_models",
    "faster-whisper",
)
TRANSCRIPTION_ENGINE = f"faster-whisper:{TRANSCRIPTION_MODEL_SOURCE}"
TRANSCRIPTION_COMPUTE_TYPE = "int8"
FALLBACK_MATCH_THRESHOLD = 0.62
MIN_DURATION_RATIO = 0.55
MAX_DURATION_GAP_SECONDS = 4.0
SPEECH_DETECTOR = "energy-vad"
MIN_ACTIVE_RMS = 2.5e-5
MICROPHONE_SILENCE_FLOOR = 8e-6
_warmup_started = False
_warmup_lock = threading.Lock()


def _load_audio(path: str) -> tuple[np.ndarray, int]:
    try:
        audio, sample_rate = sf.read(path)
    except Exception:
        waveform, sample_rate = torchaudio.load(path)
        audio = waveform.detach().cpu().numpy()

    if isinstance(audio, tuple):
        audio = np.asarray(audio)

    if audio.ndim > 1:
        if audio.shape[0] <= audio.shape[1]:
            audio = np.mean(audio, axis=0)
        else:
            audio = np.mean(audio, axis=1)

    audio = np.asarray(audio, dtype=np.float32)

    if sample_rate != TARGET_SAMPLE_RATE:
        audio = resample_poly(audio, TARGET_SAMPLE_RATE, sample_rate).astype(np.float32, copy=False)
        sample_rate = TARGET_SAMPLE_RATE

    return audio, sample_rate


def _trim_to_speech(
    audio: np.ndarray,
    sample_rate: int,
) -> tuple[np.ndarray, float]:
    if audio.size == 0:
        raise HTTPException(status_code=400, detail="No clear speech was detected in the audio sample.")

    frame_length = max(256, int(sample_rate * 0.03))
    hop_length = max(128, int(sample_rate * 0.01))

    if audio.size < frame_length:
        audio = np.pad(audio, (0, frame_length - audio.size))

    starts = list(range(0, max(audio.size - frame_length + 1, 1), hop_length))
    if not starts:
        starts = [0]

    rms = np.array([
        np.sqrt(np.mean(np.square(audio[start:start + frame_length]), dtype=np.float64) + 1e-12)
        for start in starts
    ], dtype=np.float32)

    peak_rms = float(np.max(rms)) if rms.size > 0 else 0.0
    threshold = max(peak_rms * 0.12, MIN_ACTIVE_RMS)
    active = rms >= threshold

    if not np.any(active):
        if peak_rms <= MICROPHONE_SILENCE_FLOOR:
            raise HTTPException(
                status_code=400,
                detail="No microphone signal was detected in the recorded sample. Check browser mic permission or the selected input device.",
            )

        raise HTTPException(
            status_code=400,
            detail="Speech was too weak to isolate clearly from the recording. Move closer to the microphone and speak a bit louder.",
        )

    segments: list[tuple[int, int]] = []
    current_start = None
    padding = hop_length
    max_gap = int(sample_rate * 0.18)

    for index, is_active in enumerate(active):
        start = starts[index]
        end = min(audio.size, start + frame_length)

        if is_active and current_start is None:
            current_start = max(0, start - padding)
            continue

        if not is_active and current_start is not None:
            segment_end = min(audio.size, end + padding)
            if segments and current_start - segments[-1][1] <= max_gap:
                segments[-1] = (segments[-1][0], segment_end)
            else:
                segments.append((current_start, segment_end))
            current_start = None

    if current_start is not None:
        segment_end = audio.size
        if segments and current_start - segments[-1][1] <= max_gap:
            segments[-1] = (segments[-1][0], segment_end)
        else:
            segments.append((current_start, segment_end))

    if not segments:
        raise HTTPException(status_code=400, detail="No clear speech was detected in the audio sample.")

    chunks = [audio[start:end] for start, end in segments if end > start]
    speech_audio = np.concatenate(chunks) if chunks else np.array([], dtype=np.float32)
    speech_seconds = float(len(speech_audio) / sample_rate)

   

    return speech_audio, speech_seconds


def _duration_ratio(left_seconds: float, right_seconds: float) -> float:
    longest = max(left_seconds, right_seconds)
    shortest = min(left_seconds, right_seconds)

    if longest <= 0.0:
        return 0.0

    return float(shortest / longest)


def _cosine_similarity(left: np.ndarray, right: np.ndarray) -> float:
    denominator = float(np.linalg.norm(left) * np.linalg.norm(right))
    if denominator == 0.0:
        raise HTTPException(status_code=400, detail="Voice vectors could not be compared.")

    return float(np.dot(left, right) / denominator)


def _normalize_vector(vector: np.ndarray) -> np.ndarray:
    vector = np.asarray(vector, dtype=np.float32)
    norm = float(np.linalg.norm(vector))
    if norm == 0.0:
        raise HTTPException(status_code=400, detail="The audio sample did not produce a usable voiceprint.")

    return vector / norm


def _to_scalar(value: Any) -> float:
    if hasattr(value, "item"):
        return float(value.item())

    return float(value)


def _as_bool(value: Any) -> bool:
    if hasattr(value, "item"):
        return bool(value.item())

    return bool(value)


def _prepare_waveform(path: str) -> tuple[torch.Tensor, float]:
    audio, sample_rate = _load_audio(path)

    if audio.size == 0:
        raise HTTPException(status_code=400, detail="Audio file is empty or unreadable.")

    speech_audio, speech_seconds = _trim_to_speech(audio, sample_rate)
    waveform = torch.from_numpy(np.ascontiguousarray(speech_audio)).unsqueeze(0)

    return waveform, float(speech_seconds)


def _normalize_transcript_text(text: str) -> str:
    return " ".join((text or "").strip().split())


@lru_cache(maxsize=1)
def _load_encoder() -> EncoderClassifier:
    os.makedirs(MODEL_CACHE_DIR, exist_ok=True)
    torch.set_num_threads(max(1, min(4, os.cpu_count() or 1)))

    return EncoderClassifier.from_hparams(
        source=MODEL_SOURCE,
        savedir=MODEL_CACHE_DIR,
        run_opts={"device": "cpu"},
    )


@lru_cache(maxsize=1)
def _load_verifier() -> SpeakerRecognition:
    os.makedirs(MODEL_CACHE_DIR, exist_ok=True)
    torch.set_num_threads(max(1, min(4, os.cpu_count() or 1)))

    return SpeakerRecognition.from_hparams(
        source=MODEL_SOURCE,
        savedir=MODEL_CACHE_DIR,
        run_opts={"device": "cpu"},
    )


@lru_cache(maxsize=1)
def _load_transcriber() -> WhisperModel:
    os.makedirs(TRANSCRIPTION_MODEL_CACHE_DIR, exist_ok=True)
    torch.set_num_threads(max(1, min(4, os.cpu_count() or 1)))

    return WhisperModel(
        TRANSCRIPTION_MODEL_SOURCE,
        device="cpu",
        compute_type=TRANSCRIPTION_COMPUTE_TYPE,
        cpu_threads=max(1, min(4, os.cpu_count() or 1)),
        num_workers=1,
        download_root=TRANSCRIPTION_MODEL_CACHE_DIR,
    )


def _extract_profile_from_path(path: str) -> Dict[str, Any]:
    waveform, speech_seconds = _prepare_waveform(path)

    try:
        with torch.inference_mode():
            embedding = _load_encoder().encode_batch(waveform)
    except Exception as exc:
        raise HTTPException(status_code=500, detail="The speaker embedding model could not process the audio sample.") from exc

    vector = _normalize_vector(np.asarray(embedding.squeeze().cpu(), dtype=np.float32))

    return {
        "vector": vector.astype(float).tolist(),
        "speech_seconds": float(speech_seconds),
    }


def _warm_models() -> None:
    try:
        _load_encoder()
        _load_verifier()
        _load_transcriber()
    except Exception:
        # Warm-up is best-effort. Real failures still surface per request.
        pass


def _ensure_warmup_started() -> None:
    global _warmup_started

    if _warmup_started:
        return

    with _warmup_lock:
        if _warmup_started:
            return

        threading.Thread(target=_warm_models, daemon=True, name="voice-model-warmup").start()
        _warmup_started = True


def _detect_speech_from_path(path: str) -> dict:
    audio, sample_rate = _load_audio(path)

    if audio.size == 0:
        raise HTTPException(status_code=400, detail="Audio file is empty or unreadable.")

    speech_audio, speech_seconds = _trim_to_speech(audio, sample_rate)

    transcript = _transcribe_audio(speech_audio, sample_rate)

    return {
        "detected": True,
        "speechSeconds": round(speech_seconds, 3),
        "sampleRate": int(sample_rate),
        "transcript": transcript["text"],
        "transcriptionLanguage": transcript["language"],
        "transcriptionEngine": transcript["engine"],
    }


def _transcribe_audio(audio: np.ndarray, sample_rate: int) -> dict:
    if audio.size == 0:
        raise HTTPException(status_code=400, detail="No clear speech was detected in the audio sample.")

    temp_path = None

    try:
        with tempfile.NamedTemporaryFile(delete=False, suffix=".wav") as handle:
            temp_path = handle.name

        sf.write(temp_path, np.asarray(audio, dtype=np.float32), sample_rate)

        try:
            segments, info = _load_transcriber().transcribe(
                temp_path,
                beam_size=1,
                vad_filter=True,
            )
        except Exception as exc:
            raise HTTPException(
                status_code=500,
                detail="The speech-to-text model could not process the audio sample.",
            ) from exc

        transcript = _normalize_transcript_text(" ".join(segment.text.strip() for segment in segments))

        return {
            "text": transcript,
            "language": getattr(info, "language", None),
            "engine": TRANSCRIPTION_ENGINE,
        }
    finally:
        if temp_path and os.path.exists(temp_path):
            os.unlink(temp_path)


async def _save_upload(upload: UploadFile) -> str:
    suffix = os.path.splitext(upload.filename or "audio.wav")[1] or ".wav"

    with tempfile.NamedTemporaryFile(delete=False, suffix=suffix) as handle:
        content = await upload.read()
        if not content:
            raise HTTPException(status_code=400, detail="Uploaded audio file is empty.")

        handle.write(content)
        return handle.name


@app.post("/extract")
async def extract(file: UploadFile = File(...)) -> dict:
    temp_path = await _save_upload(file)

    try:
        profile = _extract_profile_from_path(temp_path)
        return {"vector": profile["vector"], "engine": MODEL_SOURCE}
    finally:
        if os.path.exists(temp_path):
            os.unlink(temp_path)


@app.on_event("startup")
async def startup() -> None:
    _ensure_warmup_started()


@app.post("/detect")
async def detect(file: UploadFile = File(...)) -> dict:
    temp_path = await _save_upload(file)

    try:
        result = _detect_speech_from_path(temp_path)
        result["engine"] = SPEECH_DETECTOR
        result["speechDetector"] = SPEECH_DETECTOR

        return result
    finally:
        if os.path.exists(temp_path):
            os.unlink(temp_path)


@app.get("/health")
async def health() -> dict:
    return {
        "status": "ok",
        "engine": MODEL_SOURCE,
        "speechDetector": SPEECH_DETECTOR,
        "transcriptionEngine": TRANSCRIPTION_ENGINE,
        "minSpeechSeconds": MIN_SPEECH_SECONDS,
    }


@app.post("/compare")
async def compare(
    file: UploadFile = File(...),
    stored_vector: str = Form(...),
    reference_file: UploadFile | None = File(default=None),
) -> dict:
    temp_path = await _save_upload(file)
    reference_path = None

    try:
        try:
            expected_vector = _normalize_vector(np.asarray(json.loads(stored_vector), dtype=np.float32))
        except json.JSONDecodeError as exc:
            raise HTTPException(status_code=400, detail="stored_vector must be valid JSON.") from exc
        except TypeError as exc:
            raise HTTPException(status_code=400, detail="stored_vector must be a JSON array of numbers.") from exc

        live_profile = _extract_profile_from_path(temp_path)
        live_vector = np.asarray(live_profile["vector"], dtype=np.float32)
        live_transcript = _detect_speech_from_path(temp_path)

        vectors_compatible = expected_vector.size == live_vector.size and expected_vector.size > 0
        primary_score = _cosine_similarity(expected_vector, live_vector) if vectors_compatible else 0.0
        vector_distance = float(np.linalg.norm(expected_vector - live_vector)) if vectors_compatible else -1.0

        reference_score = primary_score
        duration_ratio = 1.0
        duration_gap_seconds = 0.0
        match = False

        if reference_file is not None:
            reference_path = await _save_upload(reference_file)
            reference_profile = _extract_profile_from_path(reference_path)
            reference_vector = np.asarray(reference_profile["vector"], dtype=np.float32)
            reference_score = _cosine_similarity(reference_vector, live_vector)
            duration_ratio = _duration_ratio(
                float(reference_profile["speech_seconds"]),
                float(live_profile["speech_seconds"]),
            )
            duration_gap_seconds = abs(float(reference_profile["speech_seconds"]) - float(live_profile["speech_seconds"]))

            try:
                raw_score, prediction = _load_verifier().verify_files(reference_path, temp_path)
                reference_score = _to_scalar(raw_score)
                match = _as_bool(prediction)
            except Exception:
                match = reference_score >= FALLBACK_MATCH_THRESHOLD

            if not vectors_compatible:
                primary_score = reference_score
        else:
            match = primary_score >= FALLBACK_MATCH_THRESHOLD

        match = bool(match and duration_ratio >= MIN_DURATION_RATIO and duration_gap_seconds <= MAX_DURATION_GAP_SECONDS)
        final_score = reference_score if reference_file is not None else primary_score

        return {
            "score": round(final_score, 6),
            "match": match,
            "transcript": live_transcript["transcript"],
            "transcriptionLanguage": live_transcript["transcriptionLanguage"],
            "transcriptionEngine": live_transcript["transcriptionEngine"],
            "metrics": {
                "primaryScore": round(primary_score, 6),
                "referenceScore": round(reference_score, 6),
                "vectorDistance": round(vector_distance, 6) if vector_distance >= 0 else -1.0,
                "durationRatio": round(duration_ratio, 6),
                "durationGapSeconds": round(duration_gap_seconds, 6),
                "dtwSimilarity": round(reference_score if reference_file is not None else primary_score, 6),
            },
            "engine": MODEL_SOURCE,
        }
    finally:
        if os.path.exists(temp_path):
            os.unlink(temp_path)
        if reference_path and os.path.exists(reference_path):
            os.unlink(reference_path)


if __name__ == "__main__":
    import argparse
    import uvicorn

    parser = argparse.ArgumentParser()
    parser.add_argument("--host", default="127.0.0.1")
    parser.add_argument("--port", type=int, default=5001)
    arguments = parser.parse_args()

    uvicorn.run("voice_service:app", host=arguments.host, port=arguments.port, reload=False)
