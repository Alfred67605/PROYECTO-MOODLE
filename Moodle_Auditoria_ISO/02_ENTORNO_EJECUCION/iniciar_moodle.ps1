# Script Maestro de Inicio del Laboratorio Moodle 5.3 Auditoría ISO
$baseDir = Split-Path -Parent $PSScriptRoot
$moodleDir = Join-Path $baseDir "01_CODIGO_FUENTE\moodle\public"
$routerPath = Join-Path $PSScriptRoot "router.php"
$pgStartScript = Join-Path $baseDir "03_BASE_DATOS\scripts\02_iniciar_servicio_postgresql.ps1"
$phpLog = Join-Path $baseDir "06_EVIDENCIAS_INSTALACION\logs\php_webserver.log"

Write-Host "========================================================" -ForegroundColor Cyan
Write-Host " INICIANDO LABORATORIO MOODLE 5.3 (AUDITORÍA ISO)      " -ForegroundColor Cyan
Write-Host "========================================================" -ForegroundColor Cyan

# 1. Iniciar PostgreSQL 18
Write-Host "`n[1/2] Verificando e iniciando servicio PostgreSQL (Puerto 5433)..." -ForegroundColor Yellow
& $pgStartScript

# 2. Verificar si PHP Server ya está corriendo en puerto 8000
$port8000 = Get-NetTCPConnection -LocalPort 8000 -ErrorAction SilentlyContinue
if ($port8000) {
    Write-Host "`n[2/2] Servidor Web PHP ya se encuentra activo en http://localhost:8000" -ForegroundColor Green
} else {
    Write-Host "`n[2/2] Iniciando Servidor Web PHP en http://localhost:8000..." -ForegroundColor Yellow
    $phpProc = Start-Process -FilePath "php.exe" -ArgumentList "-S", "localhost:8000", "-t", "`"$moodleDir`"", "`"$routerPath`"" -WindowStyle Hidden -PassThru
    Set-Content -Path (Join-Path $PSScriptRoot "php_server_pid.txt") -Value $phpProc.Id
    Start-Sleep -Seconds 2
    $port8000 = Get-NetTCPConnection -LocalPort 8000 -ErrorAction SilentlyContinue
    if ($port8000) {
        Write-Host "Servidor Web PHP iniciado exitosamente (PID: $($phpProc.Id))." -ForegroundColor Green
    } else {
        Write-Error "Error al iniciar el servidor web PHP en el puerto 8000."
    }
}

Write-Host "`n========================================================" -ForegroundColor Cyan
Write-Host " SISTEMA DISPONIBLE LOCALMENTE EN:                     " -ForegroundColor Cyan
Write-Host " URL: http://localhost:8000                             " -ForegroundColor White
Write-Host "========================================================" -ForegroundColor Cyan
