
<!-- edit_employee.php -->
<?php
php -S localhost:port
// Koble til databasen
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'bedriftsdatabase';


$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Kunne ikke koble til databasen: " . mysqli_connect_error());
}

// Hent ansatte fra databasen
$sql = "SELECT * FROM ansatte";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediger ansatte</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Rediger ansatte</h1>

<!-- Button to open the modal -->
<button id="editButton">Rediger ansatte</button>

<!-- The Modal -->
<div id="editModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Rediger ansatte</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <li><?php echo $row['navn']; ?></li>
            <!-- Add more fields for editing here -->
        <?php endwhile; ?>
    </ul>
  </div>
</div>

<script src="scripts.js"></script>
</body>
</html>

