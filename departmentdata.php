<?php

// Simulating data retrieval from the database
$departments = ['Department A', 'Department B', 'Department C'];
$section = ['Section 1', 'Section 2', 'Section 3'];
$data = [
    [70, 80, 90],
    [60, 70, 80],
    [80, 85, 90]
];

// Prepare the response as JSON
$response = [
    'departments' => $departments,
    'section' => $section,
    'data' => $data
];

// Set the Content-Type header to JSON
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);
