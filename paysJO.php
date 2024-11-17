<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des pays</title>
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
            padding: 150px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
    <h1>Statistiques des Medailles</h1>
    
    <canvas id="myChart" width="900" height="200"></canvas>

    <?php
    // Lecture du fichier CSV
    $data = [];
    if (($handle = fopen("C:\wamp64\www\archive\medallists.csv", "r")) !== FALSE) {
        fgetcsv($handle); // Ignore l'en-tête
        while (($row = fgetcsv($handle)) !== FALSE) {
            $country = $row[1];
            $note = (int)$row[4];
            if (!isset($data[$country])) {
                $data[$country] = [];
            }
            $data[$country][] = $note;
        }
        fclose($handle);
    }

    // Calculer les moyennes par pays
    $labels = [];
    $values = [];
    foreach ($data as $country => $notes) {
        $labels[] = $country;
        $values[] = array_sum($notes) / count($notes); // Moyenne
    }
    ?>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Note moyenne',
                    data: <?php echo json_encode($values); ?>,
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
