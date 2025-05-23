<?php
// Database connection
$servername = "localhost"; // or your server name
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "sports_team_manager"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add Player Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['player'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $number = $_POST['number'];

    $stmt = $conn->prepare("INSERT INTO players (name, position, number) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $position, $number);
    $stmt->execute();
    $stmt->close();
}

// Handle Add Match Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_match'])) {
    $opponent = $_POST['opponent'];
    $match_date = $_POST['match_date'];
    $score = $_POST['score'];

    $stmt = $conn->prepare("INSERT INTO matches (opponent, match_date, score) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $opponent, $match_date, $score);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to the main page after processing
header("Location: index.html");
exit();
?>
