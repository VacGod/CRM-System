<?php
// Database-tilkobling
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "crmv5"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Sjekk for tilkoblingsfeil
if ($conn->connect_error) {
    die("Tilkobling mislyktes: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hent dataene fra skjemaet
    $navn = $_POST['navn'];
    $telefon = $_POST['telefon'];
    $epost = $_POST['epost'];
    $kontaktperson = $_POST['kontaktperson'];

    // Sett inn ny kunde i databasen
    $sql = "INSERT INTO kontaktperson (fornavn, etternavn telefon, epost, kontaktperson) VALUES ('$navn', '$telefon', '$epost', '$kontaktperson')";
    
    // Utfør spørringen og sjekk om den ble utført uten feil
    if ($conn->query($sql) === TRUE) {
        echo "Ny kunde lagt til vellykket.";
    } else {
        echo "Feil: " . $sql . "<br>" . $conn->error;
    }
}

// Lukk databaseforbindelsen
$conn->close();
?>
