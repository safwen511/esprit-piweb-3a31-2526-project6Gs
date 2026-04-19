Animal AI Service
=================

This service is dedicated to the Animal module only.
It is isolated from social/vet/product modules.

Endpoints:
- GET /health
- POST /predict/species-breed

Default host/port:
- 127.0.0.1:7862

Setup:
1. python -m pip install -r tools\animal_ai\requirements.txt
2. powershell -ExecutionPolicy Bypass -File tools\animal_ai\start.ps1

Health check:
- http://127.0.0.1:7862/health
- Expected: {"status":"ok"}
