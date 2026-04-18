#!/usr/bin/env python
from __future__ import annotations

import io
import os
from functools import lru_cache

os.environ.setdefault("TRANSFORMERS_NO_TF", "1")
os.environ.setdefault("HF_HUB_DISABLE_SYMLINKS_WARNING", "1")

import torch
from fastapi import FastAPI, File, Form, HTTPException, UploadFile
from PIL import Image, UnidentifiedImageError
from pydantic import BaseModel
from transformers import CLIPModel, CLIPProcessor

ANIMAL_MODEL_ID = "openai/clip-vit-base-patch32"
ANIMAL_MIN_CONFIDENCE = 0.48
ANIMAL_MARGIN = 0.08

ANIMAL_LABELS = [
    "an animal",
    "a pet animal",
    "a dog",
    "a cat",
    "a rabbit",
    "a bird",
    "a hamster",
    "a horse",
    "a fish",
    "a turtle",
    "a reptile",
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

SPECIES_CANDIDATES = {
    "dog": "a dog",
    "cat": "a cat",
    "rabbit": "a rabbit",
    "bird": "a bird",
    "fish": "a fish",
    "hamster": "a hamster",
    "horse": "a horse",
    "turtle": "a turtle",
    "reptile": "a reptile",
}

BREED_CANDIDATES = {
    "dog": ["labrador", "golden retriever", "german shepherd", "husky", "poodle", "beagle", "mixed dog"],
    "cat": ["persian", "siamese", "maine coon", "ragdoll", "british shorthair", "mixed cat"],
    "rabbit": ["holland lop", "mini rex", "lionhead", "netherland dwarf", "mixed rabbit"],
    "bird": ["budgerigar", "cockatiel", "canary", "lovebird", "mixed bird"],
    "fish": ["goldfish", "betta", "guppy", "koi", "mixed fish"],
    "hamster": ["syrian hamster", "dwarf hamster", "roborovski hamster", "mixed hamster"],
    "horse": ["arabian horse", "thoroughbred", "quarter horse", "mixed horse"],
    "turtle": ["red-eared slider", "box turtle", "painted turtle", "mixed turtle"],
    "reptile": ["gecko", "iguana", "bearded dragon", "python", "mixed reptile"],
}

app = FastAPI(title="Animal AI Predictor", version="1.0.0")


class PredictionItem(BaseModel):
    label: str
    confidence: float


class SpeciesBreedPredictionResponse(BaseModel):
    is_animal: bool
    message: str
    animal_confidence: float
    species: PredictionItem | None
    breed: PredictionItem | None
    species_alternatives: list[PredictionItem]
    breed_alternatives: list[PredictionItem]


class DescriptionGenerationResponse(BaseModel):
    description: str
    species: str | None
    breed: str | None
    confidence_note: str


def device() -> str:
    return "cuda:0" if torch.cuda.is_available() else "cpu"


@lru_cache(maxsize=1)
def clip_detector() -> tuple[CLIPModel, CLIPProcessor]:
    model = CLIPModel.from_pretrained(ANIMAL_MODEL_ID)
    processor = CLIPProcessor.from_pretrained(ANIMAL_MODEL_ID)
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


def rank_labels(image: Image.Image, labels: list[str]) -> list[tuple[int, float]]:
    model, processor = clip_detector()
    inputs = processor(text=labels, images=image, return_tensors="pt", padding=True)
    inputs = {key: value.to(device()) for key, value in inputs.items()}

    with torch.no_grad():
        outputs = model(**inputs)
        probabilities = outputs.logits_per_image.softmax(dim=1)[0].detach().cpu().tolist()

    ranked_indexes = sorted(range(len(probabilities)), key=lambda idx: probabilities[idx], reverse=True)

    return [(idx, float(probabilities[idx])) for idx in ranked_indexes]


def detect_animal_confidence(image: Image.Image) -> tuple[float, str]:
    labels = ANIMAL_LABELS + NON_ANIMAL_LABELS
    ranked = rank_labels(image, labels)

    animal_scores = ranked[: len(ANIMAL_LABELS)]
    non_animal_scores = ranked[len(ANIMAL_LABELS) :]
    best_animal_idx = max(range(len(ANIMAL_LABELS)), key=lambda idx: animal_scores[idx][1])
    best_animal_conf = animal_scores[best_animal_idx][1]
    best_non_animal_conf = max((score for _idx, score in non_animal_scores), default=0.0)

    return float(best_animal_conf - best_non_animal_conf), ANIMAL_LABELS[best_animal_idx]


def predict_species(image: Image.Image) -> tuple[PredictionItem, list[PredictionItem]]:
    species_labels = list(SPECIES_CANDIDATES.keys())
    species_prompts = list(SPECIES_CANDIDATES.values())
    ranked = rank_labels(image, species_prompts)

    top_idx, top_conf = ranked[0]
    top_prediction = PredictionItem(label=species_labels[top_idx], confidence=top_conf)
    alternatives = [
        PredictionItem(label=species_labels[idx], confidence=conf)
        for idx, conf in ranked[:3]
    ]

    return top_prediction, alternatives


def predict_breed(image: Image.Image, species: str) -> tuple[PredictionItem | None, list[PredictionItem]]:
    candidates = BREED_CANDIDATES.get(species, [])
    if not candidates:
        return None, []

    prompts = [f"a {breed} {species}" for breed in candidates]
    ranked = rank_labels(image, prompts)

    top_idx, top_conf = ranked[0]
    top_prediction = PredictionItem(label=candidates[top_idx], confidence=top_conf)
    alternatives = [
        PredictionItem(label=candidates[idx], confidence=conf)
        for idx, conf in ranked[:3]
    ]

    return top_prediction, alternatives


def normalize_text(value: str | None) -> str:
    return (value or "").strip()


def render_age(age_value: str, age_unit: str) -> str:
    if age_value == "":
        return "an unknown age"

    safe_unit = "months" if age_unit not in ("months", "years") else age_unit
    return f"{age_value} {safe_unit}"


def render_gender(gender: str) -> str:
    if gender.upper() == "MALE":
        return "male"
    if gender.upper() == "FEMALE":
        return "female"

    return "unknown-gender"


def generate_description_text(
    name: str,
    species: str,
    breed: str,
    age_value: str,
    age_unit: str,
    gender: str,
) -> str:
    pet_name = name if name != "" else "This animal"
    pet_species = species if species != "" else "pet"
    pet_breed = breed if breed != "" else f"mixed {pet_species}"
    pet_age = render_age(age_value, age_unit)
    pet_gender = render_gender(gender)

    sentence_one = f"{pet_name} is a {pet_gender} {pet_species} ({pet_breed}) estimated at {pet_age}."
    sentence_two = (
        f"{pet_name} was safely found and is now looking for a caring home with a responsible adopter."
    )
    sentence_three = (
        "The profile details were assisted by AI suggestions and should be confirmed during the adoption process."
    )

    return " ".join([sentence_one, sentence_two, sentence_three])


@app.get("/health")
def health() -> dict[str, str]:
    return {"status": "ok"}


@app.post("/predict/species-breed", response_model=SpeciesBreedPredictionResponse)
async def predict_species_breed_endpoint(image: UploadFile = File(...)) -> SpeciesBreedPredictionResponse:
    image_bytes = await image.read()
    decoded_image = open_image(image_bytes)
    animal_confidence, _label = detect_animal_confidence(decoded_image)

    if animal_confidence < ANIMAL_MIN_CONFIDENCE or animal_confidence < ANIMAL_MARGIN:
        return SpeciesBreedPredictionResponse(
            is_animal=False,
            message="The uploaded image does not appear to be an animal.",
            animal_confidence=animal_confidence,
            species=None,
            breed=None,
            species_alternatives=[],
            breed_alternatives=[],
        )

    species, species_alternatives = predict_species(decoded_image)
    breed, breed_alternatives = predict_breed(decoded_image, species.label)

    return SpeciesBreedPredictionResponse(
        is_animal=True,
        message="Prediction completed.",
        animal_confidence=animal_confidence,
        species=species,
        breed=breed,
        species_alternatives=species_alternatives,
        breed_alternatives=breed_alternatives,
    )


@app.post("/generate/description", response_model=DescriptionGenerationResponse)
async def generate_description_endpoint(
    name: str = Form(default=""),
    species: str = Form(default=""),
    breed: str = Form(default=""),
    age_value: str = Form(default=""),
    age_unit: str = Form(default="months"),
    gender: str = Form(default=""),
    image: UploadFile | None = File(default=None),
) -> DescriptionGenerationResponse:
    normalized_species = normalize_text(species).lower()
    normalized_breed = normalize_text(breed).lower()
    confidence_note = "Description generated from current form data."

    if image is not None:
        image_bytes = await image.read()
        decoded_image = open_image(image_bytes)
        animal_confidence, _label = detect_animal_confidence(decoded_image)

        if animal_confidence < ANIMAL_MIN_CONFIDENCE or animal_confidence < ANIMAL_MARGIN:
            raise HTTPException(status_code=422, detail="The uploaded image does not appear to be an animal.")

        if normalized_species == "" or normalized_breed == "":
            predicted_species, _species_alternatives = predict_species(decoded_image)
            predicted_breed, _breed_alternatives = predict_breed(decoded_image, predicted_species.label)
            if normalized_species == "":
                normalized_species = predicted_species.label
            if normalized_breed == "" and predicted_breed is not None:
                normalized_breed = predicted_breed.label
            confidence_note = "Description generated with image-assisted species/breed suggestions."

    description = generate_description_text(
        name=normalize_text(name),
        species=normalized_species,
        breed=normalized_breed,
        age_value=normalize_text(age_value),
        age_unit=normalize_text(age_unit) or "months",
        gender=normalize_text(gender),
    )

    return DescriptionGenerationResponse(
        description=description,
        species=normalized_species if normalized_species != "" else None,
        breed=normalized_breed if normalized_breed != "" else None,
        confidence_note=confidence_note,
    )


if __name__ == "__main__":
    import argparse
    import uvicorn

    parser = argparse.ArgumentParser()
    parser.add_argument("--host", default="127.0.0.1")
    parser.add_argument("--port", type=int, default=7862)
    arguments = parser.parse_args()

    uvicorn.run("app:app", host=arguments.host, port=arguments.port, reload=False)
