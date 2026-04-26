<?php
session_start();
require 'users.php';
require 'logger.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (isset($users[$login]) && password_verify($password, $users[$login]['password_hash'])) {
        $_SESSION['user_id'] = $users[$login]['id'];
        $_SESSION['login'] = $login;
        
        write_log($login, 'SUCCESS_LOGIN'); 
        header('Location: profile.php'); 
        exit;
    } else {
        write_log($login, 'FAIL_LOGIN');
        echo "<script>alert('Неверный логин или пароль'); window.location.href='login.html';</script>";
    }
}
?>