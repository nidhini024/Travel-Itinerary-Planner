<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "travel_planner");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user's bookings from database
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM bookings WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
        <h1>Bookings</h1>
    </header>
    <main>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="booking">
                <h2><?php echo $row["type"]; ?></h2>
                <p><?php echo $row["details"]; ?></p>
            </div>
        <?php endwhile; ?>
    </main>
    <footer>
        <p>&copy; 2024 Travel Itinerary Planner</p>
    </footer>
</body>
</html>
