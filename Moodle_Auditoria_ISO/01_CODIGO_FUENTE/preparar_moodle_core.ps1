# ==============================================================================
# SCRIPT DE DESCARGA Y CONFIGURACIÓN DEL NÚCLEO MOODLE 5.3 (LMS)
# Descarga la versión oficial v5.3.0 de Moodle HQ y enlaza config.php
# ==============================================================================

$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$moodleTarget = Join-Path $scriptDir "moodle"
$configSource = Join-Path $scriptDir "config.php"
$configDest = Join-Path $moodleTarget "config.php"

Write-Host "==============================================================" -ForegroundColor Cyan
Write-Host " PREPARACIÓN DEL CÓDIGO FUENTE MOODLE 5.3 (MOODLE HQ OFICIAL)" -ForegroundColor Cyan
Write-Host "==============================================================" -ForegroundColor Cyan

if (Test-Path (Join-Path $moodleTarget "version.php")) {
    Write-Host "[OK] El código fuente de Moodle ya se encuentra disponible en $moodleTarget" -ForegroundColor Green
} else {
    Write-Host "[1/2] Clonando repositorio oficial de Moodle (tag v5.3.0)..." -ForegroundColor Yellow
    git clone --depth 1 -b v5.3.0 https://github.com/moodle/moodle.git "$moodleTarget"
    if ($LASTEXITCODE -ne 0) {
        Write-Error "Fallo la clonación de Moodle. Verifique su conexión a Internet o comando git."
        exit 1
    }
    Write-Host "[OK] Núcleo de Moodle 5.3 clonado exitosamente." -ForegroundColor Green
}

# Copiar config.php configurado
Write-Host "[2/2] Instalando configuración optimizada (config.php)..." -ForegroundColor Yellow
if (Test-Path $configSource) {
    Copy-Item -Path $configSource -Destination $configDest -Force
    Write-Host "[OK] Archivo config.php instalado en $configDest" -ForegroundColor Green
} else {
    Write-Warning "No se encontró $configSource. Verifique el archivo de configuración."
}

Write-Host "`n==============================================================" -ForegroundColor Cyan
Write-Host " NÚCLEO MOODLE PREPARADO Y LISTO PARA EJECUCIÓN              " -ForegroundColor Cyan
Write-Host "==============================================================" -ForegroundColor Cyan
