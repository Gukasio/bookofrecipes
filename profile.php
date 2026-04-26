<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html?error=auth_required');
    exit;
}

$userName = $_SESSION['login'];

include 'profile_view.php';