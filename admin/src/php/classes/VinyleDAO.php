<?php
require_once 'Database.php';

class VinyleDAO
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getAllVinyles(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vinyles WHERE quantite > 0 ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVinylesByCategorie(int $categorie_id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vinyles WHERE categorie_id = ? and quantite > 0 ORDER BY id ASC");
        $stmt->execute([$categorie_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNomById(int $id): ?string
    {
        $stmt = $this->pdo->prepare("SELECT titre FROM vinyles WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['titre'] : null;
    }

    public function getVinyleById(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vinyles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getQuantiteById(int $id): ?int
    {
        $stmt = $this->pdo->prepare("SELECT quantite FROM vinyles WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['quantite'] : 0;
    }

    public function addVinyle($titre, $description, $prix, $quantite, $image, $categorie_id)
{
    $query = "SELECT ajout_vinyle(:titre, :description, :prix, :quantite, :image, :categorie_id) AS retour";
    try {
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':titre', $titre);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':prix', $prix);
        $stmt->bindValue(':quantite', $quantite);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':categorie_id', $categorie_id);
        $stmt->execute();
        $retour = $stmt->fetchColumn(0);
        $this->pdo->commit();
        return $retour; // id du vinyle inséré ou -1
    } catch (PDOException $e) {
        $this->pdo->rollBack();
        print $e->getMessage();
        return -1;
    }
}


    public function updateVinyle($id, $titre, $description, $prix, $quantite, $image, $categorie_id)
{
    $query = "SELECT modifier_vinyle(:id, :titre, :description, :prix, :quantite, :image, :categorie_id) AS retour";
    try {
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':titre', $titre);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':prix', $prix);
        $stmt->bindValue(':quantite', $quantite);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':categorie_id', $categorie_id);
        $stmt->execute();
        $retour = $stmt->fetchColumn(0);
        $this->pdo->commit();
        return $retour; // id modifié ou -1
    } catch (PDOException $e) {
        $this->pdo->rollBack();
        print $e->getMessage();
        return -1;
    }
}


    public function deleteVinyle($id)
{
    $query = "SELECT supprimer_vinyle(:id) AS retour";
    try {
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $retour = $stmt->fetchColumn(0);
        $this->pdo->commit();
        return $retour; // id supprimé ou -1
    } catch (PDOException $e) {
        $this->pdo->rollBack();
        print $e->getMessage();
        return -1;
    }
}
    

}
