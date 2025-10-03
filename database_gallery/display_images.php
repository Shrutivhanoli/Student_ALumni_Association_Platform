<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "image_gallery";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

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
    <title>Image Gallery</title>
    <style>
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        .gallery img {
            width: 100%;
            height: auto;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .gallery img:hover {
            transform: scale(1.05);
        }
        /* Full-screen modal style */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.9);
        }
        .modal-content {
            display: block;
            margin: auto;
            max-width: 90%;
            height: auto;
        }
        .close {
            position: absolute;
            top: 20px;
            right: 40px;
            color: #fff;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div style="width:100%;height:140px;background-color:red;margin-bottom:50px">
        <img src="https://media.istockphoto.com/id/1219872152/vector/abstract-creative-background.jpg?s=612x612&w=0&k=20&c=hqNERUEmT9KgPCis9ZvaxemOSfFWR-oKPe3PA-nFjkY=" alt="image" style="width:100%;height:140px">
        <img src="https://lh4.googleusercontent.com/proxy/O34Qwq3ihb0Zm6_jXd3P8IQ8s4HWOkqFCW-k9-uL_HnME3v9vXeobByOv46bHHlkPj9AlA" alt="image" style="height: 80px;position: absolute;left: 30px;top: 30px;">
        <h1 style="position:absolute;left:160px;top:11px;color:white;font-size:45px;padding-bottom:6px; border-bottom: 5px solid ; border-image: linear-gradient(to right, orangered 50%, transparent 50%) 100% 1;">Gallery</h1>
    </div>
<div class="gallery">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<img src='" . $row['image_path'] . "' alt='Gallery Image' onclick='openModal(this.src)'>";
        }
    } else {
        echo "<p>No images available.</p>";
    }
    ?>
</div>



<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<script>
    function openModal(src) {
        document.getElementById("imageModal").style.display = "block";
        document.getElementById("modalImage").src = src;
    }
    
    function closeModal() {
        document.getElementById("imageModal").style.display = "none";
    }
</script>

</body>
</html>

<?php $conn->close(); ?>
