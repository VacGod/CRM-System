<?php
// add_customer.php

// Database connection
include 'db_connection.php';

// Add new company
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST['company_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    $sql = "INSERT INTO bedrift (bedriftnavn, fornavn, etternavn) VALUES ('$company_name', '$first_name', '$last_name')";
    
    if ($conn->query($sql) === TRUE) {
        // Retrieve the newly added company details
        $new_company_id = $conn->insert_id; // Get the ID of the newly inserted row
        $new_company_name = $company_name; // Use the provided company name

        // Redirect back to the HTML page with the new company details
        header("Location: exploits.html?new_company_id=$new_company_id&new_company_name=$new_company_name");
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
