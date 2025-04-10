<?php
session_start();

// Récupération des données envoyées par le formulaire
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Vérifie si l'utilisateur existe dans la base de données
require_once 'config/config.php'; // Assurez-vous que votre connexion à la DB est incluse

// Préparer la requête pour vérifier les informations d'identification
$query = $pdo->prepare('SELECT * FROM users WHERE username = :username');
$query->execute(['username' => $username]);
$user = $query->fetch(PDO::FETCH_ASSOC);

// Vérifie si le mot de passe est correct
if ($user && password_verify($password, $user['password'])) {
    // Mot de passe correct, l'utilisateur est authentifié
    $_SESSION['user'] = $user; // Enregistre l'utilisateur dans la session
    header('Location: index.php'); // Redirige vers la page principale ou admin
    exit;
} else {
    // Erreur d'authentification
    $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect";
    header('Location: login.php'); // Redirige vers la page de connexion avec un message d'erreur
    exit;
}
