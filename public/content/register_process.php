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
    $_SESSION['success'] = "Inscription réussie. Connectez-vous.";
    header("Location: login.php");
} else {
    $_SESSION['error'] = "Nom d'utilisateur ou email déjà utilisé.";
    header("Location: register.php");
}
exit;
