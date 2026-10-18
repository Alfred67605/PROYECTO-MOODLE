<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->libdir . '/gradelib.php');
require_once($CFG->libdir . '/grade/grade_category.php');
require_once($CFG->libdir . '/grade/grade_item.php');
global $DB;

try {
    $course = $DB->get_record('course', ['shortname' => 'AUD-201']);
    $courseCategory = grade_category::fetch_course_category($course->id);

    $catQuiz = new grade_category(['courseid' => $course->id, 'fullname' => 'Cuestionarios (40%)', 'parent' => $courseCategory->id], false);
    $catQuiz->apply_default_settings();
    $catQuiz->insert();
    echo "Cat Cuestionarios insertada: {$catQuiz->id}\n";

    $gradeItems = grade_item::fetch_all(['courseid' => $course->id]);
    foreach ($gradeItems as $gi) {
        echo "GI ID={$gi->id}, itemname={$gi->itemname}, itemmodule={$gi->itemmodule}\n";
        if ($gi->itemmodule === 'quiz') {
            $gi->set_parent($catQuiz->id);
            echo "  -> Movido a cat {$catQuiz->id}\n";
        }
    }
    echo "Test completado con éxito.\n";
} catch (Exception $e) {
    echo "EXCEPCIÓN: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
