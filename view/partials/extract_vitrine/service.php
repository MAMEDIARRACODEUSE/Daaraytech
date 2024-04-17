 
  <section id="services" class="services sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Services</h2>
          <p>Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat sunt id nobis omnis tiledo stran delop</p>
        </div>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
        <?php 
          require_once("model/service_db.php");
          $services = listeServices()->fetchAll();
          foreach($services as $service)
          {
          ?> 
          <div class="col-lg-4 col-md-6">
            <div class="service-item  position-relative">
              <div class="icon">
                <img src="public/images/<?= $service["photo"]?>" class="img-fluid" alt="">
              </div>
              <h3><?= $service["nom"]?></h3>
              <p><?= $service["description"]?></p>
              <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->
          <?php
            }
          ?> 
          <!-- End Service Item -->

        </div>

      </div>
    </section>
 

    <!-- ======= End Services ======= --> 