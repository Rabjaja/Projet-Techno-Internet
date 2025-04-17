<?php
require_once 'Database.php';

class CategorieDao
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getAllCategories(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories ORDER BY nom");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
