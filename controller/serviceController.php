<?php 

    require_once("../model/service_db.php");

    // Ajouter
    if (isset($_POST['frmAddService'])) {
       extract($_POST); 

        // Recuperation de la photo   
        $nomPhoto = $_FILES['photo']['name'];
        //  Uploader la photo
        $file_tmp_name =  $_FILES['photo']['tmp_name'];
        move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");

        $result = addService($nom, $description, $nomPhoto, date("Y-m-d"));
        if ($result == 1) {
            header("location:listeService");
        }
    }

     // Modifier
     if (isset($_POST['frmEditService'])) {
        extract($_POST); 
 
        if ($_FILES['photo']['name'] != '') {   
            // Recuperation de la photo   
            $nomPhoto = $_FILES['photo']['name'];
            //  Uploader la photo
            $file_tmp_name =  $_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");
            $result = editService($id, $nom, $description, $photo, date("d/m/Y"));
        }
        else 
        {
            $service = getServiceById($id)->fetch();
            $photo = $service["photo"];
            $file_tmp_name =  $_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");
            $result = editService($id, $nom, $description, $photo, date("d/m/Y"));

        }

        if ($result == 1) {
            header("location:listeService?showFrmEdition=2");
        }
     }
    
    // Supprmer
    if (isset($_GET["action"])) {
       if ($_GET["action"] == "delete") {
       $reponse = desactiverService($_GET["idService"]);

        if ($reponse == 1) {
            header("location:listeService?error=Non");
        }
        else 
        {
            header("location:listeService?error=Oui");
        }
       }
    }

    // Restaurer
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "restaurer") {
            $reponse = activerService($_GET["idService"]);
 
            if ($reponse == 1) {
                header("location:listeService");
            }
            else 
            {
                var_dump("Erreur de restauration"); die();
            }
        }
     }
?>