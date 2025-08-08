<?php
session_start(); // Start session to track login status

// Check if the user is already logged in, if so, redirect to dashboard
if (isset($_SESSION['username'])) {
    header("Location: index.php"); // Replace with your logged-in page
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temple_darshan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hashing password using MD5 (use bcrypt in production)

    // Query to check the credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, start session and redirect to dashboard
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        // Invalid credentials
        $error_message = "Invalid username or password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Temple Darshan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            text-align: center;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
        }
        .container {
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-left: auto;
            margin-right: auto;
        }
        .container input[type="text"], .container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>Temple Darshan System</h1>
</header>

<div class="container">
    <h2>Login</h2>
    
    <!-- Display error message if login fails -->
    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <!-- Login form -->
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Enter your username" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <input type="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>
