<?php
// Page de garde en PHP
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Médailles</title>
  

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
  <script src="https://d3js.org/d3.v6.min.js"></script>
  <link rel="stylesheet" href="assets/css/repartition_athlète.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/js/flag-icon.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        
        h2 i {
            color: #ffc107;
        }
        table {
            width: 40%; /* Réduit la largeur à 80% du conteneur */
            max-width: 600px; /* Limite la largeur maximale */
            margin: 20px auto; /* Centre et ajoute un espace autour */
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        th, td {
        padding: 10px; /* Diminue l'espace à l'intérieur des cellules */
        font-size: 0.9rem; /* Réduit la taille du texte */
        text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td {
            border: 1px solid #ddd;
        }
        .gold { background-color: #ffd700; color: #000; }
        .silver { background-color: #c0c0c0; color: #000; }
        .bronze { background-color: #cd7f32; color: #fff; }
        .country-flag {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .flag-icon {
            width: 25px;
            height: 15px;
        }
    </style>
</head>

<body class="index-page">
    
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/JO.svg" alt="">
        <h1 class="sitename">StatsOlympiques</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="active">Accueil</a></li>
          <li class="dropdown"><a href="#"><span>Statistiques</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li class="dropdown"><a href="extreme.php"><span>Les Extrêmes des JO</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a></li>
              <li class="dropdown"><a href="medaille.php"><span>Médailles</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a></li>
              <li class="dropdown"><a href="repartition_age.php"><span>Répartition</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a></li>
              <li class="dropdown"><a href="categorie.php"><span>Catégories</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a></li>
            </ul>
          </li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background">
      <div class="container position-relative">
        <h1>Nombre de médailles par pays</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Médailles</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->
     
    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

    <script>
    d3.csv('archive/medals.csv').then(function(data) {
        console.log("Données CSV chargées :", data);

        const medalCountByCountry = d3.rollup(data, v => ({
            gold: v.filter(d => d.medal_type === "Gold Medal").length,
            silver: v.filter(d => d.medal_type === "Silver Medal").length,
            bronze: v.filter(d => d.medal_type === "Bronze Medal").length,
            total: v.length
        }), d => d.country);

        const medalData = Array.from(medalCountByCountry, ([country, counts]) => ({
            country,
            total: counts.total,
            gold: counts.gold,
            silver: counts.silver,
            bronze: counts.bronze
        })).sort((a, b) => b.total - a.total);

        const tbody = d3.select('#medalTable tbody');
        const rows = tbody.selectAll('tr')
            .data(medalData)
            .enter()
            .append('tr');

        rows.append('td')
            .html(d => `<div class="country-flag">
                <span class="flag-icon flag-icon-${d.country.toLowerCase()}"></span>${d.country}
            </div>`);
        rows.append('td').text(d => d.total);
        rows.append('td').attr('class', 'gold').text(d => d.gold);
        rows.append('td').attr('class', 'silver').text(d => d.silver);
        rows.append('td').attr('class', 'bronze').text(d => d.bronze);
    }).catch(function(error) {
        console.error("Erreur lors du chargement du fichier CSV :", error);
    });
</script>

    

    <section id="features" class="features section">
    <div class="container section-title" data-aos="fade-up">
    <h2>Classements</h2>
    </div>
        <!-- Tableau HTML vide -->
        <table id="medalTable">
            <thead>
                <tr>
                    <th>Pays</th>
                    <th>Total Médailles</th>
                    <th class="gold">🥇 Or</th>
                    <th class="silver">🥈 Argent</th>
                    <th class="bronze">🥉 Bronze</th>
                </tr>
            </thead>
            <tbody>
                <!-- Le tableau sera rempli ici dynamiquement -->
            </tbody>
    </table>

    </section><!-- /Features Section -->
    <div style="text-align: center; margin-top: 20px;">
    <a href="TotalMedailles.php" style="display: inline-block; padding: 10px 20px; background-color: #1e4356; color: white; text-decoration: none; border-radius: 5px; font-size: 1rem; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);">
        Pour un rendu visuel, cliquez ici
    </a>
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

  
</div>

</body>

</html>