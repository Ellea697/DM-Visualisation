<?php
// Inclusion du header
include 'header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Médailles par Pays</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/js/flag-icon.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        h2 {
            font-family: 'Georgia', 'Times New Roman', serif; /* Nouvelle police */
            font-size: 2.5rem; /* Augmenté pour un meilleur impact */
            text-align: center;
            color: #dc3545;
            font-weight: bold; /* Gras */
            margin-bottom: 20px;
        }
        h2 i {
            color: #ffc107;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        th, td {
            padding: 15px;
            text-align: center;
            font-size: 1rem;
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
<body>

<!-- Contenu principal -->
<main class="container mt-5">
    <h2 class="text-center">
        <i class="fas fa-heart"></i> Nombre de Médailles par Pays <i class="fas fa-heart"></i>
    </h2>

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
</main>

<!-- Script D3.js -->
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

<?php
// Inclusion du footer
include 'footer.php';
?>
</body>
</html>
