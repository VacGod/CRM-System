<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_person_id'])) {
    $contact_person_id = $_POST['contact_person_id'];

    // Delete contact person
    $sql = "DELETE FROM kontaktperson WHERE kontaktpersonID = $contact_person_id";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error deleting contact person: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
