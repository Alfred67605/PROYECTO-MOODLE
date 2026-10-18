<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->dirroot . '/mod/assign/locallib.php');
global $DB;

try {
    $course = $DB->get_record('course', ['shortname' => 'AUD-201']);
    $student = $DB->get_record('user', ['username' => 'estudiante0001']);
    $teacher = $DB->get_record('user', ['username' => 'docente001']);
    $assignRec = $DB->get_record('assign', ['course' => $course->id, 'name' => 'Tarea 1: Marco Teórico y Ensayo Crítico']);
    $cm = get_coursemodule_from_instance('assign', $assignRec->id, $course->id);
    $context = context_module::instance($cm->id);

    $assign = new assign($context, $cm, $course);
    $submission = $assign->get_user_submission($student->id, true);
    $submission->status = ASSIGN_SUBMISSION_STATUS_SUBMITTED;
    $DB->update_record('assign_submission', $submission);
    echo "Entrega de tarea ID={$submission->id}\n";

    $grade = $assign->get_user_grade($student->id, true);
    $grade->grader = $teacher->id;
    $grade->grade = 92.5;
    $result = $assign->update_grade($grade);
    echo "assign::update_grade() resultado: " . ($result ? "ÉXITO" : "FALLÓ") . "\n";

    // Verificar en gradebook
    $gGrades = grade_get_grades($course->id, 'mod', 'assign', $assignRec->id, $student->id);
    $itemGrade = $gGrades->items[0]->grades[$student->id];
    echo "Gradebook grade para estudiante: " . $itemGrade->grade . "\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
