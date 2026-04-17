Social Feed AI Service
======================

This folder contains the optional local Python service used only by the social feed module.

What it does:
- Moderates toxic captions
- Checks whether uploaded images are unsafe
- Checks whether uploaded images are animal photos
- Suggests a caption for accepted animal images

Important scope:
- This AI service is only used by the social feed post composer.
- Other modules can keep working without changing their own code.

Main files:
- `app.py`: FastAPI service and model loading
- `requirements.txt`: Python dependencies
- `start.ps1`: local Windows startup helper

Local endpoints:
- `GET /health`
- `POST /moderate/text`
- `POST /moderate/image`
- `POST /caption/suggest`

Models used:
- `martin-ha/toxic-comment-model`
- `Falconsai/nsfw_image_detection`
- `openai/clip-vit-base-patch32`
- `HuggingFaceTB/SmolVLM-256M-Instruct`

Windows setup:
1. Make sure Python 3.11+ is installed.
2. From the project root, run:
   `powershell -ExecutionPolicy Bypass -File tools\social_ai\start.ps1`

Manual setup:
1. `python -m pip install -r tools\social_ai\requirements.txt`
2. `python tools\social_ai\app.py --host 127.0.0.1 --port 7861`

Health check:
- Open `http://127.0.0.1:7861/health`
- Expected response: `{"status":"ok"}`

Important notes for teammates:
- The first startup may take time because models can download from Hugging Face.
- Model weights are cached outside the repo and should not be committed.
- Symfony will try to warm the AI service automatically when the social composer is opened.
- If someone is not working on the social module, they do not need to run this Python service.
