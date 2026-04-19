$ErrorActionPreference = 'Stop'

$projectRoot = Resolve-Path (Join-Path $PSScriptRoot '..\..')
Set-Location $projectRoot

$pythonCmd = Get-Command python -ErrorAction SilentlyContinue
if (-not $pythonCmd) {
    $pythonCmd = Get-Command py -ErrorAction SilentlyContinue
}

if (-not $pythonCmd) {
    throw 'Python executable not found. Install Python 3.11+ and retry.'
}

Write-Host '[animal_ai] Installing/updating dependencies...'
& $pythonCmd.Path -m pip install -r tools\animal_ai\requirements.txt

Write-Host '[animal_ai] Starting Animal AI service on http://127.0.0.1:7862 ...'
& $pythonCmd.Path tools\animal_ai\app.py --host 127.0.0.1 --port 7862
