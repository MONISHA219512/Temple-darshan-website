<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temple_darshan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hashing password using MD5 for simplicity, use bcrypt in production

    // Check if the username already exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "Username already taken. Please choose another one.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            $message = "Registration successful! You can now <a href='login.php'>login</a>.";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Temple Darshan</title>
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
    <h2>Register</h2>
    
    <!-- Display message after registration attempt -->
    <?php if (isset($message)): ?>
        <div class="error"><?php echo $message; ?></div>
    <?php endif; ?>

    <!-- Registration form -->
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Enter your username" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

</body>
</html>
