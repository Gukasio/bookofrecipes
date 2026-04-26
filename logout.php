<?php
session_start();
require 'logger.php';

$login = $_SESSION['login'] ?? 'unknown';

write_log($login, 'LOGOUT');

session_unset();
session_destroy();

header('Location: login.html');
exit;
?>