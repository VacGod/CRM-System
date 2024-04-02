    <?php
    // Include header if not already included
    if (!isset($included_header)) {
        $included_header = true;
        include 'header.php';
    }
    ?>

    <div class="container">
        <h1>Customer Management</h1>

        <!-- Form for adding a new company -->
        <div class="add-customer-form">
            <h2>Add New Company</h2>
            <form action="add_customer.php" method="post" id="addCompanyForm">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" required>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
                <button type="submit">Add Company</button>
            </form>
        </div>

        <!-- List of existing companies -->
        <div class="company-list">
    
            <?php include 'company_list.php'; ?>
            <div class="company-actions">
                <!-- Remove Company Form -->
                <form action="remove_company.php" method="get">
                    <label for="remove_company_id">Enter Company ID to Remove:</label>
                    <input type="number" id="remove_company_id" name="company_id" required>
                    <button type="submit">Remove Company</button>
                </form>

                <!-- Edit Company Form -->
                <form action="edit_company.php" method="post">
                    <label for="edit_company_id">Enter Company ID to Edit:</label>
                    <input type="number" id="edit_company_id" name="company_id" required>
                    <label for="edit_company_name">New Company Name:</label>
                    <input type="text" id="edit_company_name" name="company_name" required>
                    <label for="edit_company_first_name">New First Name:</label>
                    <input type="text" id="edit_company_first_name" name="first_name" required>
                    <label for="edit_company_last_name">New Last Name:</label>
                    <input type="text" id="edit_company_last_name" name="last_name" required>
                    <button type="submit">Edit Company</button>
                </form>
            </div>
        </div>

    
                <!-- Remove Contact Person Form -->
                <form action="remove_contact_person.php" method="get">
                    <label for="remove_contact_person_id">Enter Contact Person ID to Remove:</label>
                    <input type="number" id="remove_contact_person_id" name="contact_person_id" required>
                    <button type="submit">Remove Contact Person</button>
                </form>

                <!-- Edit Contact Person Form -->
                <form action="edit_contact_person.php" method="post">
                    <label for="edit_contact_person_id">Enter Contact Person ID to Edit:</label>
                    <input type="number" id="edit_contact_person_id" name="contact_person_id" required>
                    <label for="edit_contact_person_first_name">New First Name:</label>
                    <input type="text" id="edit_contact_person_first_name" name="first_name" required>
                    <label for="edit_contact_person_last_name">New Last Name:</label>
                    <input type="text" id="edit_contact_person_last_name" name="last_name" required>
                    <label for="edit_contact_person_email">New Email:</label>
                    <input type="email" id="edit_contact_person_email" name="email" required>
                    <label for="edit_contact_person_phone">New Phone:</label>
                    <input type="tel" id="edit_contact_person_phone" name="phone" required>
                    <label for="edit_contact_person_position">New Position:</label>
                    <input type="text" id="edit_contact_person_position" name="position" required>
                    <button type="submit">Edit Contact Person</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    // Include the database connection file
    include 'db_connection.php';

    // Retrieve and display the list of companies and their associated people
    $sql = "SELECT b.bedriftid AS company_id, b.bedriftnavn AS company_name, k.kontaktpersonID AS person_id, k.fornavn AS person_fornavn, k.etternavn AS person_etternavn
            FROM bedrift b
            LEFT JOIN kontaktperson k ON b.bedriftid = k.bedrift_id";
    $result = $conn->query($sql);

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vis ansatte etter bedrift</title>
</head>
<body>
    <h2>Velg en bedrift:</h2>
    <select id="bedrift" onchange="visAnsatte()">
        <option value="">Velg bedrift</option>
        <!-- Her kan du sette inn PHP-kode for å hente bedriftene fra databasen -->
        <?php
            // Eksempel på PHP-kode for å hente bedriftene fra databasen
            // Dette må tilpasses din faktiske database og tabellstruktur
            $bedrifter = array("Bedrift A", "Bedrift B", "Bedrift C");

            foreach ($bedrifter as $bedrift) {
                echo "<option value='$bedrift'>$bedrift</option>";
            }
        ?>
    </select>

    <div id="ansatte" style="display: none;">
        <h2>Ansatte:</h2>
        <ul id="ansatte-liste">
            <!-- Dette vil bli fylt med ansatte når en bedrift er valgt -->
        </ul>
    </div>

    <script>
        function visAnsatte() {
            var valgtBedrift = document.getElementById("bedrift").value;
            var ansatteDiv = document.getElementById("ansatte");
            var ansatteListe = document.getElementById("ansatte-liste");

            // Sjekker om en bedrift er valgt
            if (valgtBedrift !== "") {
                // Her kan du bruke AJAX for å hente ansatte til den valgte bedriften fra databasen
                // I dette eksempelet bruker vi en hardkodet liste over ansatte for hver bedrift

                // Tømmer den eksisterende listen over ansatte
                ansatteListe.innerHTML = "";

                // Legger til ansatte til den valgte bedriften
                if (valgtBedrift === "Bedrift A") {
                    leggTilAnsatte(["Ansatt 1A", "Ansatt 2A", "Ansatt 3A"]);
                } else if (valgtBedrift === "Bedrift B") {
                    leggTilAnsatte(["Ansatt 1B", "Ansatt 2B"]);
                } else if (valgtBedrift === "Bedrift C") {
                    leggTilAnsatte(["Ansatt 1C", "Ansatt 2C", "Ansatt 3C", "Ansatt 4C"]);
                }

                // Viser ansatte-diven
                ansatteDiv.style.display = "block";
            } else {
                // Skjuler ansatte-diven hvis ingen bedrift er valgt
                ansatteDiv.style.display = "none";
            }
        }

        // Funksjon for å legge til ansatte i listen
        function leggTilAnsatte(ansatte) {
            var ansatteListe = document.getElementById("ansatte-liste");
            for (var i = 0; i < ansatte.length; i++) {
                var ansatt = ansatte[i];
                var listItem = document.createElement("li");
                listItem.textContent = ansatt;
                ansatteListe.appendChild(listItem);
            }
        }
    </script>
</body>
</html>





