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
        $stmt = $this->pdo->prepare("SELECT * FROM vinyles ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVinylesByCategorie(int $categorie_id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vinyles WHERE categorie_id = ? ORDER BY id ASC");
        $stmt->execute([$categorie_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
