# Script Maestro de Parada del Laboratorio Moodle 5.3 Auditoría ISO
$baseDir = Split-Path -Parent $PSScriptRoot
$pgStopScript = Join-Path $baseDir "03_BASE_DATOS\scripts\03_detener_servicio_postgresql.ps1"
$pidFile = Join-Path $PSScriptRoot "php_server_pid.txt"

Write-Host "========================================================" -ForegroundColor Cyan
Write-Host " DETENIENDO LABORATORIO MOODLE 5.3 (AUDITORÍA ISO)     " -ForegroundColor Cyan
Write-Host "========================================================" -ForegroundColor Cyan

# 1. Detener Servidor Web PHP
Write-Host "`n[1/2] Deteniendo Servidor Web PHP (Puerto 8000)..." -ForegroundColor Yellow
if (Test-Path $pidFile) {
    $procId = Get-Content $pidFile
    $proc = Get-Process -Id $procId -ErrorAction SilentlyContinue
    if ($proc) {
        Stop-Process -Id $procId -Force
        Write-Host "Proceso PHP (PID $procId) detenido." -ForegroundColor Green
    }
    Remove-Item $pidFile -Force -ErrorAction SilentlyContinue
}

# Detener cualquier proceso PHP en puerto 8000
$port8000 = Get-NetTCPConnection -LocalPort 8000 -ErrorAction SilentlyContinue
if ($port8000) {
    foreach ($c in $port8000) {
        Stop-Process -Id $c.OwningProcess -Force -ErrorAction SilentlyContinue
    }
    Write-Host "Puerto 8000 liberado." -ForegroundColor Green
}

# 2. Detener PostgreSQL
Write-Host "`n[2/2] Deteniendo servicio PostgreSQL 18..." -ForegroundColor Yellow
& $pgStopScript

Write-Host "`n========================================================" -ForegroundColor Cyan
Write-Host " TODOS LOS SERVICIOS HAN SIDO DETENIDOS LIMPIAMENTE    " -ForegroundColor Green
Write-Host "========================================================" -ForegroundColor Cyan
