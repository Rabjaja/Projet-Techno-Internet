<?php
session_start();
require_once '../../admin/src/php/classes/AuthDAO.php';

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';

if ($password !== $password_confirm) {
    $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
    header("Location: register.php");
    exit;
}

$auth = new AuthService();
$success = $auth->register($username, $email, $password);

if ($success) {
    header("Location: login.php");
} else {
    header("Location: register.php");
}
exit;
