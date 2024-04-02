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
            <h2>Company List</h2>
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

        <!-- List of contact persons -->
        <div class="contact-person-list">
            <h2>Contact Person List</h2>
            <?php include 'contact_person_list.php'; ?>
            <div class="contact-person-actions">
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

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<div class='list-item'>";
            echo "<div class='company-info'>";
            echo "<strong>Company ID:</strong> " . $row["company_id"] . "<br>";
            echo "<strong>Company Name:</strong> " . $row["company_name"] . "<br>";
            echo "</div>";
            echo "<div class='actions'>";
            echo "<a href='edit_company.php?id=" . $row["company_id"] . "'>Edit</a>";
            echo "<a href='delete_company.php?id=" . $row["company_id"] . "'>Delete</a>";
            echo "</div>";
            echo "<div class='people-info'>";
            if ($row["person_id"]) {
                echo "<strong>Person ID:</strong> " . $row["person_id"] . "<br>";
                echo "<strong>Person Name:</strong> " . $row["person_fornavn"] . " " . $row["person_etternavn"] . "<br>";
            } else {
                echo "No associated person";
            }
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No companies found";
    }

    // Close the database connection
    $conn->close();
    ?>


    <?php include 'footer.php'; ?>
