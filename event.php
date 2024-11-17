<?php
// Fonction pour lire le fichier CSV et retourner les données sous forme de tableau
function readCsv($filename) {
    $data = [];
    if (($handle = fopen($filename, 'r')) !== false) {
        $header = fgetcsv($handle, 1000, ','); // Lire l'en-tête
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

// Fonction pour afficher les statistiques des événements
function displayEventStatistics($data) {
    $eventCount = [];

    foreach ($data as $event) {
        $eventName = $event['event'];
        if (!isset($eventCount[$eventName])) {
            $eventCount[$eventName] = 0;
        }
        $eventCount[$eventName]++;
    }

    return $eventCount;
}

// Chemin du fichier CSV
$filename = 'C:\wamp64\www\archive\events.csv';

// Lire les données du fichier CSV
$data = readCsv($filename);

// Obtenir les statistiques des événements
$eventStatistics = displayEventStatistics($data);
?>

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

<canvas id="eventChart" width="600" height="300"></canvas>
<script>
    const ctx = document.getElementById('eventChart').getContext('2d');
    const eventData = <?php echo json_encode($eventStatistics); ?>;
    
    const labels = Object.keys(eventData);
    const data = Object.values(eventData);

    const eventChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre d\'événements',
                data: data,
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
