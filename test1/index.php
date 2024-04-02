<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktpersoner og Bedrifter</title>
    <link rel="stylesheet" href="indexcss.css"> <!-- Lenke til stilarket -->
</head>
<body>

<div class="header">
    <h1>CRM Oppgavenavn</h1>
    <div class="admin-box">
        <a href="admin.php">Admin Login</a>
    </div>
</div>

<div class="outer-container">
    <div class="container">
        
        <?php
        // Databasekobling
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
    
        // Hent alle informasjonen per bedrift fra databasen
        $sql = "SELECT bedrift.*, kontaktperson.fornavn, kontaktperson.etternavn, kontaktperson.epost, kontaktperson.telefon, kontaktperson.stilling FROM bedrift LEFT JOIN kontaktperson ON bedrift.bedriftid = kontaktperson.bedrift_id";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // Loop gjennom resultatet og lag en boks for hver bedrift
            while($row = $result->fetch_assoc()) {
                echo "<div class='box'>";
                echo "<h2>" . $row["bedriftnavn"] . "</h2>";
                echo "<p><strong>E-post:</strong> " . $row["epost"] . "</p>";
                echo "<p><strong>Telefon:</strong> " . $row["telefon"] . "</p>";
                echo "<p><strong>Stilling:</strong> " . $row["stilling"] . "</p>";
                echo "<div class='grid-container'>";
                // Fyll opp 3x3 oppsettet med tomme elementer for demonstrasjonsformål
                for ($i = 1; $i <= 3; $i++) {
                    echo "<div class='grid-item'>Element $i</div>";
                }
                echo "</div>"; // Avslutt grid-container
                echo "</div>"; // Avslutt boks
            }
        } else {
            echo "Ingen bedrifter funnet.";
        }
    
        // Lukk databasetilkobling
        $conn->close();
        ?>

    </div>
</div>


</body>
</html>
