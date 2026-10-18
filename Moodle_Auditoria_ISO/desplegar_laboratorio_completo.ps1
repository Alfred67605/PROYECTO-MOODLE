# ==============================================================================
# DESPLIEGUE AUTOMÁTICO COMPLETO DEL LABORATORIO MOODLE AUDITORÍA ISO
# Ejecuta la preparación del núcleo, restauración de BD y encendido del sistema
# ==============================================================================

$projectDir = Split-Path -Parent $MyInvocation.MyCommand.Path

Write-Host "==================================================================" -ForegroundColor Cyan
Write-Host " INICIANDO DESPLIEGUE COMPLETO - LABORATORIO MOODLE 5.3 ISO      " -ForegroundColor Cyan
Write-Host "==================================================================" -ForegroundColor Cyan

# 1. Preparar Código Fuente Moodle Core
$prepCore = Join-Path $projectDir "01_CODIGO_FUENTE\preparar_moodle_core.ps1"
if (Test-Path $prepCore) {
    Write-Host "`n>>> [FASE 1/3] Verificando núcleo de Moodle 5.3..." -ForegroundColor Yellow
    & powershell -ExecutionPolicy Bypass -File $prepCore
}

# 2. Restaurar Base de Datos con Escenario Universitario UATF
$restoreDb = Join-Path $projectDir "03_BASE_DATOS\scripts\04_restaurar_base_datos_poblada.ps1"
if (Test-Path $restoreDb) {
    Write-Host "`n>>> [FASE 2/3] Restaurando base de datos poblada UATF..." -ForegroundColor Yellow
    & powershell -ExecutionPolicy Bypass -File $restoreDb
}

# 3. Iniciar Servicios (PostgreSQL + Servidor Web PHP)
$startMoodle = Join-Path $projectDir "02_ENTORNO_EJECUCION\iniciar_moodle.ps1"
if (Test-Path $startMoodle) {
    Write-Host "`n>>> [FASE 3/3] Iniciando servicios de ejecución..." -ForegroundColor Yellow
    & powershell -ExecutionPolicy Bypass -File $startMoodle
}

Write-Host "`n==================================================================" -ForegroundColor Green
Write-Host " LABORATORIO DESPLEGADO Y LISTO PARA AUDITORÍA                   " -ForegroundColor Green
Write-Host " URL: http://localhost:8000                                      " -ForegroundColor White
Write-Host " Admin:     admin_auditoria / X%RDN5bnFyqPG@6+U&                 " -ForegroundColor White
Write-Host " Docente:   profesor1       / =YKvHz$nxsws5b@VYI                 " -ForegroundColor White
Write-Host " Alumno:    estudiante1     / Zg*Ya4mQBfy%NSHkKA                 " -ForegroundColor White
Write-Host "==================================================================" -ForegroundColor Green
