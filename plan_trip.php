<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to database
    $conn = new mysqli("localhost", "root", "", "travel_planner");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $destination = $_POST["destination"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $user_id = $_SESSION["user_id"];

    // Prepare and execute SQL query
    $sql = "INSERT INTO trips (user_id, destination, start_date, end_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $destination, $start_date, $end_date);

    if ($stmt->execute()) {
        echo "Trip planned successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
