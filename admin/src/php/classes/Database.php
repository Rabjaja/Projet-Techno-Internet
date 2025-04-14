<?php
class Database
{
    private static $pdo;

    public static function getConnection(): PDO
    {
        if (!self::$pdo) {
            try {
                self::$pdo = new PDO("pgsql:host=localhost;dbname=DB_Projet_TI", "postgres", "admin");
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}