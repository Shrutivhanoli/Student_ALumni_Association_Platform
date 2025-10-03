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

$sql = "SELECT * FROM projects ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Gallery</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #F7F9FB; }
        .project-container { display: flex; flex-direction: column; gap: 20px; max-width: 800px; margin: auto; }
        .project { padding: 15px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .project h3 { margin: 0 0 10px; color: #007BFF; }
        .project p { margin: 5px 0; }
        .project a { color: #FF6B6B; text-decoration: none; }
    </style>
</head>
<body>

<h2 style="font-size:32px;margin-left:500px">Project Gallery</h2>
<a href="http://localhost/database_connect1/index1.html" style="text-decoration:none;font-size:16px;position:relative;left:85%;bottom:70px;padding-right:20px;border-right:1px solid;padding-left:20px;border-left:1px solid">Home</a>
<!--<a href="http://localhost/database_project/upload_project.php " style="text-decoration:none;font-size:16px;position:relative;left:86%;bottom:70px">Add</a>-->
    
<div class="project-container" style="height:auto;box-shadow:5px 5px 5px">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='project' style='box-shadow:10px 10px 10px black;background-color:lightblue'>";
            echo "<h3 style='margin-left:300px'>" . htmlspecialchars($row['project_name']) . "</h3>";
            echo "<h4 style='color:black;font-weight: 10px;position:relative;bottom:10px'>"."Name : ". htmlspecialchars($row['name']) . "</h4>";
          //  echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
            echo "<p style='position:relative;bottom:25px'>" . "<p>"."About project :-"."</p>". htmlspecialchars($row['description']) . "</p>";

            // Resume link if available
            if (!empty($row['resume_path'])) {
                echo "<p style='position:relative;bottom:10px;margin-top:25px; '><a  href='" . $row['resume_path'] . "' download>See Resume</a></p>";
            }

            // Project files if available
            if (!empty($row['files_path'])) {
                $files = json_decode($row['files_path']);
                echo "<p><strong>Project Files:</strong></p><ul>";
                foreach ($files as $file) {
                    echo "<li><a href='$file' download>" . basename($file) . "</a></li>";
                }
                echo "</ul>";
            }
            echo "</div>";
        }
    } else {
        echo "<p>No projects found.</p>";
    }
    ?>
</div>

</body>
</html>

<?php $conn->close(); ?>
