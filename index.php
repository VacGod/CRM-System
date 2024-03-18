<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktpersoner og Bedrifter</title>
    <style>
        /* Stil for midtjustert tabell */
        table {
            margin-left: auto;
            margin-right: auto;
            margin-top: 20rem;
        }
        /* Stil for pop-up-boksen */
        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            z-index: 1000;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Kontaktpersoner og Bedrifter</h1>

<table border="1">
    <tr>
        <th>Bedrift</th>
        <th>Kontaktperson</th>
    </tr>
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

    // Hent kontaktpersoner og tilhørende bedrifter fra databasen
    $sql = "SELECT kontaktperson.*, bedrift.bedriftnavn AS bedrift_navn FROM kontaktperson LEFT JOIN bedrift ON kontaktperson.bedrift_id = bedrift.bedriftid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Vis data for hver rad
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["bedrift_navn"] . "</td>";
            echo "<td>" . $row["fornavn"] . " " . $row["etternavn"] . " - <a href='#' onclick='showPopup(\"" . $row["kontaktpersonID"] . "\", \"" . $row["fornavn"] . "\", \"" . $row["etternavn"] . "\", \"" . $row["epost"] . "\", \"" . $row["telefon"] . "\", \"" . $row["stilling"] . "\")'>Rediger/Slett</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>Ingen kontaktpersoner funnet.</td></tr>";
    }

    // Lukk databasetilkobling
    $conn->close();
    ?>
</table>

<!-- Pop-up boks for redigering og sletting av kontaktperson -->
<div id="popup" class="popup">
    <h2>Rediger kontaktperson</h2>
    <form action="update_contact.php" method="post">
        <input type="hidden" id="contact_id" name="contact_id">
        <label for="fname">Fornavn:</label><br>
        <input type="text" id="fname" name="fname" required><br>
        <label for="lname">Etternavn:</label><br>
        <input type="text" id="lname" name="lname" required><br>
        <label for="email">Epost:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Telefon:</label><br>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{20}" required maxlength="20"><br>
        <label for="position">Stilling:</label><br>
        <input type="text" id="position" name="position" required><br><br>
        <input type="submit" value="Oppdater">
        <input type="submit" formaction="delete_contact.php" value="Slett">
        <input type="reset" name="teset" id="reset" value="Reset">
    </form>
    <button onclick="hidePopup()">Lukk</button>
</div>

<script>
    // Funksjon for å vise pop-up boksen med kontaktpersoninformasjon
    function showPopup(id, fname, lname, email, phone, position) {
        document.getElementById("contact_id").value = id;
        document.getElementById("fname").value = fname;
        document.getElementById("lname").value = lname;
        document.getElementById("email").value = email;
        document.getElementById("phone").value = phone;
        document.getElementById("position").value = position;
        document.getElementById("popup").style.display = "block";
    }

    // Funksjon for å skjule pop-up-boksen
    function hidePopup() {
        document.getElementById("popup").style.display = "none";
    }
</script>

</body>
</html>
