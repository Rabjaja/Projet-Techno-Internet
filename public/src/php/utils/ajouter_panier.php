<?php
session_start();
require_once '../../../../admin/src/php/classes/VinyleDAO.php';

header('Content-Type: application/json');

$vinyleDAO = new VinyleDAO();
$id = $_POST['id'];
$titre = $vinyleDAO->getNomById($id);
$quantite = $vinyleDAO->getQuantiteById($id);

echo json_encode(['success' => true, 'titre' => $titre, 'quantite' => $quantite]);
