<?php
// =============================================================================
// PUBLIC ENTRY POINT - Main application router
// =============================================================================

require_once dirname(__DIR__) . '/config/config.php';

spl_autoload_register(function (string $class): void {
    foreach (['core', 'controllers', 'models'] as $directory) {
        $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $class . '.php';
        if (is_file($file)) {
            require_once $file;
            return;
        }
    }
});

// Initialize Router
$router = new Router();

// =============================================================================
// API ROUTES
// =============================================================================

// Authentication
$router->post('/api/auth/register', 'AuthController@register');
$router->post('/api/auth/login', 'AuthController@login');
$router->post('/api/auth/logout', 'AuthController@logout');
$router->get('/api/auth/me', 'AuthController@me');

// Games
$router->get('/api/games', 'GameApiController@list');
$router->get('/api/games/{id}', 'GameApiController@get');
$router->post('/api/games', 'GameApiController@create');
$router->put('/api/games/{id}', 'GameApiController@update');

// Reviews
$router->post('/api/games/{id}/reviews', 'ReviewController@create');
$router->get('/api/games/{id}/reviews', 'ReviewController@list');

// =============================================================================
// PAGE ROUTES - Frontend
// =============================================================================

// Home
$router->get('/', function(array $params) {
    header('Location: ' . app_url('/games'));
    exit;
});

$router->get('/games', 'GameController@index');
$router->get('/games/new', 'GameController@showCreate');
$router->post('/games', 'GameController@create');
$router->get('/games/{slug}', 'GameController@show');

// Authors
$router->get('/author/{id}', 'AuthorController@show');
$router->get('/author/{id}/games', 'AuthorController@games');

// Auth pages
$router->get('/auth/login', 'AuthController@showLogin');
$router->get('/auth/register', 'AuthController@showRegister');
$router->post('/auth/login', 'AuthController@login');
$router->post('/auth/register', 'AuthController@register');
$router->post('/auth/logout', 'AuthController@logout');

// Account
$router->get('/account', 'AccountController@dashboard');
$router->get('/cart', 'CartController@index');
$router->post('/cart/add', 'CartController@add');
$router->post('/cart/checkout', 'CartController@checkout');
$router->get('/collections', 'CollectionController@index');
$router->get('/forums', 'ForumController@index');
$router->get('/forums/{id}', 'ForumController@show');
$router->get('/jams', 'JamController@index');
$router->get('/jams/{slug}', 'JamController@show');
$router->get('/orders', 'OrderController@index');

// =============================================================================
// ADMIN / MODERATION
// =============================================================================

$router->get('/admin', 'AdminController@dashboard');
$router->get('/admin/games', 'AdminController@games');
$router->get('/admin/reports', 'AdminController@reports');
$router->get('/admin/users', 'AdminController@users');

// =============================================================================
// DISPATCH
// =============================================================================

$result = $router->dispatch($_SERVER['REQUEST_URI'] ?? '/', $_SERVER['REQUEST_METHOD'] ?? 'GET');
if ($result) {
    [$handler, $params] = $result;
    if (is_callable($handler)) {
        $handler($params);
    } else {
        [$controllerName, $methodName] = explode('@', $handler, 2);
        $controller = new $controllerName();
        $controller->$methodName($params);
    }
} else {
    http_response_code(404);
    echo 'Page not found';
}
