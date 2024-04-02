<?php
// db_connection.php

//$servername = "localhost:3306";
//$username = "im22geo0601";
//$password = "3til59C1!";
//dbname = "db_im22geo0601";

$servername = "localhost";
$username = "root";
$password = "";
$database = "crmv6";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
