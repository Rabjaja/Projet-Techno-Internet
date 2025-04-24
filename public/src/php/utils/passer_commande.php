<?php
session_start();
require_once '../../../../admin/src/php/classes/CommandeDAO.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['user_id']) && isset($data['vinyles']) && is_array($data['vinyles'])) {
    $userId = $data['user_id'];
    $vinyles = $data['vinyles'];

    $commandeDAO = new CommandeDAO();

    try {
        $commandeId = $commandeDAO->createCommande($userId, $vinyles);
        echo json_encode(['success' => true, 'commande_id' => $commandeId]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Données manquantes.']);
}
