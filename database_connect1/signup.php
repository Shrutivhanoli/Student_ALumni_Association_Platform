<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "user_system";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            // Automatically log the user in by storing their ID and username in the session
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $username;

            // Redirect to My Account page
            header("Location: myaccount.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Passwords do not match!";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            position:relative;
            top:100px;
            left:450px;
        }

        .signup-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
            background-color: #f9f9f9;
            outline: none;
        }

        .form-group input:focus {
            border-color: #007bff;
        }

        .form-group input[type="file"] {
            padding: 5px;
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .form-group .terms {
            font-size: 12px;
            color: #777;
            text-align: center;
            margin-top: 15px;
        }
    </style>
    <title>Signup</title>
</head>
<body >
<div style="height:100%;width:100%;background-image: url('signup.jpg');background-repeat:no-repeat;background-size: cover;background-position: center;">
<div class="signup-container">
        <h2>Sign-up</h2>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
            <label style="color:black">Username:</label>
            <input type="text" name="username" required><br>
            </div>

            <div class="form-group">
            <label style="color:black">Email:</label>
            <input type="email" name="email" required><br>
            </div>

            <div class="form-group">
            <label style="color:black">Password:</label>
            <input type="password" name="password" required><br>
            </div>

            <div class="form-group">
            <label style="color:black">Confirm Password:</label>
            <input type="password" name="confirm_password" required><br>
            </div>
            <!--<div class="form-group">
                <label for="document">Upload Document for Authentication</label>
                <input type="file" id="document" name="document" required>
            </div>
        -->
            <div class="form-group">
               <!-- <button type="submit" onclick="myfunction"><a href="index1.html" style="text-decoration: none; color: white;">Sign Up</a></button>-->
               <button type="submit" name="register" style="margin-top:20px">Register</button>
            </div>
            
        </form>
    </div>
    </div>

    

</body>
</html>
