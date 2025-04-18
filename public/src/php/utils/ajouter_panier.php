<?php
session_start();
require_once '../../../../admin/src/php/classes/VinyleDAO.php';

header('Content-Type: application/json');

$vinyleDAO = new VinyleDAO();
$id = (int)$_POST['id'];
$titre = $vinyleDAO->getNomById($id);
$quantite = $vinyleDAO->getQuantiteById($id);

if (!$titre) {
    echo json_encode(['error' => 'Vinyle non trouvé']);
    exit;
}

// Initialiser le panier si non existant
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$_SESSION['panier'][] = ['id' => $id, 'titre' => $titre, 'quantite' => $quantite];

echo json_encode(['success' => true, 'titre' => $titre, 'quantite' => $quantite]);
