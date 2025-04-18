<?php
session_start();

// Activer l'affichage des erreurs PHP pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure les classes nécessaires
require_once '../../../../admin/src/php/classes/CommandeDAO.php';  // Classe pour gérer les commandes

// Vérifier que la requête est bien en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées en JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifier que l'ID utilisateur et les vinyles sont présents
    if (isset($data['user_id']) && isset($data['vinyles']) && is_array($data['vinyles'])) {
        $userId = $data['user_id'];
        $vinyles = $data['vinyles'];

        // Instancier la classe CommandeDAO pour ajouter la commande dans la base de données
        $commandeDAO = new CommandeDAO();

        try {
            // Créer la commande et insérer les vinyles dans la base de données
            $commandeId = $commandeDAO->createCommande($userId, $vinyles);

            // Répondre avec un JSON de succès
            echo json_encode(['success' => true, 'commande_id' => $commandeId]);
        } catch (Exception $e) {
            // En cas d'erreur, renvoyer un message d'erreur
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        // Si des données manquent, envoyer un message d'erreur
        echo json_encode(['success' => false, 'error' => 'Données manquantes.']);
    }
} else {
    // Si la requête n'est pas en POST
    echo json_encode(['success' => false, 'error' => 'Méthode non autorisée.']);
}
?>
