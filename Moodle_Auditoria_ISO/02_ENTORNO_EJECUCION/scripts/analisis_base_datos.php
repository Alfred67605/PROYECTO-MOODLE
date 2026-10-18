<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../01_CODIGO_FUENTE/moodle/config.php');

global $DB;

$report = [];

// 1. Motor y base de datos
$pgVersion = $DB->get_record_sql("SELECT version() as ver");
$dbSize = $DB->get_record_sql("SELECT pg_size_pretty(pg_database_size(current_database())) as size, pg_database_size(current_database()) as bytes");
$tableCount = $DB->get_record_sql("SELECT count(*) as total FROM information_schema.tables WHERE table_schema = 'public'");

$report['database'] = [
    'engine' => $pgVersion->ver,
    'database_name' => $CFG->dbname,
    'host' => $CFG->dbhost,
    'port' => $CFG->dboptions['dbport'],
    'user' => $CFG->dbuser,
    'table_prefix' => $CFG->prefix,
    'total_tables' => (int)$tableCount->total,
    'size_pretty' => $dbSize->size,
    'size_bytes' => (int)$dbSize->bytes,
];

// 2. Clasificación de tablas por subsistema
$allTables = $DB->get_fieldset_sql("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' ORDER BY table_name");
$categories = [
    'Usuario y Autenticación (mdl_user*, auth, mfa)' => 0,
    'Roles, Contextos y Permisos (mdl_role*, mdl_context*)' => 0,
    'Cursos, Categorías y Matrícula (mdl_course*, mdl_enrol*, mdl_category*)' => 0,
    'Módulo: Tareas y Evaluaciones (mdl_assign*)' => 0,
    'Módulo: Cuestionarios y Banco de Preguntas (mdl_quiz*, mdl_question*)' => 0,
    'Módulo: Foros y Comunicación (mdl_forum*, mdl_message*)' => 0,
    'Libro de Calificaciones (mdl_grade*)' => 0,
    'Competencias y Badges (mdl_competency*, mdl_badge*)' => 0,
    'Sistema de Archivos y Repositorios (mdl_files*, mdl_repository*)' => 0,
    'Auditoría, Trazabilidad y Logs (mdl_logstore*)' => 0,
    'Caché, Eventos y Tareas Programadas (mdl_cache*, mdl_event*, mdl_task*)' => 0,
    'Analítica de Aprendizaje (mdl_analytics*)' => 0,
    'Configuración y Núcleo del Sistema (mdl_config*, mdl_upgrade*, etc.)' => 0,
    'Otras Tablas Modulares (feedback, wiki, scorm, etc.)' => 0
];

foreach ($allTables as $t) {
    if (str_starts_with($t, 'mdl_user') || str_starts_with($t, 'mdl_auth') || str_starts_with($t, 'mdl_tool_mfa')) {
        $categories['Usuario y Autenticación (mdl_user*, auth, mfa)']++;
    } elseif (str_starts_with($t, 'mdl_role') || str_starts_with($t, 'mdl_context')) {
        $categories['Roles, Contextos y Permisos (mdl_role*, mdl_context*)']++;
    } elseif (str_starts_with($t, 'mdl_course') || str_starts_with($t, 'mdl_enrol')) {
        $categories['Cursos, Categorías y Matrícula (mdl_course*, mdl_enrol*, mdl_category*)']++;
    } elseif (str_starts_with($t, 'mdl_assign')) {
        $categories['Módulo: Tareas y Evaluaciones (mdl_assign*)']++;
    } elseif (str_starts_with($t, 'mdl_quiz') || str_starts_with($t, 'mdl_question')) {
        $categories['Módulo: Cuestionarios y Banco de Preguntas (mdl_quiz*, mdl_question*)']++;
    } elseif (str_starts_with($t, 'mdl_forum') || str_starts_with($t, 'mdl_message')) {
        $categories['Módulo: Foros y Comunicación (mdl_forum*, mdl_message*)']++;
    } elseif (str_starts_with($t, 'mdl_grade')) {
        $categories['Libro de Calificaciones (mdl_grade*)']++;
    } elseif (str_starts_with($t, 'mdl_competency') || str_starts_with($t, 'mdl_badge')) {
        $categories['Competencias y Badges (mdl_competency*, mdl_badge*)']++;
    } elseif (str_starts_with($t, 'mdl_files') || str_starts_with($t, 'mdl_repository')) {
        $categories['Sistema de Archivos y Repositorios (mdl_files*, mdl_repository*)']++;
    } elseif (str_starts_with($t, 'mdl_logstore')) {
        $categories['Auditoría, Trazabilidad y Logs (mdl_logstore*)']++;
    } elseif (str_starts_with($t, 'mdl_cache') || str_starts_with($t, 'mdl_event') || str_starts_with($t, 'mdl_task')) {
        $categories['Caché, Eventos y Tareas Programadas (mdl_cache*, mdl_event*, mdl_task*)']++;
    } elseif (str_starts_with($t, 'mdl_analytics')) {
        $categories['Analítica de Aprendizaje (mdl_analytics*)']++;
    } elseif (str_starts_with($t, 'mdl_config') || str_starts_with($t, 'mdl_upgrade')) {
        $categories['Configuración y Núcleo del Sistema (mdl_config*, mdl_upgrade*, etc.)']++;
    } else {
        $categories['Otras Tablas Modulares (feedback, wiki, scorm, etc.)']++;
    }
}
$report['categories'] = $categories;

// 3. Usuarios a fondo
$users = $DB->get_records_sql("
    SELECT u.id, u.username, u.firstname, u.lastname, u.email, u.auth, u.confirmed, u.suspended, u.deleted,
           u.firstaccess, u.lastaccess, u.lastlogin, u.currentlogin, u.timecreated, u.timemodified,
           u.lang, u.timezone,
           substring(u.password from 1 for 10) as pass_hash_prefix
    FROM {user} u
    ORDER BY u.id ASC
");

$report['users'] = [];
foreach ($users as $u) {
    // Buscar roles asignados
    $roles = $DB->get_records_sql("
        SELECT r.shortname, r.name, ctx.contextlevel, ctx.instanceid
        FROM {role_assignments} ra
        JOIN {role} r ON r.id = ra.roleid
        JOIN {context} ctx ON ctx.id = ra.contextid
        WHERE ra.userid = :uid
    ", ['uid' => $u->id]);

    $roleList = [];
    foreach ($roles as $r) {
        $roleList[] = [
            'role' => $r->shortname,
            'contextlevel' => (int)$r->contextlevel,
            'instanceid' => (int)$r->instanceid
        ];
    }

    // Buscar cursos matriculados
    $enrols = $DB->get_records_sql("
        SELECT c.id as courseid, c.fullname, c.shortname, ue.status, ue.timestart, ue.timeend
        FROM {user_enrolments} ue
        JOIN {enrol} e ON e.id = ue.enrolid
        JOIN {course} c ON c.id = e.courseid
        WHERE ue.userid = :uid
    ", ['uid' => $u->id]);

    $enrolList = [];
    foreach ($enrols as $e) {
        $enrolList[] = [
            'courseid' => (int)$e->courseid,
            'fullname' => $e->fullname,
            'shortname' => $e->shortname,
            'status' => (int)$e->status
        ];
    }

    $report['users'][] = [
        'id' => (int)$u->id,
        'username' => $u->username,
        'fullname' => $u->firstname . ' ' . $u->lastname,
        'email' => $u->email,
        'auth' => $u->auth,
        'confirmed' => (int)$u->confirmed,
        'suspended' => (int)$u->suspended,
        'deleted' => (int)$u->deleted,
        'firstaccess_str' => $u->firstaccess ? date('Y-m-d H:i:s', $u->firstaccess) : 'Nunca',
        'lastaccess_str' => $u->lastaccess ? date('Y-m-d H:i:s', $u->lastaccess) : 'Nunca',
        'hash_type' => str_starts_with($u->pass_hash_prefix, '$2y$') ? 'bcrypt (Blowfish 60 chars)' : (str_starts_with($u->pass_hash_prefix, '$6$') ? 'sha512crypt' : 'otro/not_cached'),
        'roles' => $roleList,
        'courses' => $enrolList
    ];
}

// 4. Categorías de cursos
$categories = $DB->get_records_sql("
    SELECT id, name, idnumber, description, parent, sortorder, coursecount, visible
    FROM {course_categories}
    ORDER BY id ASC
");
$report['course_categories'] = [];
foreach ($categories as $c) {
    $report['course_categories'][] = [
        'id' => (int)$c->id,
        'name' => $c->name,
        'idnumber' => $c->idnumber,
        'parent' => (int)$c->parent,
        'coursecount' => (int)$c->coursecount,
        'visible' => (int)$c->visible
    ];
}

// 5. Cursos a detalle
$courses = $DB->get_records_sql("
    SELECT c.id, c.category, c.fullname, c.shortname, c.idnumber, c.summary, c.format,
           c.startdate, c.enddate, c.visible, c.enablecompletion, c.timecreated, c.timemodified
    FROM {course} c
    ORDER BY c.id ASC
");
$report['courses'] = [];
foreach ($courses as $c) {
    // Contar módulos en este curso
    $modCount = $DB->get_record_sql("SELECT count(*) as count FROM {course_modules} WHERE course = :cid", ['cid' => $c->id]);
    // Contar estudiantes matriculados
    $studentCount = $DB->get_record_sql("
        SELECT count(DISTINCT ue.userid) as count
        FROM {user_enrolments} ue
        JOIN {enrol} e ON e.id = ue.enrolid
        WHERE e.courseid = :cid
    ", ['cid' => $c->id]);

    $report['courses'][] = [
        'id' => (int)$c->id,
        'category' => (int)$c->category,
        'fullname' => $c->fullname,
        'shortname' => $c->shortname,
        'format' => $c->format,
        'startdate_str' => $c->startdate ? date('Y-m-d H:i:s', $c->startdate) : 'N/A',
        'enddate_str' => $c->enddate ? date('Y-m-d H:i:s', $c->enddate) : 'N/A',
        'visible' => (int)$c->visible,
        'total_modules' => (int)$modCount->count,
        'total_enrolled' => (int)$studentCount->count
    ];
}

// 6. Actividades y Módulos dentro del Curso de Auditoría
$activities = $DB->get_records_sql("
    SELECT cm.id as cmid, m.name as modname, cm.instance, cm.visible, cm.section
    FROM {course_modules} cm
    JOIN {modules} m ON m.id = cm.module
    WHERE cm.course = 2
    ORDER BY cm.section ASC, cm.id ASC
");
$report['course_activities'] = [];
foreach ($activities as $act) {
    $detail = ['cmid' => (int)$act->cmid, 'type' => $act->modname, 'section' => (int)$act->section];
    if ($act->modname === 'assign') {
        $assign = $DB->get_record('assign', ['id' => $act->instance]);
        $subs = $DB->get_record_sql("SELECT count(*) as count FROM {assign_submission} WHERE assignment = :aid AND status = 'submitted'", ['aid' => $act->instance]);
        $grades = $DB->get_record_sql("SELECT count(*) as count FROM {assign_grades} WHERE assignment = :aid AND grade >= 0", ['aid' => $act->instance]);
        $detail['name'] = $assign->name;
        $detail['intro'] = strip_tags($assign->intro);
        $detail['submissions'] = (int)$subs->count;
        $detail['graded'] = (int)$grades->count;
    } elseif ($act->modname === 'forum') {
        $forum = $DB->get_record('forum', ['id' => $act->instance]);
        $discs = $DB->get_record_sql("SELECT count(*) as count FROM {forum_discussions} WHERE forum = :fid", ['fid' => $act->instance]);
        $posts = $DB->get_record_sql("SELECT count(*) as count FROM {forum_posts} fp JOIN {forum_discussions} fd ON fd.id = fp.discussion WHERE fd.forum = :fid", ['fid' => $act->instance]);
        $detail['name'] = $forum->name;
        $detail['type_forum'] = $forum->type;
        $detail['discussions'] = (int)$discs->count;
        $detail['posts'] = (int)$posts->count;
    } elseif ($act->modname === 'quiz') {
        $quiz = $DB->get_record('quiz', ['id' => $act->instance]);
        $slots = $DB->get_record_sql("SELECT count(*) as count FROM {quiz_slots} WHERE quizid = :qid", ['qid' => $act->instance]);
        $attempts = $DB->get_record_sql("SELECT count(*) as count FROM {quiz_attempts} WHERE quiz = :qid", ['qid' => $act->instance]);
        $detail['name'] = $quiz->name;
        $detail['questions_count'] = (int)$slots->count;
        $detail['attempts'] = (int)$attempts->count;
    }
    $report['course_activities'][] = $detail;
}

// 7. Roles del sistema
$roles = $DB->get_records_sql("
    SELECT r.id, r.name, r.shortname, r.description, r.sortorder, r.archetype,
           (SELECT count(*) FROM {role_assignments} ra WHERE ra.roleid = r.id) as assigned_count
    FROM {role} r
    ORDER BY r.sortorder ASC
");
$report['roles'] = [];
foreach ($roles as $r) {
    $report['roles'][] = [
        'id' => (int)$r->id,
        'name' => $r->name ?: $r->shortname,
        'shortname' => $r->shortname,
        'archetype' => $r->archetype,
        'assigned_count' => (int)$r->assigned_count
    ];
}

// 8. Trazabilidad Forense / Logs
$logsTotal = $DB->get_record_sql("SELECT count(*) as count FROM {logstore_standard_log}");
$logsByComponent = $DB->get_records_sql("
    SELECT component, count(*) as count
    FROM {logstore_standard_log}
    GROUP BY component
    ORDER BY count DESC
    LIMIT 10
");
$logsByAction = $DB->get_records_sql("
    SELECT action, target, count(*) as count
    FROM {logstore_standard_log}
    GROUP BY action, target
    ORDER BY count DESC
    LIMIT 10
");

$report['logs'] = [
    'total_events' => (int)$logsTotal->count,
    'top_components' => array_map(fn($x) => ['component' => $x->component, 'count' => (int)$x->count], array_values($logsByComponent)),
    'top_actions' => array_map(fn($x) => ['action' => $x->action, 'target' => $x->target, 'count' => (int)$x->count], array_values($logsByAction)),
];

// 9. Archivos almacenados (mdl_files)
$filesTotal = $DB->get_record_sql("SELECT count(*) as count, coalesce(sum(filesize), 0) as total_bytes FROM {files}");
$filesMime = $DB->get_records_sql("
    SELECT mimetype, count(*) as count, coalesce(sum(filesize), 0) as bytes
    FROM {files}
    WHERE mimetype IS NOT NULL
    GROUP BY mimetype
    ORDER BY count DESC
    LIMIT 10
");

$report['files'] = [
    'total_records' => (int)$filesTotal->count,
    'total_bytes' => (int)$filesTotal->total_bytes,
    'total_size_mb' => round($filesTotal->total_bytes / (1024 * 1024), 2),
    'top_mimetypes' => array_map(fn($x) => ['mimetype' => $x->mimetype, 'count' => (int)$x->count, 'bytes' => (int)$x->bytes], array_values($filesMime))
];

echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
