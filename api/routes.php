<?php

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$input = json_decode(file_get_contents('php://input'), true) ?? [];

if ($uri === '/api/v1/register' && $method === 'POST') {
    UserController::register($input);
} elseif ($uri === '/api/v1/login' && $method === 'POST') {
    UserController::login($input);
} elseif ($uri === '/api/v1/users' && $method === 'GET') {
    UserController::index();
} elseif (preg_match('/^\/api\/v1\/users\/(\d+)$/', $uri, $matches)) {
    $id = $matches[1];
    if ($method === 'GET') {
        UserController::show($id);
    } elseif ($method === 'PUT' || $method === 'PATCH') {
        UserController::updatePassword($id, $input);
    } elseif ($method === 'DELETE') {
        UserController::delete($id);
    }
} else {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Endpoint не найден'], JSON_UNESCAPED_UNICODE);
}
?>