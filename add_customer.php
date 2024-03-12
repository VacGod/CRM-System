<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "crmv4";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $navn = $_POST['navn'];
    $telefon = $_POST['telefon'];
    $epost = $_POST['epost'];

    // Insert new customer into the database
    $sql = "INSERT INTO kunde (navn, telefon, epost) VALUES ('$navn', '$telefon', '$epost')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Ny kunde lagt til vellykket.";
    } else {
        echo "Feil: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
