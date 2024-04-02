<?php
// Include the database connection file
include 'db_connection.php';

// Query to fetch contact persons with their respective company names
$sql = "SELECT kontaktperson.*, bedrift.bedriftnavn AS company_name 
        FROM kontaktperson 
        INNER JOIN bedrift ON kontaktperson.bedrift_id = bedrift.bedriftid";
$result = $conn->query($sql);

// Check if there are contact persons found
if ($result->num_rows > 0) {
    // Loop through each contact person
    while($row = $result->fetch_assoc()) {
        // Output contact person details
        echo "<div class='contact-person-item'>";
        echo "<strong>Company:</strong> " . $row["company_name"] . "<br>";
        echo "<strong>Name:</strong> " . $row["fornavn"] . " " . $row["etternavn"] . "<br>";
        echo "<strong>Email:</strong> " . $row["epost"] . "<br>";
        echo "<strong>Phone:</strong> " . $row["telefon"] . "<br>";
        echo "<strong>Position:</strong> " . $row["stilling"] . "<br>";
        echo "</div>";
    }
} else {
    // If no contact persons found, display a message
    echo "No contact persons found";
}

// Close the database connection
$conn->close();
?>
