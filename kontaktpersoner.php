<?php
// Database tilkobling (samme som tidligere)
include 'db_connection.php';

// Sjekk om det er sendt med en bedrifts-ID
if (isset($_GET['bedriftid'])) {
    $bedriftid = $_GET['bedriftid'];

    // Hent kontaktpersoner for den spesifikke bedriften
    $sql = "SELECT * FROM kontaktperson WHERE bedrift_id = $bedriftid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Kontaktpersoner for Bedrift</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['fornavn'] . " " . $row['etternavn'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Ingen kontaktpersoner funnet for denne bedriften.";
    }
} else {
    echo "Ingen bedrift valgt.";
}

$conn->close();
?>
