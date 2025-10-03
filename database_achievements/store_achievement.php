<?php
$host = "localhost";
$username = "root"; // Change this if necessary
$password = ""; // Change this if necessary
$database = "achievements";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Retrieve form data and sanitize inputs
    $student_name = $conn->real_escape_string($_POST['student_name']);
    $achievement_title = $conn->real_escape_string($_POST['achievement_title']);
    $achievement_description = $conn->real_escape_string($_POST['achievement_description']);
    $date_achieved = $conn->real_escape_string($_POST['date_achieved']);

    // Ensure image upload is compulsory
    if (isset($_FILES['achievement_image']) && $_FILES['achievement_image']['name'] != '') {
        // Validate image type (allow only jpg, png, gif)
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $image_extension = strtolower(pathinfo($_FILES['achievement_image']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($image_extension, $allowed_extensions)) {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit();
        }

        // Handle image upload
        $image_name = $_FILES['achievement_image']['name'];
        $image_tmp_name = $_FILES['achievement_image']['tmp_name'];
        $upload_dir = "uploads/";

        // Create the uploads directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Generate a unique file name to avoid overwriting
        $image_path = $upload_dir . uniqid() . '.' . $image_extension;

        if (move_uploaded_file($image_tmp_name, $image_path)) {
            // Insert data into the database using prepared statements
            $stmt = $conn->prepare("INSERT INTO achievements (student_name, achievement_title, achievement_description, date_achieved, image_path)
                                    VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $student_name, $achievement_title, $achievement_description, $date_achieved, $image_path);

            if ($stmt->execute()) {
                echo "Achievement added successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to upload the image.";
        }
    } else {
        // Image is not provided, show an error message
        echo "Error: Image upload is mandatory.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <div style="height:60px;width:200px;background-color:white;border-radius:10px;border:1px solid;position:relative;top:50px">
        <a href="display_achievements.php" style="text-decoration:none;font-size:22px;position:relative;top:15px;left:12px;color:black;border-bottom:1px solid">View Achievements</a>
    </div>
</body>
</html>