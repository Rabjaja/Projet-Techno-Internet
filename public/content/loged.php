<?php
session_start();

$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
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
</body>
</html>
