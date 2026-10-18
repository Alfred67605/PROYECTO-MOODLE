<?php
/**
 * ETAPA 6: Participación Académica y Libro de Calificaciones Nativo UATF
 * Moodle 5.3 Laboratorio de Auditoría ISO
 * 
 * Acciones:
 * 1. Configura el libro de calificaciones con ponderaciones:
 *    - Tareas: 40% (3 tareas ponderadas)
 *    - Cuestionarios: 40% (2 cuestionarios ponderados)
 *    - Participación en Foros: 20%
 *    - Total del curso: 100 puntos
 * 2. Genera actividad participativa y entregas para 20 cursos representativos de todas las facultades:
 *    - Hilos de debate y réplicas en foros por estudiantes.
 *    - Entregas de texto en línea en tareas por los estudiantes matriculados.
 *    - Evaluaciones y retroalimentación docente con notas altas, medias, bajas y ausencias.
 *    - Intentos finalizados y notas sincronizadas en cuestionarios.
 */

define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->libdir . '/gradelib.php');
require_once($CFG->libdir . '/grade/grade_item.php');
require_once($CFG->libdir . '/grade/grade_category.php');
require_once($CFG->dirroot . '/mod/assign/locallib.php');
require_once($CFG->dirroot . '/mod/forum/lib.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');

global $DB, $CFG, $USER;

set_time_limit(0);
ini_set('memory_limit', '1024M');

echo "=================================================================\n";
echo " UATF MOODLE: CALIFICACIONES Y PARTICIPACIÓN SINTÉTICA          \n";
echo "=================================================================\n";

$startTime = microtime(true);

// 20 Cursos muestra distribuidos por todas las facultades
$sampleCourseCodes = [
    'AUD-201', // FCEFA - Auditoría
    'AUD-102', // FCEFA - Contabilidad
    'ADM-101', // FCEFA - Administración
    'ECO-101', // FCEFA - Economía
    'SIS-111', // VIC - Sistemas
    'SIS-211', // VIC - Sistemas
    'INF-111', // FCP - Informática
    'DER-101', // DER - Derecho
    'MED-101', // MED - Medicina
    'CIV-211', // FI - Civil
    'MIN-101', // FI - Minería
    'GEO-101', // FI - Geología
    'ELE-101', // FIT - Eléctrica/Electrónica
    'MEC-101', // FIT - Mecánica
    'TUR-101', // FCSH - Turismo
    'LIN-101', // FCSH - Lingüística
    'TS-101',  // FCSH - Trabajo Social
    'AGR-101', // FCAP - Agronomía
    'ARQ-101', // FA - Arquitectura
    'ARM-101'  // FA - Artes Musicales
];

$teacherRole = $DB->get_record('role', ['shortname' => 'editingteacher'], 'id', MUST_EXIST)->id;
$studentRole = $DB->get_record('role', ['shortname' => 'student'], 'id', MUST_EXIST)->id;

$totalPosts = 0;
$totalSubmissions = 0;
$totalGradesAssigned = 0;
$totalQuizAttempts = 0;

foreach ($sampleCourseCodes as $idx => $code) {
    $course = $DB->get_record('course', ['shortname' => $code]);
    if (!$course) {
        echo "  - Curso $code no encontrado, omitiendo.\n";
        continue;
    }

    echo "\n[" . ($idx + 1) . "/20] Configurando Curso: {$course->fullname} (ID: {$course->id})...\n";
    $courseContext = context_course::instance($course->id);

    // 1. Obtener Docente Asignado
    $teacherAssignment = $DB->get_record_sql("
        SELECT u.id, u.firstname, u.lastname 
        FROM {role_assignments} ra
        JOIN {context} ctx ON ctx.id = ra.contextid
        JOIN {user} u ON u.id = ra.userid
        WHERE ctx.id = :ctxid AND ra.roleid = :roleid
        LIMIT 1
    ", ['ctxid' => $courseContext->id, 'roleid' => $teacherRole]);
    $teacherId = $teacherAssignment ? $teacherAssignment->id : 2; // admin fallback

    // 2. Obtener Estudiantes Matriculados en este curso
    $enrolledStudents = $DB->get_records_sql("
        SELECT u.id, u.firstname, u.lastname, u.username
        FROM {role_assignments} ra
        JOIN {context} ctx ON ctx.id = ra.contextid
        JOIN {user} u ON u.id = ra.userid
        WHERE ctx.id = :ctxid AND ra.roleid = :roleid
        ORDER BY u.id ASC
    ", ['ctxid' => $courseContext->id, 'roleid' => $studentRole]);
    $studentsList = array_values($enrolledStudents);
    $studentCount = count($studentsList);
    echo "  - Estudiantes inscritos: $studentCount | Docente: " . ($teacherAssignment ? "{$teacherAssignment->firstname} {$teacherAssignment->lastname}" : "Admin") . "\n";

    if ($studentCount === 0) {
        echo "  - Sin estudiantes matriculados en este curso. Omitiendo participación.\n";
        continue;
    }

    // 3. Configurar Libro de Calificaciones (Categorías y Ponderaciones 40 / 40 / 20)
    $courseCategory = grade_category::fetch_course_category($course->id);
    $courseCategory->aggregation = GRADE_AGGREGATE_WEIGHTED_MEAN;
    $courseCategory->update();

    // Categoría 1: Tareas (40%)
    $catTareasList = $DB->get_records('grade_categories', ['courseid' => $course->id, 'fullname' => 'Tareas (40%)']);
    if (empty($catTareasList)) {
        $catTareasObj = new grade_category(['courseid' => $course->id, 'fullname' => 'Tareas (40%)', 'parent' => $courseCategory->id], false);
        $catTareasObj->apply_default_settings();
        $catTareasObj->aggregation = GRADE_AGGREGATE_MEAN;
        $catTareasObj->aggregationcoef = 40.0;
        $catTareasObj->insert();
        $catTareasId = $catTareasObj->id;
    } else {
        $catTareasObj = reset($catTareasList);
        $catTareasId = $catTareasObj->id;
    }

    // Categoría 2: Cuestionarios (40%)
    $catQuizList = $DB->get_records('grade_categories', ['courseid' => $course->id, 'fullname' => 'Cuestionarios (40%)']);
    if (empty($catQuizList)) {
        $catQuizObj = new grade_category(['courseid' => $course->id, 'fullname' => 'Cuestionarios (40%)', 'parent' => $courseCategory->id], false);
        $catQuizObj->apply_default_settings();
        $catQuizObj->aggregation = GRADE_AGGREGATE_MEAN;
        $catQuizObj->aggregationcoef = 40.0;
        $catQuizObj->insert();
        $catQuizId = $catQuizObj->id;
    } else {
        $catQuizObj = reset($catQuizList);
        $catQuizId = $catQuizObj->id;
    }

    // Categoría 3: Participación en Foros (20%)
    $catForoList = $DB->get_records('grade_categories', ['courseid' => $course->id, 'fullname' => 'Participación en Foros (20%)']);
    if (empty($catForoList)) {
        $catForoObj = new grade_category(['courseid' => $course->id, 'fullname' => 'Participación en Foros (20%)', 'parent' => $courseCategory->id], false);
        $catForoObj->apply_default_settings();
        $catForoObj->aggregation = GRADE_AGGREGATE_MEAN;
        $catForoObj->aggregationcoef = 20.0;
        $catForoObj->insert();
        $catForoId = $catForoObj->id;
    } else {
        $catForoObj = reset($catForoList);
        $catForoId = $catForoObj->id;
    }

    // Mover ítems de calificación a sus respectivas categorías
    $gradeItems = grade_item::fetch_all(['courseid' => $course->id]);
    if ($gradeItems) {
        foreach ($gradeItems as $gi) {
            if ($gi->itemmodule === 'assign') {
                $gi->set_parent($catTareasId);
            } else if ($gi->itemmodule === 'quiz') {
                $gi->set_parent($catQuizId);
            }
        }
    }

    // Crear ítem de calificación manual para Participación si no existe
    $foroItem = $DB->get_record('grade_items', ['courseid' => $course->id, 'itemname' => 'Evaluación de Participación en Foros']);
    if (!$foroItem) {
        $gItem = new grade_item(['courseid' => $course->id, 'categoryid' => $catForoId, 'itemname' => 'Evaluación de Participación en Foros'], false);
        $gItem->itemtype = 'manual';
        $gItem->gradetype = GRADE_TYPE_VALUE;
        $gItem->grademin = 0;
        $gItem->grademax = 100;
        $gItem->insert();
        $foroGradeItem = $gItem;
    } else {
        $foroGradeItem = new grade_item($foroItem, false);
    }

    // 4. GENERAR INTERACCIÓN EN FOROS
    $forums = $DB->get_records('forum', ['course' => $course->id]);
    foreach ($forums as $forum) {
        if ($forum->type === 'news') continue;

        // Crear 2 discusiones académicas
        for ($d = 1; $d <= 2; $d++) {
            $starterStudent = $studentsList[($d * 3) % $studentCount];
            $discussion = new stdClass();
            $discussion->course = $course->id;
            $discussion->forum = $forum->id;
            $discussion->name = "Aporte Crítico $d: Perspectivas sobre {$course->shortname}";
            $discussion->message = "<p>Estimados docentes y compañeros: Quisiera abrir debate sobre la aplicación metodológica analizada en la Unidad $d. Considero fundamental evaluar su viabilidad en nuestro contexto profesional.</p>";
            $discussion->messageformat = FORMAT_HTML;
            $discussion->messagetrust = 0;
            $discussion->mailnow = 0;
            $discussion->timestart = 0;
            $discussion->timeend = 0;
            $discussion->pinned = 0;
            $discussion->groupid = -1;
            $discussion->userid = $starterStudent->id;
            $discussion->timemodified = time() - (86400 * (10 - $d));

            $discId = forum_add_discussion($discussion, null, null, $starterStudent->id);
            $totalPosts++;

            // 3 Réplicas de otros estudiantes
            $firstPost = $DB->get_record('forum_discussions', ['id' => $discId]);
            if ($firstPost) {
                for ($r = 1; $r <= 3; $r++) {
                    $replyStudent = $studentsList[($d * 3 + $r * 2) % $studentCount];
                    $USER = $replyStudent; // Set current user for forum attribution
                    $post = new stdClass();
                    $post->discussion = $discId;
                    $post->parent = $firstPost->firstpost;
                    $post->subject = "Re: Aporte Crítico $d";
                    $post->message = "<p>Coincido con el planteamiento de {$starterStudent->firstname}. Desde mi perspectiva, la evidencia recopilada en los textos de lectura confirma que este enfoque optimiza los resultados académicos.</p>";
                    $post->messageformat = FORMAT_HTML;
                    $post->userid = $replyStudent->id;
                    $post->mailnow = 0;
                    $post->created = time() - (86400 * (9 - $d) - ($r * 3600));
                    $post->modified = $post->created;
                    forum_add_new_post($post, null);
                    $totalPosts++;
                }
            }
        }
    }

    // 5. GENERAR ENTREGAS Y CALIFICACIONES DE TAREAS
    $assigns = $DB->get_records('assign', ['course' => $course->id]);
    foreach ($assigns as $assignRec) {
        $cm = get_coursemodule_from_instance('assign', $assignRec->id, $course->id);
        $context = context_module::instance($cm->id);
        $assign = new assign($context, $cm, $course);

        // 85% de estudiantes entregan la tarea
        $numSubmitters = ceil($studentCount * 0.85);

        for ($s = 0; $s < $numSubmitters; $s++) {
            $student = $studentsList[$s];
            $submission = $assign->get_user_submission($student->id, true);

            // Registro de entrega nativa online text
            $submission->status = ASSIGN_SUBMISSION_STATUS_SUBMITTED;
            $submission->timemodified = time() - (86400 * (5 + ($s % 7)));
            $DB->update_record('assign_submission', $submission);

            // Guardar texto en assignsubmission_onlinetext
            $onlinetext = $DB->get_record('assignsubmission_onlinetext', ['submission' => $submission->id, 'assignment' => $assignRec->id]);
            $essayContent = "<p><strong>Informe Académico - {$student->firstname} {$student->lastname}</strong></p><p>El presente trabajo aborda los requerimientos metodológicos establecidos en la consigna de la materia {$course->fullname}. Se estructuró el análisis conforme al marco teórico y se integraron las referencias bibliográficas institucionales.</p>";
            if (!$onlinetext) {
                $onlinetext = new stdClass();
                $onlinetext->assignment = $assignRec->id;
                $onlinetext->submission = $submission->id;
                $onlinetext->onlinetext = $essayContent;
                $onlinetext->onlineformat = FORMAT_HTML;
                $DB->insert_record('assignsubmission_onlinetext', $onlinetext);
            }
            $totalSubmissions++;

            // Calificación por el docente asignado
            // Distribución: notas altas (80-98), notas medias (60-79), notas bajas (45-59), ausencias
            $randPattern = ($s + $assignRec->id) % 20;
            if ($randPattern === 0) {
                $score = 0;
                $feedback = "Trabajo incompleto que no responde a los criterios de evaluación de la unidad.";
            } else if ($randPattern < 3) {
                $score = 45 + ($s % 15);
                $feedback = "Se evidencia debilidad en la fundamentación teórica. Recomendamos revisar las lecturas de la Unidad 1.";
            } else if ($randPattern < 10) {
                $score = 65 + ($s % 15);
                $feedback = "Cumple con los requerimientos básicos del ensayo. Puede profundizar en el análisis crítico.";
            } else {
                $score = 85 + ($s % 14);
                $feedback = "Excelente desarrollo conceptual, sólida argumentación y rigor metodológico.";
            }

            // Calificar mediante assign::update_grade()
            $grade = $assign->get_user_grade($student->id, true);
            $grade->grader = $teacherId;
            $grade->grade = $score;
            $assign->update_grade($grade);

            // Guardar retroalimentación en assignfeedback_comments
            $feedbackRecord = $DB->get_record('assignfeedback_comments', ['assignment' => $assignRec->id, 'grade' => $grade->id]);
            if (!$feedbackRecord) {
                $feedbackRecord = new stdClass();
                $feedbackRecord->assignment = $assignRec->id;
                $feedbackRecord->grade = $grade->id;
                $feedbackRecord->commenttext = $feedback;
                $feedbackRecord->commentformat = FORMAT_HTML;
                $DB->insert_record('assignfeedback_comments', $feedbackRecord);
            } else {
                $feedbackRecord->commenttext = $feedback;
                $DB->update_record('assignfeedback_comments', $feedbackRecord);
            }

            $totalGradesAssigned++;

            // Asignar también nota de participación en el ítem manual
            if ($foroGradeItem) {
                $partScore = min(100, max(40, $score + 5));
                $foroGradeItem->update_final_grade($student->id, $partScore, 'manual', 'Evaluación de participación en foros y talleres', FORMAT_HTML, $teacherId);
            }
        }
    }

    // 6. GENERAR INTENTOS Y NOTAS EN CUESTIONARIOS
    $quizzes = $DB->get_records('quiz', ['course' => $course->id]);
    foreach ($quizzes as $quizRec) {
        $numAttemptQuiz = ceil($studentCount * 0.80);

        for ($s = 0; $s < $numAttemptQuiz; $s++) {
            $student = $studentsList[$s];
            
            // Variación de notas de cuestionario (55 a 100)
            $qScore = 55 + (($s * 7 + $quizRec->id * 11) % 46);

            // Registrar intento en quiz_attempts
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
                $attempt->timestart = time() - (86400 * 4) + ($s * 120);
                $attempt->timefinish = $attempt->timestart + 1200;
                $attempt->timemodified = $attempt->timefinish;
                $attempt->timemodifiedoffline = 0;
                $attempt->timecheckstate = null;
                $attempt->sumgrades = $qScore;
                $DB->insert_record('quiz_attempts', $attempt);
            }

            // Registrar en quiz_grades
            $qGrade = $DB->get_record('quiz_grades', ['quiz' => $quizRec->id, 'userid' => $student->id]);
            if (!$qGrade) {
                $qGrade = new stdClass();
                $qGrade->quiz = $quizRec->id;
                $qGrade->userid = $student->id;
                $qGrade->grade = $qScore;
                $qGrade->timemodified = time() - (86400 * 3);
                $DB->insert_record('quiz_grades', $qGrade);
            }

            // Sincronizar con el libro de calificaciones nativo de Moodle
            quiz_update_grades($quizRec, $student->id);
            $totalQuizAttempts++;
        }
    }

    // Regrading del curso para calcular totales ponderados
    grade_regrade_final_grades($course->id);
    echo "  [OK] Curso $code: Participación, foros, entregas y libro de notas configurado y recalculado.\n";
}

$totalTime = round(microtime(true) - $startTime, 2);
echo "\n=================================================================\n";
echo " PARTICIPACIÓN Y CALIFICACIONES COMPLETADAS EXITOSAMENTE        \n";
echo " Cursos muestra procesados: " . count($sampleCourseCodes) . "    \n";
echo " Posts y réplicas en foros generados: $totalPosts                \n";
echo " Entregas de tareas procesadas: $totalSubmissions                \n";
echo " Calificaciones de tareas y retroalimentación: $totalGradesAssigned\n";
echo " Intentos de cuestionario finalizados y calificados: $totalQuizAttempts\n";
echo " Tiempo transcurrido: {$totalTime} segundos                      \n";
echo "=================================================================\n";
