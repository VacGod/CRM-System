<style>
.info {
    text-align: center;
    font-size: 3rem;
    margin-top: 20%;
}
</style>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "crmv6";

// Opprette tilkobling
$conn = new mysqli($servername, $username, $password, $database);

// Sjekke tilkobling
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hente data fra skjemaet
$company_name = $_POST['company_name'];
$contact_fname = $_POST['contact_fname'];
$contact_lname = $_POST['contact_lname'];
$contact_email = $_POST['contact_email'];
$contact_phone = $_POST['contact_phone'];
$contact_position = $_POST['contact_position'];

// Legge til bedrift i bedrift-tabellen
$sql_insert_company = "INSERT INTO bedrift (bedriftnavn, fornavn, etternavn) VALUES ('$company_name', '$contact_fname', '$contact_lname')";
if ($conn->query($sql_insert_company) === TRUE) {
    // Hente ID til den nye bedriften
    $company_id = $conn->insert_id;

    // Legge til kontaktperson i kontaktperson-tabellen
    $sql_insert_contact = "INSERT INTO kontaktperson (bedrift_id, bedrift_navn, fornavn, etternavn, epost, telefon, stilling) VALUES ($company_id, '$company_name', '$contact_fname', '$contact_lname', '$contact_email', '$contact_phone', '$contact_position')";
    if ($conn->query($sql_insert_contact) === TRUE) {
        echo "<div class='info'> Ny bedrift og kontaktperson ble lagt til. </div>";
        header("refresh:5; url=admin.php");
    } else {
        echo "Feil: " . $sql_insert_contact . "<br>" . $conn->error;
    }
} else {
    echo "Feil: " . $sql_insert_company . "<br>" . $conn->error;
}

// Lukk databasetilkobling
$conn->close();
?>
