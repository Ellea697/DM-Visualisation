<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Événements</title>
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
    <h1>Statistiques des Événements</h1>
    
    <canvas id="myChart" width="800" height="290"></canvas>
    
    <?php
    // Lire le fichier CSV
    $file = fopen('C:\wamp64\www\archive\torch_route.csv', 'r');
    $header = fgetcsv($file); // Lire les en-têtes
    $data = [];
    
    while (($row = fgetcsv($file)) !== FALSE) {
        $data[] = array_combine($header, $row);
    }
    fclose($file);
    
    // Effectuer des statistiques
    $cityCount = [];
    foreach ($data as $event) {
        $city = $event['city'];
        if (!isset($cityCount[$city])) {
            $cityCount[$city] = 0;
        }
        $cityCount[$city]++;
    }
    
    $cities = array_keys($cityCount);
    $counts = array_values($cityCount);
    ?>
    
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($cities); ?>,
                datasets: [{
                    label: 'Nombre d\'événements par ville',
                    data: <?php echo json_encode($counts); ?>,
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