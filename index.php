<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM system</title>
</head>
<body>
<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "crmv4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get customers and their contacts
function getCustomersAndContacts($conn) {
    $sql = "SELECT kunde.kundeid, kunde.navn, kunde.telefon, kunde.epost, GROUP_CONCAT(kontaktperson.fornavn, ' ', kontaktperson.etternavn) AS kontaktpersoner 
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

// Function to create a new customer
function createCustomer($conn, $navn, $telefon, $epost) {
    $sql = "INSERT INTO kunde (navn, telefon, epost) VALUES ('$navn', '$telefon', '$epost')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to update customer details
function updateCustomer($conn, $kundeid, $navn, $telefon, $epost) {
    $sql = "UPDATE kunde SET navn='$navn', telefon='$telefon', epost='$epost' WHERE kundeid=$kundeid";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a customer
function deleteCustomer($conn, $kundeid) {
    $sql = "DELETE FROM kunde WHERE kundeid=$kundeid";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Get all customers and their contacts from the database
$customers = getCustomersAndContacts($conn);

// Close the database connection
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

    <h2>Legg til ny kunde</h2>
    <form action="add_customer.php" method="POST">
        <label for="navn">Navn:</label><br>
        <input type="text" id="navn" name="navn"><br>
        <label for="telefon">Telefon:</label><br>
        <input type="text" id="telefon" name="telefon"><br>
        <label for="epost">E-post:</label><br>
        <input type="text" id="epost" name="epost"><br><br>
        <input type="submit" value="Legg til kunde">
    </form>

    <!-- Additional forms for updating and deleting customers can be added here -->


</html>
