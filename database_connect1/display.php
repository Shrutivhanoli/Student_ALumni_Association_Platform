<?php
$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "image_gallery";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM images";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
</head>
<body>

<h2>Upload an Image</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Select Image:</label>
        <input type="file" name="image" required>
        <input type="submit" name="submit" value="Upload">
    </form>


    <h2>Image Gallery</h2>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<img src='" . $row['image_path'] . "' alt='" . $row['image_name'] . "' style='width:400px;height:auto;'>";
            echo "<p>" . $row['image_name'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "No images found.";
    }
    $conn->close();
    ?>
</body>
</html>
