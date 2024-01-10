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
            width: 60%;
        }

        #bar-container {
            position: relative;
            margin: auto;
            width: 80%;
        }
    </style>
    <?php include('db_connect.php'); ?>

    <?php
    // Assuming you have a connection to the database, e.g., $conn

    $sql = "SELECT department, COUNT(*) as vote_count FROM users WHERE type = 2 GROUP BY department";
    $result = $conn->query($sql);

    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'department' => $row['department'],
                'vote_count' => $row['vote_count'],
            ];
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
        <div id="chart-container" style=" float: left;">
            <canvas id="pieChart"></canvas>
        </div>
        <br><br>
        <div id="legend-container" style="float: left;">
            <!-- Legend will be displayed here -->
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Define a global variable to store the colors
            let pieChartColors = [];

            document.addEventListener("DOMContentLoaded", function() {
                // Use the PHP-generated data to create the pie chart
                createPieChart(data);
            });

            function createPieChart(data) {
                const ctx = document.getElementById("pieChart").getContext("2d");

                // Check if colors are not generated yet
                if (pieChartColors.length === 0) {
                    // Generate colors and store them
                    pieChartColors = getRandomColors(data.length);
                }

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.map(entry => entry.department),
                        datasets: [{
                            data: data.map(entry => entry.vote_count),
                            backgroundColor: pieChartColors,
                        }],
                    },
                    options: {
                        legend: {
                            display: false, // Hide default legend
                        },
                    },
                });

                // Create custom legend
                const legendContainer = document.getElementById("legend-container");
                const legendHTML = createLegendHTML(data);
                legendContainer.innerHTML = legendHTML;
            }

            function createLegendHTML(data) {
                let legendHTML = '<ul>';
                data.forEach(entry => {
                    legendHTML += `<li>${entry.department}: ${entry.vote_count}</li>`;
                });
                legendHTML += '</ul>';
                return legendHTML;
            }

            function getRandomColors(count) {
                // Define a fixed set of colors
                const fixedColors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff', '#c0c0c0', '#808080', '#800000', '#008000'];

                // Return a slice of the fixed colors array based on the count
                return fixedColors.slice(0, count);
            }
        </script>
    </div>

    <!-- bar chart new task -->

    <div class="card col-lg-12">
        <div id="bar-container"></div>
        <script>
            $(document).ready(function() {
                // Predefined fixed colors
                const fixedColors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff', '#c0c0c0', '#808080', '#800000', '#008000'];

                // Fetch data from the server
                $.ajax({
                    url: 'departmentdata.php', // Replace with your actual backend endpoint
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Extract data from the response
                        const departments = response.departments;
                        const section = response.section;
                        const data = response.data;

                        // Create a bar chart for each department
                        departments.forEach((department, index) => {
                            createBarChart(department, section, data[index], fixedColors[index % fixedColors.length]);
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });

                function createBarChart(department, section, data, color) {
                    // Create a unique canvas for each department
                    const canvasId = 'barChart_' + department.replace(/\s/g, ''); // Remove spaces from department name
                    $('#bar-container').append(`<canvas id="${canvasId}" class="bar-chart"></canvas>`);

                    const ctx = document.getElementById(canvasId).getContext('2d');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: section,
                            datasets: [{
                                label: department,
                                data: data,
                                backgroundColor: color,
                            }],
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
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: department,
                                    position: 'top',
                                    font: {
                                        size: 16,
                                    },
                                },
                            },
                        }
                    });
                }
            });
        </script>
    </div>



</body>

</html>