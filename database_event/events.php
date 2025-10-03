<?php
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $database = "events";

    $con = new mysqli($localhost,$username,$password,$database);

    if($con->connect_errno){
        // if ($con->connect_error) {
            die("Connection failed".$con->connect_error);
        // }
    }
    $sql = "SELECT * FROM events_form";
    $result = $con->query($sql); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
        $eventId = intval($_POST['event_id']); // Ensure it's an integer
        $deleteSql = "DELETE FROM events_form WHERE sr_no = ?";
        
        if ($stmt = $con->prepare($deleteSql)) {
            $stmt->bind_param("i", $eventId); // Bind the parameter
            if ($stmt->execute()) {
                // Check if any rows were affected
                $adjustSql = "SET @count = 0; UPDATE events_form SET sr_no = @count := (@count + 1) ORDER BY sr_no;";
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

        $con->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Events</title>
    <link rel="stylesheet" href="events.css">
    <link rel="stylesheet" href="style_event.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

</head>
<style>
    .register-link{
        height: 40px;
        width: 120px;
        background-color: red;
        border-radius: 30px;
        position: relative;
        top: -5px;
        left: 800px;
        padding: 0px;
        margin: 0px;
    }
    .link{
        text-decoration: none;
        color: white;
        font-size:18px;
        position: relative;
        top: 8px;
    }
    .event-date{
        position: relative;
        top: -40px;
        left: 780px;
        color: black;
        width: 200px;
    }
    .event-title{
        color: black;
        position: relative;
        right: -60px;
        top: 1px;
        width: 200px;
        text-align: left;
    }
    .event-description{
        color: black;
        position: relative;
        left: 80px;
        top:-20px;
        text-align: left;
        height: 65px;
        width: 870px;
        padding: 0px;
        margin: 0px;

    }
    .read{
        position: relative;
        right: 400px;
        bottom: 60px;
    }
    a{
        text-decoration: none;
    }
    .event-detail {
    display: none;
    width: 700px;
    height: 100px;
    color: black;
    margin-top: 10px;
    position: relative;
    right: -70px;
    bottom: 110px;
    background: linear-gradient(to left, #D8EBF1, #A8E6CF);
    text-align: left;
}
.view-btn {
    cursor: pointer;
    color: blue;
    text-decoration:none;
    background-color: #A8E6CF;
    border: none;
    position: relative;
    right: 400px;
    bottom: 100px;

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
                    <h1 style="position: absolute;top: 47px;left: 430px;color: white;font-size:40px ;" >Events</h1>
                    <div class="dropdown">
                        <a href="http://localhost/database_finalchat/dashboard.php" style="text-decoration: none;" id="connect" ><h2 class="dropbtn" style="margin-left: 30px;margin-right: 10px;position: relative;bottom: 100px;right:210px;color: white;font-size: 24px;">Connect</h2></a>
                        <!--<div class="dropdown-content">
                          <a href="#" target="_blank">Link 1</a>
                          <a href="#" target="_blank">Link 2</a>
                          <a href="#" target="_blank">Link 3</a>
                        </div>-->
                      </div>
        
                      <div class="dropdown">
                        <h2 class="dropbtn" id="ie" style="margin-left: 10px;margin-right: 10px;position: relative;bottom: 100px;right:210px;">Industry Exposure</h2>
                        <div class="dropdown-content" style="position:absolute;top:-50px;right:260px">
                          <a href="http://localhost/database_industry/display_jobs.php" >jobs</a>
                          <a href="http://localhost/database_industry/display_internship.php" >Internships</a>
                          <a href="http://localhost/database_project/display_projects.php" >Project Showcase</a>
                         
                        </div>
                      </div>
        
                      <div class="dropdown">
                        <h2 class="dropbtn" id="post" style="margin-left: 10px;margin-right: 10px;position: relative;bottom: 100px;right:210px;">posts</h2>
                        <div class="dropdown-content" style="position:absolute;top:-50px;right:180px">
                          <a href="http://localhost/database_success_stories/display_stories.php" >Success Stories</a>
                          <a href="http://localhost/database_gallery/display_images.php" >Gallery</a>
                          <a href="http://localhost/database_achievements/display_achievements.php"  >Achievements</a>
                          <a href="http://localhost/database_student_vlog/display_vlogs.php" >Student Vlogs</a>
                          <a href="notable.html" >Notable Alumni</a>
        
                        </div>
                      </div>
        
                      <div class="dropdown">
                        <a href="http://localhost/database_event/events.php"  style="text-decoration: none;"id="event"><h2 class="dropbtn" style="margin-left: 10px;margin-right: 10px;position: relative;bottom: 100px;right:210px;">Events</h2></a>
                        <!--<div class="dropdown-content">
                          <a href="events.html" target="_blank">Link 1</a>
                          <a href="#" target="_blank">Link 2</a>
                          <a href="#" target="_blank">Link 3</a>
                        </div>-->
                      </div>
        
                      <div class="dropdown">
                        <a  href="http://localhost/database_news/news.php" style="text-decoration: none; "><h2 class="dropbtn" style="margin-left: 10px;margin-right: 10px;position: relative;bottom: 100px;right:210px;" id="news">News</h2></a>
                        <!--<div class="dropdown-content">
                          <a href="#" target="_blank">Link 1</a>
                          <a href="#" target="_blank">Link 2</a>
                          <a href="#" target="_blank">Link 3</a>
                        </div>
                      -->
                      </div>
        
                      <div class="dropdown">
                        <h2 class="dropbtn" style="margin-left: 10px;margin-right: 10px;position: relative;bottom: 100px;right:210px;" id="au">About Us</h2>
                        <div class="dropdown-content" style="position:absolute;top:-50px;right:200px">
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
    <header style="height:100px">
        <img src="kitlogo.png" alt="image"  style="height: 85px;position: absolute;left: 30px;top: 30px;">
        <h1 style="height:100px;font-size: 42px;margin:0px;position:relative;right:460px;top:30px">Events</h1>
    </header>

-->
    <div style="height:200px;width:1200px;background-color:rgb(245, 190, 72);margin-left:85px;margin-bottom:20px">
    <p id="para" style="background-color:rgb(245, 190, 72);width:700px;position:relative;top:15px;right:110px;font-size:22px;color:black">
        "Life is about the moments that take your breath away, and these events are filled with those moments! Connect
        with like-minded people, learn from the best, and build a network that lasts a lifetime.<b> Every event is a
            new story waiting to be written—let’s write yours together!"</b>
    </p>
    </div>
    <!-- Calendar -->
   
    <div class="calendar-wrapper" >
         <div id="calendar" style="border:2px solid  #b6b2b2; box-shadow: 10px 10px 10px;"></div>
    </div>
    <!-- Search Bar -->
     
   <!-- <form id="search-form" style="position:relative;left:800px;bottom:830px;width:500px;border-radius: 30px;">-->
       <!-- <label for="search"><i class="fas fa-search"></i></label>-->
      <!--  <input type="search" id="search" placeholder="Search events...">
        <button type="submit" style=" background-color: #7c2deb;">Search</button>
    </form>
-->

    <!--<a href="events-form.php"><button class="addEvent" style="position:relative;left:420px;bottom:40px">Add Event</button></a>-->
    <!-- Events Container -->
    <div id="events-container" >
        
   <div style="height:auto;width:1200px;padding:0px;position:relative;left:50px">
  
    <?php

        
            if($result->num_rows>0)
            {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='event-box' style='height:160px;margin-bottom:20px;width:1000px'>";
                    
                        echo "<h2 class='event-title'>" . htmlspecialchars($row['title']) . "</h2>";
                        echo "<p class='event-date'>" . date("F j, Y", strtotime($row['dates'])) . "</p>";
                         echo "<p class='event-description'>" . htmlspecialchars($row['shortDec']) . "</p>";
                       //echo "<a href='view.php?event_id=" . htmlspecialchars($row['sr_no']) . "' class='view-btn'>View</a>";
                       // echo "<button class='remove-btn' data-id='" . $row['sr_no'] . "'>Remove</button>";
                     echo "<div class='register-link' ><a class='link' href='" . $row['registration_status'] . "' target='_blank'>Register</a></div>";
                     //echo "<p class='detail'> ". htmlspecialchars($row['detailedDec']) . "</p>";
                    //echo"<a href='http://localhost/database_event/view.php'>view</a>";
                    echo "<button class='view-btn' onclick='toggleDetail(" . $row['id'] . ")'>View All</button>";
                    echo "<p id='detail-" . $row['id'] . "' class='event-detail'>" . htmlspecialchars($row['detailedDec']) . "</p>";
                    
                    //echo '<a href="view-news.php?id=' . urlencode($row['id']) . '">View</a>';
                   
       
                    
                    echo "</div>";
                }
              



            } else {
                echo "<p>No events found.</p>";
            
            }

            
        ?>
        </div>
        
        
    </div>

    <!-- Add Calendar for Events -->
    
    
    <script>
        
    function toggleDetail(eventId) {
        const detailElement = document.getElementById('detail-' + eventId);
        if (detailElement.style.display === 'none' || !detailElement.style.display) {
            detailElement.style.display = 'block';
        } else {
            detailElement.style.display = 'none';
        }
    }


         document.addEventListener('DOMContentLoaded', function () {
        const removeButtons = document.querySelectorAll('.remove-btn');

        // Handle remove button clicks
        removeButtons.forEach(button => {
            button.addEventListener('click', function () {
                const eventId = this.getAttribute('data-id'); // Get the event ID
                if (confirm('Are you sure you want to remove this event?')) { // Confirmation dialog
                    const formData = new FormData();
                    formData.append('remove', true); // Indicate that this is a remove request
                    formData.append('event_id', eventId); // Pass the event ID

                    // Send a POST request to events.php
                    fetch('events.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data); // Log the response for debugging
                        if (data.includes("removed successfully")) {
                            // Remove the event box from the DOM
                            const eventBox = button.closest('.event-box');
                            eventBox.remove();

                            // Refresh the calendar to remove the deleted event
                            refreshCalendarEvents();
                        } else {
                            alert(data); // Show any error message returned
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });

        // Initialize FullCalendar
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 500, // Set height directly in FullCalendar
            contentHeight: 600,
            aspectRatio:2,
            
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''  // No add event button
            },
            eventDisplay: 'block',
            dayMaxEventRows: true,
            moreLinkClick: 'popover',
            events: function (fetchInfo, successCallback, failureCallback) {
                fetchEvents(successCallback, failureCallback);
            }
        });

        calendar.render();

        // Fetch and display events
        function fetchEvents(successCallback, failureCallback) {
            fetch('fetch_events.php')
                .then(response => response.json())
                .then(data => successCallback(data))
                .catch(error => failureCallback(error));
        }

        // Refresh events on the calendar
        function refreshCalendarEvents() {
            calendar.refetchEvents(); // Refresh events in the FullCalendar instance
        }
    });

    </script>
    <!-- <script src="events.js"></script> -->
</body>
</html>