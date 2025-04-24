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

    public function addVinyle(string $titre, float $prix, int $quantite, string $image, int $categorieId): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO vinyles (titre, prix, quantite, image_url, categorie_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$titre, $prix, $quantite, $image, $categorieId]);
    }

    public function updateVinyle(int $id, string $titre, float $prix, int $quantite, string $image, int $categorie_id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE vinyles SET titre = ?, prix = ?, quantite = ?, image_url = ?, categorie_id = ? WHERE id = ?");
        return $stmt->execute([$titre, $prix, $quantite, $image, $categorie_id, $id]);
    }

    public function deleteVinyle(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM vinyles WHERE id = ?");
        return $stmt->execute([$id]);
    }

}
