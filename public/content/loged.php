<?php
// Démarrer la session
session_start();

// Récupérer les données de l'utilisateur (exemple)
$username = $_SESSION['user']['username'];  // Assurez-vous que ces données ont été stockées lors de la connexion
$email = $_SESSION['user']['email']; // L'email de l'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Bienvenue, <?php echo htmlspecialchars($username); ?> !</h1>
    <p>Email : <?php echo htmlspecialchars($email); ?></p>

    <div class="alert alert-success">
        <p>Vous êtes connecté à votre compte.</p>
    </div>

    <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
