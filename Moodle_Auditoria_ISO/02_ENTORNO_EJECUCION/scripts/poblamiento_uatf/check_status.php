<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
global $DB;

$users = $DB->count_records('user', ['deleted' => 0]);
$teachers = $DB->count_records_sql("SELECT COUNT(*) FROM {user} WHERE username LIKE 'docente%' AND deleted = 0");
$students = $DB->count_records_sql("SELECT COUNT(*) FROM {user} WHERE username LIKE 'estudiante%' AND deleted = 0");
$courses = $DB->count_records('course');
$categories = $DB->count_records('course_categories');
$enrolments = $DB->count_records('user_enrolments');
$roleAssignments = $DB->count_records('role_assignments');
$pages = $DB->count_records('page');
$forums = $DB->count_records('forum');
$assigns = $DB->count_records('assign');
$quizzes = $DB->count_records('quiz');
$questions = $DB->count_records('question');

echo "=== ESTADO ACTUAL DE LA BASE DE DATOS ===\n";
echo "Usuarios activos: $users (Docentes sintéticos: $teachers, Estudiantes sintéticos: $students)\n";
echo "Categorías: $categories\n";
echo "Cursos totales: $courses\n";
echo "Matrículas: $enrolments (Asignaciones de rol: $roleAssignments)\n";
echo "Actividades:\n";
echo "  - Páginas: $pages\n";
echo "  - Foros: $forums\n";
echo "  - Tareas: $assigns\n";
echo "  - Cuestionarios: $quizzes\n";
echo "  - Preguntas en banco: $questions\n";
echo "=========================================\n";
