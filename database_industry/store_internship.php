<?php
$host = "localhost";
$username = "root"; // Change this if necessary
$password = ""; // Change this if necessary
$database = "industry"; // Database name is industry

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $company_name = $_POST['company_name'];
    $position = $_POST['position'];
    $skills_required = $_POST['skills_required'];
    $description = $_POST['description'];
    $apply_link = $_POST['apply_link'];

    // Insert data into the database
    $sql = "INSERT INTO internship (company_name, position, skills_required, description, apply_link)
            VALUES ('$company_name', '$position', '$skills_required', '$description', '$apply_link')";

    if ($conn->query($sql) === TRUE) {
        echo "Internship added successfully! ";
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
    <title>store job</title>
</head>
<body>
    <div style="height:60px;width:260px;background-color:white;border:1px solid black;border-radius:40px;position:relative;top:40px">
            <a href="display_internship.php" style="text-decoration:none;font-size:25px;position:relative;left:22px;top:15px">See All Opportunity</a>
    </div>
</body>
</html>