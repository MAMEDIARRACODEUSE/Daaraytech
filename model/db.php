<?php 

    // Permet de se connecter à la base de données 
    function getConnexion()
    {
        $host = "localhost";
        $dbname = "daaraytechnologie";
        $user = "root";
        $password = "";

        $dsn = "mysql:
                host=$host; 
                dbname=$dbname";

        try {
            $db = new PDO($dsn, $user, $password);
        } catch (PDOException $error) {
            die("Erreur de connexion à la base de données " . $error->getMessage());
        }
        return $db;
    }
?>