<?php 

    require_once("../model/user_db.php");

    if (isset($_POST["login"])) 
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        //Validation coté back
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location:login?error=1");
        }

        $user = login($email, $password)->fetch();
        if ($user["email"]) {
            header("location:admin");
        }
        else 
        {
            header("location:login?error=1");
        }
    }
?>

<!------------- Fin LOGIN ------------->

<!------------- Modal User ------------->
<?php 

    require_once("../model/user_db.php");

    // Ajouter
    if (isset($_POST['frmAddUser'])) {
       extract($_POST); 

        // Recuperation de la photo   
        $nomPhoto = $_FILES['photo']['name'];
        //  Uploader la photo
        $file_tmp_name =  $_FILES['photo']['tmp_name'];
        move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");

        $result = addUser($nom, $prenom, $tel, $email, $password, $nomPhoto, date("Y-m-d"));
        if ($result == 1) {
            header("location:listeUser");
        }
    }

     // Modifier
     if (isset($_POST['frmEditUser'])) {
        extract($_POST); 
 
        if ($_FILES['photo']['name'] != '') {   
            // Recuperation de la photo   
            $nomPhoto = $_FILES['photo']['name'];
            //  Uploader la photo
            $file_tmp_name =  $_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");
            $result = editUser($id, $nom, $prenom, $tel, $email, $password, $photo, date("d/m/Y"));
        }
        else
        {
            $user = getUserById($id)->fetch();
            $photo = $user["photo"];
            $file_tmp_name =  $_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp_name, "../public/images/$nomPhoto");
            $result = editUser($id, $nom, $prenom, $tel, $email, $password, $photo, date("d/m/Y"));

        }

        if ($result == 1) {
            header("location:listeUser?showFrmEdition=2");
        }
     }
    
    // Supprmer
    if (isset($_GET["action"])) {
       if ($_GET["action"] == "delete") {
       $reponse = desactiverUser($_GET["idUser"]);

        if ($reponse == 1) {
            header("location:listeUser?error=Non");
        }
        else 
        {
            header("location:listeUser?error=Oui");
        }
       }
    }

    // Restaurer
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "restaurer") {
            $reponse = activerUser($_GET["idUser"]);
 
            if ($reponse == 1) {
                header("location:listeUser");
            }
            else 
            {
                var_dump("Erreur de restauration"); die();
            }
        }
     }
?>