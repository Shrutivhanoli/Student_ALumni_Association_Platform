<?php
$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "student_db";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $linkedin = !empty($_POST['linkedin']) ? $_POST['linkedin'] : NULL;
    $instagram = !empty($_POST['instagram']) ? $_POST['instagram'] : NULL;
    $skills = $_POST['skills'];
    $experience = $_POST['experience'];
    $date = $_POST['date'];

    // Handle image upload (optional)
    $image_path = NULL;
    if (isset($_FILES['story_image']) && $_FILES['story_image']['name'] != '') {
        $image_name = $_FILES['story_image']['name'];
        $image_tmp_name = $_FILES['story_image']['tmp_name'];
        $upload_dir = "uploads/";

        // Create the uploads directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file to the server
        $image_path = $upload_dir . basename($image_name);
        move_uploaded_file($image_tmp_name, $image_path);
    }

    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO stories (name, linkedin, instagram, skills, experience, image_path, date)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters to the statement
    $stmt->bind_param("sssssss", $name, $linkedin, $instagram, $skills, $experience, $image_path, $date);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Success story added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
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
        <a href="display_stories.php" style="text-decoration:none;position:relative;left:10px;top:7px">show stories</a>
    </div>
</body>
</html>
