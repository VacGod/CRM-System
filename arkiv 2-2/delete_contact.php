<?php
// Databasekobling
$servername = "localhost";
$username = "root";
$password = "";
$database = "crmv6";

// Opprette tilkobling
$conn = new mysqli($servername, $username, $password, $database);

// Sjekke tilkobling
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['contact_id'])) {
    // Håndter sletteoperasjon
    $contact_id = ($_SERVER["REQUEST_METHOD"] == "POST") ? $_POST['contact_id'] : $_GET['contact_id'];

    $sql = "DELETE FROM kontaktperson WHERE kontaktpersonID=$contact_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Feil ved sletting av kontaktperson: " . $conn->error;
    }
}

// Lukk databasetilkobling
$conn->close();
?>
