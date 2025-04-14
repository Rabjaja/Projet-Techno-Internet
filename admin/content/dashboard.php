<?php
global $pdo;
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
    <h1 class="mt-5">Page Admin</h1>
    <div class="alert alert-info mt-3">
        <p>Connecté en tant qu'administrateur.</p>
    </div>

    <h3>Gestion des utilisateurs</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Date d'inscription</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once '../../admin/src/php/classes/UserDAO.php';

        $userDAO = new UserDAO();
        $users = $userDAO->getAllUsers();
        ?>

        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= date('d F Y à H:i', strtotime($user['created_at'])) ?></td>
            <td>
                <a href="../src/php/utils/delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

    <a href="../../public/content/logout.php" class="btn btn-danger">Se déconnecter</a>
</div>
</body>
</html>
