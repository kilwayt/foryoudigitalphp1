<?php
// Include the Database class
require_once 'Database.php';

// Create an instance of the Database class
$database = new Database();

// Get all products from the database
$products = $database->getAllProduits();

// Count the occurrences of each category
$categoryCounts = array_count_values(array_column($products, 'categorie'));

// Extract category names and counts for chart data
$categories = array_keys($categoryCounts);
$categoryCountsValues = array_values($categoryCounts);

// Define manual background colors for each category
$backgroundColorArray = [
    'Netflix' => 'rgba(255, 0, 0, 2)', // Red
    'Canva' => 'rgba(65,105,225, 2)', // Blue
    'Crunchyroll' => 'rgba(244,164,96,2)', // Yellow
     'Disney+' => 'rgba(127,255,0, 2)', // Green
    'Games' => 'rgba(0,0,139, 2)', // Purple
    'Chatgpt' => 'rgba(25,25,132,2)' // Orange
];

// Convert data to JSON for Chart.js
$chartData = [  
    'labels' => $categories,
    'datasets' => [
        [
            'label' => 'PLATFORM',
            'data' => $categoryCountsValues,
            'backgroundColor' => array_values($backgroundColorArray), // Manual background colors
            'borderColor' => '', // Border color for all bars
            'borderWidth' => 2,
        ],
    ],
];

// Encode data as JSON
$chartDataJSON = json_encode($chartData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body>
    <div>
        <canvas id="categoryChart"></canvas>
    </div>

    <script>
        // Parse PHP data into JavaScript
        const chartData = <?php echo $chartDataJSON; ?>;
console.log(chartData); // Log the chart data to the console

// Get chart canvas element
const ctx = document.getElementById('categoryChart').getContext('2d');

// Create Chart.js chart
const myChart = new Chart(ctx, {
    type: 'line',
    data: chartData,
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 50, // Set initial max value
                title: {
                    display: true,
                    text: 'Number of Products'
                }
            },
            x: {
                title: {
                    display: true,
                    text: ''
                }
            }
        }
    }
});

// Function to update y-axis max value
function updateMaxValue() {
    const maxValue = Math.max(...chartData.datasets[0].data); // Find the maximum value in the dataset
    myChart.options.scales.y.max = Math.max(maxValue, 50); // Set max value to the greater of maxValue or 10
    myChart.update(); // Update the chart
}

// Call updateMaxValue function whenever new data is added
updateMaxValue();
    </script>
</body>
</html>
