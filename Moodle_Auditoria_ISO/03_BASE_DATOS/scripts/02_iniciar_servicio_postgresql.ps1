# Script de inicio del motor PostgreSQL 18 para el Laboratorio de Auditoría Moodle
$baseDir = Split-Path -Parent (Split-Path -Parent $PSScriptRoot)
$pgData = Join-Path $baseDir "02_ENTORNO_EJECUCION\pgsql_data"
$pgBin = "C:\Program Files\PostgreSQL\18\bin"
$pgCtl = Join-Path $pgBin "pg_ctl.exe"
$pgLog = Join-Path $baseDir "06_EVIDENCIAS_INSTALACION\logs\postgresql_cluster.log"

Write-Host "Verificando estado del servidor PostgreSQL (Puerto 5433)..." -ForegroundColor Cyan

$conn = Get-NetTCPConnection -LocalPort 5433 -ErrorAction SilentlyContinue
if ($conn) {
    Write-Host "PostgreSQL ya se encuentra en ejecución en el puerto 5433." -ForegroundColor Green
    exit 0
}

Write-Host "Iniciando PostgreSQL 18 en $pgData..." -ForegroundColor Yellow
& $pgCtl -D $pgData -l $pgLog start

Start-Sleep -Seconds 2
$conn = Get-NetTCPConnection -LocalPort 5433 -ErrorAction SilentlyContinue
if ($conn) {
    Write-Host "PostgreSQL iniciado correctamente en el puerto 5433." -ForegroundColor Green
} else {
    Write-Error "Fallo al iniciar PostgreSQL. Consulte $pgLog"
}
