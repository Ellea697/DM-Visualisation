<?php
// Chemin vers le fichier CSV
$filename = 'C:\wamp64\www\archive\medallists.csv';

// Initialisation des variables pour stocker les données
$medalCounts = [];

// Lire le fichier CSV
if (($handle = fopen($filename, 'r')) !== FALSE) {
    // Ignorer la première ligne (les en-têtes)
    fgetcsv($handle);
    
    // Lire chaque ligne du CSV
    while (($data = fgetcsv($handle)) !== FALSE) {
        $medalType = $data[1]; // 'medal_type' (Gold, Silver, Bronze)
        
        if (!isset($medalCounts[$medalType])) {
            $medalCounts[$medalType] = 0;
        }
        $medalCounts[$medalType]++;
    }
    fclose($handle);
}

// Convertir les données pour le graphique
$labels = json_encode(array_keys($medalCounts));
$values = json_encode(array_values($medalCounts));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Médailles</title>
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
    <h1>Distribution des Médailles</h1>
    <canvas id="medalChart" width="200" height="10"></canvas>
    <script>
        const ctx = document.getElementById('medalChart').getContext('2d');
        const medalChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo $labels; ?>,
                datasets: [{
                    data: <?php echo $values; ?>,
                    backgroundColor: ['gold', 'silver', 'brown'],
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
                        text: 'Distribution des Médailles'
                    }
                }
            }
        });
    </script>
    <br>
    <a href="index.php">Retour à la page d'acceuil</a>
<div>
</body>
</html>
