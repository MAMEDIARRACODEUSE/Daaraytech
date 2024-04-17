<?php 


    require_once("db.php");

        // Permet de d'ajouter une utilisateur dans la bd

    function addContact($nom, $prenom, $email, $photo, $message)
    {
        try {
            $req = "INSERT INTO contacts VALUES(null, '$nom', '$prenom', '$email', '$photo', '$message', default)";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {
            die("Une erreur s'est produit à l'ajout de la utilisateur C " . $error->getMessage());
        }
    }
     // Permet de recuperer la liste des utilisateur supprimées depuis la bd
     function listeContacts(){
        try {
            $req = "SELECT * FROM contacts      ";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            
            die("Impossible de recuperer la contact d'identifiant " . $error->getMessage());
        }

     }
   
    // Permet de recuperer la liste des réalisations supprimées depuis la bd
    function listeContactsSupprimer()
    {
        try { 
            $req = "SELECT * FROM contacts r WHERE r.etat=0";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            die("Impossible de recuperer la liste des utilisateurs supprimées " . $error->getMessage());
        }
    }
    // Permet de d'Modifier une utilisateur dans la bd
    function editContact($idContact, $nom, $prenom,  $email, $photo, $message, $date)
    {
        try {
            $req = "UPDATE contacts r SET r.nom='$nom', r.prenom='$prenom', r.email='$email'',r.photo='$photo', r.message='$message',  r.date='$date' WHERE r.id='$idContact'";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {
            die("Une erreur s'est produit lors de la modification de la utilisateur d'identifiant " . $idContact . ' ' . $error->getMessage());
        }
    }

    // Permet de recuperer la liste des utilisateur supprimées depuis la bd
     function getContactById($idContact){
        try {
            $req = "SELECT * FROM contacts r WHERE r.id='$idContact' LIMIT 0,1";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            
            die("Impossible de recuperer la contact d'identifiant " 
            . $idContact . ' ' . $error->getMessage());
        }

     }

     function activerContact($idContact){
        try {
            $req = "UPDATE  contacts r SET r.etat=1 WHERE r.id='$idContact'";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {

            die("Impossible de recuperer la contact d'identifiant "
            .$idContact.''. $error->getMessage());

        }
     }
    
     function desactivercontact($idContact){
        try {
            $req = "UPDATE  contacts r SET r.etat=0 WHERE r.id='$idContact'";
            return getConnexion()->exec($req);

        } catch (PDOException $error) {

            die("Impossible de remover la contact d'identifiant "
            .$idContact.''. $error->getMessage());

        }
    }  


    

?>