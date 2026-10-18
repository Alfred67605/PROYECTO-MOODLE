<?php
/**
 * ETAPA 1: Generación de Usuarios Sintéticos UATF (Docentes y Estudiantes)
 * Moodle 5.3 Laboratorio de Auditoría
 * 
 * Genera:
 * - 150 Docentes sintéticos (docente001 a docente150)
 * - 2.500 Estudiantes sintéticos (estudiante0001 a estudiante2500)
 */

define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->dirroot . '/user/lib.php');

global $DB, $CFG;

echo "========================================================\n";
echo " ETAPA 1: GENERACIÓN MASIVA DE USUARIOS SINTÉTICOS     \n";
echo "========================================================\n";

$vaultPath = getenv('APPDATA') . DIRECTORY_SEPARATOR . 'UATF_Credenciales_Sinteticas_Boveda.json';
$credentialsVault = [];
if (file_exists($vaultPath)) {
    $credentialsVault = json_decode(file_get_contents($vaultPath), true) ?: [];
}

// Bancos de nombres y apellidos típicos en Bolivia / hispanos
$firstNamesM = [
    'Juan', 'Carlos', 'Luis', 'Pedro', 'José', 'Jorge', 'Miguel', 'Alejandro', 'Fernando', 'David',
    'Rodrigo', 'Álvaro', 'Mateo', 'Lucas', 'Sebastián', 'Gabriel', 'Javier', 'Gonzalo', 'Mario', 'Víctor',
    'Diego', 'Hugo', 'Oscar', 'Christian', 'Daniel', 'Marcos', 'Esteban', 'Andrés', 'Ramiro', 'Gustavo',
    'Mauricio', 'Erick', 'Jaime', 'Boris', 'Wilfredo', 'René', 'Rubén', 'Edgar', 'Freddy', 'Félix'
];

$firstNamesF = [
    'María', 'Ana', 'Laura', 'Elena', 'Sofía', 'Valentina', 'Camila', 'Lucía', 'Paola', 'Gabriela',
    'Patricia', 'Claudia', 'Andrea', 'Daniela', 'Natalia', 'Carmen', 'Rosa', 'Teresa', 'Silvia', 'Verónica',
    'Monica', 'Adriana', 'Jessica', 'Carla', 'Ximena', 'Rocío', 'Lorena', 'Fabiola', 'Mariana', 'Beatriz',
    'Vanessa', 'Miriam', 'Cecilia', 'Rosario', 'Gladys', 'Sonia', 'Erika', 'Tania', 'Noemí', 'Lourdes'
];

$lastNames = [
    'Mamani', 'Flores', 'Quispe', 'Condori', 'Rodríguez', 'López', 'García', 'Pérez', 'Fernández', 'Gonzales',
    'Gutiérrez', 'Chávez', 'Ramos', 'Vargas', 'Morales', 'Rojas', 'Mendoza', 'Torres', 'Cruz', 'Castro',
    'Romero', 'Álvarez', 'Ruiz', 'Suárez', 'Salazar', 'Ortega', 'Delgado', 'Ortiz', 'Aguilar', 'Guzmán',
    'Medina', 'Silva', 'Cabrera', 'Navarro', 'Pinto', 'Villca', 'Callisaya', 'Choque', 'Colque', 'Paredes',
    'Ticona', 'Aruquipa', 'Huanca', 'Apaza', 'Tarqui', 'Villegas', 'Peña', 'Miranda', 'Benítez', 'Valenzuela'
];

// Carreras para asignación contextual sintética
$careerList = [
    'Ingeniería de Sistemas', 'Ingeniería Informática', 'Auditoría - Contaduría Pública',
    'Administración de Empresas', 'Economía', 'Ingeniería Comercial', 'Derecho',
    'Medicina', 'Enfermería', 'Ingeniería Civil', 'Ingeniería Minera', 'Ingeniería Geológica',
    'Ingeniería Electrónica', 'Ingeniería Mecánica', 'Turismo', 'Lingüística e Idiomas'
];

// 1. GENERAR 150 DOCENTES
echo "\n[1/2] Generando / Verificando 150 Docentes Sintéticos...\n";
$teacherCount = 150;
$createdTeachers = 0;
$existingTeachers = 0;

for ($i = 1; $i <= $teacherCount; $i++) {
    $uname = sprintf("docente%03d", $i);
    
    // Verificar si ya existe
    $existing = $DB->get_record('user', ['username' => $uname, 'mnethostid' => $CFG->mnet_localhost_id]);
    if ($existing) {
        $existingTeachers++;
        continue;
    }

    $isFemale = ($i % 2 === 0);
    $fn = $isFemale ? $firstNamesF[($i * 7) % count($firstNamesF)] : $firstNamesM[($i * 11) % count($firstNamesM)];
    $ln1 = $lastNames[($i * 13) % count($lastNames)];
    $ln2 = $lastNames[($i * 17) % count($lastNames)];
    $career = $careerList[$i % count($careerList)];

    // Generar contraseña segura
    if (!isset($credentialsVault[$uname])) {
        $chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%&*';
        $pass = 'DocUatf2026!';
        for ($p = 0; $p < 6; $p++) {
            $pass .= $chars[random_int(0, strlen($chars) - 1)];
        }
        $credentialsVault[$uname] = $pass;
    } else {
        $pass = $credentialsVault[$uname];
    }

    $docUser = new stdClass();
    $docUser->auth = 'manual';
    $docUser->confirmed = 1;
    $docUser->mnethostid = $CFG->mnet_localhost_id;
    $docUser->username = $uname;
    $docUser->password = hash_internal_user_password($pass);
    $docUser->idnumber = sprintf("DOC-UATF-%04d", 1000 + $i);
    $docUser->firstname = $fn;
    $docUser->lastname = "$ln1 $ln2";
    $docUser->email = sprintf("docente%03d@example.invalid", $i);
    $docUser->institution = "Universidad Autónoma Tomás Frías (Simulación)";
    $docUser->department = $career;
    $docUser->city = "Potosí";
    $docUser->country = "BO";
    $docUser->lang = "es";
    $docUser->timezone = "America/La_Paz";
    $docUser->timecreated = time();
    $docUser->timemodified = time();

    \core\user::create_user($docUser, false, false);
    $createdTeachers++;

    if ($createdTeachers % 50 === 0) {
        echo "  - Creados $createdTeachers docentes...\n";
    }
}
echo "Resultado Docentes: $createdTeachers creados, $existingTeachers ya existentes. Total: 150.\n";

// 2. GENERAR 2.500 ESTUDIANTES
echo "\n[2/2] Generando / Verificando 2.500 Estudiantes Sintéticos...\n";
$studentCount = 2500;
$createdStudents = 0;
$existingStudents = 0;

for ($i = 1; $i <= $studentCount; $i++) {
    $uname = sprintf("estudiante%04d", $i);

    $existing = $DB->get_record('user', ['username' => $uname, 'mnethostid' => $CFG->mnet_localhost_id]);
    if ($existing) {
        $existingStudents++;
        continue;
    }

    $isFemale = ($i % 2 === 0);
    $fn = $isFemale ? $firstNamesF[($i * 3) % count($firstNamesF)] : $firstNamesM[($i * 5) % count($firstNamesM)];
    $ln1 = $lastNames[($i * 7) % count($lastNames)];
    $ln2 = $lastNames[($i * 11) % count($lastNames)];
    $career = $careerList[$i % count($careerList)];
    $yearCohort = 2022 + ($i % 5); // Cohortes 2022 a 2026

    if (!isset($credentialsVault[$uname])) {
        $chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%&*';
        $pass = 'EstUatf2026!';
        for ($p = 0; $p < 6; $p++) {
            $pass .= $chars[random_int(0, strlen($chars) - 1)];
        }
        $credentialsVault[$uname] = $pass;
    } else {
        $pass = $credentialsVault[$uname];
    }

    $estUser = new stdClass();
    $estUser->auth = 'manual';
    $estUser->confirmed = 1;
    $estUser->mnethostid = $CFG->mnet_localhost_id;
    $estUser->username = $uname;
    $estUser->password = hash_internal_user_password($pass);
    $estUser->idnumber = sprintf("RU-%d-%05d", $yearCohort, 10000 + $i);
    $estUser->firstname = $fn;
    $docUser->lastname = "$ln1 $ln2";
    $estUser->lastname = "$ln1 $ln2";
    $estUser->email = sprintf("estudiante%04d@example.invalid", $i);
    $estUser->institution = "Universidad Autónoma Tomás Frías (Simulación)";
    $estUser->department = "$career (Cohorte $yearCohort)";
    $estUser->city = "Potosí";
    $estUser->country = "BO";
    $estUser->lang = "es";
    $estUser->timezone = "America/La_Paz";
    $estUser->timecreated = time();
    $estUser->timemodified = time();

    \core\user::create_user($estUser, false, false);
    $createdStudents++;

    if ($createdStudents % 500 === 0) {
        echo "  - Creados $createdStudents estudiantes...\n";
    }
}

echo "Resultado Estudiantes: $createdStudents creados, $existingStudents ya existentes. Total: 2.500.\n";

// Guardar bóveda de credenciales
file_put_contents($vaultPath, json_encode($credentialsVault, JSON_PRETTY_PRINT));
echo "\nBóveda de credenciales protegida actualizada en:\n$vaultPath\n";

$totalInDb = $DB->count_records('user', ['deleted' => 0]);
echo "Total usuarios activos en base de datos: $totalInDb\n";
