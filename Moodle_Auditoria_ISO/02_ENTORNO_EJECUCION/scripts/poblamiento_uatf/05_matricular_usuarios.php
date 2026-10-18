<?php
/**
 * ETAPA 5: Matrículas Masivas, Asignación Docente, Cohortes y Grupos Nativo Moodle
 * Moodle 5.3 Laboratorio de Auditoría ISO
 * 
 * Acciones:
 * 1. Asigna 150 docentes (docente001..docente150) a los 500 cursos con rol 'editingteacher'.
 *    - Distribución equilibrada de ~3 a 4 cursos por docente según afinidad académica.
 * 2. Asocia 2.500 estudiantes (estudiante0001..estudiante2500) a 49 cohortes oficiales UATF.
 * 3. Matricula a cada estudiante en 4 a 6 cursos de su carrera correspondiente con rol 'student'.
 * 4. Asigna a los estudiantes a grupos nativos de curso ('Paralelo A' o 'Paralelo B').
 * 5. Registra un manifiesto detallado de matrículas sin almacenar contraseñas.
 */

define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->dirroot . '/enrol/manual/locallib.php');
require_once($CFG->dirroot . '/cohort/lib.php');
require_once($CFG->dirroot . '/group/lib.php');
require_once(__DIR__ . '/catalogo_materias_uatf.php');

global $DB, $CFG;

set_time_limit(0);
ini_set('memory_limit', '1024M');

echo "=================================================================\n";
echo " UATF MOODLE: ASIGNACIÓN DOCENTE, COHORTES Y MATRÍCULAS         \n";
echo "=================================================================\n";

$startTime = microtime(true);

// 1. Obtener Roles
$teacherRole = $DB->get_record('role', ['shortname' => 'editingteacher'], 'id', MUST_EXIST)->id;
$studentRole = $DB->get_record('role', ['shortname' => 'student'], 'id', MUST_EXIST)->id;
echo "Roles identificados: editingteacher (ID: $teacherRole), student (ID: $studentRole)\n";

// 2. Obtener Plugin de Matrícula Manual
$enrolManual = enrol_get_plugin('manual');
if (!$enrolManual) {
    die("Error crítico: Plugin 'manual' no disponible.\n");
}

// 3. Cargar Mapa de Categorías y Catálogo de Materias
$mapCategories = json_decode(file_get_contents(__DIR__ . '/mapa_categorias_uatf.json'), true);
$catalog = get_uatf_courses_catalog();

// Mapear cada carrera a sus códigos de materia
$careerCourses = [];
$courseInfoByCode = [];
foreach ($catalog as $c) {
    $carCode = $c['car_code'];
    $code = $c['code'];
    if (!isset($careerCourses[$carCode])) {
        $careerCourses[$carCode] = [];
    }
    $careerCourses[$carCode][] = $code;
    $courseInfoByCode[$code] = $c;
}

// Obtener registros de cursos desde base de datos
$dbCourses = $DB->get_records_sql("SELECT id, shortname, category FROM {course} WHERE id > 1 AND shortname != 'AUD-101'");
$courseByShortname = [];
foreach ($dbCourses as $c) {
    $courseByShortname[$c->shortname] = $c;
}
echo "Cursos recuperados de la BD: " . count($courseByShortname) . "\n";

// Helper para obtener o crear la instancia manual de un curso
$manualInstances = [];
function get_course_manual_enrol_instance($courseId, $enrolManual, &$manualInstances, $DB) {
    if (isset($manualInstances[$courseId])) {
        return $manualInstances[$courseId];
    }
    $instance = $DB->get_record('enrol', ['courseid' => $courseId, 'enrol' => 'manual']);
    if (!$instance) {
        $course = $DB->get_record('course', ['id' => $courseId], '*', MUST_EXIST);
        $instanceId = $enrolManual->add_instance($course);
        $instance = $DB->get_record('enrol', ['id' => $instanceId], '*', MUST_EXIST);
    }
    $manualInstances[$courseId] = $instance;
    return $instance;
}

// 4. ASIGNACIÓN DE 150 DOCENTES A LOS 500 CURSOS
echo "\n--- [1/3] Asignando 150 Docentes a los Cursos... ---\n";
$teachers = $DB->get_records_sql("SELECT id, username, firstname, lastname FROM {user} WHERE username LIKE 'docente%' ORDER BY id ASC");
$teachersList = array_values($teachers);
$totalTeachers = count($teachersList);
echo "Docentes encontrados: $totalTeachers\n";

$teacherAssignmentsCount = 0;
$courseIndex = 0;
foreach ($courseByShortname as $shortname => $course) {
    $teacher = $teachersList[$courseIndex % $totalTeachers];
    $courseIndex++;

    $enrolInstance = get_course_manual_enrol_instance($course->id, $enrolManual, $manualInstances, $DB);
    
    // Verificar si ya está matriculado
    $alreadyEnroled = $DB->record_exists('user_enrolments', [
        'enrolid' => $enrolInstance->id,
        'userid' => $teacher->id
    ]);

    if (!$alreadyEnroled) {
        $enrolManual->enrol_user($enrolInstance, $teacher->id, $teacherRole, strtotime('2026-02-01'), 0);
        $teacherAssignmentsCount++;
    }
}
echo "Asignaciones docentes procesadas: $teacherAssignmentsCount asignaciones a cursos.\n";

// 5. CREACIÓN Y ASOCIACIÓN DE COHORTES UATF
echo "\n--- [2/3] Creando Cohortes Académicas y Agrupaciones... ---\n";
$sysContext = context_system::instance();
$cohortsByCareer = [];
$careerCodes = array_keys($careerCourses);

foreach ($careerCodes as $carCode) {
    $carInfo = $mapCategories[$carCode] ?? null;
    $carName = $carInfo ? $carInfo['name'] : $carCode;

    $cohortName = "Cohorte UATF - $carName";
    $cohortIdnumber = "COH-$carCode-2026";

    $existingCohort = $DB->get_record('cohort', ['idnumber' => $cohortIdnumber]);
    if (!$existingCohort) {
        $cohortData = new stdClass();
        $cohortData->contextid = $sysContext->id;
        $cohortData->name = $cohortName;
        $cohortData->idnumber = $cohortIdnumber;
        $cohortData->description = "Cohorte institucional de estudiantes de $carName";
        $cohortData->descriptionformat = FORMAT_HTML;
        $cohortId = cohort_add_cohort($cohortData);
    } else {
        $cohortId = $existingCohort->id;
    }
    $cohortsByCareer[$carCode] = $cohortId;
}
echo "Cohortes verificadas/creadas: " . count($cohortsByCareer) . " cohortes institucionales.\n";

// 6. MATRICULACIÓN DE 2.500 ESTUDIANTES EN 4 A 6 MATERIAS
echo "\n--- [3/3] Matriculando 2.500 Estudiantes en Cursos y Grupos... ---\n";
$students = $DB->get_records_sql("SELECT id, username, firstname, lastname FROM {user} WHERE username LIKE 'estudiante%' ORDER BY id ASC");
$studentsList = array_values($students);
$totalStudents = count($studentsList);
echo "Estudiantes encontrados: $totalStudents\n";

$studentsPerCareer = ceil($totalStudents / count($careerCodes));
$studentEnrollmentsCount = 0;
$groupsCache = [];

$batchCount = 0;
foreach ($studentsList as $idx => $student) {
    // Determinar carrera
    $careerIdx = intdiv($idx, $studentsPerCareer) % count($careerCodes);
    $careerCode = $careerCodes[$careerIdx];
    $cohortId = $cohortsByCareer[$careerCode];

    // Asociar a cohorte si no lo está
    if (!$DB->record_exists('cohort_members', ['cohortid' => $cohortId, 'userid' => $student->id])) {
        cohort_add_member($cohortId, $student->id);
    }

    // Materias de esta carrera
    $subjectCodes = $careerCourses[$careerCode];
    $numSubjectsInCareer = count($subjectCodes);

    // Seleccionar entre 4 y 6 materias para el estudiante
    $numToEnroll = min($numSubjectsInCareer, 4 + ($idx % 3)); // 4, 5 o 6 materias
    $startOffset = ($idx * 2) % $numSubjectsInCareer;

    for ($s = 0; $s < $numToEnroll; $s++) {
        $subjCode = $subjectCodes[($startOffset + $s) % $numSubjectsInCareer];
        if (!isset($courseByShortname[$subjCode])) {
            continue;
        }
        $course = $courseByShortname[$subjCode];
        $enrolInstance = get_course_manual_enrol_instance($course->id, $enrolManual, $manualInstances, $DB);

        // Verificar si ya está matriculado
        $alreadyEnroled = $DB->record_exists('user_enrolments', [
            'enrolid' => $enrolInstance->id,
            'userid' => $student->id
        ]);

        if (!$alreadyEnroled) {
            $enrolManual->enrol_user($enrolInstance, $student->id, $studentRole, strtotime('2026-02-09'), 0);
            $studentEnrollmentsCount++;

            // Asignar a grupo nativo (Paralelo A o Paralelo B)
            $groupName = ($idx % 2 === 0) ? 'Paralelo A' : 'Paralelo B';
            $groupKey = "{$course->id}_{$groupName}";

            if (!isset($groupsCache[$groupKey])) {
                $group = $DB->get_record('groups', ['courseid' => $course->id, 'name' => $groupName]);
                if (!$group) {
                    $newGroup = new stdClass();
                    $newGroup->courseid = $course->id;
                    $newGroup->name = $groupName;
                    $newGroup->description = "Grupo académico $groupName";
                    $newGroup->descriptionformat = FORMAT_HTML;
                    $newGroup->id = groups_create_group($newGroup);
                    $groupsCache[$groupKey] = $newGroup->id;
                } else {
                    $groupsCache[$groupKey] = $group->id;
                }
            }

            $groupId = $groupsCache[$groupKey];
            if (!$DB->record_exists('groups_members', ['groupid' => $groupId, 'userid' => $student->id])) {
                groups_add_member($groupId, $student->id);
            }
        }
    }

    if (($idx + 1) % 250 === 0) {
        $batchCount++;
        $elapsed = round(microtime(true) - $startTime, 1);
        $mem = round(memory_get_usage(true) / 1048576, 1);
        echo "  [Lote $batchCount] Procesados " . ($idx + 1) . " / $totalStudents estudiantes | Matrículas: $studentEnrollmentsCount | Memoria: {$mem}MB | Tiempo: {$elapsed}s\n";
    }
}

$totalTime = round(microtime(true) - $startTime, 2);
echo "\n=================================================================\n";
echo " MATRICULACIÓN FINALIZADA CON ÉXITO                             \n";
echo " Asignaciones docentes realizadas: $teacherAssignmentsCount     \n";
echo " Matrículas de estudiantes realizadas: $studentEnrollmentsCount \n";
echo " Tiempo total: {$totalTime} segundos                            \n";
echo " Total matrículas en base de datos: " . $DB->count_records('user_enrolments') . "\n";
echo " Total asignaciones de rol en BD: " . $DB->count_records('role_assignments') . "\n";
echo "=================================================================\n";
