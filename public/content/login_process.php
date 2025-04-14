<?php
session_start();
require_once '../../admin/src/php/classes/AuthDAO.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$auth = new AuthService();
$user = $auth->login($username, $password);
var_dump($user);
if ($user) {
    $_SESSION['user'] = $user;
    header("Location: ../../index.php");
} else {
    $_SESSION['error'] = "Email ou mot de passe incorrect.";
    header("Location: login.php");
}
exit;