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

$sql = "SELECT * FROM internship";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Opportunities</title>
    <style>
        .internship-box {
            border: 1px solid #ccc;
            height: 200px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);

        }
        .internship-title {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .internship-meta {
            margin-bottom: 15px;
        }
        .internship-link a {
            text-decoration: none;
            color: #0073b1;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div style="height:400px;width:100%;">
    <img src="https://media.istockphoto.com/id/1404131751/vector/dark-blue-abstract-background-with-triangle-lines-and-light-composition.jpg?s=612x612&w=0&k=20&c=RNw6Zjy1FzuarEn55jQoLRip0fAOlXu_YW5a8V-Tz_4=" alt="image" style="width: 100%;height: 500px;">
    <h2 style="font-size:40px;position:absolute;left:500px;top:10px;color:white;border-bottom:5px solid white;padding-bottom:10px">Internships</h2>
    <a href="http://localhost/database_connect1/index1.html" style="text-decoration:none;font-size:25px;position:relative;left:85%;bottom:470px;padding-right:20px;border-right:1px solid;color:white;padding-left:20px;border-left:1px solid">Home</a>
    <!--<a href="uploadinternship.html" style="text-decoration:none;font-size:25px;position:relative;left:86%;bottom:470px;color:white">Add</a>
    -->
</div>

    <div style="width:80%;position:relative;left:10%;bottom:250px;background-color:white;">
    <?php
    if ($result->num_rows > 0) {
        // Output each internship in a box
        while($row = $result->fetch_assoc()) {
            echo "<div class='internship-box' style='box-shadow:10px 10px 10px black'>";
            echo "<div class='internship-title'>" . $row['company_name'] . " - " . $row['position'] . "</div>";
            echo "<div class='internship-meta'><strong>Skills Required:</strong> " . $row['skills_required'] . "</div>";
            echo "<div class='internship-meta'><strong>Description:</strong> " . $row['description'] . "</div>";
            echo "<div class='internship-link'><a href='" . $row['apply_link'] . "' target='_blank'>Apply for this internship</a></div>";
            echo "</div>";
        }
    } else {
        echo "<p>No internship opportunities found.</p>";
    }

    $conn->close();
    ?>
    </div>
</body>
</html>
