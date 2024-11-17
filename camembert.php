<?php
// Lire le fichier CSV
$filename = 'C:\wamp64\www\archive\schedules.csv';
$data = [];

// Ouvrir le fichier
if (($handle = fopen($filename, 'r')) !== false) {
    // Lire les en-têtes
    $headers = fgetcsv($handle, 1000, ',');
    
    // Lire les données
    while (($row = fgetcsv($handle, 1000, ',')) !== false) {
        $data[] = array_combine($headers, $row);
    }
    fclose($handle);
}

// Préparer les données pour le graphique
$labels = [];
$values = [];

foreach ($data as $event) {
    // Par exemple, nous comptons le nombre d'événements par discipline
    $discipline = $event['discipline'];
    if (!isset($values[$discipline])) {
        $values[$discipline] = 0;
    }
    $values[$discipline]++;
}

$labels = array_keys($values);
$dataValues = array_values($values);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique des Événements</title>
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
    <h1>Graphique des Événements par Discipline</h1>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Type de graphique
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Nombre d\'événements',
                    data: <?php echo json_encode($dataValues); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
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
