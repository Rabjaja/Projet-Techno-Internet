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
            $stmt = $this->pdo->prepare("SELECT c.id AS commande_id, c.created_at
                                     FROM commandes c
                                     WHERE c.user_id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des commandes : " . $e->getMessage());
        }
    }

    public function getCommandeDetailsById(int $commande_id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, user_id, created_at FROM commandes WHERE id = ?");
            $stmt->execute([$commande_id]);
            $commande = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$commande) {
                throw new Exception("Commande non trouvée.");
            }

            $stmtVinyles = $this->pdo->prepare("
            SELECT v.titre, v.prix, cv.quantite
            FROM commande_vinyles cv
            JOIN vinyles v ON cv.vinyle_id = v.id
            WHERE cv.commande_id = ?
        ");
            $stmtVinyles->execute([$commande_id]);
            $vinyles = $stmtVinyles->fetchAll(PDO::FETCH_ASSOC);

            $commande['vinyles'] = $vinyles;

            return $commande;

        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des détails de la commande : " . $e->getMessage());
        }
    }

    public function createCommande(int $user_id, array $vinyles): int
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO commandes (user_id) VALUES (?)");
            $stmt->execute([$user_id]);
            $commande_id = $this->pdo->lastInsertId();

            $updateStmt = $this->pdo->prepare("UPDATE vinyles SET quantite = quantite - 1 WHERE id = ? AND quantite > 0");

            foreach ($vinyles as $vinyle) {
                $updateStmt->execute([$vinyle['id']]);

                if ($updateStmt->rowCount() === 0) {
                    $this->pdo->rollBack();
                    throw new Exception("Quantité insuffisante pour le vinyle : " . $vinyle['titre']);
                }

                $stmt = $this->pdo->prepare("INSERT INTO commande_vinyles (commande_id, vinyle_id, quantite) VALUES (?, ?, ?)");
                $stmt->execute([$commande_id, $vinyle['id'], 1]);
            }

            $this->pdo->commit();

            return $commande_id;
        } catch (Exception $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw new Exception($e->getMessage());
        }
    }
}
?>
