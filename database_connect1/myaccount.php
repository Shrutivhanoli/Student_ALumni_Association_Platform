
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signup.php");
    exit;
}

$host = "localhost";
$username = "root";
$password = "";
$database = "user_system";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
    
<head>
    <title>My Account</title>
    <style>
    .links {
        display: none; /* Hidden initially */
        position: absolute;
        top: 90px;
        left: 20px;
        background-color: black;
        padding: 10px;
        border: 1px solid #ddd;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    }

    .links a {
        display: block;
        text-decoration: none;
        color: #007BFF;
        font-weight: bold;
        margin: 5px 0;
    }

    .links a:hover {
        color: #0056b3;
    }
</style>

</head>
<body style="background-image: url('account.jpg');background-repeat:no-repeat;background-size: cover;height:592px;width:100%">


    <div style="background-color:black;width:100%;height:50px;margin-top:30px;opacity: 0.7;border:1px solid black;margin-left:-5px">
    <a style="position:relative;left:1250px;top:-8px;color:white;text-decoration:none;font-size:20px;padding:10px;border:1px solid red;background-color:red" href="logout.php">Logout</a>
    <img src="lines.jpg" alt="lines" style="height:40px;position:relative;right:40px;top:5px"> 
    <a style="position:relative;left:-20px;top:-8px;color:white;text-decoration:none;font-size:20px;padding:10px;border:1px solid red;background-color:red" href="http://localhost/database_connect1/index1.html">Home</a>
    <a style="position:relative;left:5px;top:-8px;color:white;text-decoration:none;font-size:20px;padding:10px;border:1px solid red;background-color:red" href="http://localhost/database_profile/store_profile.php" target="_black">Build Profile</a>
<div class="links" id="link-container">
    <a href="http://localhost/database_gallery/uploadimage.html" target="_blank">Add Image</a>
    <a href="http://localhost/database_industry/uploadjob.html" target="_blank">Add job opportunitie</a>
    <a href="http://localhost/database_industry/uploadinternship.html" target="_blank">Add Internship opportunitie</a>
    <a href="http://localhost/database_project/upload_project.php" target="_blank">Add project</a>
    <a href="http://localhost/database_success_stories/upload_story.html" target="_blank">Add Success Story</a>
    <a href="http://localhost/database_achievements/upload_achi.html" target="_blank">Add Achievement</a>
    <a href="http://localhost/database_student_vlog/upload_vlog.html" target="_blank">Add Vlogs</a>
    <a href="http://localhost/database_event/events-form.php" target="_blank">Add Event</a>
    <a href="http://localhost/database_news/news-form.php" target="_blank">Add News</a>

</div>


    </div>

 <div style="height:430px;width:700px;position:relative;top:40px;left:320px;background-color:white;opacity: 0.6;border:1px solid blue;box-shadow:10px 10px 10px black">

         <h2 style="margin-left:190px;font-size:38px;margin-top:10px;margin-bottom:20px;padding-top:20px">Welcome <?php echo htmlspecialchars($user['username']); ?><strong> !!</strong></h2>
        <h3 style="font-size:20px;color:black;margin-left:70px;margin-top:40px">Hello <?php echo htmlspecialchars($user['username']); ?><strong> !</strong></h3>
        <p style="font-size:20px;color:black;margin-left:70px;margin-top:-10px;width:500px">
            Welcome to the Student-Alumni Association!  
            Here, you can connect with alumni and fellow students, share your experiences, and explore opportunities that help you grow professionally and personally.  
            We're excited to have you here. Let’s build a stronger community together!
        </p>
    <!--
         <p style="font-size:24px;margin-left:40px;margin-top:30px;color:black"><strong style="font-size:24px;margin-left:40px;margin-top:30px">Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
         <p style="font-size:24px;margin-left:40px;margin-top:30px;"><strong style="font-size:24px;margin-left:40px;margin-top:30px">Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
   
-->     
    
    </div>

    <script>
    const toggleImage = document.querySelector("img[alt='lines']");
    const linkContainer = document.getElementById("link-container");

    toggleImage.addEventListener("click", () => {
        if (linkContainer.style.display === "none" || linkContainer.style.display === "") {
            linkContainer.style.display = "block";
        } else {
            linkContainer.style.display = "none";
        }
    });
</script>

</body>
</html>




