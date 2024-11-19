<?php
// Page de garde en PHP
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
  
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
                  <li><a href="medailles.php">Medailles</a></li>
                  <li><a href="TotalMedailles.php">Total Medailles</a></li>
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