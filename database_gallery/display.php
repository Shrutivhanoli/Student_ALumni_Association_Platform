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

$sql = "SELECT * FROM images";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
</head>

<body>
<style>
        .gallery {
            width: 100%;
            /* Allows wrapping to the next row if there's not enough space */
        }
        .gallery div {
            margin: 10px;
        }
        .gallery img {
            width: 200px; /* Set the image width */
            height: auto; /* Maintain aspect ratio */
            border: 1px solid #ccc;
            padding: 5px;
        }
        .gallery p {
            text-align: center; /* Center-align image name */
        }
        #p{
            width: 500px;
            height: auto;
            margin-left: 500px;

        }
  
        /*display images in table format*/
.image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Adjust 200px to control image size */
    gap: 20px; /* Space between images */
    padding: 20px;
}

.image-item {
    background-color: #f1f1f1; 
    padding: 10px;
    text-align: center; 

}

.image-item img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
     
}
    </style>

<!-- header -->
<div style="width:100%;height:140px;background-color:red;margin-bottom:50px">
        <img src="https://media.istockphoto.com/id/1219872152/vector/abstract-creative-background.jpg?s=612x612&w=0&k=20&c=hqNERUEmT9KgPCis9ZvaxemOSfFWR-oKPe3PA-nFjkY=" alt="image" style="width:100%;height:140px">
        <img src="https://lh4.googleusercontent.com/proxy/O34Qwq3ihb0Zm6_jXd3P8IQ8s4HWOkqFCW-k9-uL_HnME3v9vXeobByOv46bHHlkPj9AlA" alt="image" style="height: 80px;position: absolute;left: 30px;top: 30px;">
        <h1 style="position:absolute;left:160px;top:11px;color:white;font-size:45px;padding-bottom:6px; border-bottom: 5px solid ; border-image: linear-gradient(to right, orangered 50%, transparent 50%) 100% 1;">Gallery</h1>
    </div>


    <!--display images-->
    <div class="gallery" >
    <?php 
    if ($result->num_rows > 0) {
        // Open a container div for the grid layout
        echo "<div class='image-grid'>";
        
        while($row = $result->fetch_assoc()) {
            // Each image container
            echo "<div class='image-item'>";
            echo "<img src='" . $row['image_path'] . "' alt='" . $row['image_name'] . "' style='width:100%;height:auto;'>";
            // Uncomment if you want to display the image name
            // echo "<p>" . $row['image_name'] . "</p>";
            echo "</div>";
        }

        // Close the container div
        echo "</div>";
    } else {
        echo "No images found.";
    }
    $conn->close();
?>

    </div>

    

    <div id="footer">
    <div  style="background-color: rgb(0, 0, 0);height: 200px;width: 100%; margin-top: 50px; position:relative;bottom:0px;margin-bottom: 0px;margin-top:100px">
            <hr style="background-color: white;height: 2px;position: relative;top: 30px;width: 80%;">
            <pre><h3 style="color: white;font-family: 'times new roman';margin-top: 60px;margin-left: 20px;">Kolhapur Institute Of Technology,
Kolhapur</h3></pre>
            </h3>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcyQiONPi2adI2TFdYD0sVDvMopYLoZzvNFQ&s" alt="image" style="height: 27px;border-radius: 50%;margin-left: 20px;">
            <a href="https://www.facebook.com/official.kitcoek/"  style="color: white;font-size: 20px;margin-left: 5px;position: relative;top: -8px;text-decoration: none;">Facebook</a>
            <img src="data:image/png;base64,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" alt="image"style="height: 27px;border-radius: 50%;margin-left: 20px;">
            <a href="https://www.instagram.com/kitcoek.official/?hl=en" style="color: white;font-size: 20px;margin-left: 5px;position: relative;top: -8px;text-decoration: none;">Instrgram</a>
            <img src="data:image/png;base64,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" alt="image" style="height: 27px;border-radius: 50%;margin-left: 20px;">
            <a href="https://twitter.com/officialkitcoek?lang=en" style="color: white;font-size: 20px;margin-left: 5px;position: relative;top: -8px;text-decoration: none;">Twitter</a>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxdYwozA9MbvQoyUmsgHE9L-mHJ1Hxb-MlGg&s" alt="image" style="height: 27px;border-radius: 50%;margin-left: 20px;" >
            <a href="https://www.youtube.com/@OfficialKITCoEK" style="color: white;font-size: 20px;margin-left: 5px;position: relative;top: -8px;text-decoration: none;">You Tude</a>
          </div>
    </div>

</body>
</html>
