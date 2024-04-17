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
<!-- ======= End Head ======= -->

<!-- ======= MenuHaut ======= -->
<?php require_once("../../../partials/extract_admin/menuHaut.php"); ?> 
<!-- ======= MenuHaut ======= -->


<!-- ======= MenuGauche ======= -->
<?php require_once("../../../partials/extract_admin/menuGauche.php"); ?> 
<!-- ======= MenuGauche ======= -->

<?php 
    require_once("../../../../model/service_db.php");
    $services = listeServicesSupprimer()->fetchAll();
?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Gestion des sevices</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                
                 <h5  class="card-title">Liste des sevices supprimées</h5>

                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Photo</th>
                        <th scope="col" class="text-center">Nom</th>
                        <th scope="col" class="text-center">Description</th>
                        <th scope="col" class="text-center">Date</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($services as $service)
                        {
                        ?>
                        <tr >
                            <td class="text-center" scope="row">
                                <img width="50px" src="public/images/<?= $service['photo']?>" alt="Photo sevice">
                            </td>
                            <td class="text-center"><?= $service["nom"]?></td>
                            <td class="text-center"><?= $service["description"]?></td>
                            <td class="text-center"><?= $service["date"]?></td>
                            <td class="text-center">
                                <button  title="Supprimer" type="button" class="btn btn-danger">
                                   <a class="text-white" href="serviceController?idService=<?= $service["id"] ?>&action=restaurer">
                                    <strong>Restauter</strong>
                                   </a>
                                </button>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>

        </div>
      </div>
    </section>

  </main>


   
<!-- ======= Footer ======= -->
<?php require_once("../../../partials/extract_admin/footer.php"); ?> 
<!-- ======= Footer ======= -->


<!-- ======= Foot ======= -->
<?php require_once("../../../partials/extract_admin/foot.php"); ?> 
<!-- ======= Foot ======= -->