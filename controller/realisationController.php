<?php 

    require_once("../model/realisation_db.php");

    // Ajouter
    if (isset($_POST['frmAddRealisation'])) {
       extract($_POST); 

        // Recuperation de la photo   
        $nomPhoto = $_FILES['photo']['name'];
        //  Uploader la photo
        $file_tmp_name =  $_FILES['photo']['tmp_name'];
        move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");

        $result = addRealisation($nom, $description, $nomPhoto, date("Y-m-d"));
        if ($result == 1) {
            header("location:listeRealisation");
        }
    }

     // Modifier
     if (isset($_POST['frmEditRealisation'])) {
        extract($_POST); 
 
        if ($_FILES['photo']['name'] != '') {   
            // Recuperation de la photo   
            $nomPhoto = $_FILES['photo']['name'];
            //  Uploader la photo
            $file_tmp_name =  $_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");
            $result = editRealisation($id, $nom, $description, $photo, date("d/m/Y"));
        }
        else 
        {
            $realisation = getRealisationById($id)->fetch();
            $photo = $realisation["photo"];
            $file_tmp_name =  $_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");
            $result = editRealisation($id, $nom, $description, $photo, date("d/m/Y"));

        }

        if ($result == 1) {
            header("location:listeRealisation?showFrmEdition=2");
        }
     }
    
    // Supprmer
    if (isset($_GET["action"])) {
       if ($_GET["action"] == "delete") {
       $reponse = desactiverRealisation($_GET["idRealisation"]);

        if ($reponse == 1) {
            header("location:listeRealisation?error=Non");
        }
        else 
        {
            header("location:listeRealisation?error=Oui");
        }
       }
    }

    // Restaurer
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "restaurer") {
            $reponse = activerRealisation($_GET["idRealisation"]);
 
            if ($reponse == 1) {
                header("location:listeRealisation");
            }
            else 
            {
                var_dump("Erreur de restauration"); die();
            }
        }
     }
?>