<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temple_darshan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch unique locations
$sql = "SELECT DISTINCT location FROM temples";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Location</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Temple Darshan - Select Location</h1>
</header>

<section>
    <form action="select_temple.php" method="GET">
        <label>Select Location:</label><br>
        <select name="location" required>
            <option value="">--Select--</option>
            <?php
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['location'] . "'>" . $row['location'] . "</option>";
            }
            ?>
        </select><br><br>
        <button type="submit">Show Temples</button>
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
