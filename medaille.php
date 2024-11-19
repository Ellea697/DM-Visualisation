<?php
// Page de garde en PHP
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Médailles par Pays</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <style>
        /* Style pour les colonnes de médailles */
        .gold { background-color: gold; }
        .silver { background-color: silver; }
        .bronze { background-color: #cd7f32; }
        table {
            width: 80%; /* Largeur du tableau */
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

<h2>Tableau des Médailles par Pays</h2>

<!-- Tableau HTML vide -->
<table id="medalTable">
    <thead>
        <tr>
            <th>Country</th>
            <th>Medals Count</th>
            <th class="gold">Gold</th>
            <th class="silver">Silver</th>
            <th class="bronze">Bronze</th>
        </tr>
    </thead>
    <tbody>
        <!-- Le tableau sera rempli ici dynamiquement -->
    </tbody>
</table>

<script>
    // Charger le fichier CSV
    d3.csv('archive/medals.csv').then(function(data) {
        console.log("Données CSV chargées :", data); // Vérifie les données

        // Comptage du nombre de médailles par pays et par type (Gold, Silver, Bronze)
        const medalCountByCountry = d3.rollup(data, v => {
            // Compter les médailles par type pour chaque pays
            return {
                gold: v.filter(d => d.medal_type === "Gold Medal").length,
                silver: v.filter(d => d.medal_type === "Silver Medal").length,
                bronze: v.filter(d => d.medal_type === "Bronze Medal").length,
                total: v.length
            };
        }, d => d.country);

        console.log("Comptage des médailles par pays et type :", medalCountByCountry); // Vérifie les comptes

        // Convertir en tableau pour trier les pays par nombre de médailles
        const medalData = Array.from(medalCountByCountry, ([country, counts]) => ({
            country,
            total: counts.total,
            gold: counts.gold,
            silver: counts.silver,
            bronze: counts.bronze
        }));

        console.log("Données triées :", medalData); // Vérifie les données triées

        // Trier les pays par nombre total de médailles (ordre décroissant)
        medalData.sort((a, b) => b.total - a.total);

        // Sélectionner le corps du tableau
        const tbody = d3.select('#medalTable tbody');

        // Ajouter les lignes de données dans le tableau
        const rows = tbody.selectAll('tr')
            .data(medalData)
            .enter()
            .append('tr');

        // Ajouter les cellules pour chaque pays, le nombre total de médailles et chaque catégorie (Gold, Silver, Bronze)
        rows.append('td')
            .text(d => d.country);

        rows.append('td')
            .text(d => d.total);

        rows.append('td')
            .attr('class', 'gold')
            .text(d => d.gold);

        rows.append('td')
            .attr('class', 'silver')
            .text(d => d.silver);

        rows.append('td')
            .attr('class', 'bronze')
            .text(d => d.bronze);

    }).catch(function(error) {
        console.error("Erreur lors du chargement du fichier CSV :", error);
    });
</script>

</body>
</html>
