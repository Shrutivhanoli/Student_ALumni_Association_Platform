<?php
if (isset($_POST['title'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "events";

    // Connect to database
    $con = mysqli_connect($server, $username, $password, $database);

    if (!$con) {
        die("Failed to connect: " . mysqli_connect_error());
    }

    // Retrieve form data
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $shortInfo = mysqli_real_escape_string($con, $_POST['short-info']);
    $detailedDec = mysqli_real_escape_string($con, $_POST['detailed-descr']);
    $dates = $_POST['date'];  // Use 'date' to match form input name

    // Insert data into database
    $sql = "INSERT INTO `news_form`(`title`, `summary`, `detailedDec`, `dates`) 
            VALUES ('$title', '$shortInfo', '$detailedDec', '$dates')";

    if ($con->query($sql) === true) {
        // Success
    } else {
        echo "Error: $sql <br>" . $con->error;
    }

    // Close the database connection
    $con->close();
    
    // Redirect to news.php after submitting
    header("Location: news.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlinkNews</title>
    <link rel="stylesheet" href="news-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <form action="news-form.php" method="POST" class="news-form" id="news-form">
        <h1>News Feed Form</h1>
        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" placeholder="Enter the news title" required>
        </div>
        <div class="form-group">
            <label for="short-info">Summary</label>
            <input id="short-info" type="text" name="short-info" placeholder="Enter a short summary" required>
        </div>
        <div class="form-group">
            <label for="detailed-descr">Detailed Description</label>
            <textarea id="detailed-descr" name="detailed-descr" placeholder="Enter the detailed description" required></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input id="date" type="date" name="date" required>
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
