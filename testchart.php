<?php
// Include the Database class
require_once 'Database.php';

// Create an instance of the Database class
$database = new Database();

// Get platform names and their corresponding client counts
$result = $database->query("SELECT platform.name AS platform_name, COUNT(clients.id) AS client_count FROM platform LEFT JOIN clients ON platform.id = clients.id_platform GROUP BY platform.name");
if (!$result) {
    echo "Failed to fetch platform statistics.";
    exit();
}

// Initialize arrays to store platform names and client counts
$platformNames = [];
$clientCounts = [];

// Fetch the results and populate the arrays
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $platformNames[] = $row['platform_name'];
    $clientCounts[] = $row['client_count'];
}

// Convert data to JSON for Chart.js
$platformChartData = [
    'labels' => $platformNames,
    'datasets' => [
        [
            'label' => 'platform',
            'data' => $clientCounts,
            'backgroundColor' => [
                'rgba(0, 0, 139, 2)',   // Red for Netflix
                'rgba(199,21,133, 2)', // Blue for Canva
                'rgba(105,105,105, 2)', // Yellow for Crunchyroll
                'rgba(0, 0, 0, 2)',  // Green for Disney+
                'rgb(0,128,0, 2)',  // Purple for Games
                'rgba(255, 165, 0, 2)',  // Orange for Chatgpt
                // Add more colors if needed
            ],
            'borderColor' => 'rgba(54, 162, 235, 1)', // Border color for all bars
            'borderWidth' => 1,
        ],
    ],
];

// Encode data as JSON
$platformChartDataJSON = json_encode($platformChartData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <canvas id="platformChart"></canvas>
    </div>

    <script>
        // Parse PHP data into JavaScript
        const platformChartData = <?php echo $platformChartDataJSON; ?>;

        // Get chart canvas element
        const platformCtx = document.getElementById('platformChart').getContext('2d');

        // Create Chart.js chart
        const platformChart = new Chart(platformCtx, {
            type: 'doughnut',
            data: platformChartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 25, // Set initial max value
                        title: {
                            display: true,
                            text: 'PLATFORM '
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Platform'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
