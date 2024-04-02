<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_id = $_POST['company_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    
    $sql = "INSERT INTO kontaktperson (bedrift_id, fornavn, etternavn, epost, telefon, stilling) VALUES ('$company_id', '$first_name', '$last_name', '$email', '$phone', '$position')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New contact person added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
