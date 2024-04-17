
<!------------- Modal Contact ------------->
<?php 

    require_once("../model/contact_db.php");

    // Ajouter
    if (isset($_POST['frmAddContact'])) {
       extract($_POST); 

        // Recuperation de la photo   
        $nomPhoto = $_FILES['photo']['name'];
        //  Uploader la photo
        $file_tmp_name =  $_FILES['photo']['tmp_name'];
        move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");

        $result = addContact($nom, $prenom, $email, $nomPhoto, $message, date("Y-m-d"));
        if ($result == 1) {
            header("location:listeContact");
        }
    }
     // Modifier
     if (isset($_POST['frmEditContact'])) {
        extract($_POST); 
 
        if ($_FILES['photo']['name'] != '') {   
            // Recuperation de la photo   
            $nomPhoto = $_FILES['photo']['name'];
            //  Uploader la photo
            $file_tmp_name =  $_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");
            $result = editContact($id, $nom, $prenom,  $email, $nomPhoto,$message, date("d/m/Y"));
        }
        else 
        {
            $Contact = getContactById($id)->fetch();
            $photo = $Contact["photo"];
            $file_tmp_name =  $_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");
            $result = editContact($id, $nom, $prenom,  $email, $nomPhoto,$message, date("d/m/Y"));

        }

        if ($result == 1) {
            header("location:listeContact?showFrmEdition=2");
        }
     }
    
    // Supprmer
    if (isset($_GET["action"])) {
       if ($_GET["action"] == "delete") {
       $reponse = desactiverContact($_GET["idContact"]);

        if ($reponse == 1) {
            header("location:listeContact?error=Non");
        }
        else 
        {
            header("location:listeContact?error=Oui");
        }
       }
    }

    // Restaurer
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "restaurer") {
            $reponse = activerContact($_GET["idContact"]);
 
            if ($reponse == 1) {
                header("location:listeContact");
            }
            else 
            {
                var_dump("Erreur de restauration"); die();
            }
        }
     }
?>
