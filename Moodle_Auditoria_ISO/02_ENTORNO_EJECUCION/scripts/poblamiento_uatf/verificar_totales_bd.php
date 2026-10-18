<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
global $DB;

$stats = [
    'Usuarios activos (sin eliminar)' => $DB->count_records('user', ['deleted' => 0]),
    'Docentes sintéticos (docente%)' => $DB->count_records_sql("SELECT COUNT(*) FROM {user} WHERE username LIKE 'docente%' AND deleted = 0"),
    'Estudiantes sintéticos (estudiante%)' => $DB->count_records_sql("SELECT COUNT(*) FROM {user} WHERE username LIKE 'estudiante%' AND deleted = 0"),
    'Categorías de cursos' => $DB->count_records('course_categories'),
    'Cursos totales en sistema' => $DB->count_records('course'),
    'Cursos UATF sintéticos' => $DB->count_records_sql("SELECT COUNT(*) FROM {course} WHERE id > 1 AND shortname != 'AUD-101'"),
    'Matrículas (user_enrolments)' => $DB->count_records('user_enrolments'),
    'Asignaciones de rol (role_assignments)' => $DB->count_records('role_assignments'),
    'Docentes con asignación de rol' => $DB->count_records_sql("SELECT COUNT(DISTINCT userid) FROM {role_assignments} WHERE roleid = 3"),
    'Estudiantes con asignación de rol' => $DB->count_records_sql("SELECT COUNT(DISTINCT userid) FROM {role_assignments} WHERE roleid = 5"),
    'Cohortes creadas' => $DB->count_records('cohort'),
    'Miembros en cohortes' => $DB->count_records('cohort_members'),
    'Grupos de curso creados' => $DB->count_records('groups'),
    'Miembros en grupos' => $DB->count_records('groups_members'),
    'Secciones de curso (course_sections)' => $DB->count_records('course_sections'),
    'Recursos de lectura (mod_page)' => $DB->count_records('page'),
    'Foros (mod_forum)' => $DB->count_records('forum'),
    'Discusiones de foros creadas' => $DB->count_records('forum_discussions'),
    'Mensajes/posts en foros' => $DB->count_records('forum_posts'),
    'Tareas (mod_assign)' => $DB->count_records('assign'),
    'Entregas de tareas (assign_submission)' => $DB->count_records('assign_submission'),
    'Entregas con texto en línea' => $DB->count_records('assignsubmission_onlinetext'),
    'Calificaciones de tareas (assign_grades)' => $DB->count_records('assign_grades'),
    'Comentarios/feedback docente en tareas' => $DB->count_records('assignfeedback_comments'),
    'Cuestionarios (mod_quiz)' => $DB->count_records('quiz'),
    'Preguntas en banco nativo' => $DB->count_records('question'),
    'Intentos de cuestionario (quiz_attempts)' => $DB->count_records('quiz_attempts'),
    'Notas de cuestionario (quiz_grades)' => $DB->count_records('quiz_grades'),
    'Categorías de calificación (grade_categories)' => $DB->count_records('grade_categories'),
    'Ítems de calificación (grade_items)' => $DB->count_records('grade_items'),
    'Calificaciones registradas en libro (grade_grades)' => $DB->count_records('grade_grades')
];

echo "=================================================================\n";
echo " RECUENTO GENERAL DE INTEGRIDAD EN BASE DE DATOS POSTGRESQL     \n";
echo "=================================================================\n";
foreach ($stats as $k => $v) {
    printf("%-50s : %d\n", $k, $v);
}
echo "=================================================================\n";
