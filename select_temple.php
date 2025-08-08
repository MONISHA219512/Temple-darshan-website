<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temple_darshan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$location = $_GET['location'];
$sql = "SELECT * FROM temples WHERE location = '$location'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Temple</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Temples in <?php echo htmlspecialchars($location); ?></h1>
</header>

<section>
    <form action="book_darshan.php" method="GET">
        <input type="hidden" name="location" value="<?php echo $location; ?>">
        <label>Select Temple:</label><br>
        <select name="temple_id" required>
            <option value="">--Select Temple--</option>
            <?php
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select><br><br>
        <button type="submit">Book Darshan</button>
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
