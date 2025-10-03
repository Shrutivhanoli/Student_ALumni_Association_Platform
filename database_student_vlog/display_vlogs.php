<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "student_vlogs";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM vlogs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Vlogs</title>
    <style>
        .vlog-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            position:relative;
            bottom: 80px;
            left: 0px;
            margin-bottom: 30px;
        }
        .vlog-item {
            border: 2px solid rgb(118, 118, 194);
            padding: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color:white;
            width: 250px;
            margin-left: 20px;
            
            margin-bottom: 40px;

        }
        .vlog-item img {
            max-width: 100%;
            height: auto;
        }
        .vlog-title {
            font-size: 1.2em;
            margin: 10px 0;
        }
        .vlog-link a {
            text-decoration: none;
            color: #0073b1;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div style="height:250px;width:100%;background-color:red">
    <img src="vlog_background.png" alt="images" style="height:320px;width:100%">
    <img src="kitlogo.png" alt="image" style="height: 80px;position: absolute;left: 50px;top: 50px;">
    <h1 style="position:relative;bottom:300px;left:550px;font-size:40px;color:white;padding-bottom:10px;border-bottom:5px solid white;width:100px"> Vlogs</h1>
    <a href="" style="position:absolute;top:20px;right:100px;padding-right:15px;color:black;text-decoration:none;font-size:25px;color:white">Home</a>
    <!--<a href="upload_vlog.html" style="position:absolute;top:20px;right:45px;color:black;text-decoration:none;font-size:25px;color:white" >Add</a>-->
       
</div>
    <div class="vlog-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='vlog-item'>";
                if ($row['photo_path']) {
                    echo "<img src='" . $row['photo_path'] . "' alt='Vlog Image'>";
                }
                echo "<div class='vlog-title'>" . $row['title'] . "</div>";
                echo "<div><em>by " . $row['author_name'] . " on " . $row['date'] . "</em></div>";
                echo "<div class='vlog-link'><a href='view_vlog.php?id=" . $row['id'] . "'>Read More</a></div>";
                echo "</div>";
            }
        } else {
            echo "<p>No vlogs available.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
