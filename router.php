<?php
define('ROOT', __DIR__);

session_start();

$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Serve real static files (css, js, images) directly
if (php_sapi_name() === 'cli-server') {
    $file = ROOT . $uri;
    if (is_file($file) && pathinfo($file, PATHINFO_EXTENSION) !== 'php') {
        return false;
    }
}

$path = rtrim($uri, '/') ?: '/';

$routes = [
    '/'                  => 'pages/home.php',
    '/login'             => 'pages/login.php',
    '/register'          => 'pages/register.php',
    '/logout'            => 'pages/logout.php',
    '/quartos'           => 'pages/quartos.php',
    '/reservas'          => 'pages/reservas/index.php',
    '/reservas/nova'     => 'pages/reservas/nova.php',
    '/reservas/cancelar' => 'pages/reservas/cancelar.php',
    '/perfil'            => 'pages/perfil.php',
    '/api/quartos'       => 'api/quartos.php',
];

$page = $routes[$path] ?? null;

if ($page && file_exists(ROOT . '/' . $page)) {
    require ROOT . '/' . $page;
} else {
    http_response_code(404);
    require ROOT . '/pages/404.php';
}
