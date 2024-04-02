<?php
// db_connection.php
include 'db_connection.php';

// Remove contact person
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['contact_person_id'])) {
    $contact_person_id = $_GET['contact_person_id'];
    
    // Delete contact person
    $sql = "DELETE FROM kontaktperson WHERE kontaktpersonID = $contact_person_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Contact person removed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
