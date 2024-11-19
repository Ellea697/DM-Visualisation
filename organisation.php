<?php
// Lire le fichier CSV
$filename = 'C:\wamp64\www\archive\technical_officials.csv';
$data = [];
if (($handle = fopen($filename, 'r')) !== FALSE) {
    // Sauter la première ligne (en-têtes)
    fgetcsv($handle);
    while (($row = fgetcsv($handle)) !== FALSE) {
        $data[] = $row;
    }
    fclose($handle);
}

// Statistiques simples
$organisationCount = [];

foreach ($data as $row) {
    $organisation = $row[6]; // Organisation
    if (isset($organisationCount[$organisation])) {
        $organisationCount[$organisation]++;
    } else {
        $organisationCount[$organisation] = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répartition par Organisation</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    </style>
</head>
<body>
<div class="container">
    <h1>Répartition par Organisation</h1>
    <canvas id="organisationChart" width="1000" height="310"></canvas>
    <script>
        const orgCtx = document.getElementById('organisationChart').getContext('2d');
        const organisationChart = new Chart(orgCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_keys($organisationCount)) ?>,
                datasets: [{
                    label: 'Nombre de personnes par Organisation',
                    data: <?= json_encode(array_values($organisationCount)) ?>,
                    backgroundColor: '#FFCE56',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Répartition par Organisation'
                    }
                }
            }
        });
    </script>
    <br>
    <a href="technicalOfficial.php">Retour à la Répartition par Genre</a>
    <br><br><br>
    <a href="index.php">Retour à la page d'accueil</a>
</div>
</body>
</html>