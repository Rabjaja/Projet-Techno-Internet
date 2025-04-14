<?php
session_start();

// Par défaut, on est "public" (si non connecté)
$pageToLoad = 'public/content/home.php'; // Page d'accueil publique

// Si l'utilisateur est connecté et a un rôle d'admin, on change la page
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['username'] == 'admin') {
        header("Location: admin/content/dashboard.php");
    }
    else{
        header("Location: public/content/loged.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="page" class="container">

    <!-- Inclusion de l'entête -->
    <?php include('public/src/php/utils/header.php'); ?>

    <!-- Affichage du contenu selon le rôle -->
    <section>
        <?php
        // Charge la page spécifique en fonction du rôle
        include($pageToLoad);
        ?>
    </section>

    <!-- Inclusion du footer -->
    <?php include('public/src/php/utils/footer.php'); ?>

</div>
</body>
</html>
