<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "project_portal";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Collect project information
    $name = $_POST['name'];
    $project_name = $_POST['project_name'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    
    // Directory for file uploads
    $upload_dir = "uploads/";

    // Check if the uploads directory exists, if not, create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Handle resume upload (optional)
    $resume_path = NULL;
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $resume_name = basename($_FILES['resume']['name']);
        $resume_path = $upload_dir . "resume_" . time() . "_" . $resume_name;
        if (!move_uploaded_file($_FILES['resume']['tmp_name'], $resume_path)) {
            echo "Failed to upload resume file.";
        }
    }

    // Handle project files upload
    $files_paths = [];
    if (isset($_FILES['project_files'])) {
        foreach ($_FILES['project_files']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['project_files']['error'][$key] == 0) {
                $file_name = basename($_FILES['project_files']['name'][$key]);
                $file_path = $upload_dir . "file_" . time() . "_" . $file_name;
                if (move_uploaded_file($tmp_name, $file_path)) {
                    $files_paths[] = $file_path;
                } else {
                    echo "Failed to upload file: " . $file_name;
                }
            }
        }
    }
    
    // Store file paths as JSON in the database
    $files_paths_json = json_encode($files_paths);

    // Insert project information into the database using prepared statements
    $stmt = $conn->prepare("INSERT INTO projects (name, project_name, email, description, resume_path, files_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $project_name, $email, $description, $resume_path, $files_paths_json);

    if ($stmt->execute()) {
        echo "Project uploaded successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>store job</title>
</head>
<body>
    <div style="height:30px;width:120px;background-color:white;border:1px solid black;border-radius:40px;position:relative;top:40px">
            <a href="http://localhost/database_project/display_projects.php" style="text-decoration:none;font-size:15px;position:relative;left:22px;top:5px">See projects</a>
    </div>
</body>
</html>