<?php
session_start();
require_once '../../admin/src/php/classes/AuthDAO.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$auth = new AuthService();
$user = $auth->login($username, $password);

if ($user) {
    $_SESSION['user'] = $user;
    header("Location: ../../index.php");
} else {
    header("Location: login.php");
}
exit;