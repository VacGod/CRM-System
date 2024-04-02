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
    $bedriftnavn = $_POST['bedriftnavn']; // Endret fra 'bedriftnavn' til 'navn'
    $kontaktperson = $_POST['kontaktperson'];

    // Sett inn ny kunde i databasen
    $sql = "INSERT INTO kontaktperson (bedriftnavn, kontaktperson) VALUES ('$bedriftnavn', '$kontaktperson')";
    
    // Utfør spørringen og sjekk om den ble utført uten feil
    if ($conn->query($sql) === TRUE) {
        echo "Ny bedrift lagt til";
    } else {
        echo "Feil: " . $sql . "<br>" . $conn->error;
    }
}

// Lukk databaseforbindelsen
$conn->close();
?>
