<?php
include 'db_connection.php';

$sql = "SELECT kontaktperson.*, bedrift.bedriftnavn AS company_name FROM kontaktperson INNER JOIN bedrift ON kontaktperson.bedrift_id = bedrift.bedriftid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='contact-person-item'>";
        echo "<strong>Company:</strong> " . $row["company_name"] . "<br>";
        echo "<strong>Name:</strong> " . $row["fornavn"] . " " . $row["etternavn"] . "<br>";
        echo "<strong>Email:</strong> " . $row["epost"] . "<br>";
        echo "<strong>Phone:</strong> " . $row["telefon"] . "<br>";
        echo "<strong>Position:</strong> " . $row["stilling"] . "<br>";
        echo "</div>";
    }
} else {
    echo "No contact persons found";
}

$conn->close();
?>
