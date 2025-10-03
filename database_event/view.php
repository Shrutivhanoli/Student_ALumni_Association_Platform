<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "events";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM events_form WHERE id = $id";
$result = $conn->query($sql);

// Check if query executed successfully and returned a result
if ($result && $result->num_rows > 0) {
    $event = $result->fetch_assoc();
} else {
    $event = null; // Set event to null if no result found
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($event['title'] ?? 'Event Not Found'); ?></title>
</head>
<body>
    <div style="width:70%;height:auto;position:relative;left:15%;top:10px;border:1px solid black;border-radius:5px;margin-bottom:50px">
    <?php if ($event): ?>
        <h2 style="position:relative;left:40%;width:100px;font-size:38px"><?php echo htmlspecialchars($event['title']); ?></h2>
        <p style="position:relative;left:40%;font-size:20px;width:500px"><em>Date: <?php echo htmlspecialchars($event['dates']); ?></em></p>
        <p style="position:relative;left:10%;font-size:16px"><?php echo nl2br(htmlspecialchars($event['detailedDec'])); ?></p>
    <?php else: ?>
        <p>Event not found.</p>
    <?php endif; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
