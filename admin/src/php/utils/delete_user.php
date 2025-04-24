<?php
session_start();
require_once '../classes/UserDAO.php';

$userId = $_GET['id'];

$userDAO = new UserDAO();
$success = $userDAO->deleteUser($userId);

header("Location: ../../../content/dashboard.php");
exit;
