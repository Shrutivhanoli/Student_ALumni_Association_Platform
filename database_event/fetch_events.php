<?php
// fetch-events.php

header('Content-Type: application/json'); // Set the content type to JSON
$server = "localhost";
$username = "root";
$password = "";
$database = "events";

// create a database connection
$conn = mysqli_connect($server,$username,$password,$database);

// check for connectionn 
if(!$conn)
{
    die("Connection to this database failed");
}
// Database connection
// $conn = new mysqli("host", "username", "password", "events");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch events from the database
$sql = "SELECT title, dates FROM events_form"; // Adjust the table and column names as needed
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = [
            'title' => $row['title'],
            'start' => $row['dates']
        ];
    }
}

echo json_encode($events);

$conn->close();
?>
