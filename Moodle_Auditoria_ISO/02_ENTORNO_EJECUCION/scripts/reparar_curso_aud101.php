<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->dirroot . '/course/lib.php');

global $DB;

echo "========================================================\n";
echo " REPARACIÓN DE VISIBILIDAD DE ACTIVIDADES CURSO AUD-101 \n";
echo "========================================================\n";

$courseId = 2;
$course = $DB->get_record('course', ['id' => $courseId], '*', MUST_EXIST);

// Obtener las secciones existentes del curso
$sections = $DB->get_records('course_sections', ['course' => $courseId], 'section ASC');
echo "Secciones encontradas:\n";
foreach ($sections as $s) {
    echo "  - Section num: {$s->section}, ID: {$s->id}, Sequence actual: '{$s->sequence}'\n";
}

// Módulos a reasignar correctamente:
// cmid 1 -> Avisos (Foro noticias) -> Section num 0 (General)
// cmid 2 -> Foro Académico -> Section num 1 (Tema 1)
// cmid 3 -> Tarea 1 -> Section num 2 (Tema 2)
// cmid 4 -> Cuestionario -> Section num 3 (Tema 3)

$mapping = [
    1 => 0, // cmid 1 -> section 0
    2 => 1, // cmid 2 -> section 1
    3 => 2, // cmid 3 -> section 2
    4 => 3, // cmid 4 -> section 3
];

// Asignar nombres descriptivos a las secciones si están vacíos
$sectionNames = [
    1 => 'Tema 1: Fundamentos y Marco Normativo ISO 19011',
    2 => 'Tema 2: Gestión de Riesgos y Controles ISO/IEC 27001 / 27002',
    3 => 'Tema 3: Evaluación y Diagnóstico Técnico de Auditoría',
    4 => 'Tema 4: Conclusiones y Dictamen de Auditoría'
];

foreach ($sectionNames as $snum => $sname) {
    if (isset($sections[$snum]) || $DB->record_exists('course_sections', ['course' => $courseId, 'section' => $snum])) {
        $DB->set_field('course_sections', 'name', $sname, ['course' => $courseId, 'section' => $snum]);
        echo "  [OK] Nombre asignado a Sección $snum: '$sname'\n";
    }
}

// Reasociar cada CM a su sección mediante la API nativa de Moodle
foreach ($mapping as $cmid => $targetSectionNum) {
    $cm = $DB->get_record('course_modules', ['id' => $cmid], '*', MUST_EXIST);
    $targetSec = $DB->get_record('course_sections', ['course' => $courseId, 'section' => $targetSectionNum], '*', MUST_EXIST);
    
    // Actualizar course_modules.section al ID de la sección
    $DB->set_field('course_modules', 'section', $targetSec->id, ['id' => $cmid]);
    
    // Asegurar que cmid esté en sequence de la sección
    $seqArray = array_filter(explode(',', trim($targetSec->sequence ?? '')));
    if (!in_array((string)$cmid, $seqArray)) {
        $seqArray[] = (string)$cmid;
        $newSeq = implode(',', $seqArray);
        $DB->set_field('course_sections', 'sequence', $newSeq, ['id' => $targetSec->id]);
        echo "  [OK] CMID $cmid agregado a la secuencia de Sección num $targetSectionNum (Sec ID: {$targetSec->id}, Sequence: '$newSeq')\n";
    } else {
        echo "  [INFO] CMID $cmid ya estaba en la secuencia de Sección num $targetSectionNum\n";
    }
}

// Limpiar y asegurar que Avisos (cmid 1) no esté duplicado en secciones
$sec0 = $DB->get_record('course_sections', ['course' => $courseId, 'section' => 0]);
$DB->set_field('course_sections', 'sequence', '1', ['id' => $sec0->id]);

// Reconstruir caché del curso y purgar caché de navegación
rebuild_course_cache($courseId, true);
purge_all_caches();

echo "\nCaché reconstruida y purgada exitosamente para el curso AUD-101.\n";

// Verificación final de secciones
$updatedSections = $DB->get_records('course_sections', ['course' => $courseId], 'section ASC');
echo "\nEstado final de secciones y secuencias:\n";
foreach ($updatedSections as $s) {
    echo "  - Section {$s->section} ('{$s->name}'): Sequence='{$s->sequence}', Visible={$s->visible}\n";
}
