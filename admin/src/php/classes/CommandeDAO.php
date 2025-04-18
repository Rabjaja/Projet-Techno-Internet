<?php
require_once 'Database.php';

class CommandeDAO
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getCommandesByUserId(int $user_id)
    {
        try {
            // Prépare la requête pour récupérer les commandes de l'utilisateur
            $stmt = $this->pdo->prepare("SELECT c.id AS commande_id, c.created_at
                                     FROM commandes c
                                     WHERE c.user_id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne les commandes sous forme de tableau
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des commandes : " . $e->getMessage());
        }
    }

    public function getCommandeDetailsById(int $commande_id)
    {
        try {
            // Récupère les infos générales de la commande
            $stmt = $this->pdo->prepare("SELECT id, user_id, created_at FROM commandes WHERE id = ?");
            $stmt->execute([$commande_id]);
            $commande = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$commande) {
                throw new Exception("Commande non trouvée.");
            }

            // Récupère les vinyles liés à cette commande avec leur titre, prix et quantité
            $stmtVinyles = $this->pdo->prepare("
            SELECT v.titre, v.prix, cv.quantite
            FROM commande_vinyles cv
            JOIN vinyles v ON cv.vinyle_id = v.id
            WHERE cv.commande_id = ?
        ");
            $stmtVinyles->execute([$commande_id]);
            $vinyles = $stmtVinyles->fetchAll(PDO::FETCH_ASSOC);

            // Ajoute les vinyles dans le tableau de la commande
            $commande['vinyles'] = $vinyles;

            return $commande;

        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des détails de la commande : " . $e->getMessage());
        }
    }

    public function createCommande(int $user_id, array $vinyles): int
    {
        try {
            // Démarre une transaction
            $this->pdo->beginTransaction();

            // Insertion de la commande avec l'ID de l'utilisateur
            $stmt = $this->pdo->prepare("INSERT INTO commandes (user_id) VALUES (?)");
            $stmt->execute([$user_id]);
            $commande_id = $this->pdo->lastInsertId(); // Récupère l'ID de la commande insérée

            // Préparer la mise à jour des quantités
            $updateStmt = $this->pdo->prepare("UPDATE vinyles SET quantite = quantite - 1 WHERE id = ? AND quantite > 0");

            foreach ($vinyles as $vinyle) {
                // Essayer de mettre à jour la quantité du vinyle dans la base de données
                $updateStmt->execute([$vinyle['id']]);

                // Vérifier si la quantité a bien été mise à jour (c'est-à-dire que la quantité était suffisante)
                if ($updateStmt->rowCount() === 0) {
                    // Si la mise à jour échoue, annuler la commande et retourner une erreur
                    $this->pdo->rollBack();
                    throw new Exception("Quantité insuffisante pour le vinyle : " . $vinyle['titre']);
                }

                // Ajouter le vinyle dans la commande
                $stmt = $this->pdo->prepare("INSERT INTO commande_vinyles (commande_id, vinyle_id, quantite) VALUES (?, ?, ?)");
                $stmt->execute([$commande_id, $vinyle['id'], 1]); // On suppose que la quantité est toujours 1 pour chaque vinyle
            }

            // Commit de la transaction
            $this->pdo->commit();

            // Retourner l'ID de la commande
            return $commande_id;
        } catch (Exception $e) {
            // Si une erreur survient, annule la transaction et renvoie une erreur
            if ($this->pdo->inTransaction()) {
                // Vérifie si une transaction est active avant de faire un rollBack
                $this->pdo->rollBack();
            }
            throw new Exception($e->getMessage());
        }
    }
}
?>
