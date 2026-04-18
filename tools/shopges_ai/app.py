#!/usr/bin/env python
from __future__ import annotations

import os
import re
from functools import lru_cache
from io import BytesIO

os.environ.setdefault("TRANSFORMERS_NO_TF", "1")
os.environ.setdefault("HF_HUB_DISABLE_SYMLINKS_WARNING", "1")

from fastapi import FastAPI, File, Form, UploadFile
from PIL import Image
from pydantic import BaseModel, Field
from sentence_transformers import SentenceTransformer, util
from transformers import pipeline

MODEL_ID = "sentence-transformers/all-MiniLM-L6-v2"
IMAGE_MODEL_ID = "Salesforce/blip-image-captioning-base"
MAX_RESULTS = 5
DEFAULT_MIN_RESULTS = 3

MEDICAL_KEYWORDS = {
    "bleeding",
    "blood",
    "vomit",
    "vomiting",
    "diarrhea",
    "diarrhoea",
    "seizure",
    "seizures",
    "fracture",
    "fractures",
    "infection",
    "infected",
    "poison",
    "poisoning",
    "toxic",
    "emergency",
    "urgent",
    "pain",
    "injury",
    "injured",
    "fever",
    "cannot breathe",
    "not breathing",
    "respiratory",
    "collapse",
    "collapsed",
}

CATEGORY_HINTS = {
    "food": {"food", "feeding", "hungry", "diet", "nutrition", "digestive", "digestion", "meal"},
    "medical": {"medical", "medicine", "wound", "recovery", "healing", "vitamin", "supplement", "care"},
    "toys": {"toy", "play", "bored", "chew", "fun", "activity", "enrichment"},
    "clothing": {"clothing", "coat", "jacket", "warm", "cold", "wear", "shirt", "sweater"},
}

PET_TYPE_HINTS = {
    "dog": {"dog", "puppy", "canine"},
    "cat": {"cat", "kitten", "feline"},
    "rabbit": {"rabbit", "bunny"},
    "bird": {"bird", "parrot", "canary"},
    "hamster": {"hamster", "guinea pig", "rodent"},
}

app = FastAPI(title="Shop AI Recommender", version="1.0.0")


class ProductPayload(BaseModel):
    id: int
    title: str
    description: str = ""
    category: str
    visible_price: float = Field(ge=0)
    stock: int = Field(ge=0)


class ShopRecommendationRequest(BaseModel):
    pet_type: str = ""
    age: str = ""
    symptoms_or_need: str = ""
    budget: float | None = Field(default=None, ge=0)
    preferred_category: str = ""
    products: list[ProductPayload]
    limit: int = Field(default=MAX_RESULTS, ge=1, le=MAX_RESULTS)


class RecommendedProduct(BaseModel):
    product_id: int
    title: str
    category: str
    visible_price: float
    stock: int
    score: float
    explanation: str
    matched_signals: list[str]


class UpsellBundle(BaseModel):
    title: str
    items: list[str]
    reason: str


class ShopRecommendationResponse(BaseModel):
    warning: str | None
    recommendations: list[RecommendedProduct]
    upsell_bundle: UpsellBundle | None


class ShopDescriptionResponse(BaseModel):
    description: str
    image_caption: str | None
    confidence_note: str


def normalize(text: str) -> str:
    lowered = text.lower().strip()
    lowered = re.sub(r"\s+", " ", lowered)
    return lowered


def tokenize(text: str) -> set[str]:
    return {token for token in re.findall(r"[a-z0-9]+", normalize(text)) if len(token) >= 2}


def price_band_signal(price: float, budget: float | None) -> tuple[float, str | None]:
    if budget is None:
        return 0.0, None

    if price <= budget:
        closeness = 1.0 - min(1.0, abs(budget - price) / max(budget, 1.0))
        return 12.0 + (8.0 * closeness), "Fits the budget."

    overspend_ratio = (price - budget) / max(budget, 1.0)
    if overspend_ratio <= 0.15:
        return 4.0, "Slightly above budget but still close."

    return -18.0, "Significantly above budget."


def age_signal(age: str, text: str) -> tuple[float, str | None]:
    normalized_age = normalize(age)
    if normalized_age == "":
        return 0.0, None

    combined = normalize(text)
    if any(keyword in combined for keyword in ("kitten", "puppy", "junior", "young", "baby")) and any(
        hint in normalized_age for hint in ("month", "months", "young", "baby", "kitten", "puppy")
    ):
        return 10.0, "Looks suitable for a young pet."

    if any(keyword in combined for keyword in ("adult", "all ages")) and "adult" in normalized_age:
        return 7.0, "Looks suitable for an adult pet."

    if any(keyword in combined for keyword in ("senior", "aging", "older")) and "senior" in normalized_age:
        return 10.0, "Looks suitable for a senior pet."

    return 0.0, None


def pet_type_signal(pet_type: str, text: str) -> tuple[float, str | None]:
    normalized_pet_type = normalize(pet_type)
    if normalized_pet_type == "":
        return 0.0, None

    combined = normalize(text)
    for canonical, aliases in PET_TYPE_HINTS.items():
        if normalized_pet_type in aliases or normalized_pet_type == canonical:
            if any(alias in combined for alias in aliases):
                return 15.0, f"Matches the requested pet type ({pet_type.strip()})."

    if normalized_pet_type in combined:
        return 10.0, f"References the requested pet type ({pet_type.strip()})."

    return 0.0, None


def category_signal(preferred_category: str, product_category: str, need_text: str) -> tuple[float, str | None]:
    preferred = normalize(preferred_category)
    category = normalize(product_category)
    if preferred != "":
        if preferred == category:
            return 18.0, "Matches the preferred category."
        return -10.0, "Different from the preferred category."

    need_tokens = tokenize(need_text)
    for candidate, hints in CATEGORY_HINTS.items():
        if candidate == category and need_tokens.intersection(hints):
            return 8.0, f"Category aligns with the stated need ({candidate})."

    return 0.0, None


def stock_signal(stock: int) -> tuple[float, str | None]:
    if stock <= 0:
        return -100.0, "Out of stock."
    if stock <= 3:
        return 2.0, "Still in stock, but low availability."
    return 6.0, "Comfortably in stock."


def medical_warning(need_text: str) -> str | None:
    normalized = normalize(need_text)
    if normalized == "":
        return None

    for keyword in MEDICAL_KEYWORDS:
        if keyword in normalized:
            return (
                "Some symptoms sound medical or urgent. These suggestions are shopping guidance only, "
                "so a veterinarian should review the situation."
            )

    return None


def build_query_text(request: ShopRecommendationRequest) -> str:
    parts: list[str] = []
    if request.pet_type.strip() != "":
        parts.append(f"pet type: {request.pet_type.strip()}")
    if request.age.strip() != "":
        parts.append(f"age: {request.age.strip()}")
    if request.symptoms_or_need.strip() != "":
        parts.append(f"need: {request.symptoms_or_need.strip()}")
    if request.preferred_category.strip() != "":
        parts.append(f"category: {request.preferred_category.strip()}")
    if request.budget is not None:
        parts.append(f"budget: {request.budget:.2f}")

    return " | ".join(parts)


def build_product_text(product: ProductPayload) -> str:
    return (
        f"title: {product.title}. "
        f"description: {product.description}. "
        f"category: {product.category}. "
        f"price: {product.visible_price:.2f}. "
        f"stock: {product.stock}."
    )


def open_image(image_bytes: bytes) -> Image.Image:
    image = Image.open(BytesIO(image_bytes))
    image.load()

    return image.convert("RGB")


@lru_cache(maxsize=1)
def image_captioner():
    return pipeline("image-to-text", model=IMAGE_MODEL_ID)


def generate_image_caption(image: Image.Image) -> str:
    outputs = image_captioner()(image, max_new_tokens=40)
    if not outputs:
        return ""

    generated = outputs[0].get("generated_text", "")

    return re.sub(r"\s+", " ", generated).strip()


def generate_product_description_text(
    title: str,
    category: str,
    price: str,
    tva: str,
    stock: str,
    existing_description: str,
    image_caption: str | None,
) -> tuple[str, str]:
    clean_title = title.strip() or "This product"
    clean_category = category.strip().lower() or "shop"
    clean_description = existing_description.strip()

    try:
        visible_price = max(0.0, float(price or 0) - float(tva or 0))
    except ValueError:
        visible_price = 0.0

    try:
        stock_count = max(0, int(stock or 0))
    except ValueError:
        stock_count = 0

    category_openers = {
        "food": "supports everyday feeding with a practical nutrition-focused profile",
        "medical": "fits a care-oriented routine for pets that need reliable support items",
        "toys": "adds enrichment and play to a pet's daily routine",
        "clothing": "helps pets stay comfortable with a simple wearable layer",
    }

    opener = category_openers.get(clean_category, "adds a practical option to the shop")
    stock_sentence = (
        f"It is currently available with {stock_count} item{'s' if stock_count != 1 else ''} in stock."
        if stock_count > 0
        else "Stock should be confirmed before purchase."
    )
    image_sentence = f"The product photo suggests {image_caption}." if image_caption else ""
    price_sentence = f"The current visible price is {visible_price:.2f} TND." if visible_price > 0 else ""
    description_seed = clean_description if clean_description else "It is presented as a straightforward choice for pet owners looking for a dependable shop item."

    composed = " ".join(
        part
        for part in [
            f"{clean_title} is a {clean_category} product that {opener}.",
            description_seed,
            image_sentence,
            price_sentence,
            stock_sentence,
        ]
        if part
    )

    confidence_note = (
        "Description generated with the current product details and image cues."
        if image_caption
        else "Description generated from the current product details."
    )

    return re.sub(r"\s+", " ", composed).strip(), confidence_note


@lru_cache(maxsize=1)
def embedding_model() -> SentenceTransformer:
    return SentenceTransformer(MODEL_ID)


def semantic_similarity(query_text: str, product_texts: list[str]) -> list[float]:
    model = embedding_model()
    query_embedding = model.encode(query_text, convert_to_tensor=True, normalize_embeddings=True)
    product_embeddings = model.encode(product_texts, convert_to_tensor=True, normalize_embeddings=True)
    scores = util.cos_sim(query_embedding, product_embeddings)[0]

    return [float(score) for score in scores]


def format_explanation(signals: list[str], fallback: str) -> str:
    cleaned = [signal for signal in signals if signal and "Out of stock." not in signal]
    if cleaned:
        return " ".join(cleaned[:3])

    return fallback


def build_upsell_bundle(recommendations: list[RecommendedProduct]) -> UpsellBundle | None:
    categories = {normalize(item.category): item for item in recommendations}
    bundle_items: list[str] = []

    for category in ("food", "toys", "medical", "clothing"):
        item = categories.get(category)
        if item is not None:
            bundle_items.append(item.title)

    if len(bundle_items) < 2:
        return None

    title = "Helpful starter bundle"
    if {"food", "toys", "medical"}.issubset(categories.keys()):
        title = "Food + toy + care bundle"
    elif {"food", "toys"}.issubset(categories.keys()):
        title = "Food + play bundle"

    return UpsellBundle(
        title=title,
        items=bundle_items[:3],
        reason="Combines complementary products from the recommended list.",
    )


@app.get("/health")
def health() -> dict[str, str]:
    return {"status": "ok"}


@app.post("/recommend", response_model=ShopRecommendationResponse)
def recommend(request: ShopRecommendationRequest) -> ShopRecommendationResponse:
    limit = max(DEFAULT_MIN_RESULTS, min(MAX_RESULTS, request.limit))
    warning = medical_warning(request.symptoms_or_need)
    query_text = build_query_text(request)
    product_texts = [build_product_text(product) for product in request.products]

    if product_texts == []:
        return ShopRecommendationResponse(
            warning=warning,
            recommendations=[],
            upsell_bundle=None,
        )

    semantic_scores = semantic_similarity(query_text, product_texts)
    ranked: list[RecommendedProduct] = []

    for index, product in enumerate(request.products):
        signals: list[str] = []
        score = 45.0 * max(0.0, semantic_scores[index])

        stock_bonus, stock_reason = stock_signal(product.stock)
        score += stock_bonus
        if stock_reason is not None:
            signals.append(stock_reason)

        pet_bonus, pet_reason = pet_type_signal(request.pet_type, product_texts[index])
        score += pet_bonus
        if pet_reason is not None:
            signals.append(pet_reason)

        age_bonus, age_reason = age_signal(request.age, product_texts[index])
        score += age_bonus
        if age_reason is not None:
            signals.append(age_reason)

        category_bonus, category_reason = category_signal(
            request.preferred_category,
            product.category,
            request.symptoms_or_need,
        )
        score += category_bonus
        if category_reason is not None:
            signals.append(category_reason)

        budget_bonus, budget_reason = price_band_signal(product.visible_price, request.budget)
        score += budget_bonus
        if budget_reason is not None:
            signals.append(budget_reason)

        need_tokens = tokenize(request.symptoms_or_need)
        product_tokens = tokenize(product_texts[index])
        keyword_hits = sorted(need_tokens.intersection(product_tokens))
        if keyword_hits:
            score += min(12.0, 4.0 * len(keyword_hits))
            signals.append(f"Matches need keywords: {', '.join(keyword_hits[:3])}.")

        score = max(0.0, min(100.0, score))
        ranked.append(
            RecommendedProduct(
                product_id=product.id,
                title=product.title,
                category=product.category,
                visible_price=round(product.visible_price, 2),
                stock=product.stock,
                score=round(score, 2),
                explanation=format_explanation(
                    signals,
                    "Selected as one of the closest matches to the request.",
                ),
                matched_signals=signals[:5],
            )
        )

    ranked.sort(key=lambda item: (-item.score, item.visible_price, item.product_id))
    recommendations = ranked[:limit]

    return ShopRecommendationResponse(
        warning=warning,
        recommendations=recommendations,
        upsell_bundle=build_upsell_bundle(recommendations),
    )


@app.post("/generate-description", response_model=ShopDescriptionResponse)
async def generate_description(
    title: str = Form(default=""),
    category: str = Form(default=""),
    price: str = Form(default=""),
    tva: str = Form(default=""),
    stock: str = Form(default=""),
    existing_description: str = Form(default=""),
    image: UploadFile | None = File(default=None),
) -> ShopDescriptionResponse:
    image_caption = None

    if image is not None:
        image_bytes = await image.read()
        if image_bytes:
            image_caption = generate_image_caption(open_image(image_bytes))

    description, confidence_note = generate_product_description_text(
        title,
        category,
        price,
        tva,
        stock,
        existing_description,
        image_caption,
    )

    return ShopDescriptionResponse(
        description=description,
        image_caption=image_caption,
        confidence_note=confidence_note,
    )


if __name__ == "__main__":
    import argparse
    import uvicorn

    parser = argparse.ArgumentParser()
    parser.add_argument("--host", default="127.0.0.1")
    parser.add_argument("--port", type=int, default=7863)
    arguments = parser.parse_args()

    uvicorn.run("app:app", host=arguments.host, port=arguments.port, reload=False)
