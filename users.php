<?php
$users = [
    'admin' => [
        'id' => 1,
        // Пароль: admin123
        'password_hash' => password_hash('admin123', PASSWORD_DEFAULT)
    ],
    'gukasio' => [
        'id' => 2,
        // Пароль: qwerty
        'password_hash' => password_hash('qwerty', PASSWORD_DEFAULT)
    ]
];
?>