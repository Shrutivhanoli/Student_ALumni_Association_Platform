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

$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Opportunities</title>
    <style>
        .job-box {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .job-title {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .job-meta {
            margin-bottom: 15px;
        }
        .job-link a {
            text-decoration: none;
            color: #0073b1;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div style="height:400px;width:100%;background: linear-gradient(110deg, rgba(255, 255, 255, 0.5) 100%, lightblue 20%), url('https://media.istockphoto.com/id/625736338/photo/stack-of-hands-showing-unity.jpg?s=612x612&w=0&k=20&c=20mAQjGRQ5XVKqHe2qFguqGZ4dwto6lxxinciCfnVI0=');
background-size: cover;">
    <h2 style="font-size:45px;position:relative;left:140px;top:150px;width:600px">Job Opportunities</h2>
     <!-- <a href="uploadjob.html" style="text-decoration:none;font-size:25px;position:relative;left:86%;bottom:70px">Add</a>-->
    </div>

    <div style="width:80%;position:relative;left:10%;top:-100px;background-color:white;height:auto;box-shadow:10px 10px 10px black">
    <?php
    if ($result->num_rows > 0) {
        // Output each job opportunity in a box
        while($row = $result->fetch_assoc()) {
            echo "<div class='job-box' style='box-shadow:10px 10px 10px black'>";
            echo "<div class='job-title'>" . $row['company_name'] . " - " . $row['job_position'] . "</div>";
            echo "<div class='job-meta'><strong>Skills Required:</strong> " . $row['skills_required'] . "</div>";
            echo "<div class='job-meta'><strong>Payment:</strong> " . $row['payment'] . "</div>";
            echo "<div class='job-link'><a href='" . $row['apply_link'] . "' target='_blank'>Apply for this job</a></div>";
            echo "</div>";
        }
    } else {
        echo "<p>No job opportunities found.</p>";
    }

    $conn->close();
    ?>
    </div>
</body>
</html>
