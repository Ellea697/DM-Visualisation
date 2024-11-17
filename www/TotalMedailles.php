<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histogramme des Médailles</title>
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
            box-shadow: 0 4px 70px rgba(0, 0, 0, 0.1);
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
    <h1>Histogramme des Médailles par Pays</h1>
    <canvas id="medalsChart" width="1000" height="300"></canvas>

    <?php
    // Lire les données du fichier CSV
    $data = [];
    if (($handle = fopen("C:\wamp64\www\archive\medals_total.csv", "r")) !== FALSE) {
        fgetcsv($handle); // Ignorer l'en-tête
        while (($row = fgetcsv($handle)) !== FALSE) {
            $data[] = [
                'country' => $row[1],
                'gold' => (int)$row[3],
                'silver' => (int)$row[4],
                'bronze' => (int)$row[5],
            ];
        }
        fclose($handle);
    }
    ?>

    <script>
        const labels = <?php echo json_encode(array_column($data, 'country')); ?>;
        const goldData = <?php echo json_encode(array_column($data, 'gold')); ?>;
        const silverData = <?php echo json_encode(array_column($data, 'silver')); ?>;
        const bronzeData = <?php echo json_encode(array_column($data, 'bronze')); ?>;

        const ctx = document.getElementById('medalsChart').getContext('2d');
        const medalsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Médaille d\'Or',
                        data: goldData,
                        backgroundColor: 'gold',
                    },
                    {
                        label: 'Médaille d\'Argent',
                        data: silverData,
                        backgroundColor: 'silver',
                    },
                    {
                        label: 'Médaille de Bronze',
                        data: bronzeData,
                        backgroundColor: '#cd7f32',
                    }
                ]
            },
            options: {
                responsive: true,
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
