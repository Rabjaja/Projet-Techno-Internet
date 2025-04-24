<?php
session_start();
require_once '../../admin/src/php/classes/CommandeDAO.php';
require_once '../../admin/src/php/classes/VinyleDAO.php';

$commandeDAO = new CommandeDAO();
$vinyleDAO = new VinyleDAO();

if (isset($_GET['commande_id'])) {
    $commande_id = $_GET['commande_id'];
    $commande = $commandeDAO->getCommandeDetailsById($commande_id);
} else {
    header("Location: index.php");
    exit();
}

$totalCommande = 0;
foreach ($commande['vinyles'] as $vinyle) {
    $totalCommande += $vinyle['prix'] * $vinyle['quantite'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la commande</title>
    <link rel="stylesheet" href="../assets/css/loged.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4>Détails de la commande #<?= htmlspecialchars($commande['id']) ?></h4>
            <a href="../src/php/utils/commande_pdf.php?commande_id=<?= $commande['id'] ?>" class="btn btn-info" target="_blank">Télécharger PDF</a>
        </div>
    </div>

    <div class="card bg-secondary text-white">
        <div class="card-body">
            <h5 class="card-title">Commande ID: <?= htmlspecialchars($commande['id']) ?></h5>
            <p class="card-text">Date de la commande : <?= htmlspecialchars($commande['created_at']) ?></p>

            <h6>Vinyles commandés :</h6>
            <table class="table table-dark table-bordered mt-3">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Prix unitaire (€)</th>
                    <th>Quantité</th>
                    <th>Total (€)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($commande['vinyles'] as $vinyle): ?>
                    <tr>
                        <td><?= htmlspecialchars($vinyle['titre']) ?></td>
                        <td><?= number_format($vinyle['prix'], 2, ',', ' ') ?></td>
                        <td><?= htmlspecialchars($vinyle['quantite']) ?></td>
                        <td><?= number_format($vinyle['prix'] * $vinyle['quantite'], 2, ',', ' ') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total de la commande :</th>
                    <th><?= number_format($totalCommande, 2, ',', ' ') ?> €</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>