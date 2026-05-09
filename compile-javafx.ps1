$ErrorActionPreference = 'Stop'

$javafxDir = Join-Path $PSScriptRoot 'esprit-piweb-3a31-2526-project6Gs-java\esprit-piweb-3a31-2526-project6Gs-java'

if (-not (Test-Path (Join-Path $javafxDir 'pom.xml'))) {
    throw "Could not find pom.xml in $javafxDir"
}

Push-Location $javafxDir
try {
    .\mvnw.cmd -DskipTests compile
} finally {
    Pop-Location
}
