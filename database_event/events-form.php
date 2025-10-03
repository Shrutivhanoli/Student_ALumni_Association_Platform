<?php
if (isset($_POST['event-title'])) {
   
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "events";

    
    $con = mysqli_connect($server, $username, $password, $database);

   
    if (!$con) {
        die("Connection to this database failed: " . mysqli_connect_error());
    }

   
    $event_title = mysqli_real_escape_string($con, $_POST['event-title']);
    $short_description = mysqli_real_escape_string($con, $_POST['short-description']);
    $detailed_description = mysqli_real_escape_string($con, $_POST['detailed-description']);
    $event_date = mysqli_real_escape_string($con, $_POST['event-date']);
    $registration_status = mysqli_real_escape_string($con, $_POST['registration_status']);

    
    $sql = "INSERT INTO `events_form` (`title`, `shortDec`, `detailedDec`, `registration_status`, `dates`, `dt`)
            VALUES ('$event_title', '$short_description', '$detailed_description', '$registration_status', '$event_date', current_timestamp());";

   
    if ($con->query($sql) === true) {
       
    } else {
        echo "ERROR: $sql <br> $con->error";
    }

    
    $con->close();

    
    header("Location: events.php");
    exit(); 
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Organize Event</title>
    <!-- <link rel="stylesheet" href="events.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F7F9FB;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            margin-top: 60px;
            padding-bottom: 30px;
        }

        h2 {
            color: #0D3B66;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333333;
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #dcdcdc;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        textarea {

            resize: vertical;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #FF6B6B;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #FF4C4C;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Organize New Event</h2>
        <form action="events-form.php"  method="post" id="event-form" >
            <!-- Event Title -->
            <label for="event-title">Event Title</label>
            <input type="text" id="event-title" name="event-title" placeholder="Enter event title" required>

            <!-- Short Description -->
            <label for="short-description">Short Description</label>
            <input type="text" id="short-description" name="short-description" placeholder="Enter a brief description"
                required>

            <!-- Detailed Description -->
            <label for="detailed-description">Detailed Description</label>
            <textarea id="detailed-description" name="detailed-description" rows="5"
                placeholder="Provide detailed information about the event" required></textarea>

            <label for="registration_status	">Register-link</label>
            <input type="text" id="event-title" name="registration_status" placeholder="Enter Register link" required>


            <!-- Date to Organize -->
            <label for="event-date">Date of Event</label>
            <input type="date" id="event-date" name="event-date" required>

            <!-- Submit Button -->
            <a href="events.php"><button type="submit" >Submit Event</button></a>
        </form>
    </div>

  
    

</body>

</html>