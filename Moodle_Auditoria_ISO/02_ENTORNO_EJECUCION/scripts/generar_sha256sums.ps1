# Generador Oficial de Hashes SHA-256 para Expediente de Auditoría ISO Moodle 5.3
$baseDir = Split-Path -Parent (Split-Path -Parent $PSScriptRoot)
$outSums = Join-Path $baseDir '00_CONTROL_PROYECTO\SHA256SUMS.txt'

Write-Host "Calculando sumas de verificación criptográficas SHA-256..." -ForegroundColor Cyan

$files = @()
$files += Get-ChildItem -Recurse (Join-Path $baseDir '07_BACKUPS') -File | Where-Object { $_.Name -ne 'test.tar.gz' -and $_.Name -ne 'test.zip' }
$files += Get-ChildItem -Recurse (Join-Path $baseDir '06_EVIDENCIAS_INSTALACION\capturas') -File
$files += Get-ChildItem -Recurse (Join-Path $baseDir '04_DOCUMENTACION_OFICIAL') -Filter '*.pdf' -File
$files += Get-ChildItem (Join-Path $baseDir '00_CONTROL_PROYECTO') -Filter '*.pdf' -File
$files += Get-ChildItem (Join-Path $baseDir '00_CONTROL_PROYECTO') -Filter '*.txt' -File
$files += Get-ChildItem -Recurse (Join-Path $baseDir '09_AUDITORIA_ISO\LINEA_BASE_SEGURIDAD') -File

$manifestLines = @(
    '========================================================================================',
    ' MANIFIESTO CRIPTOGRÁFICO MAESTRO DE SUMAS DE VERIFICACIÓN SHA-256',
    ' PROYECTO: LABORATORIO Y EXPEDIENTE DE AUDITORÍA ISO - MOODLE 5.3.0',
    ' FECHA DE CÁLCULO: ' + (Get-Date -Format 'yyyy-MM-dd HH:mm:ss'),
    ' ALGORITMO: SHA-256 (NIST FIPS 180-4)',
    '========================================================================================',
    ''
)

foreach ($f in ($files | Sort-Object FullName)) {
    $hash = (Get-FileHash -Path $f.FullName -Algorithm SHA256).Hash
    $rel = $f.FullName.Substring($baseDir.Length + 1)
    $manifestLines += ('{0}  {1}  ({2} bytes)' -f $hash, $rel, $f.Length)
}

$manifestLines | Set-Content -Path $outSums -Encoding UTF8
Write-Host "Total archivos procesados: $($files.Count)" -ForegroundColor Green
Write-Host "Archivo maestro guardado en: $outSums" -ForegroundColor Green
Get-Content $outSums -TotalCount 30 | Write-Host
