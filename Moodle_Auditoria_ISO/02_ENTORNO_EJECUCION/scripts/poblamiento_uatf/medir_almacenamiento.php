<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
global $DB;

$dbSize = $DB->get_field_sql("SELECT pg_size_pretty(pg_database_size('moodle'))");
$dbSizeBytes = $DB->get_field_sql("SELECT pg_database_size('moodle')");

function getDirSize($path) {
    $bytes = 0;
    if (!file_exists($path)) return 0;
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $file) {
        $bytes += $file->getSize();
    }
    return $bytes;
}

function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
}

$rootDir = realpath(__DIR__ . '/../../../');
$moodledataPath = $CFG->dataroot;
$pgsqlDataPath = $rootDir . '/02_ENTORNO_EJECUCION/pgsql_data';
$backupPath = $rootDir . '/07_BACKUPS/pre_poblamiento_uatf_20261018';

$moodledataBytes = getDirSize($moodledataPath);
$pgsqlDataBytes = getDirSize($pgsqlDataPath);
$backupBytes = getDirSize($backupPath);

echo "========================================================\n";
echo " MÉTRICAS DE ALMACENAMIENTO POST-POBLAMIENTO            \n";
echo "========================================================\n";
echo "Base de datos PostgreSQL 'moodle': $dbSize ($dbSizeBytes bytes)\n";
echo "Directorio físico pgsql_data: " . formatBytes($pgsqlDataBytes) . " ($pgsqlDataBytes bytes)\n";
echo "Directorio moodledata: " . formatBytes($moodledataBytes) . " ($moodledataBytes bytes)\n";
echo "Respaldo previo pre-poblamiento: " . formatBytes($backupBytes) . " ($backupBytes bytes)\n";
echo "========================================================\n";
