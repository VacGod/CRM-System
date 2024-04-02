<!-- This file contains the list items for companies -->
<?php
include 'db_connection.php';

// Retrieve companies
$sql = "SELECT * FROM bedrift";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='list-item'>";
        echo "<strong>Company Name:</strong> " . $row["bedriftnavn"] . "<br>";
        echo "<strong>Contact Person:</strong> " . $row["fornavn"] . " " . $row["etternavn"] . "<br>";
        // Add more details as needed
        echo "</div>";
    }
} else {
    echo "No companies found";
}

$conn->close();
?>
