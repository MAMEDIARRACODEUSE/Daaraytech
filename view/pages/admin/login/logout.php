<?php
//session_start(); 
//session_destroy(); // destroy session
//header("location:login"); 
?>
<?php 
	include("../../../../model/user_db.php");
    $email = $user["email"];
    $uid =  $user["id"];
    $_SESSION['uid'] = $uid;
    $_SESSION['email'] = $email ;
    $_SESSION['user_etat'] = 1;

    if((isset($_SESSION['email']) && isset($_SESSION['user_etat'])) )  {
        if($_SESSION['user_etat'] == 1) {
        	session_destroy();
         	header("Location: login");
        }
        else
        	header("Location: login");
    }

    else
    	header("Location: login");

?>