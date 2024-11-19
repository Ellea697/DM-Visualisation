<?php
// Lire le fichier CSV
$file = 'C:\wamp64\www\archive\teams.csv'; // Remplacez par le chemin de votre fichier CSV
$data = [];
if (($handle = fopen($file, 'r')) !== FALSE) {
    fgetcsv($handle); // Ignore l'en-tête
    while (($row = fgetcsv($handle)) !== FALSE) {
        $data[] = [
            'code' => $row[0],
            'team' => $row[1],
            'gender' => $row[2],
            'country' => $row[4],
            'discipline' => $row[6],
            'num_athletes' => (int)$row[12],
            'num_coaches' => (int)$row[14],
        ];
    }
    fclose($handle);
}

// Calculer des statistiques
$stats = [];
foreach ($data as $item) {
    $country = $item['country'];
    if (!isset($stats[$country])) {
        $stats[$country] = ['athletes' => 0, 'coaches' => 0];
    }
    $stats[$country]['athletes'] += $item['num_athletes'];
    $stats[$country]['coaches'] += $item['num_coaches'];
}

// Préparer les données pour le graphique
$chartData = [
    'countries' => array_keys($stats),
    'athletes' => array_column($stats, 'athletes'),
    'coaches' => array_column($stats, 'coaches'),
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Équipes</title>
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
    <h1>Statistiques des Équipes</h1>
    <canvas id="myChart" width="900" height="300"></canvas>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const chartData = {
            labels: <?php echo json_encode($chartData['countries']); ?>,
            datasets: [{
                label: 'Athlètes',
                data: <?php echo json_encode($chartData['athletes']); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }, {
                label: 'Coachs',
                data: <?php echo json_encode($chartData['coaches']); ?>,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <br>
    <a href="index.php">Retour à la page d'acceuil</a>
    </div>
</body>
</html>