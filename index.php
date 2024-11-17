<?php
// Page de garde en PHP
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Garde</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            background: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur notre site</h1>
        <p>Découvrez les statistiques de nos donnees.</p>
        <p><a href="histogram.php">Statistiques des Coaches des Athlètes</a></p>
        <p><a href="histogram2.php">Les Statistiques </a></p>
        <p><a href="camembert.php">Graphique des Événements par Discipline</a></p>
        <p><a href="event.php">Statistiques des Événements</a></p>
        <p><a href="medailles.php">Distribution des Médailles </a></p>
        <p><a href="TotalMedailles.php">Histogramme des Médailles par Pays</a></p>
        <p><a href="paysJO.php">Statistiques Medailles</a></p>
        <p><a href="venue.php">Statistiques des Sports</a></p>
        <p><a href="teams.php">Statistiques des Équipes</a></p>
        <p><a href="technicalOfficial.php">Statistiques des differentes repartitions</a></p>
        <p><a href="torch_route.php">Statistiques des Événements</a></p>
        <p><a href="schedulePrimary.php">Statistiques Sportives</a></p>
    </div>
</body>
</html>
