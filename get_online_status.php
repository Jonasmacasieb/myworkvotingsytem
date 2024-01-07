<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $result = $conn->query("SELECT online_status FROM users WHERE id = $user_id");

    if ($result) {
        $row = $result->fetch_assoc();
        echo $row['online_status'];
    } else {
        echo "Error fetching online status";
    }
} else {
    echo "User ID not provided";
}
