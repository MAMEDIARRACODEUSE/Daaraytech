<?php 

    require_once("db.php");

    // Permet de recuperer la liste des réalisations depuis la bd
    function listeRealisations()
    {
        try {
            $req = "SELECT * FROM realisations r WHERE r.etat=1";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            die("Impossible de recuperer la liste des réalisations " . $error->getMessage());
        }
    }

    // Permet de recuperer la liste des réalisations supprimées depuis la bd
    function listeRealisationsSupprimer()
    {
        try { 
            $req = "SELECT * FROM realisations r WHERE r.etat=0";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            die("Impossible de recuperer la liste des réalisations supprimées " . $error->getMessage());
        }
    }


    // Permet de recuperer la liste des réalisations supprimées depuis la bd
    function desactiverRealisation($idRealisation)
    {   
        try {
            $req = "UPDATE realisations r SET r.etat=0 WHERE r.id='$idRealisation'";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {
            die("Impossible de supprimer la réalisation d'identifiant " 
            . $idRealisation . ' ' . $error->getMessage());
        }
    }

     // Permet de recuperer la liste des réalisations supprimées depuis la bd
     function activerRealisation($idRealisation)
     {
         try {
             $req = "UPDATE realisations r SET r.etat=1 WHERE r.id='$idRealisation'";
             return getConnexion()->exec($req);
         } catch (PDOException $error) {
             die("Impossible de restaurer la réalisation d'identifiant " 
             . $idRealisation . ' ' . $error->getMessage());
         }
     }

    // Permet de recuperer la liste des réalisations supprimées depuis la bd
    function getRealisationById($idRealisation)
    {
        try {
            $req = "SELECT * FROM realisations r WHERE r.id='$idRealisation'  LIMIT 0,1";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            die("Impossible de recuperer la réalisation d'identifiant " 
            . $idRealisation . ' ' . $error->getMessage());
        }
    }

    // Permet de d'ajouter une réalisation dans la bd
    function addRealisation($nom, $description, $photo, $date)
    {
        try {
            $req = "INSERT INTO realisations VALUES(null, '$nom', '$description', '$photo', '$date', default)";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {
            die("Une erreur s'est produit à l'ajout de la réalisation " . $error->getMessage());
        }
    }


    // Permet de d'ajouter une réalisation dans la bd
    function editRealisation($idRealisation, $nom, $description, $photo, $date)
    {
        try {
            $req = "UPDATE realisations r SET r.nom='$nom', r.description='$description', r.photo='$photo', r.date='$date' WHERE r.id='$idRealisation'";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {
            die("Une erreur s'est produit lors de la modification de la réalisation d'identifiant " . $idRealisation . ' ' . $error->getMessage());
        }
    }
?>