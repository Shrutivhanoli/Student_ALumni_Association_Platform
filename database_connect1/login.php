<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "user_system";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: myaccount.php");
            exit;
        } else {
            echo "<h3 style='position:relative;top:220px;left:300px'>"."Incorrect password."."<h3>";
        }
    } else {
        echo "User not found.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
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

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            position:relative;
            top:100px;
            left:450px;
        }

        .login-container h2 {
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

        .form-group .forgot-password {
            font-size: 12px;
            color: #777;
            text-align: right;
            margin-top: 5px;
        }

        .form-group .forgot-password a {
            color: #007bff;
            text-decoration: none;
        }

        .form-group .forgot-password a:hover {
            text-decoration: underline;
        }

        .form-group .signup-link {
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        .form-group .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        .form-group .signup-link a:hover {
            text-decoration: underline;
        }
        #admin:hover{
            background-color: black;
            color: red;
        }
    </style>
<body>

<div style="height:100%;width:100%;background-image: url('signup.jpg');background-repeat:no-repeat;background-size: cover;background-position: center;">
<div class="login-container">
    <h2>Login</h2>
    <form method="post" action="">

    <div class="form-group">
        <label>Username:</label>
        <input type="text" name="username" required><br>
    </div>
        
    <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required><br>
    </div>
     
    <div class="form-group">   
         <button type="submit" name="login"><a href="http://localhost/database_connect1/index1.html" style="text-decoration:none;font-size:19px;color:white">Login</a></button>
    </div>
    </form>
    </div>
    </div>
   <!-- <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group forgot-password">
                <a href="#">Forgot password?</a>
            </div>
            <div class="form-group">
                <button type="submit" name="login">Login</button>
            </div>
            <div class="form-group signup-link">
                <p>Don't have an account? <a href="index.html">Sign up</a></p>
            </div>
        </form>
    </div>-->

  <a id="admin" href="" style="text-decoration:none;color:black;position:absolute;right:20px;top:20px;width:120px;padding:10px;background-color:white;border-radius:18px">As a Admin</a>
    
</body>
</html>
