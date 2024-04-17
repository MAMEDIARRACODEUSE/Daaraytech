<?php
session_start();
    require_once('model/user_db.php');
    if(empty($_SESSION['num'])){
        header('location:login');
    }



    if (isset($_COOKIE['__lingomin'])) {
        $leNum = intval($_COOKIE['__lingomin']);
        $requeteAdmin = $pdo->prepare("SELECT * FROM `users` WHERE id = 1");
        $requeteAdmin->execute(array($leNum));
        $adminInfo = $requeteAdmin->fetch();
        $adr_mail = $adminInfo['email'];
    }else{
        header("Location: login");
        exit();
    }

?>


<!-- ========= Head ======== -->
<?php require_once("view/partials/extract_admin/head.php"); ?> 
<!-- ======= End Head ======= -->

<!-- ======= MenuHaut ======= -->
<?php require_once("view/partials/extract_admin/menuHautcontent.php"); ?> 
<!-- ======= MenuHaut ======= -->


<!-- ======= MenuGauche ======= -->
<?php require_once("view/partials/extract_admin/menuGauche.php"); ?> 
<!-- ======= MenuGauche ======= -->


<!-- ======= content ======= -->
<?php require_once("view/partials/extract_admin/content.php"); ?> 
<!-- ======= content ======= -->


<!-- ======= Footer ======= -->
<?php require_once("view/partials/extract_admin/footer.php"); ?> 
<!-- ======= Footer ======= -->


<!-- ======= Foot ======= -->
<?php require_once("view/partials/extract_admin/foot.php"); ?> 
<!-- ======= Foot ======= -->