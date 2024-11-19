<?php
// Lire le fichier CSV
$filename = 'C:\wamp64\www\archive\schedules_preliminary.csv';
$data = [];
if (($handle = fopen($filename, 'r')) !== FALSE) {
    // Lire l'en-tête
    $headers = fgetcsv($handle, 1000, ',');
    
    // Lire les données
    while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
        $data[] = array_combine($headers, $row);
    }
    fclose($handle);
}

// Exemple de statistiques (par sport)
$sportStats = [];
foreach ($data as $row) {
    $sport = $row['sport'];
    if (!isset($sportStats[$sport])) {
        $sportStats[$sport] = 0;
    }
    $sportStats[$sport]++;
}

// Préparation des données pour le diagramme
$sportLabels = array_keys($sportStats);
$sportValues = array_values($sportStats);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <h1>Statistiques Sportives</h1>
    <canvas id="myChart" width="1000" height="300"></canvas>
    <script>
        const labels = <?php echo json_encode($sportLabels); ?>;
        const data = {
            labels: labels,
            datasets: [{
                label: 'Nombre d\'événements par sport',
                data: <?php echo json_encode($sportValues); ?>,
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