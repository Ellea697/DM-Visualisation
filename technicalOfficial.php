<?php
// Lire le fichier CSV
$filename = 'C:\wamp64\www\archive\technical_officials.csv';
$data = [];
if (($handle = fopen($filename, 'r')) !== FALSE) {
    // Sauter la première ligne (en-têtes)
    fgetcsv($handle);
    while (($row = fgetcsv($handle)) !== FALSE) {
        $data[] = $row;
    }
    fclose($handle);
}

// Statistiques simples
$genderCount = ['Male' => 0, 'Female' => 0];

foreach ($data as $row) {
    $gender = $row[2]; // Gender
    if (isset($genderCount[$gender])) {
        $genderCount[$gender]++;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répartition par Genre</title>
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
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Répartition par Genre</h1>
    <canvas id="genderChart" width="400" height="100"></canvas>
    <script>
        const ctx = document.getElementById('genderChart').getContext('2d');
        const genderChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'Répartition par Genre',
                    data: [<?= $genderCount['Male'] ?>, <?= $genderCount['Female'] ?>],
                    backgroundColor: ['#36A2EB', '#FF6384'],
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
                        text: 'Répartition par Genre'
                    }
                }
            }
        });
    </script>
    <br>
    <a href="organisation.php">Voir la répartition par Organisation</a>
</div>
</body>
</html>
