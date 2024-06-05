<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Link to your CSS file if needed -->
</head>
<body>
    <header>
        <h1>Welcome to the Travel Itinerary Planner</h1>
    </header>
    <main>
        <p>Welcome, <?php echo $_SESSION["username"]; ?>!</p>
        <!-- Add content for index page -->
    </main>
    <footer>
        <p>&copy; 2024 Travel Itinerary Planner</p>
    </footer>
</body>
</html>
