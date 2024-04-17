<?php 

session_start();

    require_once("db.php");

    // Permet d'authenfier un utilisateur
    function login($email, $password)
    {
        try {
            $req = "SELECT * FROM users u WHERE u.email='$email' 
            and u.password='$password' limit 0,1";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            die("Erreur de connexion à la BD " . $error->getMessage());
        }
    }

    
    // Permet de d'ajouter une Admin dans la bd

  function profilUsers(){
        try {
            $req = "SELECT * FROM users r WHERE etat=1 AND id=1";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            
            die("Impossible de recuperer la user d'identifiant " . $error->getMessage());
        }

     }
        // Permet de d'ajouter une utilisateur dans la bd

    function addUser($nom, $prenom, $tel, $email, $password, $photo, $date)
    {
        try {
            $req = "INSERT INTO users VALUES(null, '$nom', '$prenom', '$tel', '$email', '$password', '$photo', '$date', default)";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {
            die("Une erreur s'est produit à l'ajout de la utilisateur " . $error->getMessage());
        }
    }
     // Permet de recuperer la liste des utilisateur supprimées depuis la bd
     function listeUsers(){
        try {
            $req = "SELECT * FROM users r WHERE etat=1";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            
            die("Impossible de recuperer la user d'identifiant " . $error->getMessage());
        }

     }
     
    // Permet de recuperer la liste des réalisations supprimées depuis la bd
    function listeUsersSupprimer()
    {
        try { 
            $req = "SELECT * FROM users r WHERE r.etat=0";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            die("Impossible de recuperer la liste des utilisateurs supprimées " . $error->getMessage());
        }
    }
    // Permet de d'Modifier une utilisateur dans la bd
    function editUser($idUser, $nom, $prenom, $tel, $email, $password, $photo, $date)
    {
        try {
            $req = "UPDATE users r SET r.nom='$nom', r.prenom='$prenom', r.tel='$tel', r.email='$email', r.password='$password', r.photo='$photo', r.date='$date' WHERE r.id='$idUser'";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {
            die("Une erreur s'est produit lors de la modification de la utilisateur d'identifiant " . $idUser . ' ' . $error->getMessage());
        }
    }

    // Permet de recuperer la liste des utilisateur supprimées depuis la bd
     function getUserById($idUser){
        try {
            $req = "SELECT * FROM users r WHERE r.id='$idUser' LIMIT 0,1";
            return getConnexion()->query($req);
        } catch (PDOException $error) {
            
            die("Impossible de recuperer la user d'identifiant " 
            . $idUser . ' ' . $error->getMessage());
        }

     }

     function activerUser($idUser){
        try {
            $req = "UPDATE  users r SET r.etat=1 WHERE r.id='$idUser'";
            return getConnexion()->exec($req);
        } catch (PDOException $error) {

            die("Impossible de recuperer la user d'identifiant "
            .$idUser.''. $error->getMessage());

        }
     }
    
     function desactiverUser($idUser){
        try {
            $req = "UPDATE  users r SET r.etat=0 WHERE r.id='$idUser'";
            return getConnexion()->exec($req);

        } catch (PDOException $error) {

            die("Impossible de remover la user d'identifiant "
            .$idUser.''. $error->getMessage());

        }
    }  


    

?>