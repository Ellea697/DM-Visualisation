<?php
// Lire le fichier CSV
function readCSV($filename) {
    $data = [];
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        // Sauter l'en-tête
        fgetcsv($handle);
        while (($row = fgetcsv($handle)) !== FALSE) {
            $data[] = [
                'venue' => $row[0],
                'sport' => $row[1],
                'date_start' => $row[2],
                'date_end' => $row[3],
                'tag' => $row[4],
                'url' => $row[5]
            ];
        }
        fclose($handle);
    }
    return $data;
}

// Traitement des données
$csvData = readCSV('C:\wamp64\www\archive\venues.csv');
$sportCounts = [];

// Compter les occurrences de chaque sport
foreach ($csvData as $entry) {
    if (isset($sportCounts[$entry['sport']])) {
        $sportCounts[$entry['sport']]++;
    } else {
        $sportCounts[$entry['sport']] = 1;
    }
}

// Préparer les données pour le graphique
$sports = array_keys($sportCounts);
$counts = array_values($sportCounts);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques Sportives</title>
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
            padding: 100px;
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
<h1>Statistiques des Sports</h1>
<canvas id="myChart" width="1000" height="300"></canvas>

<script>
    const labels = <?php echo json_encode($sports); ?>;
    const data = {
        labels: labels,
        datasets: [{
            label: 'Occurrences par Sport',
            data: <?php echo json_encode($counts); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
<br>
<a href="index.php">Retour à la page d'acceuil</a>
</div>
</body>
</html>