$ErrorActionPreference = 'Stop'

$root = Resolve-Path (Join-Path $PSScriptRoot '..\..')
Set-Location $root

$venvPython = ".\tools\shopges_ai\.venv\Scripts\python.exe"

function New-ShopAiVirtualEnvironment {
    $python311 = Join-Path $env:LocalAppData "Programs\Python\Python311\python.exe"
    if (Test-Path $python311) {
        & $python311 -m venv ".\tools\shopges_ai\.venv"
        if (Test-Path $venvPython) {
            return
        }
    }

    $python = Get-Command python -ErrorAction SilentlyContinue
    if ($python) {
        & $python.Source -m venv ".\tools\shopges_ai\.venv"
        if (Test-Path $venvPython) {
            return
        }
    }

    throw "Python 3.11+ was not found. Install it first, then rerun this script."
}

if (-not (Test-Path $venvPython)) {
    New-ShopAiVirtualEnvironment
}

& $venvPython -m pip install -r ".\tools\shopges_ai\requirements.txt"
& $venvPython ".\tools\shopges_ai\app.py" --host 127.0.0.1 --port 7863
