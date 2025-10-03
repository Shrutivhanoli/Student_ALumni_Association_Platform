<?php
$host = "localhost";
$username = "root"; // Change this if necessary
$password = ""; // Change this if necessary
$database = "student_vlogs"; // Database name is student_vlogs

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author_name = $_POST['author_name'];
    $date = $_POST['date'];

    // Handle photo upload (optional)
    $photo_path = NULL;
    if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
        $photo_name = $_FILES['photo']['name'];
        $photo_tmp_name = $_FILES['photo']['tmp_name'];
        $upload_dir = "uploads/";

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $photo_path = $upload_dir . basename($photo_name);
        move_uploaded_file($photo_tmp_name, $photo_path);
    }

    // Insert data into the database
    $sql = "INSERT INTO vlogs (title, photo_path, description, author_name, date)
            VALUES ('$title', ". ($photo_path ? "'$photo_path'" : "NULL") .", '$description', '$author_name', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "Vlog added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="border:1px solid ;border-radius:10px;height:35px;width:120px;position:relative;top:50px">
        <a href="display_vlogs.php" style="text-decoration:none;position:relative;left:10px;top:7px">view vlogs</a>
    </div>
</body>
</html>
