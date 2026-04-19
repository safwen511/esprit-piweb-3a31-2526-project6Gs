$ErrorActionPreference = 'Stop'

$root = Resolve-Path (Join-Path $PSScriptRoot '..\..')
Set-Location $root

$venvPython = ".\tools\shopges_ai\.venv\Scripts\python.exe"

if (-not (Test-Path $venvPython)) {
    $python311 = Join-Path $env:LocalAppData "Programs\Python\Python311\python.exe"
    if (-not (Test-Path $python311)) {
        throw "Python 3.11 was not found. Install it first, then rerun this script."
    }

    & $python311 -m venv ".\tools\shopges_ai\.venv"
}

& $venvPython -m pip install -r ".\tools\shopges_ai\requirements.txt"
& $venvPython ".\tools\shopges_ai\app.py" --host 127.0.0.1 --port 7863

