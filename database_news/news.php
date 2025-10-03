<?php

// $localhost = "localhost";
// $username = "root";
// $password = "";
// $database = "events";

// $con = new  mysqli($localhost,$username,$password,$database);

// if ($con->connect_errno) {
//     die("Failed to connect.".$con->connect_error);
// }

// $sql = "SELECT * FROM news_form";
// $result = $con->query($sql); 
// if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['remove'])) {
//    $newsID = intval($_POST['news-id']);
//     $deleteSql = "DELETE FROM news_form WHERE sr_no = ?";

//     if ($stmt = $con->prepare($deleteSql)) {
//         $stmt->bind_param("i",$newsID);
//         if ($stmt->execute()) {
//             $adjustSql = "SET @count = 0; UPDATE news_form SET sr_no = @count :=(@count+1) ORDER BY sr_no;";
//         $con->query($adjustSql);
//             if ($stmt->affected_rows > 0) {
//                 echo "Event removed successfully.";
//             }else{
//                 echo "No event found with that ID.";
//             }
//         }else{
//             echo "Error executing delete query: " .$stmt->error;
//         }

//             $stmt->close();
        
//     }else{
//             echo "Error preparing the statement:  " .$con->error;
//         }

//         $con->close();
    
   
// }



?>
<!-- 
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>news</title>
    <link rel="stylesheet" href="news.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div id="ntitle">
        <h1>BlinkNews</h1>
    </div>

    <a href="news-form.php"><button class="addNews">Add news</button></a>

    <form action="/search" method="GET" id="search-form">
        Search input with Font Awesome icon
        <label for="search"><i class="fas fa-search icon-margin"></i></label>
        <input type="search" id="search" name="query" placeholder="Search...">
        <button type="submit" id="search-btn">search</button>
    </form>

   
    <div id="news-container">
        <?php
            // if($result->num_rows>0)
            // {
            //     while ($row = $result->fetch_assoc()) {
                    
            //         echo "<div class='news-box' >";
            //             echo "<h2 class='title'>". htmlspecialchars($row['title']) ."</h2>";
            //             echo "<p class='date'>". date("F j, Y", strtotime($row['dates']))  ."</p>";
            //             echo "<p class='short-info'>". htmlspecialchars($row['summary']) ."</p>";
            //             echo "<div class = 'btn-container'>";
            //             echo "<a href='news-details.php?news_id=" . htmlspecialchars($row['sr_no']) . "' class='read-btn'>View</a>";
            //             echo "<button class='remove-btn' data-id='" . $row['sr_no'] . "'>Remove</button>";
            //             echo "</div>";
                        



            //         echo "</div>";

            //     }




            // } else {
            //     echo "<p>No news found.</p>";
            
            // }

        ?>
    </div>

    <script>


            document.addEventListener('DOMContentLoaded' , function () {
                const removeButtons = document.querySelectorAll('.remove-btn');

                removeButtons.forEach(button =>{
                    button.addEventListener('click', function(){
                        const newsID = this.getAttribute('data-id');
                        if (confirm('Are you sure you waant to remove this news:')) {
                            const formData = new FormData();
                            formData.append('remove',true);
                            formData.append('news-id',newsID);

                            fetch('news.php',{
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.text())
                            .then(data => {
                                console.log(data);
                                if (data.includes("removed successfully")) {
                                    const newsBox = button.closest('news-box');
                                    newsBox.remove();

                                    
                                }
                                else{
                                    alert(data);
                                }
                            })
                            .catch(error => console.error('Error:',error));
                        }
                    });
                });
            });
        // Read More functionality
// document.querySelectorAll('.read-btn').forEach(button => {
//     button.addEventListener('click', (event) => {
//         const sr_no = event.target.closest('.news-box').dataset.sr_no;
//         fetch(`news-details.php?sr_no=${sr_no}`)
//             .then(response => response.text())
//             .then(data => {
//                 // Display the full news content as needed, like in a modal
//                 console.log(data);  // Replace with actual display code
//             })
//             .catch(error => console.error('Error:', error));
//     });
// });

// // Remove functionality
// document.querySelectorAll('.remove-btn').forEach(button => {
//     button.addEventListener('click', (event) => {
//         const sr_no = event.target.closest('.news-box').dataset.sr_no;
//         if (confirm('Are you sure you want to delete this news item?')) {
//             fetch(`delete-news.php?sr_no=${sr_no}`, { method: 'DELETE' })
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.success) {
//                         event.target.closest('.news-box').remove();
//                     } else {
//                         alert('Failed to delete the news item.');
//                     }
//                 })
//                 .catch(error => console.error('Error:', error));
//         }
//     });
// });



    </script>
    
</body>

</html> -->

<?php 
$localhost = "localhost";
$username = "root";
$password = "";
$database = "events";

$con = new mysqli($localhost, $username, $password, $database);

if ($con->connect_errno) {
    die("Failed to connect: " . $con->connect_error);
}

$sql = "SELECT * FROM news_form";
$result = $con->query($sql); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    $newsID = intval($_POST['news_id']);
    $deleteSql = "DELETE FROM news_form WHERE sr_no = ?";

    if ($stmt = $con->prepare($deleteSql)) {
        $stmt->bind_param("i", $newsID);
        if ($stmt->execute()) {
            $adjustSql = "SET @count = 0; UPDATE news_form SET sr_no = @count := (@count + 1) ORDER BY sr_no;";
            $con->query($adjustSql);
            if ($stmt->affected_rows > 0) {
                echo "Event removed successfully.";
            } else {
                echo "No event found with that ID.";
            }
        } else {
            echo "Error executing delete query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $con->error;
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>news</title>
    <link rel="stylesheet" href="news.css">
    <link rel="stylesheet" href="style_event.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    .title{
        color:black;
        position:relative;
        left: 20px;
        font-size:16px;
        width: 900px;
        height: 40px;
        color:blue;
        
    }
    .date{
        color:black;
        position: relative;
        top: 30px;
        width:400px;
        height: 30px;
        text-align: left;
        left:-100px;
        margin-top:30px;
    }
    .short-info{
        color:black;
        font-size: 20px;
        margin-top:20px;
    }
    .read-btn{
        position:relative;
        top:240px;
        right: 460px;
    }
    #t{
        max-width:200px;
    }
</style>
<body>
<div id="contents" >
        <div>
          <img src="https://media.istockphoto.com/id/1219872152/vector/abstract-creative-background.jpg?s=612x612&w=0&k=20&c=hqNERUEmT9KgPCis9ZvaxemOSfFWR-oKPe3PA-nFjkY=" alt="image" style="width:100%;height:190px">
               
                  <div id="logbar">
                      <!--<a href="login.html" style="color: rgb(255, 255, 255);position: absolute;right: 47px;top: 3px;font-size: 23px;text-decoration: none;">Log in</a>
                      <h2 style="position: absolute;right: 117px;top: -17px;color: white;font-size: 23px;">::</h2>
                      <a href="signup.html" style="color: white;position: absolute;right: 140px;top: 3px;font-size: 23px;text-decoration: none;">Register</a>-->
                      <a href="http://localhost/database_finalchat/myaccount.php" target="_blank" style="font-size: 23px;text-decoration: none;color: white;position:absolute;top: 3px;right: 40px;">| My Account |</a>
                      <a href="http://localhost/database_connect1/index1.html" style="font-size:23px;text-decoration:none;color:white;position:absolute;top:3px;left:30px">| Home |</a>
                  </div>
        
        
                  <div id="meanubar">
                    <img src="https://lh4.googleusercontent.com/proxy/O34Qwq3ihb0Zm6_jXd3P8IQ8s4HWOkqFCW-k9-uL_HnME3v9vXeobByOv46bHHlkPj9AlA" alt="image" style="height: 80px;position: absolute;left: 50px;top: 60px;">
                   <!-- <h1 style="width: 450px;position: absolute;top: 47px;left: 150px;color: white;padding-right: 0px;border-right: 1px solid;font-size: 30px;">Kolhapur Institute Of Technology, <br>Kolhapur</h1>  
-->
                    <h1 style="position: absolute;top: 47px;left: 170px;color: white;font-size:30px ;border-right:solid 2px white;padding-right:15px">Alumni-Student <br>Association</h1>
                    <h1 style="position: absolute;top: 47px;left: 430px;color: white;font-size:40px ;" >News</h1>
                    <div class="dropdown">
                        <a href="http://localhost/database_finalchat/dashboard.php" style="text-decoration: none;" id="connect" ><h2 class="dropbtn" style="margin-left: 30px;margin-right: 10px;position: relative;bottom: 100px;color: white;font-size: 24px;">Connect</h2></a>
                        <!--<div class="dropdown-content">
                          <a href="#" target="_blank">Link 1</a>
                          <a href="#" target="_blank">Link 2</a>
                          <a href="#" target="_blank">Link 3</a>
                        </div>-->
                      </div>
        
                      <div class="dropdown">
                        <h2 class="dropbtn" id="ie" style="margin-left: 10px;margin-right: 10px;position: relative;bottom: 100px;">Industry Exposure</h2>
                        <div class="dropdown-content">
                          <a href="http://localhost/database_industry/display_jobs.php" >jobs</a>
                          <a href="http://localhost/database_industry/display_internship.php">Internships</a>
                          <a href="http://localhost/database_project/display_projects.php">Project Showcase</a>
                         
                        </div>
                      </div>
        
                      <div class="dropdown">
                        <h2 class="dropbtn" id="post" style="margin-left: 10px;margin-right: 10px;position: relative;bottom: 100px;">posts</h2>
                        <div class="dropdown-content">
                          <a href="http://localhost/database_success_stories/display_stories.php" >Success Stories</a>
                          <a href="http://localhost/database_gallery/display_images.php">Gallery</a>
                          <a href="http://localhost/database_achievements/display_achievements.php"  >Achievements</a>
                          <a href="http://localhost/database_student_vlog/display_vlogs.php" >Student Vlogs</a>
                          <a href="notable.html" >Notable Alumni</a>
        
                        </div>
                      </div>
        
                      <div class="dropdown">
                        <a href="http://localhost/database_event/events.php" style="text-decoration: none;"id="event"><h2 class="dropbtn" style="margin-left: 10px;margin-right: 10px;position: relative;bottom: 100px;">Events</h2></a>
                        <!--<div class="dropdown-content">
                          <a href="events.html" target="_blank">Link 1</a>
                          <a href="#" target="_blank">Link 2</a>
                          <a href="#" target="_blank">Link 3</a>
                        </div>-->
                      </div>
        
                      <div class="dropdown">
                        <a  href="http://localhost/database_news/news.php" style="text-decoration: none; "><h2 class="dropbtn" style="margin-left: 10px;margin-right: 10px;position: relative;bottom: 100px;" id="news">News</h2></a>
                        <!--<div class="dropdown-content">
                          <a href="#" target="_blank">Link 1</a>
                          <a href="#" target="_blank">Link 2</a>
                          <a href="#" target="_blank">Link 3</a>
                        </div>
                      -->
                      </div>
        
                      <div class="dropdown">
                        <h2 class="dropbtn" style="margin-left: 10px;margin-right: 10px;position: relative;bottom: 100px;" id="au">About Us</h2>
                        <div class="dropdown-content">
                        <a href="http://localhost/database_connect1/trustee.html" >Board Of Trustee</a>
                          <a href="http://localhost/database_connect1/mission.html" >Mission/vision</a>
                          <a href="http://localhost/database_connect1/contact.html" >Contact Us</a>
                        </div>
                      </div>
                      <!--
                      <div id="donatebox" style="position: absolute;right: 70px;top:100px;background-color: red;border-radius: 10px;box-shadow: 3px 5px 3px rgb(0, 0, 0);">
                        <a href="fundraising.html" target="_blank" style="font-size: 24px;text-decoration: none;color: white;position: relative;top: 3px;left: 9px;">Donate</a>
                      </div>
                    -->
                      <!--
                      <div id="account" style="position: absolute;right: 170px;top:100px;background-color: red;border-radius: 10px;box-shadow: 3px 5px 3px rgb(0, 0, 0);height: 35px;width: 130px;">
                        <a href="http://localhost/database_connect1/myaccount.php" style="font-size: 24px;text-decoration: none;color: white;position: relative;top: 3px;left: 9px;">Myaccount</a>
                      </div>
                    -->
                      <div id="demo"></div>
                </div>
        </div>
    
    <!--
    <div id="ntitle">
        <h1>BlinkNews</h1>
    </div>
-->

   <!-- <a href="news-form.php"><button class="addNews">Add news</button></a>-->

    <form action="/search" method="GET" id="search-form" style="margin-top:30px">
        <label for="search"><i class="fas fa-search icon-margin"></i></label>
        <input type="search" id="search" name="query" placeholder="Search...">
        <button type="submit" id="search-btn">search</button>
    </form>

    <div id="news-container">
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='news-box' style='height:300px;' data-id='". $row['sr_no'] ."'>";
                        echo "<div style='width:600px;height:40px;'>"."<h2 class='title' id='t' >" . htmlspecialchars($row['title']) . "</h2>"."</div>";
                        echo "<p class='date'>" . date("F j, Y", strtotime($row['dates'])) . "</p>";
                        echo "<div style='width:300px;height:160px;position:relative;right:270px;top:100px'>"."<p class='short-info' style='width:300px;height:auto;'>" . htmlspecialchars($row['summary']) . "</p>"."</div>";
                        echo "<div class='btn-container'>";
                        echo "<a href='news-details.php?news_id=" . htmlspecialchars($row['sr_no']) . "' class='read-btn'>View</a>";
                        //echo "<button class='remove-btn' data-id='" . $row['sr_no'] . "'>Remove</button>";
                        echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No news found.</p>";
            }
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const removeButtons = document.querySelectorAll('.remove-btn');

            removeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const newsID = this.getAttribute('data-id');
                    if (confirm('Are you sure you want to remove this news?')) {
                        const formData = new FormData();
                        formData.append('remove', true);
                        formData.append('news_id', newsID);

                        fetch('news.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.text())
                        .then(data => {
                            console.log(data);
                            if (data.includes("Event removed successfully")) {
                                const newsBox = button.closest('.news-box');
                                newsBox.remove();
                            } else {
                                alert(data);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>
</body>
</html>
