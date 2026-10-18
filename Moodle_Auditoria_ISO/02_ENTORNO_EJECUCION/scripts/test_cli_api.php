<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->libdir . '/clilib.php');

global $DB;

echo "Moodle Core DB connected!\n";
$usersCount = $DB->count_records('user');
echo "Current users: " . $usersCount . "\n";

$roles = $DB->get_records('role', [], '', 'id, shortname, name');
foreach ($roles as $r) {
    echo "Role: id={$r->id}, shortname={$r->shortname}\n";
}
