<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');
global $DB;

$course = $DB->get_record('course', ['shortname' => 'AUD-201']);
if (!$course) {
    die("No course AUD-201\n");
}
echo "Curso encontrado: ID={$course->id}, {$course->fullname}\n";

$sections = $DB->get_records('course_sections', ['course' => $course->id], 'section ASC');
echo "Secciones:\n";
foreach ($sections as $s) {
    echo "  Sec {$s->section} [{$s->name}]: sequence={$s->sequence}\n";
}

$cms = get_fast_modinfo($course)->get_cms();
echo "Módulos de actividad (" . count($cms) . "):\n";
foreach ($cms as $cm) {
    echo "  - Mod: {$cm->modname}, Nombre: {$cm->name}, Section: {$cm->sectionnum}\n";
}

$quizzes = $DB->get_records('quiz', ['course' => $course->id]);
foreach ($quizzes as $q) {
    $slots = $DB->count_records('quiz_slots', ['quizid' => $q->id]);
    echo "  Quiz ID={$q->id} '{$q->name}': $slots preguntas asociadas.\n";
}
