<div class="container">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


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
            <div class="add-contact-person">
    <button onclick="openAddContactPersonForm()">Add Contact Person</button>
</div>

<script>
    // Function to open add contact person form
    function openAddContactPersonForm() {
        // Your code to open the add contact person form goes here
        // For example, you can show a modal or redirect to the add contact person page
        // Here's an example of redirecting to the add contact person page:
        window.location.href = 'add_contact_person.php';
    }

    // AJAX to submit form data and add a new contact person
    document.getElementById('addContactPerson').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Create FormData object to serialize form data
        var formData = new FormData(this);

        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_contact_person.php', true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                alert(xhr.responseText); // Display response from server
                // Reset form after successful submission
                document.getElementById('addContactPerson').reset();
            } else {
                alert('Error: ' + xhr.statusText); // Display error message
            }
        };
        xhr.onerror = function() {
            alert('Error: Request failed'); // Display error message if request fails
        };
        xhr.send(formData); // Send FormData object
    });
</script>


    <!-- Display contact person ID -->
    <div class="contact-person-id">
   <?php


?>


        <!-- Form for inputting company ID -->
        <div class="company-id-form">
            <h2>Enter Company ID to view Contact Persons:</h2>
            <input type="number" id="company_id_input" placeholder="Enter Company ID">
            <button onclick="showContactPersons()">Show Contact Persons</button>
        </div>

        <div class="contact-person-list" id="contactPersonList">
    <?php include 'contact_person_list.php'; ?>
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
                // Bind delete event to delete buttons after adding them dynamically
                bindDeleteEvent();
            }
        });
    }

    function deleteContactPerson(contactPersonId) {
        console.log("Deleting contact person with ID:", contactPersonId); // Debugging statement

        if (confirm('Are you sure you want to delete this contact person?')) {
            $.ajax({
                url: 'remove_contact_person.php',
                type: 'POST',
                data: { contact_person_id: contactPersonId },
                success: function(response) {
                    if (response.trim() === 'success') {
                        // Refresh contact person list
                        showContactPersons();
                    } else {
                        alert('Error deleting contact person');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error deleting contact person:", error); // Debugging statement
                    alert('Error deleting contact person');
                }
            });
        }
    }
</script>
</div>

<?php include 'footer.php'; ?>
