<?php
// Database connection
include 'db_connection.php';

// Add new company
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST['company_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    // Prevent SQL injection by using prepared statements
    $sql = "INSERT INTO bedrift (bedriftnavn, fornavn, etternavn) VALUES (?, ?, ?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("sss", $company_name, $first_name, $last_name);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Retrieve the newly added company details
        $new_company_id = $stmt->insert_id; // Get the ID of the newly inserted row

        // Redirect back to the HTML page with the new company ID
        header("Location: text.php?new_company_id=$new_company_id");
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
