<?php
// Lire le fichier CSV
function readCSV($filename) {
    $data = [];
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        // Lire l'en-tête
        $header = fgetcsv($handle, 1000, ',');
        
        // Lire les lignes restantes
        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

$data = readCSV('C:\wamp64\www\archive\results\Archery.csv');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique des ventes</title>
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
            padding: 110px;
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
    <canvas id="myChart" width="800" height="300"></canvas>
    <script>
        const labels = <?php echo json_encode(array_column($data, 'année')); ?>;
        const data = {
            labels: labels,
            datasets: [{
                label: 'Statistiques',
                data: <?php echo json_encode(array_column($data, 'ventes')); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'line',
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
