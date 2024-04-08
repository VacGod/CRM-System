<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_id = $_POST['company_id'];

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
            echo "<button onclick=\"editContactPerson(" . $contact_person_row['kontaktpersonID'] . ")\">Edit</button>";
            echo "<button onclick=\"deleteContactPerson(" . $contact_person_row['kontaktpersonID'] . ")\">Delete</button>";
            echo "</div>";
        }
    } else {
        echo "<p>No contact persons found for this company.</p>";
    }
}
?>
