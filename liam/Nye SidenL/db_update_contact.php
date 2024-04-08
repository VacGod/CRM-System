<?php
include 'db_connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact_id = $_POST['contact_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];

    // Prevent SQL injection
    $sql = "UPDATE kontaktperson SET fornavn=?, etternavn=?, epost=?, telefon=?, stilling=? WHERE kontaktpersonID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $phone, $position, $contact_id);

    if ($stmt->execute()) {
        echo "Contact updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>
