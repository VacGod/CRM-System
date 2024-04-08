<?php
include 'db_connection.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_SANITIZE_NUMBER_INT);
    $fornavn = filter_input(INPUT_POST, 'fornavn', FILTER_SANITIZE_STRING);
    $etternavn = filter_input(INPUT_POST, 'etternavn', FILTER_SANITIZE_STRING);

    // Prepare an update statement
    $sql = "UPDATE kontaktperson SET fornavn=?, etternavn=? WHERE id=?";
    
    if($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssi", $fornavn, $etternavn, $contact_id);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()) {
            echo "Record updated successfully.";
            // Redirect back to the contact person page or display a success message
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
