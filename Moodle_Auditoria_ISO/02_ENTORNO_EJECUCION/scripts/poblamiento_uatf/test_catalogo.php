<?php
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/catalogo_materias_uatf.php');

$catalog = get_uatf_courses_catalog();
echo "Materias en catálogo: " . count($catalog) . "\n";

$mapCategories = json_decode(file_get_contents(__DIR__ . '/mapa_categorias_uatf.json'), true);
echo "Categorías en mapa: " . count($mapCategories) . "\n";

$missingCategories = [];
$codes = [];
$duplicates = [];

foreach ($catalog as $item) {
    $carCode = $item['car_code'];
    $code = $item['code'];
    $name = $item['name'];

    if (!isset($mapCategories[$carCode])) {
        $missingCategories[$carCode] = true;
    }

    if (isset($codes[$code])) {
        $duplicates[] = "$code ({$name} vs {$codes[$code]})";
    } else {
        $codes[$code] = $name;
    }
}

if (!empty($missingCategories)) {
    echo "ALERTA: Códigos de carrera no encontrados en mapa:\n";
    print_r(array_keys($missingCategories));
} else {
    echo "Todas las carreras del catálogo existen en el mapa de categorías.\n";
}

if (!empty($duplicates)) {
    echo "ALERTA: Códigos de materia duplicados:\n";
    print_r($duplicates);
} else {
    echo "Todos los códigos de materia son únicos.\n";
}
