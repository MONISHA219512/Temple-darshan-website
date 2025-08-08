<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temple_darshan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$bookings = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Query to get bookings based on the user's name and email
    $sql = "SELECT b.id, t.name AS temple_name, b.date, b.time_slot
            FROM bookings b
            JOIN temples t ON b.temple_id = t.id
            WHERE b.name = '$name' AND b.email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch all bookings
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
    } else {
        $message = "No bookings found for $name with email $email.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings - Temple Darshan</title>
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
        .container {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .container input[type="text"], .container input[type="email"] {
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
        .bookings-table {
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
        }
        .bookings-table th, .bookings-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .bookings-table th {
            background-color: #4CAF50;
            color: white;
        }
        .bookings-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .message {
            margin-top: 20px;
            color: red;
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

<div class="container">
    <h2>View Your Bookings</h2>

    <!-- Form to enter name and email -->
    <form method="POST" action="view_bookings.php">
        <input type="text" name="name" placeholder="Enter your name" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="submit" value="View Bookings">
    </form>

    <!-- Display message if no bookings found -->
    <div class="message">
        <?php echo $message; ?>
    </div>

    <!-- Display bookings if available -->
    <?php if (!empty($bookings)): ?>
        <table class="bookings-table">
            <tr>
                <th>Temple Name</th>
                <th>Date</th>
                <th>Time Slot</th>
            </tr>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?php echo $booking['temple_name']; ?></td>
                    <td><?php echo $booking['date']; ?></td>
                    <td><?php echo $booking['time_slot']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2025 Temple Darshan System</p>
</footer>

</body>
</html>
