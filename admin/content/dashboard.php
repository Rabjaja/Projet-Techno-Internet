<?php
// Démarrer la session
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Panneau d'administration</h1>
    <div class="alert alert-info mt-3">
        <p>Vous êtes connecté en tant qu'administrateur.</p>
    </div>

    <!-- Tableau d'administration -->
    <h3>Gestion des utilisateurs</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Connexion à la base de données
        require_once '../src/php/db/config.php';

        // Requête pour récupérer tous les utilisateurs
        $query = $pdo->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        // Affichage des utilisateurs
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['id']) . "</td>";
            echo "<td>" . htmlspecialchars($user['username']) . "</td>";
            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
            echo "<td><a href='delete_user.php?id=" . $user['id'] . "' class='btn btn-danger'>Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Lien pour se déconnecter -->
    <a href="../../public/content/logout.php" class="btn btn-danger">Se déconnecter</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
