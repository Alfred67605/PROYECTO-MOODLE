<?php
/**
 * Router para el Servidor Web Integrado de PHP (Moodle 5.3 Laboratorio de Auditoría)
 * Permite la ejecución local en http://localhost:8000 con soporte completo para
 * archivos estáticos, slasharguments (PATH_INFO) y ejecución modular de scripts.
 */

$root = realpath(__DIR__ . '/../01_CODIGO_FUENTE/moodle/public');
$rawUri = $_SERVER['REQUEST_URI'];
$uri = parse_url($rawUri, PHP_URL_PATH);

if (!$root) {
    http_response_code(500);
    echo "Error: Raíz de Moodle no encontrada.";
    return true;
}

$path = realpath($root . $uri);

// 1. Si es un directorio, buscar index.php
if ($path && is_dir($path)) {
    $indexPath = $path . DIRECTORY_SEPARATOR . 'index.php';
    if (file_exists($indexPath)) {
        $_SERVER['SCRIPT_FILENAME'] = $indexPath;
        $_SERVER['SCRIPT_NAME'] = rtrim($uri, '/') . '/index.php';
        $_SERVER['PHP_SELF'] = $_SERVER['SCRIPT_NAME'];
        chdir(dirname($indexPath));
        require $indexPath;
        return true;
    }
}

// 2. Si es un archivo existente directamente
if ($path && is_file($path)) {
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if ($ext === 'php') {
        $_SERVER['SCRIPT_FILENAME'] = $path;
        $_SERVER['SCRIPT_NAME'] = $uri;
        $_SERVER['PHP_SELF'] = $uri;
        chdir(dirname($path));
        require $path;
        return true;
    }
    // Dejar que el servidor integrado sirva los activos estáticos (css, js, imágenes, fuentes)
    return false;
}

// 3. Soporte para Slasharguments y PATH_INFO (ej: /pluginfile.php/1/2/test.png)
$parts = explode('/', trim($uri, '/'));
$accum = $root;
$scriptRel = '';
$pathInfo = '';

foreach ($parts as $idx => $part) {
    $accum .= DIRECTORY_SEPARATOR . $part;
    if (is_file($accum) && str_ends_with($accum, '.php')) {
        $scriptRel = '/' . implode('/', array_slice($parts, 0, $idx + 1));
        $pathInfo = '/' . implode('/', array_slice($parts, $idx + 1));
        break;
    }
}

if ($scriptRel && file_exists($root . $scriptRel)) {
    $targetScript = $root . $scriptRel;
    $_SERVER['SCRIPT_FILENAME'] = $targetScript;
    $_SERVER['SCRIPT_NAME'] = $scriptRel;
    $_SERVER['PATH_INFO'] = $pathInfo;
    $_SERVER['PHP_SELF'] = $scriptRel . $pathInfo;
    chdir(dirname($targetScript));
    require $targetScript;
    return true;
}

// 4. Si no coincide con ninguna ruta válida, retornar 404
http_response_code(404);
echo "404 No Encontrado: " . htmlspecialchars($uri, ENT_QUOTES, 'UTF-8');
return true;
