<?php
// Page de garde en PHP
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Page de Garde</title>
  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="test.php" class="logo d-flex align-items-center">
        <img src="assets/img/JO.svg" alt="">
        <h1 class="sitename">StatsOlympiques</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="test.php" class="active">Accueil</a></li>
          <li class="dropdown"><a href="#"><span>Statistiques</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span>Coaches et Athlètes</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="histogram.php">Histogram 1</a></li>
                  <li><a href="histogram2.php">Histogram 2</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#"><span>Distribution des Médailles</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="medaille.php">Medailles</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#"><span>Performances</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="paysJO.php">paysJO</a></li>
                  <li><a href="venue.php">venue</a></li>
                  <li><a href="teams.php">teams</a></li>
                  <li><a href="technicalOfficial.php">technicalOfficial</a></li>
                  <li><a href="schedulePrimary.php">schedulePrimary</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#"><span>Événements</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="camembert.php">camembert</a></li>
                  <li><a href="event.php">event</a></li>
                  <li><a href="torch_route.php">torch_route</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="team.html">Team</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <!-- <img src="assets/img/cercle.jpg" alt="" data-aos="fade-in"> -->

      <div id="hero-carousel" class="carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="container position-relative">

          <div class="carousel-item active">
            <div class="carousel-container">
              <h2>Bienvenue sur notre site</h2>
              <p>Découvrez les statistiques des Jeux Olympiques à travers plusieurs visualisations intéressantes.</p>
              <a href="#about" class="btn-get-started">Voir plus</a>
            </div>
          </div><!-- End Carousel Item -->

          <div class="carousel-item">
            <div class="carousel-container">
              <h2>Informations pratiques</h2>
              <p>Toutes les informations présentes sur ce site proviennent d'une base de donnée Kaggle</p>
              <a href="#about" class="btn-get-started">Voir plus</a>
            </div>
          </div><!-- End Carousel Item -->

          <div class="carousel-item">
            <div class="carousel-container">
              <h2>Autres Infos</h2>
              <p>N'hésitez pas à vous abonnez à notre newsletter  afin d'être informé de nos actualités</p>
              <a href="#about" class="btn-get-started">Voir plus</a>
            </div>
          </div><!-- End Carousel Item -->

          <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
          </a>

          <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
          </a>

          <ol class="carousel-indicators"></ol>

        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- Stats Section -->
    
    <section id="stats" class="stats section light-background">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Chiffres clés</h2>-
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="10500" data-purecounter-duration="1" class="purecounter"></span>
              <p>Athlètes</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="329" data-purecounter-duration="1" class="purecounter"></span>
              <p>Epreuves</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="92" data-purecounter-duration="1" class="purecounter"></span>
              <p>Records</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="41" data-purecounter-duration="1" class="purecounter"></span>
              <p>Sites Olympiques</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->
    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <div class="icon">
                <i class="bi bi-activity"></i>
              </div>
              <a href="extreme.php" class="stretched-link">
                <h3>Les athletes extrêmes</h3>
              </a>
              <p>Dans cette compétition de 26,8 ans de moyenne, des athlètes sortent du lot. Venez découvrir le/la plus grand(e);le/la plus lourd(e)... </p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <div class="icon">
                <i class="bi bi-broadcast"></i>
              </div>
              <a href="medaille.php" class="stretched-link">
                <h3>Distribution des Médailles</h3>
              </a>
              <p>Cette page se concentrera sur la répartition des médailles lors des Jeux Olympiques, montrant les pays les plus performants, les tendances et les records.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item item-teal position-relative">
              <div class="icon">
                <i class="bi bi-easel"></i>
              </div>
              <a href="repartition_age.php" class="stretched-link">
                <h3>Répartition hommes/femmes dans chaque discipline</h3>
              </a>
              <p>Cette page donnera un aperçu des statistiques de la répartition des athletes par genre et par tranche d'âge.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item item-red position-relative">
              <div class="icon">
                <i class="bi bi-bounding-box-circles"></i>
              </div>
              <a href="torch_route.php" class="stretched-link">
                <h3>Disciplines et catégories</h3>
              </a>
              <p>Une page dédiée aux différentes disciplines et événements olympiques, avec des informations sur les épreuves, les résultats et l'évolution des sports dans les JO.</p>
            </div>
          </div><!-- End Service Item -->
        </div>

      </div>

    </section><!-- /Featured Services Section -->


    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Paris 2024</h2>-
        <p>Les Jeux Olympiques ont été créés en 1896 à Athènes, réinstaurant la tradition des compétitions sportives de l'Antiquité. Aujourd'hui, ils rassemblent des athlètes du monde entier pour promouvoir l'unité et l'excellence à travers le sport. </p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
            <img src="https://th.bing.com/th/id/OIP.TOLO2vO8Qh6Wus8j9xoRyAAAAA?rs=1&pid=ImgDetMain" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
            <h3>La Cérémonie d'Ouverture Inédite sur la Seine</h3>
            <p class="fst-italic">
              La cérémonie d'ouverture des Jeux Olympiques de Paris 2024 se déroulera pour la première fois sur la Seine, transformant ainsi la capitale en un immense décor vivant. Plus de 10 000 athlètes défileront sur des bateaux, passant par des monuments emblématiques de Paris, tels que la Tour Eiffel et le Louvre.
            </p>
            <ul>
              <li><i class="bi bi-check"></i><span> La cérémonie sera gratuite pour une grande partie du public, avec des places payantes sur certains quais.</span></li>
              <li><i class="bi bi-check"></i> <span>Les spectateurs pourront profiter de 80 écrans géants et d'une sonorisation de qualité pour ne rien manquer du spectacle.</span></li>
              <li><i class="bi bi-check"></i> <span>Plus de 320 000 spectateurs sont attendus, faisant de cet événement la plus grande cérémonie d'ouverture olympique à ce jour.</span></li>
            </ul>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400_opt_1/ec6732137979487.6214e2a2a11bc.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="200">
            <h3>Les Nouvelles Disciplines Olympiques</h3>
            <p class="fst-italic">
              Les JO de Paris 2024 marqueront l’introduction du breaking, une discipline de danse acrobatique, ainsi que des révisions des formats pour des sports comme le surf et le skateboard. Ces ajouts visent à moderniser les Jeux et attirer un public plus jeune et diversifié.
            </p>
            <ul>
              <li><i class="bi bi-check"></i><span> Le breaking, discipline urbaine, fera ses débuts sur la scène olympique.</span></li>
              <li><i class="bi bi-check"></i> <span>Le surf et le skateboard bénéficieront de formats adaptés pour une expérience plus dynamique.</span></li>
              <li><i class="bi bi-check"></i> <span>Ces sports s'inscrivent dans la volonté des Jeux de s'ouvrir à des pratiques contemporaines.</span></li>
            </ul>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out">
            <img src="https://www.cmpbois.com/photos/20220818-jeux-olympiques-2024-village-athletes.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="300">
            <h3>Le Village Olympique Durable</h3>
            <p class="fst-italic">
              Le village olympique de Paris 2024 se distingue par son design durable. Conçu pour minimiser son empreinte écologique, il sera ensuite transformé en logements permanents après les Jeux, contribuant à la revitalisation de la région.
            </p>
            <ul>
              <li><i class="bi bi-check"></i><span> Le village utilise des matériaux recyclés et intègre des solutions énergétiques innovantes.</span></li>
              <li><i class="bi bi-check"></i> <span>Après les JO, le site sera reconverti en espace résidentiel et communautaire pour répondre aux besoins urbains locaux.</span></li>
              <li><i class="bi bi-check"></i> <span>Ce projet est un modèle de développement durable pour les événements futurs.</span></li>
            </ul>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out">
            <img src="https://www.hfrance.fr/wp-content/uploads/2024/07/1720637085_94_Paris_Olympics-1200x648.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="400">
            <h3>Accessibilité et Impact Économique</h3>
            <p class="fst-italic">
              Les JO de Paris 2024 seront accessibles au plus grand nombre. L'événement génère déjà un énorme impact économique, avec un afflux de visiteurs internationaux et une stimulation significative du tourisme.
            </p>
            <ul>
              <li><i class="bi bi-check"></i><span> L'accès gratuit à la cérémonie d'ouverture pour une grande partie du public souligne l'aspect inclusif des Jeux.</span></li>
              <li><i class="bi bi-check"></i> <span>Les JO devraient stimuler le tourisme et générer des milliards d'euros pour l'économie locale.</span></li>
              <li><i class="bi bi-check"></i> <span>Cette inclusivité vise à faire des JO un événement mondial accessible à tous.</span></li>
            </ul>
          </div>
        </div><!-- Features Item -->

      </div>

    </section><!-- /Features Section -->

  </main>

  <footer id="footer" class="footer dark-background text-white py-4">
  <div class="container text-center">
    <h4 class="mb-3">Rejoignez notre Newsletter</h4>
    <p class="mb-4">Recevez les dernières analyses et statistiques des JO Paris 2024 directement dans votre boîte mail.</p>
    <form action="forms/newsletter.php" method="post" class="php-email-form d-flex justify-content-center">
      <input type="email" name="email" class="form-control w-50 me-2" placeholder="Votre email" required>
      <button type="submit" class="btn btn-primary">S'abonner</button>
    </form>
    <div class="mt-3 small">
      <span class="loading d-none">Chargement...</span>
      <span class="error-message text-danger d-none">Une erreur s'est produite.</span>
      <span class="sent-message text-success d-none">Merci pour votre abonnement !</span>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row gy-4 text-center text-md-start">
      <!-- Section About -->
      <div class="col-md-4">
        <h5>Stats Olympiques</h5>
        <p>Découvrez les analyses les plus détaillées et les statistiques incontournables des Jeux Olympiques Paris 2024.</p>
      </div>

      <!-- Section Links -->
      <div class="col-md-4">
        <h5>Liens Utiles</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white text-decoration-none">Accueil</a></li>
          <li><a href="#" class="text-white text-decoration-none">À propos</a></li>
          <li><a href="#" class="text-white text-decoration-none">Nos services</a></li>
          <li><a href="#" class="text-white text-decoration-none">Mentions légales</a></li>
        </ul>
      </div>

      <!-- Section Social -->
      <div class="col-md-4">
        <h5>Suivez-nous</h5>
        <div class="social-links d-flex justify-content-center justify-content-md-start">
          <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
          <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="container text-center mt-4">
    <p class="small">© 2024 <strong>Stats Olympiques</strong>. Tous droits réservés.</p>
  </div>
</footer>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>