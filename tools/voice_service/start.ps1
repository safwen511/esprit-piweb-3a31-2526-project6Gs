param(
    [string]$BindHost = '127.0.0.1',
    [int]$Port = 5001
)

$ErrorActionPreference = 'Stop'

$root = Resolve-Path (Join-Path $PSScriptRoot '..\..')
Set-Location $root

$runtimeTempDir = ".\var\voice_runtime_tmp"

if (-not (Test-Path $runtimeTempDir)) {
    New-Item -ItemType Directory -Path $runtimeTempDir -Force | Out-Null
}

$runtimeTempPath = (Resolve-Path $runtimeTempDir).Path
$env:TEMP = $runtimeTempPath
$env:TMP = $runtimeTempPath

function Resolve-PythonExecutable {
    $python311 = Join-Path $env:LocalAppData "Programs\Python\Python311\python.exe"
    if (Test-Path $python311) {
        return $python311
    }

    $python313 = Join-Path $env:LocalAppData "Programs\Python\Python313\python.exe"
    if (Test-Path $python313) {
        return $python313
    }

    $python = Get-Command python -ErrorAction SilentlyContinue
    if ($python) {
        return $python.Source
    }

    throw "Python was not found. Install Python, then rerun this script."
}

$pythonExecutable = Resolve-PythonExecutable

& $pythonExecutable -m pip --disable-pip-version-check show fastapi uvicorn numpy scipy soundfile python-multipart *> $null
if ($LASTEXITCODE -ne 0) {
    & $pythonExecutable -m pip install --disable-pip-version-check --user fastapi uvicorn numpy scipy soundfile python-multipart
}

& $pythonExecutable -m uvicorn voice_service:app --host $BindHost --port $Port --app-dir $root
