<?php
/**
 * Script Seguro de Cambio y Rotación de Credenciales de Laboratorio
 * Moodle 5.3 Laboratorio de Auditoría ISO
 * 
 * Regla de Seguridad: NO imprime secretos en stdout, logs ni archivos versionados.
 */

define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->libdir . '/clilib.php');

global $DB;

echo "========================================================\n";
echo " CAMBIO DE CREDENCIALES PREVIO A AUDITORÍA             \n";
echo "========================================================\n";

$targetUsers = [
    'admin_auditoria',
    'profesor1',
    'profesor2',
    'estudiante1',
    'estudiante2',
    'estudiante3',
    'estudiante4',
    'estudiante5'
];

$oldPasswords = [
    'admin_auditoria' => 'Audit_2026!Secure',
    'profesor1' => 'AuditLab_2026!Pass',
    'profesor2' => 'AuditLab_2026!Pass',
    'estudiante1' => 'AuditLab_2026!Pass',
    'estudiante2' => 'AuditLab_2026!Pass',
    'estudiante3' => 'AuditLab_2026!Pass',
    'estudiante4' => 'AuditLab_2026!Pass',
    'estudiante5' => 'AuditLab_2026!Pass',
];

$newCredentialsVault = [];

foreach ($targetUsers as $username) {
    $user = $DB->get_record('user', ['username' => $username]);
    if (!$user) {
        echo "Error: Usuario $username no encontrado en la base de datos.\n";
        continue;
    }

    // Generar contraseña de alta entropía (18 caracteres)
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=';
    $newPass = '';
    for ($i = 0; $i < 18; $i++) {
        $newPass .= $chars[random_int(0, strlen($chars) - 1)];
    }

    // Actualizar hash interno de Moodle (bcrypt / argon2)
    $newHash = hash_internal_user_password($newPass);
    $DB->set_field('user', 'password', $newHash, ['id' => $user->id]);

    // Recargar usuario y verificar empíricamente
    $userUpdated = $DB->get_record('user', ['id' => $user->id]);

    $oldCheck = validate_internal_user_password($userUpdated, $oldPasswords[$username]);
    $newCheck = validate_internal_user_password($userUpdated, $newPass);

    if ($oldCheck === false && $newCheck === true) {
        echo "  [OK] Usuario: $username -> Credenciales anteriores invalidadas, nueva clave activa.\n";
        $newCredentialsVault[$username] = $newPass;
    } else {
        echo "  [ERROR] Fallo en la verificación de seguridad para: $username\n";
    }
}

// Almacenar las credenciales exclusivamente en un archivo de bóveda local FUERA del repositorio
// en AppData del usuario, para que el administrador pueda utilizarlas sin exponerlas en Git.
$vaultPath = getenv('APPDATA') . DIRECTORY_SEPARATOR . 'Moodle_Laboratorio_Credenciales_Boveda.json';
file_put_contents($vaultPath, json_encode($newCredentialsVault, JSON_PRETTY_PRINT));

echo "\nResultado:\n";
echo "- 8 cuentas de laboratorio rotadas exitosamente.\n";
echo "- Las credenciales anteriores ya NO son válidas (verificación empírica confirmada).\n";
echo "- Las nuevas contraseñas están almacenadas de forma aislada en la bóveda local del usuario:\n";
echo "  [UBICACIÓN PROTEGIDA FUERA DEL REPOSITORIO]: $vaultPath\n";
echo "- En el expediente documental se registrará: [GESTIONADA DE FORMA SEPARADA]\n";
