  <!-- ======= Contact ======= -->
  <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Nulla dolorum nulla nesciunt rerum facere sed ut inventore quam porro nihil id ratione ea sunt quis dolorem dolore earum</p>
        </div>

        <div class="row gx-lg-0 gy-4">

          <div class="col-lg-4">

            <div class="info-container d-flex flex-column align-items-center justify-content-center">
              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Location:</h4>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 55</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-clock flex-shrink-0"></i>
                <div>
                  <h4>Open Hours:</h4>
                  <p>Mon-Sat: 11AM - 23PM</p>
                </div>
              </div><!-- End Info Item -->
            </div>

          </div>
          <?php 
         
          ?> 
          <div class="col-lg-8">
            <form action="contactController" method="POST" enctype="multipart/form-data">
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
                  </div> 
                </div>
                 <div class="row mb-3">                   
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="photo" required autofocus="on">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-5">
                    <input type="text" class="form-control" placeholder="Message" name="message"   autofocus>
                  </div>
                </div>
               
                    <div class="row col-lg-4 mb-3 mx-auto">
                    <p>
                        <button type="submit" name="frmAddContact" class="btn btn-primary">Enrégistrer</button>
                        <button type="reset" class="btn btn-danger">Annuler</button>
                    </p>

                    
                    </div>
                </form>
          </div><!-- End Contact Form -->

        </div>

      </div>
    </section>
    <!-- ======= Contact  ======= -->