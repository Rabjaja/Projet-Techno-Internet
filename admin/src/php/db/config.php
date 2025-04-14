<?php


// Configuration de la connexion PDO
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=DB_Projet_TI", "postgres", "admin");
    // Configure le mode d'erreur de PDO pour lancer des exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si la connexion échoue, afficher l'erreur
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}
?>
