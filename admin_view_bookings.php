<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temple_darshan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all bookings with temple names
$sql = "SELECT bookings.id, temples.name AS temple_name, bookings.name, bookings.email, bookings.date, bookings.time_slot 
        FROM bookings 
        JOIN temples ON bookings.temple_id = temples.id
        ORDER BY bookings.date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - View Bookings</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #7b2cbf;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<header>
    <h1>Temple Darshan - Admin View</h1>
    <nav>
        <a href="index.html">Home</a>
        <a href="select_location.php">Book Darshan</a>
        <a href="admin_view_bookings.php">View Bookings</a>
    </nav>
</header>

<section>
    <h2>All Darshan Bookings</h2>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Temple</th><th>Visitor Name</th><th>Email</th><th>Date</th><th>Time Slot</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['temple_name']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['date']."</td>
                    <td>".$row['time_slot']."</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No bookings found.</p>";
    }
    ?>
</section>

<footer>
    <p>© 2025 Temple Darshan</p>
</footer>
</body>
</html>

<?php
$conn->close();
?>
