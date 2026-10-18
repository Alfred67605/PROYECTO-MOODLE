<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');
global $DB;

try {
    $course = $DB->get_record('course', ['shortname' => 'AUD-201']);
    $student = $DB->get_record('user', ['username' => 'estudiante0001']);
    $quizRec = $DB->get_record('quiz', ['course' => $course->id, 'name' => 'Cuestionario Evaluativo 1 (AUD-201)']);
    $courseContext = context_course::instance($course->id);

    // 1. Crear attempt si no existe
    $attempt = $DB->get_record('quiz_attempts', ['quiz' => $quizRec->id, 'userid' => $student->id, 'attempt' => 1]);
    if (!$attempt) {
        $attempt = new stdClass();
        $attempt->quiz = $quizRec->id;
        $attempt->userid = $student->id;
        $attempt->attempt = 1;
        $attempt->uniqueid = $DB->insert_record('question_usages', (object)[
            'contextid' => $courseContext->id,
            'component' => 'mod_quiz',
            'preferredbehaviour' => 'deferredfeedback'
        ]);
        $attempt->layout = '1,2,3,4,5,0';
        $attempt->currentpage = 0;
        $attempt->preview = 0;
        $attempt->state = 'finished';
        $attempt->timestart = time() - (86400 * 4);
        $attempt->timefinish = $attempt->timestart + 900;
        $attempt->timemodified = $attempt->timefinish;
        $attempt->timemodifiedoffline = 0;
        $attempt->timecheckstate = null;
        $attempt->sumgrades = 85.0;
        $DB->insert_record('quiz_attempts', $attempt);
    }

    // 2. Crear o actualizar quiz_grades
    $qg = $DB->get_record('quiz_grades', ['quiz' => $quizRec->id, 'userid' => $student->id]);
    if (!$qg) {
        $qg = new stdClass();
        $qg->quiz = $quizRec->id;
        $qg->userid = $student->id;
        $qg->grade = 85.0;
        $qg->timemodified = time() - (86400 * 3);
        $DB->insert_record('quiz_grades', $qg);
    }

    // 3. Sincronizar con gradebook
    quiz_update_grades($quizRec, $student->id);

    $gGrades = grade_get_grades($course->id, 'mod', 'quiz', $quizRec->id, $student->id);
    $itemGrade = $gGrades->items[0]->grades[$student->id];
    echo "Quiz gradebook grade para estudiante: " . $itemGrade->grade . "\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
