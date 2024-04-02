<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legg til Bedrift</title>
    <style>
        /* Stil for midtjustert tabell */
        form {
            text-align: center;
        }
        h1 {
            text-align: center;
        }
        </style>
</head>
<body>
    <h1>Legg til Bedrift</h1>
    <form action="insert_company.php" method="post">
        <label for="company_name">Bedriftsnavn:</label><br>
        <input type="text" id="company_name" name="company_name" required><br><br>
        <label for="contact_fname">Kontaktperson Fornavn:</label><br>
        <input type="text" id="contact_fname" name="contact_fname" required><br><br>
        <label for="contact_lname">Kontaktperson Etternavn:</label><br>
        <input type="text" id="contact_lname" name="contact_lname" required><br><br>
        <label for="contact_email">Kontaktperson Epost:</label><br>
        <input type="email" id="contact_email" name="contact_email" required><br><br>
        <label for="contact_phone">Kontaktperson Telefon:</label><br>
        <input type="tel" id="contact_phone" name="contact_phone" maxlength="20" required><br><br>
        <label for="contact_position">Kontaktperson Stilling:</label><br>
        <input type="text" id="contact_position" name="contact_position" required><br><br>
        <input type="submit" value="Legg til">
    </form>
</body>
</html>
