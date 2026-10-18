<?php
/**
 * Procedimiento de Purga Limpia y Reversa de Datos Sintéticos UATF
 * Moodle 5.3 Laboratorio de Auditoría ISO
 * 
 * Este script retira EXCLUSIVAMENTE los registros sintéticos generados:
 * - Cursos con idnumber LIKE 'UATF-%' mediante delete_course()
 * - Cohortes con idnumber LIKE 'COH-%' mediante cohort_delete_cohort()
 * - Categorías bajo la raíz UATF mediante core_course_category::delete_full()
 * - Usuarios con username LIKE 'docente%' o 'estudiante%' con correo @example.invalid mediante user_delete_user()
 * 
 * CONSERVA INTACTAS:
 * - Cuentas admin_auditoria, profesor1, profesor2, estudiante1 a estudiante5.
 * - Curso AUD-101 y sus actividades originales.
 * - Configuración del sistema.
 */

define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/cohort/lib.php');
require_once($CFG->dirroot . '/user/lib.php');

global $DB;

$options = getopt('', ['confirm::']);
if (!isset($options['confirm'])) {
    echo "=================================================================\n";
    echo " ADVERTENCIA: MODO DE SIMULACIÓN / CONFIRMACIÓN REQUERIDA        \n";
    echo "=================================================================\n";
    echo "Este script eliminará los 500 cursos sintéticos, 48 cohortes y  \n";
    echo "los 2.650 usuarios generados para la simulación UATF.            \n";
    echo "Para ejecutar la purga definitiva, use:\n";
    echo "  php purgar_carga_sintetica_uatf.php --confirm=1\n";
    echo "=================================================================\n";
    exit(0);
}

echo "Iniciando purga limpia de datos sintéticos UATF...\n";

// 1. Eliminar Cursos Sintéticos
$courses = $DB->get_records_sql("SELECT id FROM {course} WHERE idnumber LIKE 'UATF-%'");
$cCount = 0;
foreach ($courses as $c) {
    delete_course($c->id, false);
    $cCount++;
}
echo "Cursos sintéticos eliminados: $cCount\n";

// 2. Eliminar Cohortes Sintéticas
$cohorts = $DB->get_records_sql("SELECT id FROM {cohort} WHERE idnumber LIKE 'COH-%'");
$cohCount = 0;
foreach ($cohorts as $coh) {
    cohort_delete_cohort($coh);
    $cohCount++;
}
echo "Cohortes sintéticas eliminadas: $cohCount\n";

// 3. Eliminar Categorías Creadas
$uatfRoot = $DB->get_record('course_categories', ['name' => 'Universidad Autónoma Tomás Frías (UATF)']);
if ($uatfRoot) {
    $cat = core_course_category::get($uatfRoot->id);
    if ($cat) {
        $cat->delete_full(false);
        echo "Árbol de categorías UATF eliminado correctamente.\n";
    }
}

// 4. Eliminar Usuarios Sintéticos
$users = $DB->get_records_sql("
    SELECT id, username FROM {user} 
    WHERE (username LIKE 'docente%' OR username LIKE 'estudiante%') 
    AND email LIKE '%@example.invalid'
");
$uCount = 0;
foreach ($users as $u) {
    user_delete_user($u);
    $uCount++;
}
echo "Usuarios sintéticos purgados: $uCount\n";

echo "Purga finalizada. Cuentas originales y curso AUD-101 intactos.\n";
