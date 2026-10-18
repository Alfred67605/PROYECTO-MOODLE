<?php
/**
 * ETAPA 2: Estructura de Categorías de la UATF
 * Moodle 5.3 Laboratorio de Auditoría
 * 
 * Crea la jerarquía oficial:
 * Universidad Autónoma Tomás Frías -> Facultad -> Carrera / Sede
 */

define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../01_CODIGO_FUENTE/moodle/config.php');
require_once($CFG->dirroot . '/course/lib.php');

global $DB;

echo "========================================================\n";
echo " ETAPA 2: CREACIÓN DE TAXONOMÍA DE CATEGORÍAS UATF     \n";
echo "========================================================\n";

// Definición completa de la estructura oficial
$structure = [
    'Facultad de Ciencias Económicas, Financieras y Administrativas' => [
        'code' => 'FCEFA',
        'careers' => [
            'Auditoría - Contaduría Pública (Potosí)' => 'FCEFA-AUD',
            'Ingeniería Comercial (Potosí)' => 'FCEFA-ICO',
            'Administración de Empresas (Potosí)' => 'FCEFA-ADM',
            'Economía (Potosí)' => 'FCEFA-ECO',
            'Contaduría Pública (Sede Tupiza)' => 'FCEFA-CT-TUP',
            'Economía (Sede Uyuni)' => 'FCEFA-EC-UYU',
            'Economía (Sede Uncía)' => 'FCEFA-EC-UNC'
        ]
    ],
    'Facultad de Ciencias Puras' => [
        'code' => 'FCP',
        'careers' => [
            'Ingeniería Informática (Potosí)' => 'FCP-INF',
            'Química (Potosí)' => 'FCP-QMC',
            'Física (Potosí)' => 'FCP-FIS',
            'Matemática (Potosí)' => 'FCP-MAT',
            'Estadística (Potosí)' => 'FCP-EST'
        ]
    ],
    'Vicerrectorado - Programas Especiales' => [
        'code' => 'VIC',
        'careers' => [
            'Ingeniería de Sistemas (Potosí)' => 'VIC-SIS',
            'Ingeniería de Sistemas (Sede Tupiza)' => 'VIC-SIS-TUP',
            'Ingeniería en Diseño y Programación Digital' => 'VIC-IDP',
            'Odontología (Potosí)' => 'VIC-ODO'
        ]
    ],
    'Facultad de Ingeniería' => [
        'code' => 'FI',
        'careers' => [
            'Ingeniería Civil (Potosí)' => 'FI-CIV',
            'Construcciones Civiles (Potosí)' => 'FI-CCV',
            'Ingeniería en Geodesia y Topografía (Potosí)' => 'FI-GYT'
        ]
    ],
    'Facultad de Ingeniería Tecnológica' => [
        'code' => 'FIT',
        'careers' => [
            'Ingeniería Eléctrica (Potosí)' => 'FIT-ELE',
            'Ingeniería Mecánica (Potosí)' => 'FIT-MEC',
            'Mecánica Automotriz (Potosí)' => 'FIT-AUT',
            'Ingeniería Mecatrónica (Potosí)' => 'FIT-MCT',
            'Ingeniería Electrónica (Potosí)' => 'FIT-ELT'
        ]
    ],
    'Facultad de Ingeniería Minera' => [
        'code' => 'FIM',
        'careers' => [
            'Ingeniería Minera (Potosí)' => 'FIM-MIN',
            'Ingeniería de Procesos de Materias Primas Minerales' => 'FIM-PMM'
        ]
    ],
    'Facultad de Ingeniería Geológica' => [
        'code' => 'FIG',
        'careers' => [
            'Ingeniería Geológica (Potosí)' => 'FIG-GEO',
            'Ingeniería del Medio Ambiente (Potosí)' => 'FIG-AMB'
        ]
    ],
    'Facultad de Ciencias de la Salud' => [
        'code' => 'FCS',
        'careers' => [
            'Enfermería (Potosí)' => 'FCS-ENF',
            'Enfermería (Sede Villazón)' => 'FCS-ENF-VIL'
        ]
    ],
    'Facultad de Medicina' => [
        'code' => 'MED',
        'careers' => [
            'Medicina (Potosí - Régimen Anual)' => 'MED-MED'
        ]
    ],
    'Facultad de Derecho' => [
        'code' => 'DER',
        'careers' => [
            'Derecho (Potosí - Régimen Anual)' => 'DER-DER',
            'Derecho (Sede Uncía - Régimen Anual)' => 'DER-DER-UNC',
            'Derecho (Sede Tupiza - Régimen Anual)' => 'DER-DER-TUP'
        ]
    ],
    'Facultad de Ciencias Sociales y Humanísticas' => [
        'code' => 'FCSH',
        'careers' => [
            'Turismo (Potosí)' => 'FCSH-TUR',
            'Turismo (Sede Uyuni)' => 'FCSH-TUR-UYU',
            'Lingüística e Idiomas (Potosí)' => 'FCSH-LIN',
            'Lingüística e Idiomas (Sede Uyuni)' => 'FCSH-LIN-UYU',
            'Trabajo Social (Potosí)' => 'FCSH-TSO',
            'Trabajo Social (Sede Uncía)' => 'FCSH-TSO-UNC',
            'Ciencias de la Comunicación (Potosí)' => 'FCSH-COM'
        ]
    ],
    'Facultad de Ciencias Agrícolas y Pecuarias' => [
        'code' => 'FCAP',
        'careers' => [
            'Ingeniería Agronómica (Potosí)' => 'FCAP-AGR',
            'Ingeniería Agropecuaria (Sede Villazón)' => 'FCAP-AGP-VIL',
            'Medicina Veterinaria y Zootecnia (Sede Tupiza)' => 'FCAP-MVZ-TUP',
            'Ingeniería Agroindustrial (Potosí)' => 'FCAP-AGI',
            'Ingeniería en Desarrollo Rural (Potosí)' => 'FCAP-IDR'
        ]
    ],
    'Facultad de Artes' => [
        'code' => 'FA',
        'careers' => [
            'Arquitectura (Potosí)' => 'FA-ARQ',
            'Artes Musicales (Potosí)' => 'FA-ARM',
            'Artes Plásticas (Potosí)' => 'FA-ARP'
        ]
    ]
];

// 1. Categoría Raíz Institucional
$rootCat = $DB->get_record('course_categories', ['idnumber' => 'UATF-ROOT']);
if (!$rootCat) {
    $rootCat = core_course_category::create([
        'name' => 'Universidad Autónoma Tomás Frías',
        'idnumber' => 'UATF-ROOT',
        'description' => 'Estructura Académica Oficial - Simulación Universitaria Moodle 5.3',
        'parent' => 0
    ]);
    echo "[OK] Creada Categoría Raíz: UATF (ID: {$rootCat->id})\n";
} else {
    echo "[INFO] Categoría Raíz UATF ya existía (ID: {$rootCat->id})\n";
}

$createdFaculties = 0;
$createdCareers = 0;
$careerCategoryMap = [];

foreach ($structure as $facName => $facData) {
    $facCode = $facData['code'];
    $facCat = $DB->get_record('course_categories', ['idnumber' => 'CAT-' . $facCode]);
    if (!$facCat) {
        $facCat = core_course_category::create([
            'name' => $facName,
            'idnumber' => 'CAT-' . $facCode,
            'description' => "Facultad oficial de la Universidad Autónoma Tomás Frías ($facCode)",
            'parent' => $rootCat->id
        ]);
        $createdFaculties++;
        echo "  + Facultad: $facName (ID: {$facCat->id}, Código: $facCode)\n";
    }

    foreach ($facData['careers'] as $carName => $carCode) {
        $carCat = $DB->get_record('course_categories', ['idnumber' => 'CAT-' . $carCode]);
        if (!$carCat) {
            $carCat = core_course_category::create([
                'name' => $carName,
                'idnumber' => 'CAT-' . $carCode,
                'description' => "Carrera / Programa académico: $carName ($carCode) - Gestión 2026",
                'parent' => $facCat->id
            ]);
            $createdCareers++;
            echo "      - Carrera: $carName (ID: {$carCat->id}, Código: $carCode)\n";
        }
        $careerCategoryMap[$carCode] = [
            'id' => (int)$carCat->id,
            'name' => $carName,
            'fac_code' => $facCode,
            'fac_name' => $facName
        ];
    }
}

// Guardar mapa de categorías para uso en el generador de cursos
$mapFile = __DIR__ . '/mapa_categorias_uatf.json';
file_put_contents($mapFile, json_encode($careerCategoryMap, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "\nResultado:\n";
echo "- Facultades procesadas: " . count($structure) . "\n";
echo "- Carreras procesadas: " . count($careerCategoryMap) . "\n";
echo "- Mapa guardado en: $mapFile\n";
