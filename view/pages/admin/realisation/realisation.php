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
    require_once("../../../../model/realisation_db.php");
    $realisations = listeRealisations()->fetchAll();
?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Gestion des réalisations</h1>
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
                    Ajouter
                </button>
                
                <?php 
                    if (!isset($_GET["showFrmEdition"]) || $_GET["showFrmEdition"] != 1) 
                    {
                ?>
                 <h5  class="card-title">Liste des réalisations</h5>
                <?php } ?>

                <?php 
                    if (isset($_GET["showFrmEdition"])) 
                    {
                ?>
                 <h5  class="card-title">Modification - Réalisation 
                </h5>
                <?php } ?>
                <!-- Affiche la liste des realisations -->
                <?php 
                    if (!isset($_GET["showFrmEdition"]) || $_GET["showFrmEdition"] != 1) 
                    {
                ?>
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
                        foreach($realisations as $realisation)
                        {
                        ?>
                        <tr>
                            <td class="text-center" scope="row">
                                <img width="50px" src="public/images/<?= $realisation['photo']?>" alt="Photo réalisation">
                            </td>
                            <td class="text-center"><?= $realisation["nom"]?></td>
                            <td class="text-center"><?= $realisation["description"]?></td>
                            <td class="text-center"><?= $realisation["date"]?></td>
                            <td class="text-center">
                                <button  title="Supprimer"  class="btn btn-danger">
                                    <a  class="text-white" href="realisationController?idRealisation=<?= $realisation["id"] ?>&action=delete" 
                                    onclick="confirm('Voulez vous bien supprimer cette réalisation ?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>

                                <button class="btn btn-success">
                                    <a class="text-white" href="listeRealisation?idRealisationAModifier=<?= $realisation["id"] ?>&showFrmEdition=1">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </button>
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


                <!-- Formulaire d'edition d'une realisation -->
                <?php 
                    if (isset($_GET["showFrmEdition"]) && $_GET["showFrmEdition"] == 1 ) 
                    {
                        $realisationAModifier = getRealisationById($_GET["idRealisationAModifier"])->fetch();
                ?>
                <form action="realisationController" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Nom -->
                        <div class="col-lg-6 mb-3">
                            <label for="nom" class="control-label mb-2">Nom</label>
                            <input id="nom" type="text" name="nom" class="form-control" placeholder="Entrer un nom" value=<?= $realisationAModifier["nom"]?> required autofocus>
                        </div>

                        <!-- Photo -->
                        <div class="col-lg-6 mb-3">
                            <label for="photo" class="control-label mb-2">Photo</label>
                            <input id="photo" type="file" name="photo" class="form-control" placeholder="Entrer un nom">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="row col-lg-12 mb-3">
                        <label for="date" class="control-label mb-2">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5"><?= $realisationAModifier["description"]?></textarea>
                    </div>

                    <!-- idRealisation -->
                    <input hidden type="text" name="id" value="<?= $realisationAModifier["id"]?>">

                    <div class="row col-lg-4 mb-3 mx-auto">
                    <p>
                        <button type="submit" name="frmEditRealisation" class="btn btn-primary">Modifier</button>
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
                <form action="realisationController" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Nom -->
                        <div class="col-lg-6 mb-3">
                            <label for="nom" class="control-label mb-2">Nom</label>
                            <input id="nom" type="text" name="nom" class="form-control" placeholder="Entrer un nom" required autofocus>
                        </div>

                        <!-- Photo -->
                        <div class="col-lg-6 mb-3">
                            <label for="photo" class="control-label mb-2">Photo</label>
                            <input id="photo" type="file" name="photo" class="form-control" placeholder="Entrer un nom" required autofocus="on">
                        </div>
                    </div>

                    <div class="row col-lg-12 mb-3">
                        <label for="date" class="control-label mb-2">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="row col-lg-4 mb-3 mx-auto">
                    <p>
                        <button type="submit" name="frmAddRealisation" class="btn btn-primary">Enrégistrer</button>
                        <button type="reset" class="btn btn-danger">Annuler</button>
                    </p>

                    
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
<!-- ======= Foot ======= -->