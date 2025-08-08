<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temple_darshan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$temple_id = $_GET['temple_id'];

$sql = "SELECT name FROM temples WHERE id = $temple_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$temple_name = $row['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Darshan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Book Darshan at <?php echo htmlspecialchars($temple_name); ?></h1>
</header>

<section>
    <form action="confirm_booking.php" method="POST">
        <input type="hidden" name="temple_id" value="<?php echo $temple_id; ?>">

        <label>Your Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Your Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Select Date:</label><br>
        <input type="date" name="date" required><br><br>

        <label>Choose Time Slot:</label><br>
        <select name="time_slot" required>
            <option value="">--Select Slot--</option>
            <option value="06:00 AM - 07:00 AM">06:00 AM - 07:00 AM</option>
            <option value="07:00 AM - 08:00 AM">07:00 AM - 08:00 AM</option>
            <option value="08:00 AM - 09:00 AM">08:00 AM - 09:00 AM</option>
            <option value="09:00 AM - 10:00 AM">09:00 AM - 10:00 AM</option>
        </select><br><br>

        <button type="submit">Confirm Booking</button>
    </form>
</section>

<footer>
    <p>© 2025 Temple Darshan</p>
</footer>
</body>
</html>

<?php
$conn->close();
?>
