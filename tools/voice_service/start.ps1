param(
    [string]$BindHost = '127.0.0.1',
    [int]$Port = 5001
)

$ErrorActionPreference = 'Stop'

$root = Resolve-Path (Join-Path $PSScriptRoot '..\..')
Set-Location $root

$venvPython = ".\tools\voice_service\.venv\Scripts\python.exe"

function New-VoiceServiceVirtualEnvironment {
    $python311 = Join-Path $env:LocalAppData "Programs\Python\Python311\python.exe"
    if (Test-Path $python311) {
        & $python311 -m venv ".\tools\voice_service\.venv"
        if (Test-Path $venvPython) {
            return
        }
    }

    $python = Get-Command python -ErrorAction SilentlyContinue
    if ($python) {
        & $python.Source -m venv ".\tools\voice_service\.venv"
        if (Test-Path $venvPython) {
            return
        }
    }

    throw "Python 3.11+ was not found. Install it first, then rerun this script."
}

if (-not (Test-Path $venvPython)) {
    New-VoiceServiceVirtualEnvironment
}

& $venvPython -m pip install -r ".\requirements-voice.txt"
& $venvPython -m uvicorn voice_service:app --host $BindHost --port $Port --app-dir $root
