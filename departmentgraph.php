<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart with Database</title>
    <style>
        /* Styles for the chart container go here */
        #chart-container {
            position: relative;
            margin: auto;
            width: 50%;
        }

        #bar-container {
            position: relative;
            margin: auto;
            width: 80%;
        }
    </style>
    <?php include('db_connect.php'); ?>

    <?php
    $sql = "SELECT department FROM users";
    $result = $conn->query($sql);

    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row['department'];
        }
    }

    // Output the JSON-encoded data
    echo '<script>';
    echo 'var data = ' . json_encode($data) . ';';
    echo '</script>';
    ?>
</head>

<body>

    <div class="container-fluid">
        <div class="card col-lg-12">
            <div id="chart-container">
                <canvas id="pieChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Use the PHP-generated data to create the pie chart
                    createPieChart(data);
                });

                function createPieChart(data) {
                    const ctx = document.getElementById("pieChart").getContext("2d");

                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: data,
                            datasets: [{
                                data: Array(data.length).fill(1),
                                backgroundColor: getRandomColors(data.length),
                            }],
                        },
                    });
                }

                function getRandomColors(count) {
                    // Generate an array of random hex colors
                    const colors = [];
                    for (let i = 0; i < count; i++) {
                        colors.push('#' + Math.floor(Math.random() * 16777215).toString(16));
                    }
                    return colors;
                }
            </script>


        </div>


        <div class="card col-lg-12">

            <div id="bar-container">
                <canvas id="barChart"></canvas>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Replace these arrays with your actual data
                    const departments = ["ccs"];
                    const categories = ["4-1", "4-2"];
                    const data = [
                        [ /* Count data for department 'ccs' and category '4-1' */ ],
                        [ /* Count data for department 'ccs' and category '4-2' */ ]
                    ];

                    // Use the data to create the bar chart
                    createBarChart(departments, categories, data);
                });

                function createBarChart(departments, categories, data) {
                    const ctx = document.getElementById("barChart").getContext("2d");

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: categories,
                            datasets: departments.map((department, index) => ({
                                label: department,
                                data: data[index],
                                backgroundColor: getRandomColor(),
                            })),
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100,
                                    ticks: {
                                        stepSize: 25,
                                        callback: function(value) {
                                            return value.toFixed(0);
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                function getRandomColor() {
                    // Generate a random hex color
                    return '#' + Math.floor(Math.random() * 16777215).toString(16);
                }
            </script>

        </div>
    </div>
</body>

</html>