<div class="container">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <h1>Customer Relationship Management</h1>

    <!-- Form for adding a new company -->
    <div class="add-customer-form">
        <h2>Add New Company</h2>
        <form action="add_company.php" method="post" id="addCompanyForm">
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
            <label for="company_id">Company ID:</label>
            <input type="number" id="company_id" name="company_id" required>
            <button type="submit">Remove Company</button>
            </form>

        </div>

        

    <!-- Display contact person ID -->
    <div class="contact-person-id">
        <?php
        // Include the database connection file
        include 'db_connection.php';

        if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
            $company_id = $_GET['company_id'];

            // Retrieve company details
            $company_query = "SELECT bedriftid, bedriftnavn FROM bedrift WHERE bedriftid = $company_id";
            $company_result = $conn->query($company_query);

            if ($company_result->num_rows > 0) {
                $company_row = $company_result->fetch_assoc();
                $company_name = $company_row['bedriftnavn'];
                echo "<h2>Contact Persons for $company_name (ID: $company_id)</h2>";
            } else {
                echo "<h2>Contact Persons for Company ID: $company_id</h2>";
                echo "<p>No company found with ID: $company_id</p>";
            }

            // Retrieve and display contact persons for the company
            $contact_person_query = "SELECT * FROM kontaktperson WHERE bedrift_id = $company_id";
            $contact_person_result = $conn->query($contact_person_query);

            if ($contact_person_result->num_rows > 0) {
                while ($contact_person_row = $contact_person_result->fetch_assoc()) {
                    echo "<div class='contact-person'>";
                    echo "<p><strong>Name:</strong> " . $contact_person_row['fornavn'] . " " . $contact_person_row['etternavn'] . "</p>";
                    echo "<p><strong>ID:</strong> " . $contact_person_row['kontaktpersonID'] . "</p>";
                    // Add edit and delete buttons after the ID
                    echo "<button onclick=\"edit_Contact_Person(" . $contact_person_row['kontaktpersonID'] . ")\">Edit</button>";
                    echo "<button onclick=\"deleteContactPerson(" . $contact_person_row['kontaktpersonID'] . ")\">Delete</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No contact persons found for this company.</p>";
            }
        }
        ?>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>



        <!-- Form for inputting company ID -->
        <div class="company-id-form">
            <h2>Enter Company ID to view Contact Persons:</h2>
            <input type="number" id="company_id_input" placeholder="Enter Company ID">
            <button onclick="showContactPersons()">Show Contact Persons</button>
        </div>

        <!-- Display contact persons -->
        <div class="contact-person-list" id="contactPersonList"></div>
    </div>

    <script>
        function showContactPersons() {
            var companyId = document.getElementById('company_id_input').value;
            $.ajax({
                url: 'contact_person_list.php',
                type: 'POST',
                data: { company_id: companyId },
                success: function(response) {
                    document.getElementById('contactPersonList').innerHTML = response;
                }
            });
        }

        function editContactPerson(contactPersonId) {
            // Redirect to edit_contact_person.php with contactPersonId as parameter
            window.location.href = 'edit_contact_person.php?contact_person_id=' + contactPersonId;
        }

        function deleteContactPerson(contactPersonId) {
            if (confirm('Are you sure you want to delete this contact person?')) {
                $.ajax({
                    url: 'remove_contact_person.php',
                    type: 'POST',
                    data: { contact_person_id: contactPersonId },
                    success: function(response) {
                        if (response === 'success') {
                            // Refresh contact person list
                            showContactPersons();
                        } else {
                            alert('Error deleting contact person');
                        }
                    }
                });
            }
        }
    </script>
</div>

<?php include 'footer.php'; ?>
