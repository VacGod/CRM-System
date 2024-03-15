<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM-system</title>
</head>
<body>
<?php
// Database tilkobling
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "crmv5"; 
$conn = new mysqli($servername, $username, $password, $dbname);

// Sjekk tilkoblingen
if ($conn->connect_error) {
    die("Tilkobling mislyktes: " . $conn->connect_error);
}

// Funksjon for å hente kunder og deres kontakter
function getCustomersAndContacts($conn) {
    $sql = "SELECT bedrift.bedriftid, bedrift.bedriftnavn, GROUP_CONCAT(kontaktperson.fornavn, ' ', kontaktperson.etternavn) AS kontaktpersoner 
        FROM bedrift 
        LEFT JOIN kontaktperson ON bedrift.bedriftid = kontaktperson.bedrift_id 
        GROUP BY bedrift.bedriftid";


    $result = $conn->query($sql);
    
    $kunder = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $kunder[] = $row;
        }
    }
    return $kunder;
}

// Funksjon for å opprette en ny kunde (bedrift)
function createCustomer($conn, $navn, $telefon, $epost) {
    $sql = "INSERT INTO bedrift (bedriftnavn, telefon, epost) VALUES ('$navn', '$telefon', '$epost')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Funksjon for å oppdatere kundedetaljer
function updateCustomer($conn, $kundeid, $navn, $telefon, $epost) {
    $sql = "UPDATE bedrift SET bedriftnavn='$navn', telefon='$telefon', epost='$epost' WHERE bedriftid=$kundeid";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Funksjon for å slette en kunde (bedrift)
function deleteCustomer($conn, $kundeid) {
    $sql = "DELETE FROM bedrift WHERE bedriftid=$kundeid";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Hent alle kunder og deres kontakter fra databasen
$kunder = getCustomersAndContacts($conn);

// Lukk databasetilkoblingen
$conn->close();
?>

    <h2>Kunder og Kontaktpersoner</h2>
    <table border="1">
        <tr>
            <th>Bedrift ID</th>
            <th>Bedriftnavn</th>
            <th>Kontaktpersoner</th>
        </tr>
        <?php foreach ($kunder as $kunde): ?>
        <tr>
            <td><?php echo $kunde['bedriftid']; ?></td>
            <td><?php echo $kunde['bedriftnavn']; ?></td>
            <td><?php echo $kunde['kontaktpersoner']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Legg til ny Bedrift</h2>
    <form action="add_customer.php" method="POST">
        <label for="navn">Navn:</label><br>
        <input type="text" id="navn" name="navn"><br>
        <label for="kontaktperson">Kontaktperson:</label><br>
        <input type="text" id="kontaktperson" name="kontaktperson"><br>
        <input type="submit" value="Legg til kunde">
    </form>
   

    <!-- Ytterligere skjemaer for å oppdatere og slette kunder kan legges til her -->

    

</body>
</html>
