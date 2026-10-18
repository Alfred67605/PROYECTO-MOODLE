# Script de Ejecución de Cron para Moodle 5.3 Laboratorio de Auditoría
$baseDir = Split-Path -Parent $PSScriptRoot
$cronScript = Join-Path $baseDir "01_CODIGO_FUENTE\moodle\admin\cli\cron.php"
$cronLog = Join-Path $baseDir "06_EVIDENCIAS_INSTALACION\logs\cron.log"

$timestamp = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
$banner = "`n========================================================`nCRON EJECUTADO: $timestamp`n========================================================"
Write-Host $banner -ForegroundColor Cyan
Add-Content -Path $cronLog -Value $banner -Encoding UTF8

if (-not (Test-Path $cronScript)) {
    Write-Error "El script cron.php no existe en $cronScript"
    exit 1
}

$output = & php.exe $cronScript 2>&1
$output | Out-String | Write-Host
$output | Out-String | Add-Content -Path $cronLog -Encoding UTF8

Write-Host "Ejecución de cron registrada exitosamente en: $cronLog" -ForegroundColor Green
