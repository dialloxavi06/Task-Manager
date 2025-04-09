<?php

class Database
{
    private static $connection = null;

    // Méthode pour obtenir la connexion à la base de données
    public static function getConnection()
    {
        // Si la connexion n'est pas déjà établie
        if (self::$connection === null) {
            try {
                // Informations de connexion à la base de données MySQL
                $host = 'localhost';           // Hôte (souvent localhost sur MAMP)
                $dbName = 'tasks';             // Nom de la base de données
                $username = 'root';            // Nom d'utilisateur MySQL (par défaut 'root' pour MAMP)
                $password = 'root';            // Mot de passe MySQL (par défaut 'root' pour MAMP)

                // Créer la connexion PDO avec MySQL
                $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8";
                self::$connection = new PDO($dsn, $username, $password);

                // Définir l'attribut pour afficher les erreurs
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                echo 'Connection réussie à la base de données MySQL'; // Optionnel pour tester

            } catch (PDOException $e) {
                // Gestion des erreurs si la connexion échoue
                die("La connexion à la base de données a échoué : " . $e->getMessage());
            }
        }

        // Retourner la connexion
        return self::$connection;
    }
}
