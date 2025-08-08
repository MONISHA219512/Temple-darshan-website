<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temple_darshan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$temple_id = $_POST['temple_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$date = $_POST['date'];
$time_slot = $_POST['time_slot'];

$sql = "INSERT INTO bookings (temple_id, name, email, date, time_slot) 
        VALUES ('$temple_id', '$name', '$email', '$date', '$time_slot')";

if ($conn->query($sql) === TRUE) {
    $message = "Booking Confirmed!<br>Thank you, $name. Your darshan is booked for $date at $time_slot.";
} else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Temple Darshan</title>
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
        nav {
            margin-top: 20px;
        }
        nav a {
            margin: 15px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }
        nav a:hover {
            background-color: #45a049;
        }
        footer {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .confirmation-message {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .confirmation-message h2 {
            color: #4CAF50;
        }
        .confirmation-message p {
            font-size: 16px;
            margin: 15px 0;
        }
        .confirmation-message a {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
        }
        .confirmation-message a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<header>
    <h1>Temple Darshan System</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="view_temples.php">View Temples</a>
    <a href="add_temple.php">Add Temple</a>
</nav>

<div class="confirmation-message">
    <h2>Booking Status</h2>
    <p><?php echo $message; ?></p>
    <a href="index.php">Back to Home</a>
</div>

<footer>
    <p>&copy; 2025 Temple Darshan System</p>
</footer>

</body>
</html>
