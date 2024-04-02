<?php
// db_connection.php
include 'db_connection.php';

// Remove company
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['company_id'])) {
    $company_id = $_GET['company_id'];
    
    // Delete company
    $sql = "DELETE FROM bedrift WHERE bedriftid = $company_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Company removed successfully";
        header("refresh:0; url=admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
