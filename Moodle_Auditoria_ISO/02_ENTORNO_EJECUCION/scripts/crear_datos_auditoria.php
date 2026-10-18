<?php
/**
 * Script de Poblado de Datos de Prueba para Moodle 5.3 Laboratorio de Auditoría ISO
 * Crea categoría ficticia, curso AUD-101, profesores, estudiantes, matriculaciones,
 * módulos de actividad (foro, tarea, cuestionario), calificaciones y eventos de log.
 */

define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->libdir . '/clilib.php');
require_once($CFG->dirroot . '/user/lib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/lib/enrollib.php');
require_once($CFG->dirroot . '/lib/accesslib.php');
require_once($CFG->dirroot . '/mod/forum/lib.php');
require_once($CFG->dirroot . '/mod/assign/lib.php');
require_once($CFG->dirroot . '/mod/quiz/lib.php');

global $DB, $CFG;

echo "========================================================\n";
echo " POBLANDO DATOS DE PRUEBA: AUDITORÍA ISO (MOODLE 5.3)\n";
echo "========================================================\n";

// 1. Crear o recuperar Categoría de Curso
$catName = 'Facultad de Auditoría y Seguridad de la Información';
$category = $DB->get_record('course_categories', ['name' => $catName]);
if (!$category) {
    echo "[1/7] Creando categoría ficticia: $catName...\n";
    $catData = new stdClass();
    $catData->name = $catName;
    $catData->idnumber = 'FAC-AUD';
    $catData->description = 'Categoría académica exclusiva para laboratorio y pruebas de auditoría ISO.';
    $catData->descriptionformat = FORMAT_HTML;
    $category = core_course_category::create($catData);
    $categoryId = $category->id;
} else {
    echo "[1/7] Categoría ya existe (ID: {$category->id}).\n";
    $categoryId = $category->id;
}

// 2. Crear o recuperar Curso AUD-101
$courseShortname = 'AUD-101';
$course = $DB->get_record('course', ['shortname' => $courseShortname]);
if (!$course) {
    echo "[2/7] Creando curso de prueba: AUD-101...\n";
    $courseData = new stdClass();
    $courseData->fullname = 'AUD-101 Auditoría de Sistemas de Información';
    $courseData->shortname = $courseShortname;
    $courseData->idnumber = 'AUD101-2026';
    $courseData->category = $categoryId;
    $courseData->summary = 'Curso de laboratorio para evaluación de cumplimiento, control de accesos, roles y registros de auditoría ISO 19011 e ISO/IEC 27001.';
    $courseData->summaryformat = FORMAT_HTML;
    $courseData->format = 'topics';
    $courseData->numsections = 4;
    $courseData->startdate = time() - (86400 * 30);
    $courseData->visible = 1;
    $course = create_course($courseData);
    $courseId = $course->id;
} else {
    echo "[2/7] Curso ya existe (ID: {$course->id}).\n";
    $courseId = $course->id;
}

$courseContext = context_course::instance($courseId);

// 3. Crear Usuarios Ficticios (2 Profesores, 5 Estudiantes)
$testUsers = [
    // Profesores
    [
        'username' => 'profesor1',
        'firstname' => 'Carlos M.',
        'lastname' => 'Mendoza',
        'email' => 'profesor1.audit@laboratorio.local',
        'role' => 'editingteacher',
        'roleid' => 3
    ],
    [
        'username' => 'profesor2',
        'firstname' => 'Elena R.',
        'lastname' => 'Valenzuela',
        'email' => 'profesor2.audit@laboratorio.local',
        'role' => 'editingteacher',
        'roleid' => 3
    ],
    // Estudiantes
    [
        'username' => 'estudiante1',
        'firstname' => 'Mateo',
        'lastname' => 'Morales',
        'email' => 'estudiante1.audit@laboratorio.local',
        'role' => 'student',
        'roleid' => 5
    ],
    [
        'username' => 'estudiante2',
        'firstname' => 'Sofía',
        'lastname' => 'Benítez',
        'email' => 'estudiante2.audit@laboratorio.local',
        'role' => 'student',
        'roleid' => 5
    ],
    [
        'username' => 'estudiante3',
        'firstname' => 'Lucas',
        'lastname' => 'Fernández',
        'email' => 'estudiante3.audit@laboratorio.local',
        'role' => 'student',
        'roleid' => 5
    ],
    [
        'username' => 'estudiante4',
        'firstname' => 'Valentina',
        'lastname' => 'Cruz',
        'email' => 'estudiante4.audit@laboratorio.local',
        'role' => 'student',
        'roleid' => 5
    ],
    [
        'username' => 'estudiante5',
        'firstname' => 'Joaquín',
        'lastname' => 'Silva',
        'email' => 'estudiante5.audit@laboratorio.local',
        'role' => 'student',
        'roleid' => 5
    ]
];

$userObjects = [];
$defaultPassword = 'AuditLab_2026!Pass';

echo "[3/7] Creando y verificando usuarios ficticios de laboratorio...\n";
foreach ($testUsers as $userData) {
    $existing = $DB->get_record('user', ['username' => $userData['username'], 'mnethostid' => $CFG->mnet_localhost_id]);
    if (!$existing) {
        $newUser = new stdClass();
        $newUser->auth = 'manual';
        $newUser->confirmed = 1;
        $newUser->mnethostid = $CFG->mnet_localhost_id;
        $newUser->username = $userData['username'];
        $newUser->password = hash_internal_user_password($defaultPassword);
        $newUser->firstname = $userData['firstname'];
        $newUser->lastname = $userData['lastname'];
        $newUser->email = $userData['email'];
        $newUser->city = 'Laboratorio Central';
        $newUser->country = 'ES';
        $newUser->lang = 'es';
        $newUser->timezone = '99';
        $newUser->timecreated = time();
        $newUser->timemodified = time();
        $userId = user_create_user($newUser, false, false);
        $userObj = $DB->get_record('user', ['id' => $userId]);
        echo "  - Creado usuario: {$userData['username']} (ID: $userId)\n";
    } else {
        $userObj = $existing;
        echo "  - Usuario existente: {$userData['username']} (ID: {$existing->id})\n";
    }
    $userData['userobj'] = $userObj;
    $userObjects[$userData['username']] = $userData;
}

// 4. Matricular Usuarios en Curso AUD-101
echo "[4/7] Matriculando usuarios en el curso AUD-101...\n";
$enrolInstances = enrol_get_instances($courseId, true);
$manualEnrol = null;
foreach ($enrolInstances as $instance) {
    if ($instance->enrol === 'manual') {
        $manualEnrol = $instance;
        break;
    }
}

if (!$manualEnrol) {
    $enrolPlugin = enrol_get_plugin('manual');
    $manualEnrolId = $enrolPlugin->add_instance($DB->get_record('course', ['id' => $courseId]));
    $manualEnrol = $DB->get_record('enrol', ['id' => $manualEnrolId]);
}

$enrolManualPlugin = enrol_get_plugin('manual');
foreach ($userObjects as $uname => $uinfo) {
    $uObj = $uinfo['userobj'];
    $roleId = $uinfo['roleid'];
    
    // Matricular si no está matriculado
    if (!is_enrolled($courseContext, $uObj->id)) {
        $enrolManualPlugin->enrol_user($manualEnrol, $uObj->id, $roleId, 0, 0);
        echo "  - Matriculado {$uname} con rol {$uinfo['role']} (Role ID: $roleId)\n";
    } else {
        role_assign($roleId, $uObj->id, $courseContext->id);
        echo "  - Rol verificado para {$uname}\n";
    }
}

// 5. Crear Foro de Discusión en AUD-101
echo "[5/7] Verificando módulo de Foro...\n";
$forum = $DB->get_record('forum', ['course' => $courseId, 'name' => 'Foro Académico: Discusión ISO 19011']);
if (!$forum) {
    $forum = new stdClass();
    $forum->course = $courseId;
    $forum->name = 'Foro Académico: Discusión ISO 19011';
    $forum->intro = '<p>Espacio de debate sobre la aplicación de directrices para la auditoría de sistemas de gestión según ISO 19011:2026.</p>';
    $forum->introformat = FORMAT_HTML;
    $forum->type = 'general';
    $forum->assessed = 0;
    $forum->scale = 100;
    $forum->timemodified = time();
    $forumId = $DB->insert_record('forum', $forum);
    $forum->id = $forumId;
    
    // Crear Course Module
    $cm = new stdClass();
    $cm->course = $courseId;
    $cm->module = $DB->get_field('modules', 'id', ['name' => 'forum']);
    $cm->instance = $forumId;
    $cm->section = 1;
    $cm->added = time();
    $cmId = $DB->insert_record('course_modules', $cm);
    
    // Reconstruir caché de curso
    rebuild_course_cache($courseId);
    echo "  - Creado foro: {$forum->name} (ID: $forumId, CMID: $cmId)\n";
} else {
    echo "  - Foro ya existe (ID: {$forum->id})\n";
}

// 6. Crear Tarea (Assignment) en AUD-101
echo "[6/7] Verificando módulo de Tarea...\n";
$assign = $DB->get_record('assign', ['course' => $courseId, 'name' => 'Tarea 1: Matriz de Control de Riesgos ISO 27001']);
if (!$assign) {
    $assign = new stdClass();
    $assign->course = $courseId;
    $assign->name = 'Tarea 1: Matriz de Control de Riesgos ISO 27001';
    $assign->intro = '<p>Elabore y cargue la matriz de riesgos y controles de seguridad alineada a ISO/IEC 27001 e ISO/IEC 27002.</p>';
    $assign->introformat = FORMAT_HTML;
    $assign->alwaysshowdescription = 1;
    $assign->submissiondrafts = 0;
    $assign->requiresubmissionstatement = 0;
    $assign->sendnotifications = 0;
    $assign->sendlatenotifications = 0;
    $assign->duedate = time() + (86400 * 7);
    $assign->cutoffdate = 0;
    $assign->gradingduedate = time() + (86400 * 14);
    $assign->allowsubmissionsfromdate = time() - 3600;
    $assign->grade = 100;
    $assign->timemodified = time();
    $assignId = $DB->insert_record('assign', $assign);
    $assign->id = $assignId;

    // Course module para la tarea
    $cm = new stdClass();
    $cm->course = $courseId;
    $cm->module = $DB->get_field('modules', 'id', ['name' => 'assign']);
    $cm->instance = $assignId;
    $cm->section = 2;
    $cm->added = time();
    $cmId = $DB->insert_record('course_modules', $cm);

    rebuild_course_cache($courseId);
    echo "  - Creada tarea: {$assign->name} (ID: $assignId, CMID: $cmId)\n";
} else {
    echo "  - Tarea ya existe (ID: {$assign->id})\n";
}

// 7. Crear Cuestionario (Quiz) en AUD-101
echo "[7/7] Verificando módulo de Cuestionario...\n";
$quiz = $DB->get_record('quiz', ['course' => $courseId, 'name' => 'Cuestionario Diagnóstico: Principios de Auditoría']);
if (!$quiz) {
    $quiz = new stdClass();
    $quiz->course = $courseId;
    $quiz->name = 'Cuestionario Diagnóstico: Principios de Auditoría';
    $quiz->intro = '<p>Evaluación diagnóstica sobre principios de auditoría e independencia del auditor.</p>';
    $quiz->introformat = FORMAT_HTML;
    $quiz->timeopen = time() - 3600;
    $quiz->timeclose = time() + (86400 * 15);
    $quiz->timelimit = 1800;
    $quiz->grademethod = 1;
    $quiz->attempts = 2;
    $quiz->grade = 10;
    $quiz->sumgrades = 10;
    $quiz->timemodified = time();
    $quizId = $DB->insert_record('quiz', $quiz);
    $quiz->id = $quizId;

    $cm = new stdClass();
    $cm->course = $courseId;
    $cm->module = $DB->get_field('modules', 'id', ['name' => 'quiz']);
    $cm->instance = $quizId;
    $cm->section = 3;
    $cm->added = time();
    $cmId = $DB->insert_record('course_modules', $cm);

    rebuild_course_cache($courseId);
    echo "  - Creado cuestionario: {$quiz->name} (ID: $quizId, CMID: $cmId)\n";
} else {
    echo "  - Cuestionario ya existe (ID: {$quiz->id})\n";
}

// 8. Crear Entrega y Calificación de Ejemplo para Demostrar Trazabilidad
echo "\nGenerando registros de entregas, calificaciones y eventos de auditoría...\n";
$estudiante1 = $userObjects['estudiante1']['userobj'];
$profesor1 = $userObjects['profesor1']['userobj'];

$sub = $DB->get_record('assign_submission', ['assignment' => $assign->id, 'userid' => $estudiante1->id]);
if (!$sub) {
    $sub = new stdClass();
    $sub->assignment = $assign->id;
    $sub->userid = $estudiante1->id;
    $sub->timecreated = time() - 1800;
    $sub->timemodified = time() - 1800;
    $sub->status = 'submitted';
    $sub->attemptnumber = 0;
    $sub->latest = 1;
    $subId = $DB->insert_record('assign_submission', $sub);
    echo "  - Entrega ficticia registrada para estudiante1 (ID: $subId)\n";

    // Registrar calificación asignada por profesor1
    $grade = new stdClass();
    $grade->assignment = $assign->id;
    $grade->userid = $estudiante1->id;
    $grade->timecreated = time() - 900;
    $grade->timemodified = time() - 900;
    $grade->grader = $profesor1->id;
    $grade->grade = 95.00;
    $grade->attemptnumber = 0;
    $gradeId = $DB->insert_record('assign_grades', $grade);
    echo "  - Calificación registrada (95/100) otorgada por profesor1 (Grade ID: $gradeId)\n";
}

// Registrar eventos en el log de Moodle
$event = \core\event\course_viewed::create([
    'context' => $courseContext,
    'courseid' => $courseId
]);
$event->trigger();

echo "\n¡POBLADO DE DATOS COMPLETADO CON ÉXITO!\n";
echo "Resumen de Entidades Creadas:\n";
echo "- Categoría: $catName (ID: $categoryId)\n";
echo "- Curso: {$course->fullname} (ID: $courseId, Shortname: $courseShortname)\n";
echo "- Administrador: admin_auditoria\n";
echo "- Docentes: profesor1, profesor2\n";
echo "- Alumnos: estudiante1, estudiante2, estudiante3, estudiante4, estudiante5\n";
echo "- Módulos: Foro, Tarea, Cuestionario\n";
echo "- Calificaciones y Entregas registradas para trazabilidad.\n";
