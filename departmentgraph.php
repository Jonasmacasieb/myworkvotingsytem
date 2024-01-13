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
            margin: auto;
            width: 80%;
        }

        .card {
            border: 1px solid #3498db;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .serif-font {
            font-family: serif;
            font-size: 35px;
        }

        .gradient-background {
            background: linear-gradient(to bottom, #ff7e5f, #feb47b);
            color: white;
            padding: 10px;
            border-radius: 10px;
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
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
            </div>
        </div>
    </div>



    <br>
    <!-- bar chart new task -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div id="bar-container">

                    <canvas id="myBarChart"></canvas>
                </div>

                <?php
                // Fetch data from the users table, grouping by department
                $query = "SELECT department, section, has_voted FROM users WHERE type = 2";

                $result = mysqli_query($conn, $query);

                // Initialize an associative array to store data grouped by department and section name
                $departmentData = array();

                // Populate the array with data from the database
                while ($row = mysqli_fetch_assoc($result)) {
                    $department = $row['department'];
                    $section = $row['section'];
                    $voted = $row['has_voted'];

                    // Create an array for the department if it doesn't exist
                    if (!isset($departmentData[$department])) {
                        $departmentData[$department] = array();
                    }

                    // Add section and CSS score to the department array
                    if (!isset($departmentData[$department][$section])) {
                        $departmentData[$department][$section] = array('section' => $section, 'has_voted' => 0);
                    }

                    // Increment the has_voted count for the section
                    $departmentData[$department][$section]['has_voted'] += $voted;
                }
                ?>

                <script>
                    // Your data from MySQL or any other source
                    var departmentData = <?php echo json_encode($departmentData); ?>;

                    // Create an array to store the datasets
                    var datasets = [];

                    // Iterate through the departmentData and create datasets for each department
                    for (var department in departmentData) {
                        if (departmentData.hasOwnProperty(department)) {
                            var departmentDataset = {
                                label: department,
                                data: Object.values(departmentData[department]).map(item => item.has_voted),
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                borderColor: 'rgba(75, 192, 192, 1)', // Border color remains the same
                                borderWidth: 1
                            };

                            datasets.push(departmentDataset);
                        }
                    }

                    // ...

                    // Create a bar chart for each department
                    datasets.forEach(function(departmentDataset) {
                        var ctx = document.createElement('canvas').getContext('2d');

                        document.getElementById('bar-container').appendChild(ctx.canvas); // Append canvas to chart-container

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: Object.values(departmentData[departmentDataset.label]).map(item => item.section),
                                datasets: [departmentDataset]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        max: 100, // Set your desired maximum value
                                        ticks: {
                                            stepSize: 25, // Set your desired step size
                                            callback: function(value) {
                                                return value.toFixed(0);
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>


            </div>
        </div>
    </div>

</body>

</html>