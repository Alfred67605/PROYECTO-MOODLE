<?php
/**
 * Lote Piloto: 10 Cursos con Actividades Completas (Nativo)
 * Moodle 5.3 Laboratorio de Auditoría UATF
 */

define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/question/editlib.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');
require_once($CFG->dirroot . '/lib/testing/generator/component_generator_base.php');
require_once($CFG->dirroot . '/lib/testing/generator/module_generator.php');
require_once($CFG->dirroot . '/lib/testing/generator/data_generator.php');

global $DB;

echo "========================================================\n";
echo " LOTE PILOTO: GENERACIÓN DE 10 CURSOS DE PRUEBA        \n";
echo "========================================================\n";

$mapCategories = json_decode(file_get_contents(__DIR__ . '/mapa_categorias_uatf.json'), true);
if (!$mapCategories) {
    die("Error: No se encontró mapa_categorias_uatf.json\n");
}

$generator = new testing_data_generator();
$qtypeTf = question_bank::get_qtype('truefalse');

$pilotCourses = [
    [
        'car_code' => 'VIC-SIS',
        'code' => 'SIS-111',
        'name' => 'Introducción a la Programación',
        'summary' => 'Fundamentos de lógica algorítmica, estructuras de control y funciones.',
        'units' => ['Lógica Algorítmica', 'Estructuras de Control', 'Modularidad y Funciones', 'Arreglos y Matrices']
    ],
    [
        'car_code' => 'VIC-SIS',
        'code' => 'SIS-211',
        'name' => 'Estructura de Datos',
        'summary' => 'Tipos abstractos de datos, listas enlazadas, árboles, grafos y complejidad algorítmica.',
        'units' => ['Listas Enlazadas', 'Pilas y Colas', 'Árboles Binarios y AVL', 'Grafos y Algoritmos de Búsqueda']
    ],
    [
        'car_code' => 'FCP-INF',
        'code' => 'INF-111',
        'name' => 'Arquitectura de Computadoras',
        'summary' => 'Organización del procesador, microarquitectura, jerarquía de memorias e interfaces de E/S.',
        'units' => ['Sistemas de Numeración y Álgebra Booleana', 'Unidad Central de Procesamiento (CPU)', 'Jerarquía de Memoria y Caché', 'Buses e Interrupciones']
    ],
    [
        'car_code' => 'FCEFA-AUD',
        'code' => 'AUD-201',
        'name' => 'Auditoría Financiera I',
        'summary' => 'Principios de auditoría financiera, normas internacionales de auditoría (NIA) y papeles de trabajo.',
        'units' => ['Marco Teórico de la Auditoría Financiera', 'Evaluación del Control Interno', 'Procedimientos y Muestreo de Auditoría', 'Papeles de Trabajo e Informes']
    ],
    [
        'car_code' => 'FCEFA-ADM',
        'code' => 'ADM-101',
        'name' => 'Teoría General de la Administración',
        'summary' => 'Evolución histórica del pensamiento administrativo, escuelas clásicas y enfoques modernos.',
        'units' => ['Orígenes y Escuelas Clásicas', 'Enfoque Humanístico y del Comportamiento', 'Enfoque de Sistemas y Contingencial', 'Tendencias Modernas de Gestión']
    ],
    [
        'car_code' => 'DER-DER',
        'code' => 'DER-101',
        'name' => 'Derecho Constitucional Boliviano',
        'summary' => 'Bases fundamentales del Estado plurinacional, derechos fundamentales y garantías constitucionales.',
        'units' => ['Bases Fundamentales del Estado', 'Estructura y Organización del Poder', 'Derechos, Deberes y Garantías', 'Acciones de Defensa Constitucional']
    ],
    [
        'car_code' => 'MED-MED',
        'code' => 'MED-101',
        'name' => 'Anatomía Humana Descriptiva',
        'summary' => 'Estudio descriptivo y topográfico de los sistemas osteoarticular, muscular y circulatorio.',
        'units' => ['Osteología General y Cráneo', 'Miología y Artrología', 'Sistema Cardiovascular y Linfático', 'Neuroanatomía Básica']
    ],
    [
        'car_code' => 'FI-CIV',
        'code' => 'CIV-211',
        'name' => 'Resistencia de Materiales I',
        'summary' => 'Esfuerzo, deformación, tracción, compresión, torsión y flexión en elementos estructurales.',
        'units' => ['Concepto de Esfuerzo y Deformación', 'Cargas Axiales y Deformación Térmica', 'Torsión en Ejes Circulares', 'Flexión en Vigas Isostáticas']
    ],
    [
        'car_code' => 'FIT-ELE',
        'code' => 'ELE-101',
        'name' => 'Circuitos Eléctricos I',
        'summary' => 'Leyes de Kirchhoff, teoremas de redes eléctricas, análisis en corriente continua y transitorios.',
        'units' => ['Variables Eléctricas y Ley de Ohm', 'Leyes de Kirchhoff y Métodos de Nodos y Mallas', 'Teoremas de Thevenin y Norton', 'Circuitos RC y RL en Transitorios']
    ],
    [
        'car_code' => 'FCSH-TUR',
        'code' => 'TUR-101',
        'name' => 'Introducción al Turismo y Patrimonio',
        'summary' => 'Teoría general del turismo, patrimonio histórico-cultural de Potosí y turismo sostenible.',
        'units' => ['Fundamentos del Sistema Turístico', 'Patrimonio Cultural y Natural de Bolivia', 'Gestión del Turismo Sostenible', 'Planificación de Destinos Turísticos']
    ]
];

$startTime = microtime(true);
$count = 0;

foreach ($pilotCourses as $pCourse) {
    $count++;
    $carCode = $pCourse['car_code'];
    $catId = $mapCategories[$carCode]['id'] ?? 1;

    // Verificar si ya existe
    $existing = $DB->get_record('course', ['shortname' => $pCourse['code']]);
    if ($existing) {
        echo "  - Curso {$pCourse['code']} ya existe. Omitiendo.\n";
        continue;
    }

    // 1. Crear Curso
    $courseData = [
        'fullname' => $pCourse['name'] . ' (' . $pCourse['code'] . ')',
        'shortname' => $pCourse['code'],
        'idnumber' => 'UATF-' . $pCourse['code'] . '-2026',
        'category' => $catId,
        'summary' => '<p>' . $pCourse['summary'] . '</p>',
        'summaryformat' => FORMAT_HTML,
        'format' => 'topics',
        'numsections' => 4,
        'initsections' => true,
        'startdate' => strtotime('2026-02-09 08:00:00'),
        'visible' => 1
    ];
    $course = $generator->create_course($courseData);
    $courseContext = context_course::instance($course->id);

    // 2. Renombrar las 4 secciones
    foreach ($pCourse['units'] as $idx => $unitName) {
        $secNum = $idx + 1;
        $DB->set_field('course_sections', 'name', "Unidad $secNum: $unitName", [
            'course' => $course->id,
            'section' => $secNum
        ]);
    }

    // 3. Crear 2 Recursos de Lectura (Páginas)
    $page1 = $generator->create_module('page', [
        'course' => $course->id,
        'name' => "Guía de Lectura: Fundamentos de {$pCourse['name']}",
        'intro' => "<p>Documento de lectura introductorio y marco conceptual de la asignatura.</p>",
        'content' => "<h3>Objetivos Académicos</h3><p>Al finalizar esta unidad el estudiante comprenderá los conceptos clave de {$pCourse['name']}.</p><p>{$pCourse['summary']}</p>",
        'section' => 1
    ]);

    $page2 = $generator->create_module('page', [
        'course' => $course->id,
        'name' => "Compendio de Casos Prácticos y Ejercicios",
        'intro' => "<p>Lecturas complementarias y análisis de problemas aplicados.</p>",
        'content' => "<h3>Metodología de Trabajo</h3><p>Revise con detenimiento las situaciones problema planteadas para las sesiones prácticas.</p>",
        'section' => 2
    ]);

    // 4. Crear 1 Foro de Discusión
    $forum = $generator->create_module('forum', [
        'course' => $course->id,
        'name' => "Foro Académico: Análisis y Debate sobre {$pCourse['name']}",
        'intro' => "<p>Estimados estudiantes: Compartan su análisis sobre la aplicación práctica de {$pCourse['units'][0]} en el contexto profesional.</p>",
        'type' => 'general',
        'section' => 1
    ]);

    // 5. Crear 3 Tareas
    $assign1 = $generator->create_module('assign', [
        'course' => $course->id,
        'name' => "Tarea 1: Marco Teórico y Ensayo Crítico",
        'intro' => "<p>Elabore un ensayo fundamentado sobre {$pCourse['units'][0]}. Ponderación: 30 puntos.</p>",
        'grade' => 100,
        'duedate' => time() + (86400 * 14),
        'section' => 1
    ]);

    $assign2 = $generator->create_module('assign', [
        'course' => $course->id,
        'name' => "Tarea 2: Resolución Práctica y Ejercicios Aplicados",
        'intro' => "<p>Desarrolle la guía de ejercicios correspondiente a {$pCourse['units'][1]}. Ponderación: 35 puntos.</p>",
        'grade' => 100,
        'duedate' => time() + (86400 * 28),
        'section' => 2
    ]);

    $assign3 = $generator->create_module('assign', [
        'course' => $course->id,
        'name' => "Tarea 3: Proyecto Aplicativo Final",
        'intro' => "<p>Informe final integrador que articule los contenidos de {$pCourse['units'][2]} y {$pCourse['units'][3]}. Ponderación: 35 puntos.</p>",
        'grade' => 100,
        'duedate' => time() + (86400 * 45),
        'section' => 3
    ]);

    // 6. Crear Categoría de preguntas nativa para este curso
    $qcat = new stdClass();
    $qcat->name = "Banco de Preguntas - {$pCourse['code']}";
    $qcat->contextid = $courseContext->id;
    $qcat->info = 'Preguntas de evaluación nativas del curso';
    $qcat->infoformat = FORMAT_HTML;
    $qcat->stamp = make_unique_id_code();
    $qcat->parent = 0;
    $qcat->sortorder = 999;
    $qcat->idnumber = null;
    $qcat->id = $DB->insert_record('question_categories', $qcat);

    // 7. Crear 2 Cuestionarios con 5 Preguntas Cada Uno
    for ($qNum = 1; $qNum <= 2; $qNum++) {
        $quiz = $generator->create_module('quiz', [
            'course' => $course->id,
            'name' => "Cuestionario Evaluativo $qNum ({$pCourse['code']})",
            'intro' => "<p>Evaluación objetiva sobre los contenidos de las Unidades " . ($qNum === 1 ? "1 y 2" : "3 y 4") . ".</p>",
            'timeopen' => time() - 86400,
            'timeclose' => time() + (86400 * 30),
            'timelimit' => 1800,
            'attempts' => 2,
            'grade' => 100,
            'section' => $qNum === 1 ? 2 : 4
        ]);

        for ($questIdx = 1; $questIdx <= 5; $questIdx++) {
            $unitTopic = $pCourse['units'][($questIdx - 1) % 4];
            $questionObj = new stdClass();
            $questionObj->qtype = 'truefalse';
            $questionObj->category = $qcat->id;

            $formObj = new stdClass();
            $formObj->name = "Pregunta {$questIdx} ($qNum) - {$unitTopic}";
            $formObj->category = $qcat->id;
            $formObj->questiontext = [
                'text' => "<p>¿El postulado analítico de {$unitTopic} constituye un principio fundamental en {$pCourse['name']}?</p>",
                'format' => FORMAT_HTML
            ];
            $formObj->generalfeedback = [
                'text' => "<p>Retroalimentación formativa de la asignatura.</p>",
                'format' => FORMAT_HTML
            ];
            $formObj->defaultmark = 20;
            $formObj->penalty = 1;
            $formObj->correctanswer = ($questIdx % 2 === 1) ? 1 : 0;
            $formObj->feedbacktrue = ['text' => '<p>Respuesta correcta.</p>', 'format' => FORMAT_HTML];
            $formObj->feedbackfalse = ['text' => '<p>Respuesta incorrecta.</p>', 'format' => FORMAT_HTML];

            $savedQuestion = $qtypeTf->save_question($questionObj, $formObj);
            quiz_add_quiz_question($savedQuestion->id, $quiz);
        }
    }

    echo "  [OK] ($count/10) Curso creado: {$pCourse['name']} ({$pCourse['code']}) con 8 actividades y 10 preguntas.\n";
}

$elapsed = round(microtime(true) - $startTime, 2);
echo "\n========================================================\n";
echo " LOTE PILOTO COMPLETADO EXITOSAMENTE                   \n";
echo " Tiempo transcurrido: {$elapsed} segundos              \n";
echo " Cursos creados: 10                                    \n";
echo " Actividades instanciadas: 80 (20 páginas, 10 foros, 30 tareas, 20 cuestionarios)\n";
echo " Preguntas generadas: 100 preguntas nativas            \n";
echo "========================================================\n";
