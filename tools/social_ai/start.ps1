$ErrorActionPreference = 'Stop'

$projectRoot = Split-Path -Parent (Split-Path -Parent $PSScriptRoot)
Set-Location $projectRoot

python -m pip install -r ".\tools\social_ai\requirements.txt"
python ".\tools\social_ai\app.py" --host 127.0.0.1 --port 7861
