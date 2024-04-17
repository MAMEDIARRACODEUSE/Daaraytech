<?php 

    require_once("db.php");

    // Permet de recuperer la liste des services depuis la bd
    function listeServices()
    {
        try {
            $req = "SELECT * FROM services r WHERE r.etat=1";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            die("Impossible de recuperer la liste des services " . $error->getMessage());
        }
    }

    // Permet de recuperer la liste des services supprimées depuis la bd
    function listeServicesSupprimer()
    {
        try { 
            $req = "SELECT * FROM services r WHERE r.etat=0";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            die("Impossible de recuperer la liste des services supprimées " . $error->getMessage());
        }
    }


    // Permet de recuperer la liste des services supprimées depuis la bd
    function desactiverService($idService)
    {   
        try {
            $req = "UPDATE services r SET r.etat=0 WHERE r.id='$idService'";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {
            die("Impossible de supprimer la service d'identifiant " 
            . $idService . ' ' . $error->getMessage());
        }
    }

     // Permet de recuperer la liste des services supprimées depuis la bd
     function activerService($idService)
     {
         try {
             $req = "UPDATE services r SET r.etat=1 WHERE r.id='$idService'";
             return getConnexion()->exec($req);
         } catch (PDOException $error) {
             die("Impossible de restaurer la service d'identifiant " 
             . $idService . ' ' . $error->getMessage());
         }
     }

    // Permet de recuperer la liste des services supprimées depuis la bd
    function getServiceById($idService)
    {
        try {
            $req = "SELECT * FROM services r WHERE r.id='$idService'  LIMIT 0,1";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            die("Impossible de recuperer la service d'identifiant " 
            . $idService . ' ' . $error->getMessage());
        }
    }

    // Permet de d'ajouter une service dans la bd
    function addService($nom, $description, $photo, $date)
    {
        try {
            $req = "INSERT INTO services VALUES(null, '$nom', '$description', '$photo', '$date', default)";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {
            die("Une erreur s'est produit à l'ajout de la service " . $error->getMessage());
        }
    }


    // Permet de d'ajouter une service dans la bd
    function editService($idService, $nom, $description, $photo, $date)
    {
        try {
            $req = "UPDATE services r SET r.nom='$nom', r.description='$description', r.photo='$photo', r.date='$date' WHERE r.id='$idService'";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {
            die("Une erreur s'est produit lors de la modification de la service d'identifiant " . $idService . ' ' . $error->getMessage());
        }
    }
?>