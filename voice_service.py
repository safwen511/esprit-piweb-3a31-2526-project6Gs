import json
import os
import tempfile
from typing import Any, Dict, List

import librosa
import numpy as np
import soundfile as sf
from fastapi import FastAPI, File, Form, HTTPException, UploadFile

app = FastAPI(title="Local Voice Service")

TARGET_SAMPLE_RATE = 16000
MIN_SPEECH_SECONDS = 1.8
PRIMARY_MATCH_THRESHOLD = 0.975
REFERENCE_MATCH_THRESHOLD = 0.985
MAX_VECTOR_DISTANCE = 0.22
MIN_DURATION_RATIO = 0.65
MAX_DURATION_GAP_SECONDS = 2.0
MIN_DTW_SIMILARITY = 0.82


def _load_audio(path: str) -> tuple[np.ndarray, int]:
    try:
        audio, sample_rate = sf.read(path)
    except Exception:
        audio, sample_rate = librosa.load(path, sr=None, mono=False)

    if isinstance(audio, tuple):
        audio = np.asarray(audio)

    if audio.ndim > 1:
        if audio.shape[0] <= audio.shape[1]:
            audio = np.mean(audio, axis=0)
        else:
            audio = np.mean(audio, axis=1)

    audio = np.asarray(audio, dtype=np.float32)

    if sample_rate != TARGET_SAMPLE_RATE:
        audio = librosa.resample(audio, orig_sr=sample_rate, target_sr=TARGET_SAMPLE_RATE)
        sample_rate = TARGET_SAMPLE_RATE

    return audio, sample_rate


def _trim_to_speech(audio: np.ndarray, sample_rate: int) -> tuple[np.ndarray, float]:
    intervals = librosa.effects.split(audio, top_db=25)

    if intervals.size == 0:
        raise HTTPException(status_code=400, detail="No clear speech was detected in the audio sample.")

    chunks = [audio[start:end] for start, end in intervals if end > start]
    speech_audio = np.concatenate(chunks) if chunks else np.array([], dtype=np.float32)
    speech_seconds = float(len(speech_audio) / sample_rate)

    if speech_seconds < MIN_SPEECH_SECONDS:
        raise HTTPException(
            status_code=400,
            detail=f"At least {MIN_SPEECH_SECONDS:.1f} seconds of clear speech are required.",
        )

    return speech_audio, speech_seconds


def _cosine_similarity(left: np.ndarray, right: np.ndarray) -> float:
    denominator = float(np.linalg.norm(left) * np.linalg.norm(right))
    if denominator == 0.0:
        raise HTTPException(status_code=400, detail="Voice vectors could not be compared.")

    return float(np.dot(left, right) / denominator)


def _duration_ratio(left_seconds: float, right_seconds: float) -> float:
    longest = max(left_seconds, right_seconds)
    shortest = min(left_seconds, right_seconds)

    if longest <= 0.0:
        return 0.0

    return float(shortest / longest)


def _extract_profile_from_path(path: str) -> Dict[str, Any]:
    audio, sample_rate = _load_audio(path)

    if audio.size == 0:
        raise HTTPException(status_code=400, detail="Audio file is empty or unreadable.")

    speech_audio, speech_seconds = _trim_to_speech(audio, sample_rate)

    mfcc = librosa.feature.mfcc(y=speech_audio, sr=sample_rate, n_mfcc=40)
    delta = librosa.feature.delta(mfcc)
    delta2 = librosa.feature.delta(mfcc, order=2)
    spectral_contrast = librosa.feature.spectral_contrast(y=speech_audio, sr=sample_rate)
    zero_crossing = librosa.feature.zero_crossing_rate(y=speech_audio)
    rms = librosa.feature.rms(y=speech_audio)

    features = np.concatenate([
        np.mean(mfcc, axis=1), np.std(mfcc, axis=1),
        np.mean(delta, axis=1), np.std(delta, axis=1),
        np.mean(delta2, axis=1), np.std(delta2, axis=1),
        np.mean(spectral_contrast, axis=1), np.std(spectral_contrast, axis=1),
        np.mean(zero_crossing, axis=1), np.std(zero_crossing, axis=1),
        np.mean(rms, axis=1), np.std(rms, axis=1),
    ])

    norm = np.linalg.norm(features)
    if norm == 0.0:
        raise HTTPException(status_code=400, detail="The audio sample did not produce a usable voiceprint.")

    features = features / norm

    mfcc_mean = np.mean(mfcc, axis=0)
    mfcc_std = np.std(mfcc, axis=0)
    mfcc_sequence = np.vstack([mfcc_mean, mfcc_std]).astype(np.float32)

    return {
        "vector": features.astype(float).tolist(),
        "speech_seconds": float(speech_seconds),
        "mfcc_sequence": mfcc_sequence,
    }


def _detect_speech_from_path(path: str) -> dict:
    audio, sample_rate = _load_audio(path)

    if audio.size == 0:
        raise HTTPException(status_code=400, detail="Audio file is empty or unreadable.")

    _speech_audio, speech_seconds = _trim_to_speech(audio, sample_rate)

    return {
        "detected": True,
        "speechSeconds": round(speech_seconds, 3),
        "sampleRate": int(sample_rate),
    }


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
        vector = profile["vector"]
        return {"vector": vector}
    finally:
        if os.path.exists(temp_path):
            os.unlink(temp_path)


@app.post("/detect")
async def detect(file: UploadFile = File(...)) -> dict:
    temp_path = await _save_upload(file)

    try:
        return _detect_speech_from_path(temp_path)
    finally:
        if os.path.exists(temp_path):
            os.unlink(temp_path)


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
            expected_vector = np.asarray(json.loads(stored_vector), dtype=np.float32)
        except json.JSONDecodeError as exc:
            raise HTTPException(status_code=400, detail="stored_vector must be valid JSON.") from exc

        live_profile = _extract_profile_from_path(temp_path)
        live_vector = np.asarray(live_profile["vector"], dtype=np.float32)

        if expected_vector.size != live_vector.size:
            raise HTTPException(status_code=400, detail="Stored vector size does not match extracted vector size.")

        primary_score = _cosine_similarity(expected_vector, live_vector)
        vector_distance = float(np.linalg.norm(expected_vector - live_vector))

        reference_score = primary_score
        duration_ratio = 1.0
        duration_gap_seconds = 0.0
        dtw_similarity = 1.0

        if reference_file is not None:
            reference_path = await _save_upload(reference_file)
            reference_profile = _extract_profile_from_path(reference_path)
            reference_vector = np.asarray(reference_profile["vector"], dtype=np.float32)

            if reference_vector.size != live_vector.size:
                raise HTTPException(status_code=400, detail="Stored sample vector size does not match extracted vector size.")

            reference_score = _cosine_similarity(reference_vector, live_vector)
            duration_ratio = _duration_ratio(
                float(reference_profile["speech_seconds"]),
                float(live_profile["speech_seconds"]),
            )
            duration_gap_seconds = abs(float(reference_profile["speech_seconds"]) - float(live_profile["speech_seconds"]))

            dtw_cost, _ = librosa.sequence.dtw(
                X=reference_profile["mfcc_sequence"],
                Y=live_profile["mfcc_sequence"],
                metric="euclidean",
            )
            normalized_cost = float(dtw_cost[-1, -1] / max(dtw_cost.shape[0], dtw_cost.shape[1], 1))
            dtw_similarity = float(1.0 / (1.0 + normalized_cost))

        is_match = (
            primary_score >= PRIMARY_MATCH_THRESHOLD
            and vector_distance <= MAX_VECTOR_DISTANCE
            and reference_score >= REFERENCE_MATCH_THRESHOLD
            and duration_ratio >= MIN_DURATION_RATIO
            and duration_gap_seconds <= MAX_DURATION_GAP_SECONDS
            and dtw_similarity >= MIN_DTW_SIMILARITY
        )

        return {
            "score": round(primary_score, 6),
            "match": is_match,
            "metrics": {
                "primaryScore": round(primary_score, 6),
                "referenceScore": round(reference_score, 6),
                "vectorDistance": round(vector_distance, 6),
                "durationRatio": round(duration_ratio, 6),
                "durationGapSeconds": round(duration_gap_seconds, 6),
                "dtwSimilarity": round(dtw_similarity, 6),
            },
        }
    finally:
        if os.path.exists(temp_path):
            os.unlink(temp_path)
        if reference_path and os.path.exists(reference_path):
            os.unlink(reference_path)
