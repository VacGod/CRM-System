<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hei</title>
</head>
<body>
<?php
// Database connection
$servername = "localhost";
$username = "brukernavn";
$password = "passord";
$dbname = "crmv4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Funksjon for å hente kunder og deres kontaktpersoner
function getCustomersAndContacts($conn) {
    $sql = "SELECT kunde.*, GROUP_CONCAT(kontaktperson.fornavn, ' ', kontaktperson.etternavn) AS kontaktpersoner 
            FROM kunde 
            LEFT JOIN kontaktperson ON kunde.kundeid = kontaktperson.kunde_id 
            GROUP BY kunde.kundeid";
    $result = $conn->query($sql);
    
    $customers = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
    }
    return $customers;
}

// Henter alle kunder og deres kontaktpersoner fra databasen
$customers = getCustomersAndContacts($conn);

// Lukk databaseforbindelsen
$conn->close();
?>
<h2>Kunder og Kontaktpersoner</h2>
    <table border="1">
        <tr>
            <th>Kunde ID</th>
            <th>Navn</th>
            <th>Telefon</th>
            <th>E-post</th>
            <th>Kontaktpersoner</th>
        </tr>
        <?php foreach ($customers as $customer): ?>
        <tr>
            <td><?php echo $customer['kundeid']; ?></td>
            <td><?php echo $customer['navn']; ?></td>
            <td><?php echo $customer['telefon']; ?></td>
            <td><?php echo $customer['epost']; ?></td>
            <td><?php echo $customer['kontaktpersoner']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>



</body>
</html>
