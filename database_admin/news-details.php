<?php

$localhost = "localhost";
$username = "root";
$password = "";
$database = "events";

$con = new mysqli($localhost, $username, $password, $database);

if ($con->connect_errno) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_GET['news_id']) && is_numeric($_GET['news_id'])) {
    $newsID = intval($_GET['news_id']); // Sanitize input
    $sql = "SELECT title, dates, detailedDec FROM news_form WHERE sr_no = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $newsID); 
        $stmt->execute();
        $stmt->bind_result($title, $date, $detailedDec);
        if ($stmt->fetch()) {
            // Success: Data fetched successfully
        } else {
            echo "<p>News not found.</p>";
            exit;
        }
        $stmt->close();
    }
} else {
    echo "<p>Invalid event ID.</p>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($news['title']); ?></title>
</head>

<style>

    .news-details{
        width:650px;
        height:auto;
        border: 1px solid black;
        border-radius:8px;
        margin-left:35%;
        margin-top:10%;
        background-color:#bbdae9;
        padding:15px;
    }
    #news-title{
        text-align:center;

    }
    #news-date{
        font-size:18px;
        text-align:center;
        color: blue;
    }
    #news-description{
        margin-left:10%;
        font-size:17px;
        margin-bottom:10%;
        
    }
    .back{
        width:150px;
        height:40px;
        padding:10px;
        font-size:18px;
        margin-left:40%;
        margin-bottom:5%;
        border-radius:5px;
        background-color:#28a745;  
        border:none;
        color:white;      

    }
    .back:hover{
        background-color: #218838;
    cursor: pointer;
    }
</style>
<body>
    

    <div class="news-details" style="position:relative;right:130px;bottom:50px;height:600px">
         <h1 id = "news-title"><?php echo htmlspecialchars($title); ?></h1>
        <h2 id = "news-date">Date: <?php echo date("F j, Y", strtotime($date)); ?></h2>
        
        <p id="news-description" ><?php echo nl2br(htmlspecialchars($detailedDec)); ?></p>
        <a href="news.php"  ><button class ="back" style="position:relative;top:340px">Back to News</button></a>
        
        
    </div>
</body>
</html> 
<?php
$con->close();
?>
