<?php
session_start();
require_once '../classes/UserDAO.php';

$userId = $_GET['id'];

$userDAO = new UserDAO();
$success = $userDAO->deleteUser($userId);

if ($success) {
    $_SESSION['success'] = "Utilisateur supprimé avec succès.";
} else {
    $_SESSION['error'] = "La suppression a échoué.";
}

header("Location: ../../../content/dashboard.php");
exit;
