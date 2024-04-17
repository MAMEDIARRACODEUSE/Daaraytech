 <!-- ======= Réalisations ======= -->
 <section id="portfolio" class="portfolio sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Réallisation de Daaray Technologie </h2>
          <p>Des projets web réalisés avec passion .Ils aiment notre accompagnement .Samane corporation exerce son expertise de développement de site internet, d’application mobile, de marketing digital et de communication pour des clients, à l’échelle nationale et de tous secteurs d’activité.</p>
        </div>

        <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

          <div>
            <ul class="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-product">Product</li>
              <li data-filter=".filter-branding">Branding</li>
              <li data-filter=".filter-books">Books</li>
            </ul><!-- End Portfolio Filters -->
          </div>

          <div class="row gy-4 portfolio-container">
          <?php 
            require_once("model/realisation_db.php");
            $realisations = listeRealisations()->fetchAll();
            foreach($realisations as $realisation)
            {
            ?>
            <div class="col-xl-4 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="public/images/<?= $realisation["photo"]?>" data-gallery="portfolio-gallery-app" class="glightbox">
                  <img src="public/images/<?= $realisation["photo"]?>" class="img-fluid" alt="">
                </a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details"><?= $realisation["nom"]?></a></h4>
                  <p><?= $realisation["description"]?></p>
                </div>
              </div>
            </div>
            <?php 
              }
            ?>

          </div><!-- End Portfolio Container -->

        </div>

      </div>
    </section>
    <!-- ======= Réalisations ======= -->