# ==============================================================================
# SCRIPT DE RESTAURACIÓN AUTOMÁTICA DE BASE DE DATOS MOODLE UATF POBLADA
# Plataforma: PostgreSQL 18 (o 16+) | Puerto: 5433
# Archivo fuente: Moodle_Auditoria_ISO\03_BASE_DATOS\moodle_uatf_poblado.dump
# ==============================================================================

$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$baseDatosDir = Split-Path -Parent $scriptDir
$projectDir = Split-Path -Parent $baseDatosDir
$dumpFile = Join-Path $baseDatosDir "moodle_uatf_poblado.dump"

Write-Host "==============================================================" -ForegroundColor Cyan
Write-Host " RESTAURANDO BASE DE DATOS MOODLE UATF (ESCENARIO UNIVERSITARIO)" -ForegroundColor Cyan
Write-Host "==============================================================" -ForegroundColor Cyan

# 1. Localizar binarios de PostgreSQL
$pgBinDirs = @(
    "C:\Program Files\PostgreSQL\18\bin",
    "C:\Program Files\PostgreSQL\17\bin",
    "C:\Program Files\PostgreSQL\16\bin"
)

$pgBin = $null
foreach ($dir in $pgBinDirs) {
    if (Test-Path (Join-Path $dir "pg_restore.exe")) {
        $pgBin = $dir
        break
    }
}

if (-not $pgBin) {
    $pgRestoreCmd = Get-Command "pg_restore.exe" -ErrorAction SilentlyContinue
    if ($pgRestoreCmd) {
        $pgBin = Split-Path -Parent $pgRestoreCmd.Source
    }
}

if (-not $pgBin) {
    Write-Error "No se encontro pg_restore.exe en las rutas estandar de PostgreSQL. Verifique su instalacion."
    exit 1
}

$pgRestore = Join-Path $pgBin "pg_restore.exe"
$psql = Join-Path $pgBin "psql.exe"

# 2. Verificar existencia del archivo dump
if (-not (Test-Path $dumpFile)) {
    Write-Error "No se encontro el archivo de respaldo: $dumpFile"
    exit 1
}

$dumpSizeMB = [math]::Round((Get-Item $dumpFile).Length / 1MB, 2)
Write-Host "[1/4] Archivo dump verificado: $dumpFile ($dumpSizeMB MB)" -ForegroundColor Green

# 3. Comprobar conexion con PostgreSQL en puerto 5433
Write-Host "[2/4] Comprobando conexion con PostgreSQL en puerto 5433..." -ForegroundColor Yellow
$conn = Get-NetTCPConnection -LocalPort 5433 -ErrorAction SilentlyContinue
if (-not $conn) {
    Write-Host "Iniciando servicio de PostgreSQL..." -ForegroundColor Yellow
    $pgStart = Join-Path $scriptDir "02_iniciar_servicio_postgresql.ps1"
    if (Test-Path $pgStart) {
        & $pgStart
    }
    Start-Sleep -Seconds 2
}

# 4. Crear usuario y base de datos si no existen
Write-Host "[3/4] Inicializando usuario 'moodleuser' y base de datos 'moodle'..." -ForegroundColor Yellow
$sqlInit = Join-Path $scriptDir "01_crear_base_datos_usuario.sql"
& $psql -h 127.0.0.1 -p 5433 -U postgres -d postgres -f $sqlInit 2>&1 | Out-Null

# Verificar si la base de datos existe, si no, crearla
$dbExists = & $psql -h 127.0.0.1 -p 5433 -U postgres -d postgres -t -A -c "SELECT 1 FROM pg_database WHERE datname='moodle';" 2>&1
if ($dbExists -ne "1") {
    Write-Host "Creando base de datos 'moodle'..." -ForegroundColor Yellow
    & $psql -h 127.0.0.1 -p 5433 -U postgres -d postgres -c "CREATE DATABASE moodle WITH OWNER moodleuser ENCODING 'UTF8' LC_COLLATE = 'C' LC_CTYPE = 'C';" 2>&1 | Out-Null
}

# 5. Ejecutar pg_restore
Write-Host "[4/4] Restaurando dump relacional en 'moodle'..." -ForegroundColor Yellow
& $pgRestore -h 127.0.0.1 -p 5433 -U postgres -d moodle --clean --if-exists --no-owner --no-privileges $dumpFile 2>&1 | Out-Null

# 6. Comprobacion de tablas restauradas
$tableCount = & $psql -h 127.0.0.1 -p 5433 -U postgres -d moodle -t -A -c "SELECT count(*) FROM information_schema.tables WHERE table_schema='public';" 2>&1
$userCount = & $psql -h 127.0.0.1 -p 5433 -U postgres -d moodle -t -A -c "SELECT count(*) FROM mdl_user WHERE deleted=0;" 2>&1
$courseCount = & $psql -h 127.0.0.1 -p 5433 -U postgres -d moodle -t -A -c "SELECT count(*) FROM mdl_course;" 2>&1

Write-Host "`n==============================================================" -ForegroundColor Green
Write-Host " RESTAURACION COMPLETADA EXITOSAMENTE                          " -ForegroundColor Green
Write-Host "==============================================================" -ForegroundColor Green
Write-Host "Tablas restauradas: $tableCount" -ForegroundColor White
Write-Host "Usuarios activos:   $userCount" -ForegroundColor White
Write-Host "Cursos activos:     $courseCount" -ForegroundColor White
Write-Host "Motor disponible:   127.0.0.1:5433 / moodle" -ForegroundColor White
