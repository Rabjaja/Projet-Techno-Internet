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
        $stmt = $this->pdo->prepare("SELECT * FROM vinyles WHERE categorie_id = ? ORDER BY id ASC");
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

    public function getQuantiteById(int $id): ?int
    {
        $stmt = $this->pdo->prepare("SELECT quantite FROM vinyles WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['quantite'] : 0;
    }

}
