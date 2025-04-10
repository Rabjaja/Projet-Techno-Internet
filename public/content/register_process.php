<?php
session_start();

// Récupération des données envoyées par le formulaire
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';

// Vérification des champs
if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
    $_SESSION['error'] = 'Tous les champs sont obligatoires.';
    header('Location: register.php');
    exit;
}

// Vérification de la confirmation du mot de passe
if ($password !== $password_confirm) {
    $_SESSION['error'] = 'Les mots de passe ne correspondent pas.';
    header('Location: register.php');
    exit;
}

// Validation de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'L\'adresse e-mail est invalide.';
    header('Location: register.php');
    exit;
}

// Hachage du mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Connexion à la base de données
require_once 'config/config.php'; // Connexion à la DB

// Vérification si l'email ou le nom d'utilisateur existe déjà
$query = $pdo->prepare('SELECT * FROM users WHERE email = :email OR username = :username');
$query->execute(['email' => $email, 'username' => $username]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $_SESSION['error'] = 'Ce nom d\'utilisateur ou cette adresse e-mail est déjà utilisé.';
    header('Location: register.php');
    exit;
}

// Enregistrement de l'utilisateur dans la base de données
$query = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
$query->execute(['username' => $username, 'email' => $email, 'password' => $hashedPassword]);

// Rediriger vers la page de connexion après l'inscription réussie
$_SESSION['success'] = 'Inscription réussie. Vous pouvez maintenant vous connecter.';
header('Location: login.php');
exit;
