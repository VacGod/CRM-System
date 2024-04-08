<?php
// db_connection.php
include 'db_connection.php';

// Remove contact person
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['company_id'])) {
    $company_id = $_GET['company_id'];
    
    // Delete contact person
    $sql = "DELETE FROM bedrift WHERE bedriftID = $company_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Contact person removed successfully";
        // Redirect back to the original page after deletion
        echo '<script>window.location.replace("text.php");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
