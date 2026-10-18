# Script para detener de manera limpia el motor PostgreSQL de auditoría
$baseDir = Split-Path -Parent (Split-Path -Parent $PSScriptRoot)
$pgData = Join-Path $baseDir "02_ENTORNO_EJECUCION\pgsql_data"
$pgBin = "C:\Program Files\PostgreSQL\18\bin"
$pgCtl = Join-Path $pgBin "pg_ctl.exe"

Write-Host "Deteniendo cluster PostgreSQL en $pgData..." -ForegroundColor Yellow
& $pgCtl -D $pgData stop -m fast
Write-Host "Servicio PostgreSQL detenido correctamente." -ForegroundColor Green
