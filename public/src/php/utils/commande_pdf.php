<?php
require_once '../vendor/autoload.php';
require_once '../../../../admin/src/php/classes/CommandeDAO.php';

use Dompdf\Dompdf;

$commandeDAO = new CommandeDAO();

if (!isset($_GET['commande_id'])) {
    die("ID de commande manquant.");
}

$commande_id = $_GET['commande_id'];
$commande = $commandeDAO->getCommandeDetailsById($commande_id);

$totalCommande = 0;
foreach ($commande['vinyles'] as $vinyle) {
    $totalCommande += $vinyle['prix'] * $vinyle['quantite'];
}

ob_start();
?>

<style>
    body { font-family: DejaVu Sans, sans-serif; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 8px; }
    th { background-color: #eee; }
</style>

<h1>Details de la commande #<?= htmlspecialchars($commande['id']) ?></h1>
<p>Date de la commande : <?= htmlspecialchars($commande['created_at']) ?></p>

<h3>Vinyles commandes :</h3>
<table>
    <thead>
    <tr>
        <th>Titre</th>
        <th>Prix unitaire</th>
        <th>Quantite</th>
        <th>Total</th>
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
        <th colspan="3" style="text-align:right;">Total :</th>
        <th><?= number_format($totalCommande, 2, ',', ' ') ?> 	&#8364;</th>
    </tr>
    </tfoot>
</table>

<?php
$html = ob_get_clean();

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream("commande_$commande_id.pdf", ["Attachment" => false]);
exit;
