#!/usr/bin/env python
from __future__ import annotations

import io
import os
import re
from functools import lru_cache
from typing import Any

os.environ.setdefault("TRANSFORMERS_NO_TF", "1")
os.environ.setdefault("HF_HUB_DISABLE_SYMLINKS_WARNING", "1")

import torch
from fastapi import FastAPI, File, Form, HTTPException, UploadFile
from PIL import Image, UnidentifiedImageError
from pydantic import BaseModel
from transformers import (
    AutoModelForImageTextToText,
    AutoModelForSequenceClassification,
    AutoProcessor,
    AutoTokenizer,
    CLIPModel,
    CLIPProcessor,
    TextClassificationPipeline,
    pipeline,
)

TEXT_MODEL_ID = "martin-ha/toxic-comment-model"
NSFW_MODEL_ID = "Falconsai/nsfw_image_detection"
ANIMAL_MODEL_ID = "openai/clip-vit-base-patch32"
CAPTION_MODEL_ID = "HuggingFaceTB/SmolVLM-256M-Instruct"

ANIMAL_LABELS = [
    "an animal",
    "a pet animal",
    "a dog",
    "a cat",
    "a rabbit",
    "a bird",
    "a hamster or guinea pig",
    "a horse",
    "a fish",
    "a turtle or reptile",
    "an insect",
]

NON_ANIMAL_LABELS = [
    "a human person",
    "food",
    "a vehicle",
    "a building",
    "a landscape",
    "a household object",
    "a phone or computer",
]

LIGHT_PROFANITY_PATTERNS = [
    re.compile(pattern, re.IGNORECASE)
    for pattern in (
        r"\bfuck(?:ing|er|ed)?\b",
        r"\bshit(?:ty|ting)?\b",
        r"\basshole\b",
        r"\bbitch(?:es)?\b",
        r"\bmerde\b",
        r"\bpute\b",
        r"\bconn?ard(?:e)?\b",
        r"\bcon\b",
    )
]

TEXT_BLOCK_THRESHOLD = 0.72
NSFW_BLOCK_THRESHOLD = 0.30
ANIMAL_MIN_CONFIDENCE = 0.48
ANIMAL_MARGIN = 0.08

app = FastAPI(title="Social Feed AI Helper", version="1.0.0")


class TextModerationResponse(BaseModel):
    allowed: bool
    blocked: bool
    toxic_score: float
    reason: str


class ImageModerationResponse(BaseModel):
    allowed: bool
    blocked: bool
    reason: str
    nsfw_score: float
    animal_confidence: float
    detected_label: str


class CaptionSuggestionResponse(BaseModel):
    caption: str
    detected_label: str


def device() -> str:
    return "cuda:0" if torch.cuda.is_available() else "cpu"


def torch_dtype() -> torch.dtype:
    return torch.float16 if torch.cuda.is_available() else torch.float32


@lru_cache(maxsize=1)
def text_classifier() -> TextClassificationPipeline:
    tokenizer = AutoTokenizer.from_pretrained(TEXT_MODEL_ID)
    model = AutoModelForSequenceClassification.from_pretrained(TEXT_MODEL_ID)

    return TextClassificationPipeline(
        model=model,
        tokenizer=tokenizer,
        return_all_scores=True,
        function_to_apply="sigmoid",
        truncation=True,
    )


@lru_cache(maxsize=1)
def nsfw_classifier():
    return pipeline(
        "image-classification",
        model=NSFW_MODEL_ID,
        device=device(),
    )


@lru_cache(maxsize=1)
def animal_detector() -> tuple[CLIPModel, CLIPProcessor]:
    model = CLIPModel.from_pretrained(ANIMAL_MODEL_ID)
    processor = CLIPProcessor.from_pretrained(ANIMAL_MODEL_ID)
    model.to(device())
    model.eval()

    return model, processor


@lru_cache(maxsize=1)
def caption_generator() -> tuple[Any, Any]:
    processor = AutoProcessor.from_pretrained(CAPTION_MODEL_ID)
    model = AutoModelForImageTextToText.from_pretrained(
        CAPTION_MODEL_ID,
        torch_dtype=torch_dtype(),
    )
    model.to(device())
    model.eval()

    return model, processor


def open_image(image_bytes: bytes) -> Image.Image:
    try:
        image = Image.open(io.BytesIO(image_bytes))
        image.load()
    except (UnidentifiedImageError, OSError) as exc:
        raise HTTPException(status_code=400, detail="Please upload a valid image file.") from exc

    return image.convert("RGB")


def contains_light_profanity(text: str) -> bool:
    if text.strip() == "":
        return False

    return any(pattern.search(text) for pattern in LIGHT_PROFANITY_PATTERNS)


def toxic_score_for_text(text: str) -> float:
    results = text_classifier()(text)[0]

    for item in results:
        label = str(item["label"]).lower()
        if "toxic" in label and "non" not in label:
            return float(item["score"])

    return float(results[-1]["score"])


def moderate_text(text: str) -> TextModerationResponse:
    if text.strip() == "":
        return TextModerationResponse(
            allowed=True,
            blocked=False,
            toxic_score=0.0,
            reason="Caption is empty.",
        )

    score = toxic_score_for_text(text)
    blocked = score >= TEXT_BLOCK_THRESHOLD or contains_light_profanity(text)

    return TextModerationResponse(
        allowed=not blocked,
        blocked=blocked,
        toxic_score=score,
        reason=(
            "The caption looks inappropriate for the social feed."
            if blocked
            else "Caption passed moderation."
        ),
    )


def analyze_nsfw(image: Image.Image) -> float:
    predictions = nsfw_classifier()(image)
    label_scores = {
        str(item["label"]).lower(): float(item["score"])
        for item in predictions
    }

    return label_scores.get("nsfw", 0.0)


def analyze_animal(image: Image.Image) -> tuple[float, str]:
    model, processor = animal_detector()
    labels = ANIMAL_LABELS + NON_ANIMAL_LABELS
    inputs = processor(
        text=labels,
        images=image,
        return_tensors="pt",
        padding=True,
    )
    inputs = {key: value.to(device()) for key, value in inputs.items()}

    with torch.no_grad():
        outputs = model(**inputs)
        probabilities = outputs.logits_per_image.softmax(dim=1)[0].detach().cpu().tolist()

    animal_probabilities = probabilities[: len(ANIMAL_LABELS)]
    non_animal_probabilities = probabilities[len(ANIMAL_LABELS) :]
    best_animal_index = max(range(len(ANIMAL_LABELS)), key=lambda index: animal_probabilities[index])
    best_non_animal = max(non_animal_probabilities) if non_animal_probabilities else 0.0
    best_animal = animal_probabilities[best_animal_index]

    return float(best_animal - best_non_animal), ANIMAL_LABELS[best_animal_index]


def moderate_image_bytes(image_bytes: bytes) -> ImageModerationResponse:
    image = open_image(image_bytes)
    nsfw_score = analyze_nsfw(image)
    animal_confidence, detected_label = analyze_animal(image)

    blocked_for_nsfw = nsfw_score >= NSFW_BLOCK_THRESHOLD
    blocked_for_non_animal = animal_confidence < ANIMAL_MIN_CONFIDENCE or animal_confidence < ANIMAL_MARGIN

    if blocked_for_nsfw:
        return ImageModerationResponse(
            allowed=False,
            blocked=True,
            reason="The uploaded image looks unsafe or explicit.",
            nsfw_score=nsfw_score,
            animal_confidence=animal_confidence,
            detected_label=detected_label,
        )

    if blocked_for_non_animal:
        return ImageModerationResponse(
            allowed=False,
            blocked=True,
            reason="The uploaded image does not appear to show an animal clearly enough.",
            nsfw_score=nsfw_score,
            animal_confidence=animal_confidence,
            detected_label=detected_label,
        )

    return ImageModerationResponse(
        allowed=True,
        blocked=False,
        reason="Image passed moderation.",
        nsfw_score=nsfw_score,
        animal_confidence=animal_confidence,
        detected_label=detected_label,
    )


def clean_caption(text: str) -> str:
    cleaned = re.sub(r"\s+", " ", text.replace("\n", " ")).strip().strip("\"'`")
    cleaned = re.sub(r"\s*#\w+", "", cleaned).strip()

    if cleaned.endswith((".", "!", "?")):
        return cleaned

    return f"{cleaned}." if cleaned else ""


def generate_caption(image_bytes: bytes) -> CaptionSuggestionResponse:
    image = open_image(image_bytes)
    moderation = moderate_image_bytes(image_bytes)
    model, processor = caption_generator()

    messages = [
        {
            "role": "user",
            "content": [
                {"type": "image"},
                {
                    "type": "text",
                    "text": (
                        "Write one warm social-media caption for this animal photo. "
                        "Keep it under 12 words, avoid hashtags, and sound wholesome."
                    ),
                },
            ],
        }
    ]
    prompt = processor.apply_chat_template(messages, add_generation_prompt=True)
    inputs = processor(text=prompt, images=[image], return_tensors="pt")
    inputs = {key: value.to(device()) for key, value in inputs.items()}

    with torch.no_grad():
        generated_ids = model.generate(
            **inputs,
            max_new_tokens=32,
            do_sample=False,
        )

    new_tokens = generated_ids[:, inputs["input_ids"].shape[1] :]
    caption = processor.batch_decode(new_tokens, skip_special_tokens=True)[0]
    caption = clean_caption(caption)

    if caption == "":
        detected = moderation.detected_label.replace("a ", "").replace("an ", "")
        caption = clean_caption(f"A sweet {detected} moment")

    return CaptionSuggestionResponse(
        caption=caption,
        detected_label=moderation.detected_label,
    )


@app.get("/health")
def health() -> dict[str, str]:
    return {"status": "ok"}


@app.post("/moderate/text", response_model=TextModerationResponse)
def moderate_text_endpoint(caption: str = Form(default="")) -> TextModerationResponse:
    return moderate_text(caption)


@app.post("/moderate/image", response_model=ImageModerationResponse)
async def moderate_image_endpoint(image: UploadFile = File(...)) -> ImageModerationResponse:
    image_bytes = await image.read()
    return moderate_image_bytes(image_bytes)


@app.post("/caption/suggest", response_model=CaptionSuggestionResponse)
async def caption_suggest_endpoint(image: UploadFile = File(...)) -> CaptionSuggestionResponse:
    image_bytes = await image.read()
    moderation = moderate_image_bytes(image_bytes)

    if moderation.blocked:
        raise HTTPException(status_code=422, detail=moderation.reason)

    return generate_caption(image_bytes)


if __name__ == "__main__":
    import argparse
    import uvicorn

    parser = argparse.ArgumentParser()
    parser.add_argument("--host", default="127.0.0.1")
    parser.add_argument("--port", type=int, default=7861)
    arguments = parser.parse_args()

    uvicorn.run("app:app", host=arguments.host, port=arguments.port, reload=False)
