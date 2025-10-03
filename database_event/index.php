<?php
    if(isset($_POST['event-title']))
    {
        //set connection variables
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "events";

        // create a database connection
        $con = mysqli_connect($server,$username,$password,$database);

        // check for connectionn 
        if(!$con)
        {
            die("Connection to this database failed");
        }

        //collect post variables
        $event_title = $_POST['event-title'];
        $short_description = $_POST['short-description'];
        $detailed_description = $_POST['detailed-description'];
        $event_date = $_POST['event-date'];
        $registration_status=$_POST['registration-status'];

        $sql = " INSERT INTO `event_form` ( `tittle`, `shortDescription`, `detailedDescription`,`registration_status`, `date`,`dt`) VALUES ('$event_title ', '$short_description',
    '$detailed_description',''$registration_status, '$event_date', current_timestamp());";

        if($con->query($sql)===true)
        {}
        else{
            echo "ERROR: $sql <br> $con->error";
        }
        $con->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Organize Event</title>
    <link rel="stylesheet" href="event-form.css">
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
        <form method="post" id="event-form" onsubmit="return addEvent();">
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

            <!-- Date to Organize -->
            <label for="event-date">Date of Event</label>
            <input type="date" id="event-date" name="event-date" required>

            <!-- Submit Button -->
            <button type="submit">Submit Event</button>
        </form>
    </div>
    
    <script>
        function addEvent() {
            const title = document.getElementById("event-title").value;
            const shortInfo = document.getElementById("short-description").value;
            const detailedInfo = document.getElementById("detailed-description").value;
            const date = document.getElementById("event-date").value;

            // Retrieve existing events from localStorage or initialize as an empty array
            const existingEvents = JSON.parse(localStorage.getItem("eventData")) || [];

            // Create a new event object
            const newEvent = {
                title,
                shortInfo,
                detailedInfo,
                date
            };

            // Add the new event to the existing events array
            existingEvents.push(newEvent);

            // Save the updated events array back to localStorage
            localStorage.setItem("eventData", JSON.stringify(existingEvents));

            // Redirect to events.html to display the events
            window.location.href = "events.html";

            return false; // Prevent the default form submission
        }
    </script>

</body>

</html>