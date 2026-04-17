Shop AI Recommender
===================

This folder contains a local Python AI helper dedicated only to the shop module.

What it does:
- receives the shopper's context: pet type, age, symptoms or need, budget, preferred category
- reads the real shop catalog payload provided by Symfony
- ranks only existing products from that payload
- returns 3 to 5 recommendations with short explanations
- adds a veterinary safety warning when the request sounds medical or urgent
- can suggest a small upsell bundle from the recommended items

Important scope:
- this service is isolated to the shop feature
- it does not modify or reuse the social AI or animal AI services
- it never invents products; it only ranks the products sent in the request

Model used:
- `sentence-transformers/all-MiniLM-L6-v2`

How the ranking works:
- semantic similarity between the shopper request and each product
- rule boosts for matching pet type, age, category, budget, and stock
- a warning layer for medical or urgent wording

Default host and port:
- `127.0.0.1:7863`

Endpoints:
- `GET /health`
- `POST /recommend`

Windows setup:
1. Make sure Python 3.11+ is installed.
2. From the project root, run:
   `powershell -ExecutionPolicy Bypass -File tools\shopges_ai\start.ps1`

Manual setup:
1. `python -m pip install -r tools\shopges_ai\requirements.txt`
2. `python tools\shopges_ai\app.py --host 127.0.0.1 --port 7863`

Health check:
- Open `http://127.0.0.1:7863/health`
- Expected response: `{"status":"ok"}`

Example request body:
```json
{
  "pet_type": "cat",
  "age": "2 months",
  "symptoms_or_need": "kitten with digestion problems and low appetite",
  "budget": 60,
  "preferred_category": "food",
  "limit": 5,
  "products": [
    {
      "id": 1,
      "title": "Sensitive Kitten Food",
      "description": "Gentle dry food for young kittens with digestive support",
      "category": "food",
      "visible_price": 24.9,
      "stock": 12
    },
    {
      "id": 2,
      "title": "Soft Cat Toy",
      "description": "Indoor play toy for kittens and young cats",
      "category": "toys",
      "visible_price": 8.5,
      "stock": 9
    }
  ]
}
```

Expected response shape:
- `warning`: nullable string
- `recommendations`: ranked products with `score`, `explanation`, and `matched_signals`
- `upsell_bundle`: nullable bundle suggestion

Integration idea for Symfony:
- fetch products from `ProduitRepository`
- map them into the request payload
- call `POST /recommend`
- render the response above or beside the shop catalog

