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
require_once("../../../../model/contact_db.php");
$contacts = listeContacts()->fetchAll();
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
    if (isset($_GET["error"]) && $_GET["error"] == "Oui") {
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
                        if (!isset($_GET["showFrmEdition"]) || $_GET["showFrmEdition"] != 1) {
                        ?>
                            <h5 class="card-title">Liste des utilisateur</h5>
                        <?php } ?>

                        <?php
                        if (isset($_GET["showFrmEdition"])) {
                        ?>
                            <h5 class="card-title">Modification - Réalisation
                            </h5>
                        <?php } ?>
                        <!-- Affiche la liste des contacts -->
                        <?php
                        if (!isset($_GET["showFrmEdition"]) || $_GET["showFrmEdition"] != 1) {
                        ?>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Photo</th>
                                        <th scope="col" class="text-center">Nom</th>
                                        <th scope="col" class="text-center">Prenom</th>
                                        <th scope="col" class="text-center">Email</th>
                                        <th scope="col" class="text-center">message</th>
                                        <th scope="col" class="text-center">Date</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($contacts as $contact) {
                                    ?>
                                        <tr>
                                            <td class="text-center" scope="row">
                                                <img width="50px" src="public/images/<?= $contact['photo'] ?>" alt="Photo utilisateur">
                                            </td>
                                            <td class="text-center"><?= $contact["nom"] ?></td>
                                            <td class="text-center"><?= $contact["prenom"] ?></td>
                                            <td class="text-center"><?= $contact["email"] ?></td>
                                            <td class="text-center"><?= $contact["message"] ?></td>
                                            <td class="text-center"><?= $contact["date"] ?></td>
                                            <td class="text-center">
                                                <button title="Supprimer" class="btn btn-danger">
                                                    <a class="text-white" href="ContactController?idContact=<?= $contact["id"] ?>&action=delete" onclick="confirm('Voulez vous bien supprimer cette réalisation ?')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </button>

                                                <button class="btn btn-success">
                                                    <a class="text-white" href="listeContact?idContactAModifier=<?= $contact["id"] ?>&showFrmEdition=1">
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


                        <!-- Formulaire d'edition d'une contact -->


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