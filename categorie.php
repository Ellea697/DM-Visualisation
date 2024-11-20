<?php
// Page de garde en PHP
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Catégorie</title>
  
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


  <style>
        /* Style général */
        select {
            display: block;
            margin: 20px auto 20px;
            padding: 8px 12px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23333" d="M2 0L0 2h4z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px;
        }

        select:hover {
            border-color: #666;
        }

        svg {
            display: block;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .bar {
            fill: #1e4356;
            transition: fill 0.3s ease;
        }

        .bar:hover {
            fill: #68a4c4;
        }

        
        .axis text {
            font-size: 12px;
        }

        .axis path,
        .axis line {
            fill: none;
            stroke: #000;
        }

        .container2 {
            display: flex;
            justify-content: space-around;
            margin: 20px auto;
            max-width: 1200px;
        }

        .container3 {
            margin: 20px auto;
            max-width: 1200px;
            text-align: center;
            margin-bottom: 0px;
            padding-bottom: 0px; 
        }

        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 30%;
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
        <h1>Disciplines et catégories</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Catégories</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->
     
    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">
    <div class="container3">
    <label for="discipline-select">Choisir une Discipline :</label>
    <select id="discipline-select"></select>
    <svg id="barchart" width="1200"></svg>
    </div>

    <div class="container2">
        <div class="card" id="total-disciplines">
            <h3 class="chart-title">Nombre total de disciplines</h3>
        </div>
        <div class="card" id="discipline-represented">
            <h3 class="chart-title">Discipline avec le plus d'athlètes</h3>
        </div>
        <div class="card" id="most-categories">
            <h3 class="chart-title">Discipline avec le plus de catégories</h3>
        </div>
    </div>

    <script>
        d3.csv("archive/athletes.csv").then(data => {
            // Pré-traitement des données
            data.forEach(d => {
                d.disciplines = d.disciplines.replace(/[\[\]']+/g, '').trim();
                d.events = d.events.replace(/[\[\]""]+/g, '').trim();
                d.athletes = +d.athletes; // Assurez-vous que la colonne "athletes" contient un nombre
            });

            // Obtenir les disciplines uniques
            const disciplines = Array.from(new Set(data.map(d => d.disciplines)));

            // Ajouter un menu déroulant
            const select = d3.select("#discipline-select");
            select.selectAll("option")
                .data(disciplines)
                .enter()
                .append("option")
                .text(d => d)
                .attr("value", d => d);

            // Dimensions initiales du graphique
            const margin = { top: 20, right: 30, bottom: 50, left: 150 };
            const width = 1200 - margin.left - margin.right;

            const svg = d3.select("#barchart");

            // Échelles
            const x = d3.scaleLinear().range([0, width]);
            const y = d3.scaleBand().padding(0.1);

            // Ajouter des conteneurs pour les axes
            const chartGroup = svg.append("g").attr("transform", `translate(${margin.left},${margin.top})`);
            const xAxisGroup = chartGroup.append("g");
            const yAxisGroup = chartGroup.append("g");

            // Fonction pour mettre à jour le graphique
            function updateChart(discipline) {
                // Filtrer les catégories pour la discipline choisie
                const filteredData = data.filter(d => d.disciplines === discipline);
                const categoryCounts = d3.rollup(
                    filteredData,
                    v => v.length,
                    d => d.events
                );

                const categories = Array.from(categoryCounts, ([events, count]) => ({
                    events,
                    count
                }));

                // Calculer la hauteur dynamique
                const barHeight = 30; // Hauteur de chaque barre
                const height = categories.length * barHeight + margin.top + margin.bottom;
                svg.attr("height", height);

                // Mettre à jour les échelles
                x.domain([0, d3.max(categories, d => d.count)]);
                y.domain(categories.map(d => d.events)).range([0, categories.length * barHeight]);

                // Mettre à jour les axes
                xAxisGroup
                    .attr("transform", `translate(0, ${categories.length * barHeight})`)
                    .transition()
                    .call(d3.axisBottom(x).ticks(5));
                yAxisGroup
                    .transition()
                    .call(d3.axisLeft(y));

                // Liaison des données pour les barres
                const bars = chartGroup.selectAll(".bar")
                    .data(categories, d => d.events);

                // Entrée
                bars.enter()
                    .append("rect")
                    .attr("class", "bar")
                    .attr("x", 0)
                    .attr("y", d => y(d.events))
                    .attr("height", y.bandwidth())
                    .attr("width", 0) // Animation vers la largeur finale
                    .attr("fill", "steelblue")
                    .transition()
                    .duration(800)
                    .attr("width", d => x(d.count));

                // Mise à jour
                bars.transition()
                    .duration(800)
                    .attr("y", d => y(d.events))
                    .attr("height", y.bandwidth())
                    .attr("width", d => x(d.count));

                // Sortie
                bars.exit().remove();

                // Ajouter des étiquettes de texte
                const labels = chartGroup.selectAll(".label")
                    .data(categories, d => d.events);

                // Entrée des étiquettes
                labels.enter()
                    .append("text")
                    .attr("class", "label")
                    .attr("x", d => x(d.count) + 5) // Positionner légèrement après la barre
                    .attr("y", d => y(d.events) + y.bandwidth() / 2)
                    .attr("dy", "0.35em") // Centrer verticalement
                    .attr("fill", "black")
                    .text(d => d.count);

                // Mise à jour des étiquettes
                labels.transition()
                    .duration(800)
                    .attr("x", d => x(d.count) + 5)
                    .attr("y", d => y(d.events) + y.bandwidth() / 2)
                    .text(d => d.count);

                // Sortie des anciennes étiquettes
                labels.exit().remove();
            }

            // 1. Nombre total de disciplines
            const totalDisciplines = disciplines.length;

            d3.select("#total-disciplines")
                .append("p")
                .text(`${totalDisciplines}`)
                .style("font-size", "1.5rem")
                .style("text-align", "center")
                .style("color", "#1e4356");

            // 2. Discipline avec le plus d'athlètes
            const disciplinesCounts = d3.rollup(data, v => v.length, d => d.disciplines);
            const disciplineCountsArray = Array.from(disciplinesCounts, ([disciplines, count]) => ({ disciplines, count }));
    
            const mostRepresentedDiscipline = disciplineCountsArray.reduce((a, b) => a.count > b.count ? a : b);

            d3.select("#discipline-represented")
                .append("p")
                .text(`${mostRepresentedDiscipline.disciplines} (${mostRepresentedDiscipline.count} athlètes)`)
                .style("font-size", "1.5rem")
                .style("text-align", "center")
                .style("color", "#1e4356");

            // 3. Discipline avec le plus de catégories
            const disciplineByCategories = d3.rollup(
                data,
                v => new Set(v.map(d => d.events)).size,
                d => d.disciplines
            );

            const maxCategories = Array.from(disciplineByCategories, ([disc, categories]) => ({ disc, categories }))
                .reduce((max, current) => (current.categories > max.categories ? current : max));

            d3.select("#most-categories")
                .append("p")
                .text(`${maxCategories.disc} (${maxCategories.categories})`)
                .style("font-size", "1.5rem")
                .style("text-align", "center")
                .style("color", "#1e4356");

            // Initialisation du graphique
            updateChart(disciplines[0]);

            // Ajouter un événement pour changer la discipline
            select.on("change", function () {
                const selectedDiscipline = this.value;
                updateChart(selectedDiscipline);
            });
        }).catch(error => {
            console.error("Erreur lors du chargement des données :", error);
        });
    </script>

    

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