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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Håndter oppdateringsoperasjon
    $contact_id = $_POST['contact_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];

    $sql = "UPDATE kontaktperson SET fornavn='$fname', etternavn='$lname', epost='$email', telefon='$phone', stilling='$position' WHERE kontaktpersonID=$contact_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Feil ved oppdatering av kontaktperson: " . $conn->error;
    }
}

// Lukk databasetilkobling
$conn->close();
?>
