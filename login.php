<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to database
    $conn = new mysqli("localhost", "root", "", "travel_planner");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute SQL query
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password);

    // Verify user credentials
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            // Authentication successful
            $_SESSION["user_id"] = $user_id;
            header("Location: index.php"); // Redirect to index page after login
            exit();
        } else {
            // Invalid password
            echo "Invalid password.";
        }
    } else {
        // User not found
        echo "No user found with that username.";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
