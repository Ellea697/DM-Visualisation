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

// Fonction pour afficher les statistiques
function displayStatistics($data) {
    $totalAthletes = count($data);
    $genderCount = ['Male' => 0, 'Female' => 0];
    $eventCount = [];

    foreach ($data as $athlete) {
        $genderCount[$athlete['gender']]++;
        $event = $athlete['events'];
        if (!isset($eventCount[$event])) {
            $eventCount[$event] = 0;
        }
        $eventCount[$event]++;
    }

    return [
        'total' => $totalAthletes,
        'genderCount' => $genderCount,
        'eventCount' => $eventCount,
    ];
}

// Chemin du fichier CSV
$filename = 'C:\wamp64\www\archive\coaches.csv';

// Lire les données du fichier CSV
$data = readCsv($filename);

// Obtenir les statistiques
$statistics = displayStatistics($data);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Athlètes</title>
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
<h1>Statistiques des Coaches des Athlètes</h1>
<p>Total d'athlètes : <?php echo $statistics['total']; ?></p>
<p>Hommes : <?php echo $statistics['genderCount']['Male']; ?></p>
<p>Femmes : <?php echo $statistics['genderCount']['Female']; ?></p>

<canvas id="eventChart" width="400" height="120"></canvas>
<script>
    const ctx = document.getElementById('eventChart').getContext('2d');
    const eventData = <?php echo json_encode($statistics['eventCount']); ?>;
    
    const labels = Object.keys(eventData);
    const data = Object.values(eventData);

    const eventChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de coaches des athlètes par événement',
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
