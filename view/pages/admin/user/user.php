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
    require_once("../../../../model/user_db.php");
    $users = listeUsers()->fetchAll();
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
                    Ajouter
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
                                <button  title="Supprimer"  class="btn btn-danger">
                                    <a  class="text-white" href="userController?idUser=<?= $user["id"] ?>&action=delete" 
                  onclick="confirm('Voulez vous bien supprimer cette utilisateur ?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>

                                <button class="btn btn-success" >
                                    <a class="text-white" href="listeUser?idUserAModifier=<?= $user["id"] ?>&showFrmEdition=1">
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


              <!--  Formulaire d'edition d'une user --> 
                <?php 
                    if (isset($_GET["showFrmEdition"]) && $_GET["showFrmEdition"] == 1 ) 
                    {
                        $userAModifier = getUserById($_GET["idUserAModifier"])->fetch();
                ?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="profile ">
  <div class="row ">
    <div class="col-4">

      <div class="card">
        <div class="card-body profile-card pt-7 d-flex flex-column align-items-left">

          <img src="public/images/<?= $userAModifier["photo"]?>" alt="Profile" class="rounded-circle">
          <h2><?= $userAModifier["prenom"]," ",$userAModifier["nom"]?></h2>
          <h3>Web Designer</h3>
          <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">About</h5>
              <p class="small fst-italic">Bienvenue sur Daaray Technologie, une école virtuelle gratuite composée de groupe de développeurs très passionnés. </p>

              <h5 class="card-title">Profile Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                <div class="col-lg-9 col-md-8"><?= $userAModifier["prenom"],' ',$userAModifier["nom"]?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Company</div>
                <div class="col-lg-9 col-md-8">Daaray Technologie</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Job</div>
                <div class="col-lg-9 col-md-8">Web Designer</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Country</div>
                <div class="col-lg-9 col-md-8">Affrique</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Address</div>
                <div class="col-lg-9 col-md-8">Dakar</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Phone</div>
                <div class="col-lg-9 col-md-8">+221 <?= $userAModifier["tel"]?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><?= $userAModifier["email"]?></div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form action="userController" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <img src=" public/images/<?= $userAModifier["photo"]?>" alt="Profile">
                    <div class="pt-2">
                      <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                      <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="nom" type="text" class="form-control" id="nom" value="<?= $userAModifier["nom"]?>">
                  </div>
                </div>  
                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Prenom</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="prenom" type="text" class="form-control" id="prenom" value="<?= $userAModifier["prenom"]?>">
                  </div>
                </div>

              

                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="text" class="form-control" id="email" value="<?= $userAModifier["email"]?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Telephone</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="tel" type="text" class="form-control" id="tel" value="<?= $userAModifier["tel"]?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Mot de pass</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="text" class="form-control" id="password" value="<?= $userAModifier["password"]?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Photo</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="photo" type="file" class="form-control" id="photo" >
                  </div>
                </div>
        <!-- idservice -->
        <input hidden type="text" name="id" value="<?= $userAModifier["id"]?>">

                

                <div class="text-center">
                  <button type="submit" name="frmEditUser" class="btn btn-primary">Save Changes</button>
                </div>
              </form><!-- End Profile Edit Form -->

            </div>

            
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<?php
    }
    ?>
</main>
<!-- End #main -->

                <!--  <form action="userController" method="POST" enctype="multipart/form-data">
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
                    <input class="form-control" type="file" id="formFile" name="photo"  autofocus="on" value=<?= $userAModifier["photo"]?>>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-5">
                    <input type="password" class="form-control" placeholder="Password" name="password"  value=<?= $userAModifier["password"]?> autofocus>
                  </div>
                </div>

                    
                    <input hidden type="text" name="id" value=<?= $userAModifier["id"]?>>

                    <div class="row col-lg-4 mb-3 mx-auto">
                    <p>
                        <button type="submit" name="frmEditUser" class="btn btn-primary">Modifier</button>
                    </p>

                    
                    </div>
                </form>-->
                <?php 
                
                ?>

            </div>
        </div>

        </div>
      </div>
    </section>

  </main>


    <!-- Modal Add Réalisation -->

    <div class="modal fade" id="largeModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une réalisation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="userController" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Nom -->
                        <div class=" row mb-3">
                  <div class="col-sm-5">
                    <input type="text" class="form-control"  placeholder="Nom" name="nom" required autofocus>
                  </div>
                  <div class="col-sm-5">
                    <input type="text" class="form-control"  placeholder="Prenom" name="prenom" required autofocus>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-5">
                    <input type="email" class="form-control" placeholder="Email" name="email" required autofocus>
                  </div>  
                  <div class="col-sm-5">
                    <input type="number" class="form-control" placeholder="Telephone" name="tel" required autofocus>
                  </div> 
                </div>
           
                <div class="row mb-3">
                    
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="photo" required autofocus="on">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-5">
                    <input type="password" class="form-control" placeholder="Password" name="password"   autofocus>
                  </div>
                </div>

                    <div class="row col-lg-4 mb-3 mx-auto">
                    <p>
                        <button type="submit" name="frmAddUser" class="btn btn-primary">Enrégistrer</button>
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
    
</main><!-- End #main -->
    
        <!--==== Footer ======= -->
<?php require_once("../../../partials/extract_admin/footer.php"); ?> 
<!-- ======= Footer ======= -->


<!-- ======= Foot ======= -->
<?php require_once("../../../partials/extract_admin/foot.php"); ?> 
<!-- ======= Foot ======= -->