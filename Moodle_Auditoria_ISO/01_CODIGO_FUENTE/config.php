<?php  // Moodle configuration file - Laboratorio Auditoria ISO
unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'pgsql';
$CFG->dblibrary = 'native';
$CFG->dbhost    = '127.0.0.1';
$CFG->dbname    = 'moodle';
$CFG->dbuser    = 'moodleuser';
$CFG->dbpass    = 'Moodle_Audit_2026_Secure!';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => 5433,
  'dbsocket' => '',
);

$CFG->wwwroot   = 'http://localhost:8000';
// Calculo portable y dinamico de la ruta de moodledata relativo al directorio raiz del proyecto
$CFG->dataroot  = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . '02_ENTORNO_EJECUCION' . DIRECTORY_SEPARATOR . 'moodledata';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 02777;

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
