<?php
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

$admin = $_SESSION['admin'];
?>

<div id="contents" >
<div>
  <img src="https://media.istockphoto.com/id/1219872152/vector/abstract-creative-background.jpg?s=612x612&w=0&k=20&c=hqNERUEmT9KgPCis9ZvaxemOSfFWR-oKPe3PA-nFjkY=" alt="image" style="width:100%;height:190px">
       
            <div style="height:30px;width:100%;background-color:orangered;position:relative;bottom:180px ">

            </div> 

          <div id="meanubar">
            <img src="https://lh4.googleusercontent.com/proxy/O34Qwq3ihb0Zm6_jXd3P8IQ8s4HWOkqFCW-k9-uL_HnME3v9vXeobByOv46bHHlkPj9AlA" alt="image" style="height: 80px;position: absolute;left: 50px;top: 60px;">
            <h1 style="width: 450px;position: absolute;top: 47px;left: 150px;color: white;padding-right: 0px;border-right: 1px solid;font-size: 30px;">Kolhapur Institute Of Technology, <br>Kolhapur</h1>  
            
            <h1 style="position: absolute;top: 47px;left: 620px;color: white;font-size:30px ;">Alumni-Student <br>Association</h1>

</div>
</div>
</div>

<h2 style="position:relative;bottom:30px;left:10px;font-size:25px">Welcome, <?= htmlspecialchars($admin['name']) ?></h2>
<a href="admin_logout.php" style="position:absolute;top:20px;right:27px;text-decoration:none;color:white;font-size:20px">| Logout |</a>

<div style="height:1000px;width:1000px;position:relative;left:180px;">
<style>
div.gallery {
  border: 1px solid #ccc;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height:200px;
  margin-top:20px
}

div.desc {
  padding: 15px;
  text-align: center;
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  float: left;
  width: 24.99999%;
  margin-top:20px;
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 49.99999%;
    margin: 6px 0;
    margin-top:20px
  }
}

@media only screen and (max-width: 500px) {
  .responsive {
    width: 100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}
</style>

<div class="responsive">
  <div class="gallery">
    <a  href="http://localhost/database_finalchat/users.php">
      <img src="users.jpeg" alt="Cinque Terre" width="600" height="400">
    </a>
    <div class="desc">Users</div>
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <a href="events.php">
      <img src="event.jpeg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Events</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a  href="news.php">
      <img src="news.jpeg" alt="Northern Lights" width="600" height="100">
    </a>
    <div class="desc">News</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a href="display_gallery.php">
      <img src="gallery.jpeg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Gallery</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a  href="http://localhost/database_industry/uploadjob.html" target="_blank">
      <img src="job.jpeg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Jobs</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a  href="http://localhost/database_industry/uploadinternship.html"  target="_blank">
      <img src="internship.jpeg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Internships</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a  href="http://localhost/database_student_vlog/upload_vlog.html"  target="_blank">
      <img src="vlog.jpeg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Students Articles</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a  href="img_forest.jpg">
      <img src="img_forest.jpg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

</div>