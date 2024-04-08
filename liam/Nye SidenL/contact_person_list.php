<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['company_id'])) {
    $company_id = $_POST['company_id'];

    // Prepare and execute query to retrieve company details
    $company_query = "SELECT bedriftnavn FROM bedrift WHERE bedriftid = ?";
    $stmt = $conn->prepare($company_query);
    $stmt->bind_param("i", $company_id);
    $stmt->execute();
    $company_result = $stmt->get_result();

    if ($company_result->num_rows > 0) {
        $company_row = $company_result->fetch_assoc();
        $company_name = htmlspecialchars($company_row['bedriftnavn']);
        echo "<h2>Contact Persons for $company_name (ID: $company_id)</h2>";
    } else {
        echo "<h2>Contact Persons for Company ID: $company_id</h2>";
        echo "<p>No company found with ID: $company_id</p>";
    }

    // Prepare and execute query to retrieve contact persons for the company
    $contact_person_query = "SELECT * FROM kontaktperson WHERE bedrift_id = ?";
    $stmt = $conn->prepare($contact_person_query);
    $stmt->bind_param("i", $company_id);
    $stmt->execute();
    $contact_person_result = $stmt->get_result();

    if ($contact_person_result->num_rows > 0) {
        while ($contact_person_row = $contact_person_result->fetch_assoc()) {
            $contact_person_name = htmlspecialchars($contact_person_row['fornavn']) . " " . htmlspecialchars($contact_person_row['etternavn']);
            $contact_person_id = $contact_person_row['kontaktpersonID'];
            echo "<div class='contact-person'>";
            echo "<p><strong>Name:</strong> " . $contact_person_name . "</p>";
            echo "<p><strong>ID:</strong> " . $contact_person_id . "</p>";
            // Add edit and delete buttons after the ID
            echo "<button onclick=\"editContactPerson($contact_person_id)\">Edit</button>";
            echo "<button onclick=\"removeContactPerson($contact_person_id)\">Delete</button>";
            echo "</div>";
        }
    } else {
        echo "<p>No contact persons found for this company.</p>";
    }

    $stmt->close(); // Close the statement
}

$conn->close();
?>
