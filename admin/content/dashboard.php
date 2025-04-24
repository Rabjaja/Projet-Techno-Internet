<?php

session_start();
require_once '../../admin/src/php/classes/UserDAO.php';
$userDAO = new UserDAO();
$users = $userDAO->getAllUsers();

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
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h1>Page Admin</h1>
        <div>
            <a href="admin_vinyles.php" class="btn btn-primary">Gestion des Vinyles</a>
        </div>
    </div>

    <h3 class="mt-5">Gestion des utilisateurs</h3>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
