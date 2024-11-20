<?php
// Page de garde en PHP
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Répartition</title>
  
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
        <h1>Répartition Hommes/Femmes dans chaque discipline</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Répartition</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->
     
    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

    <div class="container">
    <form class="form">
      <div class="form__group">
        <label for="discipline-select">Sectionner une discipline</label>
        <select id="discipline-select" name="discipline-select" >
            <option value="all">Toutes</option>
       </select>
      </div>
    </form>
    <div id="kpi-cards" class="kpi-container">
        <div class="kpi-card">
            <h3 id="kpi-total-athletes">0</h3>
            <p>Total Athlètes</p>
        </div>
        <div class="kpi-card">
            <h3 id="kpi-males">0</h3>
            <p>Hommes</p>
        </div>
        <div class="kpi-card">
            <h3 id="kpi-females">0</h3>
            <p>Femmes</p>
        </div>
    </div>
    </div>
    <div id="chart"></div>

    <script>
        // Charger le fichier CSV
        d3.csv("archive/athletes.csv").then(data => {

            data.forEach(d => {
            d.disciplines = d.disciplines.replace(/[\[\]']+/g, '').trim();
            d.events = d.events.replace(/[\[\]""]+/g, '').trim();
            });
            // Préparer les disciplines uniques
            const disciplines = Array.from(new Set(data.map(d => d.disciplines))).sort();
            const select = d3.select("#discipline-select");

            // Remplir la liste déroulante des disciplines
            disciplines.forEach(discipline => {
                select.append("option")
                    .attr("value", discipline)
                    .text(discipline);
            });

            

            
            const updateKPI = (data, selectedDiscipline) => {
                // Filtrer les données par discipline si nécessaire
                const filteredData = selectedDiscipline === "all" ? data : data.filter(d => d.disciplines === selectedDiscipline);

                // Calculer les KPI
                const totalAthletes = filteredData.length;
                const totalMales = filteredData.filter(d => d.gender === "Male").length;
                const totalFemales = filteredData.filter(d => d.gender === "Female").length;

                // Mettre à jour les cartes KPI
                d3.select("#kpi-total-athletes").text(totalAthletes);
                d3.select("#kpi-males").text(totalMales);
                d3.select("#kpi-females").text(totalFemales);
            };

            // Appeler la fonction `updateKPI` lors de l'initialisation et de la mise à jour du graphique
            
            // Fonction pour calculer et afficher le graphique
            const updateChart = (selectedDiscipline) => {
                // Filtrer les données par discipline si nécessaire
                const filteredData = selectedDiscipline === "all" ? data : data.filter(d => d.disciplines === selectedDiscipline);

                // Convertir les dates de naissance en âges
                const currentYear = new Date().getFullYear();
                filteredData.forEach(d => {
                    d.birth_date = new Date(d.birth_date);
                    d.age = currentYear - d.birth_date.getFullYear();
                });

                // Définir les tranches d'âge
                const ageRanges = [
                    { label: "<20", min: 0, max: 19 },
                    { label: "20-30", min: 20, max: 30 },
                    { label: "30-40", min: 30, max: 40 },
                    { label: "40-50", min: 40, max: 50 },
                    { label: "50-60", min: 50, max: 60 },
                    { label: ">60", min: 61, max: Infinity }
                ];

                // Grouper les données par tranche d'âge et sexe
                const groupedData = [];
                ageRanges.forEach(range => {
                    const males = filteredData.filter(d => d.gender === "Male" && d.age >= range.min && d.age <= range.max).length;
                    const females = filteredData.filter(d => d.gender === "Female" && d.age >= range.min && d.age <= range.max).length;
                    groupedData.push({ range: range.label, males, females });
                });

                // Mettre à jour le graphique
                const margin = { top: 40, right: 20, bottom: 100, left: 100 };
                const width = 800 - margin.left - margin.right;
                const height = 400 - margin.top - margin.bottom;

                // Effacer le graphique précédent
                d3.select("#chart").selectAll("*").remove();

                const svg = d3.select("#chart")
                    .append("svg")
                    .attr("width", width + margin.left + margin.right)
                    .attr("height", height + margin.top + margin.bottom)
                    .append("g")
                    .attr("transform", `translate(${margin.left}, ${margin.top})`);

                // Configurer les échelles
                const x = d3.scaleBand()
                    .domain(groupedData.map(d => d.range))
                    .range([0, width])
                    .padding(0.2);

                const y = d3.scaleLinear()
                    .domain([0, d3.max(groupedData, d => Math.max(d.males, d.females))])
                    .nice()
                    .range([height, 0]);

                const color = d3.scaleOrdinal()
                    .domain(["Males", "Females"])
                    .range(["#1e4356", "#68a4c4"]);

                // Ajouter les axes
                svg.append("g")
                    .attr("class", "axis")
                    .attr("transform", `translate(0, ${height})`)
                    .call(d3.axisBottom(x));

                svg.append("g")
                    .attr("class", "axis")
                    .call(d3.axisLeft(y));

                // Ajouter les barres
                const barWidth = x.bandwidth() / 2;
                // Ajouter les barres masculines
                svg.selectAll(".bar-male")
                    .data(groupedData)
                    .enter()
                    .append("rect")
                    .attr("class", "bar-male bar")
                    .attr("x", d => x(d.range))
                    .attr("y", d => y(d.males))
                    .attr("width", barWidth - 5)
                    .attr("height", d => height - y(d.males))
                    .attr("fill", color("Males"));

                // Ajouter des étiquettes pour les barres masculines avec un fond
                svg.selectAll(".label-male")
                    .data(groupedData)
                    .enter()
                    .append("g") // Groupes pour contenir le texte et le fond
                    .attr("class", "label-male-group")
                    .each(function(d) {
                        const group = d3.select(this);

                        // Fond pour l'étiquette
                        group.append("rect")
                            .attr("x", x(d.range) + (barWidth - 5) / 2 - 15) // Ajuste la position
                            .attr("y", y(d.males) - 25) // Position légèrement au-dessus de la barre
                            .attr("width", 30) // Taille du fond
                            .attr("height", 20)
                            .attr("fill", "rgba(196, 196, 196, 0.54)") // Bleu semi-transparent
                            .attr("rx", 5); // Coins arrondis

                        // Texte de l'étiquette
                        group.append("text")
                            .attr("x", x(d.range) + (barWidth - 5) / 2)
                            .attr("y", y(d.males) - 10) // Position centrée avec le fond
                            .attr("text-anchor", "middle")
                            .attr("fill", "black") // Couleur du texte
                            .style("font-size", "12px")
                            .text(d.males);
                    });

                // Ajouter des étiquettes pour les barres féminines avec un fond
                svg.selectAll(".label-female")
                    .data(groupedData)
                    .enter()
                    .append("g")
                    .attr("class", "label-female-group")
                    .each(function(d) {
                        const group = d3.select(this);

                        // Fond pour l'étiquette
                        group.append("rect")
                            .attr("x", x(d.range) + barWidth + (barWidth - 5) / 2 - 15)
                            .attr("y", y(d.females) - 25)
                            .attr("width", 30)
                            .attr("height", 20)
                            .attr("fill", "rgba(196, 196, 196, 0.54)")
                            .attr("rx", 5);

                        // Texte de l'étiquette
                        group.append("text")
                            .attr("x", x(d.range) + barWidth + (barWidth - 5) / 2)
                            .attr("y", y(d.females) - 10)
                            .attr("text-anchor", "middle")
                            .attr("fill", "black")
                            .style("font-size", "12px")
                            .text(d.females);
                    });


                // Ajouter les barres féminines
                svg.selectAll(".bar-female")
                    .data(groupedData)
                    .enter()
                    .append("rect")
                    .attr("class", "bar-female bar")
                    .attr("x", d => x(d.range) + barWidth)
                    .attr("y", d => y(d.females))
                    .attr("width", barWidth - 5)
                    .attr("height", d => height - y(d.females))
                    .attr("fill", color("Females"));

                    // Ajouter le nom de l'axe X
                    svg.append("text")
                        .attr("class", "x-axis-label")
                        .attr("x", width / 2) // Centrer horizontalement
                        .attr("y", height + margin.bottom - 40) // Position sous l'axe X
                        .attr("text-anchor", "middle")
                        .text("Tranche d'âge");

                    // Ajouter le nom de l'axe Y
                    svg.append("text")
                        .attr("class", "y-axis-label")
                        .attr("x", -(height / 2)) // Rotation, centré verticalement
                        .attr("y", -margin.left + 20) // Position à gauche
                        .attr("text-anchor", "middle")
                        .attr("transform", "rotate(-90)") // Faire pivoter pour l'axe Y
                        .text("Nombre d'athlètes");


                // Ajouter une légende
                const legend = svg.selectAll(".legend")
                    .data(["Males", "Females"])
                    .enter()
                    .append("g")
                    .attr("class", "legend")
                    .attr("transform", (d, i) => `translate(${width - 120}, ${i * 20})`);

                legend.append("rect")
                    .attr("x", 0)
                    .attr("width", 18)
                    .attr("height", 18)
                    .attr("fill", d => color(d));

                legend.append("text")
                    .attr("x", 24)
                    .attr("y", 9)
                    .attr("dy", "0.35em")
                    .text(d => d);
            };

            // Initialiser le graphique avec toutes les données
            updateChart("all");
            updateKPI(data, "all");

            // Ajouter un écouteur pour le changement de sélection
            d3.select("#discipline-select").on("change", function() {
                const selectedDiscipline = this.value;
                updateChart(selectedDiscipline);
            });

            d3.select("#discipline-select").on("change", function () {
                const selectedDiscipline = this.value;
                updateKPI(data, selectedDiscipline);
                updateChart(selectedDiscipline); // Met à jour le graphique
            });
            
        }).catch(error => {
            console.error("Erreur lors du chargement des données :", error);
        });
    </script>

    </section><!-- /Features Section -->
    <div style="text-align: center; margin-top: 20px;">
    <a href="Map_Athlètes.php" style="display: inline-block; padding: 10px 20px; background-color: #1e4356; color: white; text-decoration: none; border-radius: 5px; font-size: 1rem; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);">
        Affichage par pays
    </a>
    
    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Synthèse</h2>-
        <p><span style="color: #1e4356;"><strong>De manière globale, les hommes dominent les Jeux Olympiques 2024</strong></span>, avec une prédominance dans de nombreuses disciplines. En moyenne, les athlètes participants sont âgés de <span style="color: #1e4356;"><strong>20 à 30 ans</strong></span>, un âge où les performances physiques sont souvent optimales. Certaines disciplines, comme le <span style="color: #1e4356;"><em>artistic swimming</em></span>, sont <span style="color: #1e4356;"><strong>exclusivement féminines</strong></span>, avec aucune représentation masculine. D'autres sports, comme le <span style="color: #1e4356;"><strong>football</strong></span>, montrent une nette prédominance masculine, particulièrement dans les catégories plus jeunes. Cependant, des sports comme le <span style="color: #1e4356;"><strong>tennis de table, le beach-volley, le tir, le rugby</strong></span> ou le <span style="color: #1e4356;"><strong>BMX freestyle</strong></span> présentent une répartition presque égale entre les sexes. Enfin, dans des disciplines comme la <span style="color: #1e4356;"><strong>gymnastique artistique</strong></span>, bien que la répartition homme-femme soit relativement équilibrée, il existe une disparité notable entre les tranches d'âges, avec une surreprésentation des athlètes plus jeunes dans certaines épreuves.</p>
        </div><!-- End Section Title -->

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