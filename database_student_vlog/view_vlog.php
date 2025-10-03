<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "student_vlogs";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$sql = "SELECT * FROM vlogs WHERE id = $id";
$result = $conn->query($sql);
$vlog = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($vlog['title']); ?></title>
</head>
<body>
    <div style="width:70%;height:auto;position:relative;left:15%;top:10px;border:1px solid black;border-radius:5px;margin-bottom:50px">
    <?php if ($vlog): ?>
        <h2 style="position:relative;left:40%;width:800px;font-size:38px"><?php echo htmlspecialchars($vlog['title']); ?></h2>
        <?php if ($vlog['photo_path']): ?>
            <img src="<?php echo $vlog['photo_path']; ?>" alt="Vlog Image" style="max-width:100%;position:relative;left:80px;">
        <?php endif; ?>
        <p style="position:relative;left:40%;font-size:20px;width:500px"><em>by <?php echo htmlspecialchars($vlog['author_name']); ?> on <?php echo $vlog['date']; ?></em></p>
        <p style="position:relative;left:10%;font-size:16px;font-size:20px;width:800px;height:auto;" ><?php echo nl2br(htmlspecialchars($vlog['description'])); ?></p>
    <?php else: ?>
        <p>Vlog not found.</p>
    <?php endif; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
