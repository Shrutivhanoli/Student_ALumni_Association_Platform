
<?php
$host = "localhost";
$username = "root"; // Change this if necessary
$password = ""; // Change this if necessary
$database = "image_gallery";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Check if image file is uploaded
    if ($_FILES['image']['name']) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $upload_dir = "uploads/";

        // Create upload directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file to the server
        $image_path = $upload_dir . basename($image_name);
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            // Insert the image details into the database
            $sql = "INSERT INTO images (image_name, image_path) VALUES ('$image_name', '$image_path')";

            if ($conn->query($sql) === TRUE) {
                echo  "Image uploaded and saved successfully!";
        
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo   "Failed to upload the image.";
            
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
</head>

<body>
        <div style="height:50px;width:170px;background-color:red;border-radius:20px;position:relative;left:600px;top:100px;box-shadow: 7px 7px;">
        <a href="display.php" style="text-decoration:none;color:white;margin:10px;font-size:22px;position:relative;top:10px;left:10px">Go To Gallery</a>
        </div>
</body>
</html>