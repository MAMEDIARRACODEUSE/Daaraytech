<?php
session_start();
    require_once('../../../../model/user_db.php');
    if(empty($_SESSION['num'])){
        header('location:login');
    }



    if (isset($_COOKIE['__lingomin'])) {
        $leNum = intval($_COOKIE['__lingomin']);
        $requeteAdmin = $pdo->prepare("SELECT * FROM `users` WHERE id = ?");
        $requeteAdmin->execute(array($leNum));
        $adminInfo = $requeteAdmin->fetch();
        $adr_mail = $adminInfo['email'];
    }else{
        header("Location: login");
        exit();
    }

?>

<!-- ========= Head ======== -->
<?php require_once("../../../partials/extract_admin/head.php"); ?> 
<!-- ======= ========= Head ======== -->
<?php require_once("../../../partials/extract_admin/head.php"); ?> 
<!-- ======= End Head ======= -->

<!-- ======= MenuHaut ======= -->
<?php require_once("../../../partials/extract_admin/menuHaut.php"); ?> 
<!-- ======= MenuHaut ======= -->


<!-- ======= MenuGauche ======= -->
<?php require_once("../../../partials/extract_admin/menuGauche.php"); ?> 
<!-- ======= MenuGauche ======= -->

<?php 
    require_once("../../../../model/user_db.php");
    $users = profilUsers()->fetchAll();
?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Gestion des utilisateur</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <!-- Afficher message erreur -->
    <?php 
    if(isset($_GET["error"]) && $_GET["error"] == "Oui")
    {
    ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            Erreur de suppression ! 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php 
        }
    ?>


    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

                <button style="float:right" type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#largeModal">
                    View
                </button>
                
                <?php 
                    if (!isset($_GET["showFrmEdition"]) || $_GET["showFrmEdition"] != 1) 
                    {
                ?>
                 <h5  class="card-title">Liste des utilisateur</h5>
                <?php } ?>

                <?php 
                    if (isset($_GET["showFrmEdition"])) 
                    {
                ?>
                 <h5  class="card-title">Modification - Réalisation 
                </h5>
                <?php } ?>
                  <!-- Affiche la liste des users -->
                  <?php 
                    if (!isset($_GET["showFrmEdition"]) || $_GET["showFrmEdition"] != 1) 
                    {
                ?>
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Photo</th>
                        <th scope="col" class="text-center">Nom</th>
                        <th scope="col" class="text-center">Prenom</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Telephone</th> 
                        <th scope="col" class="text-center">Date</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($users as $user)
                        {
                        ?>
                        <tr>
                            <td class="text-center" scope="row">
                                <img width="50px" src="public/images/<?= $user['photo']?>" alt="Photo utilisateur">
                            </td>
                            <td class="text-center"><?= $user["nom"]?></td>
                            <td class="text-center"><?= $user["prenom"]?></td>
                            <td class="text-center"><?= $user["email"]?></td>                            
                            <td class="text-center"><?= $user["tel"]?></td>
                            <td class="text-center"><?= $user["date"]?></td>
                            <td class="text-center">
                             <!--     <button  title="Supprimer"  class="btn btn-danger">
                                    <a  class="text-white" href="userController?idUser=<?= $user["id"] ?>&action=delete" 
                                    onclick="confirm('Voulez vous bien supprimer cette utilisateur ?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>

                                <button class="btn btn-success">
                                    <a class="text-white" href="listeUser?iduUserAModifier=<?= $user["id"] ?>&showFrmEdition=1">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </button>-->
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
                <?php 
                    }
                ?>
                <!-- Formulaire d'edition d'une user -->


                <!-- Formulaire d'edition d'une user -->
                <?php 
                    if (isset($_GET["showFrmEdition"]) && $_GET["showFrmEdition"] == 1 ) 
                    {
                        $userAModifier = getUserById($_GET["iduUserAModifier"])->fetch();
                ?>
                <form action="userController" method="POST" enctype="multipart/form-data">
                <div class=" row mb-3">
                  <div class="col-sm-5">
                    <input type="text" class="form-control"  placeholder="Nom" name="nom" value=<?= $userAModifier["nom"]?> autofocus>
                  </div>
                  <div class="col-sm-5">
                    <input type="text" class="form-control"  placeholder="Prenom" name="prenom" value=<?= $userAModifier["prenom"]?>  autofocus>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-5">
                    <input type="email" class="form-control" placeholder="Email" name="email" value=<?= $userAModifier["email"]?> autofocus>
                  </div>  
                  <div class="col-sm-5">
                    <input type="number" class="form-control" placeholder="Telephone" name="tel" value=<?= $userAModifier["tel"]?>  autofocus>
                  </div> 
                </div>
           
                <div class="row mb-3">
                    
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="photo"  autofocus="on" value=<?= $userAModifier["password"]?>>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-5">
                    <input type="password" class="form-control" placeholder="Password" name="password"  value=<?= $userAModifier["password"]?> autofocus>
                  </div>
                </div>

                    <!-- iduser -->
                    <input hidden type="text" name="id" value=<?= $userAModifier["id"]?>>

                    <div class="row col-lg-4 mb-3 mx-auto">
                    <p>
                        <button type="submit" name="frmEdituser" class="btn btn-primary">Modifier</button>
                    </p>

                    
                    </div>
                </form>
                <?php 
                }
                ?>

            </div>
        </div>

        </div>
      </div>
    </section>

  </main>


    <!-- Modal Add Réalisation -->

    <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une réalisation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    
            <script type="text/javascript">
            
            function printPage3(){
                var divElements = document.getElementById('printDataHolder3').innerHTML;
                var oldPage = document.body.innerHTML;
                document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'><div class='padding'><b style='font-size: 16px;'><p class=''></p></b></div>"+divElements+"</body>";
                window.print();
                document.body.innerHTML = oldPage;
                }
                
            </script>   
            
    
                
         
                <form action="userController" method="post">
                 
                              
                    <div class="modal-body p-lg" id="printDataHolder3">
                        <div class="col-md-12">
                            <div class="form-group">   <center><label style="padding-top: 15px; padding-bottom:1px"  class="form-label">PRECIOUS BROS CONSTRUCTION<p style="padding-top: 0px;" class="-label">Calatagan Tibang, Virac, Catanduanes</p></label></center>
                                <center><img height="120" width="120" src="public/images/<?= $user["photo"]?>"></center>
                                <br><center><p><?= $user["prenom"],' ',  $user["nom"]?><br><?= $user["email"]?><br><?= $user["tel"]?></p></center>
                                <center><img src="">  </center> 
                                
                                <center><br><small style="padding-top: 20px">Person to be contacted in case of emergency,<br>  ()</small>
                                </center>
                            </div>
    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div style="padding-right: 12px;">
                            <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn success p-x-md" onclick="printPage3()">Print</button>
                        </div>
                    </div>
                </form>
               
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>



<!-- ======= Footer ======= -->
<?php require_once("../../../partials/extract_admin/footer.php"); ?> 
<!-- ======= Footer ======= -->


<!-- ======= Foot ======= -->
<?php require_once("../../../partials/extract_admin/foot.php"); ?> 
<!-- ======= Foot ======= -->nd Head ======= -->
