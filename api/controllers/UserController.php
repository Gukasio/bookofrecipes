<?php

class UserController {
    private static function jsonResponse($data, $status = 200) {
        http_response_code($status);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function register($input) {
        if (empty($input['name']) || empty($input['email']) || empty($input['password'])) {
            self::jsonResponse(['status' => 'error', 'message' => 'Пустые поля'], 400);
        }
        if (User::findByEmail($input['email'])) {
            self::jsonResponse(['status' => 'error', 'message' => 'Email уже занят'], 400);
        }
        
        $user = [
            'name' => $input['name'],
            'email' => $input['email'],
            'password_hash' => password_hash($input['password'], PASSWORD_DEFAULT)
        ];
        User::create($user);
        self::jsonResponse(['status' => 'success', 'message' => 'Пользователь зарегистрирован']);
    }

    public static function login($input) {
        $user = User::findByEmail($input['email'] ?? '');
        if ($user && password_verify($input['password'] ?? '', $user['password_hash'])) {
            self::jsonResponse(['status' => 'success', 'message' => 'Успешный вход', 'user_id' => $user['id']]);
        }
        self::jsonResponse(['status' => 'error', 'message' => 'Неверный email или пароль'], 401);
    }

    public static function index() {
        self::jsonResponse(['status' => 'success', 'data' => User::getAll()]);
    }

    public static function show($id) {
        $user = User::findById($id);
        if ($user) self::jsonResponse(['status' => 'success', 'data' => $user]);
        self::jsonResponse(['status' => 'error', 'message' => 'Пользователь не найден'], 404);
    }

    public static function updatePassword($id, $input) {
        if (empty($input['password'])) self::jsonResponse(['status' => 'error', 'message' => 'Пустой пароль'], 400);
        
        if (!User::findById($id)) self::jsonResponse(['status' => 'error', 'message' => 'Пользователь не найден'], 404);

        $newHash = password_hash($input['password'], PASSWORD_DEFAULT);
        User::update($id, ['password_hash' => $newHash]);
        self::jsonResponse(['status' => 'success', 'message' => 'Пароль обновлен']);
    }

    public static function delete($id) {
        if (!User::findById($id)) self::jsonResponse(['status' => 'error', 'message' => 'Пользователь не найден'], 404);
        User::delete($id);
        self::jsonResponse(['status' => 'success', 'message' => 'Пользователь удален']);
    }
}
?>