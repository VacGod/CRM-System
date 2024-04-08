<?php
include 'db_connection.php';

// Check if contact person ID is provided and valid
if (isset($_REQUEST['contact_person_id']) && !empty($_REQUEST['contact_person_id'])) {
    $contact_person_id = $_REQUEST['contact_person_id'];

    // Prepare and execute query to retrieve contact person details
    $contact_person_query = "SELECT * FROM kontaktperson WHERE kontaktpersonID = ?";
    $stmt = $conn->prepare($contact_person_query);
    $stmt->bind_param("i", $contact_person_id);
    $stmt->execute();
    $contact_person_result = $stmt->get_result();

    if ($contact_person_result->num_rows > 0) {
        $contact_person_row = $contact_person_result->fetch_assoc();
        $contact_person_name = htmlspecialchars($contact_person_row['fornavn']) . " " . htmlspecialchars($contact_person_row['etternavn']);
        echo "<h2>Edit Contact Person: $contact_person_name (ID: $contact_person_id)</h2>";

        // Display edit button
        echo "<button onclick=\"openEditForm()\">Edit</button>";

        // Display form to edit contact person's name within a modal
        ?>
        <div id="editFormModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditForm()">&times;</span>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="edit-form">
                    <input type="hidden" name="contact_person_id" value="<?php echo $contact_person_id; ?>">
                    <label for="new_firstname">New First Name:</label>
                    <input type="text" name="new_firstname" required><br>
                    <label for="new_lastname">New Last Name:</label>
                    <input type="text" name="new_lastname" required><br>
                    <input type="submit" value="Update Name">
                </form>
            </div>
        </div>

        <script>
            // Get the modal
            var modal = document.getElementById('editFormModal');

            // When the user clicks the edit button, open the modal
            function openEditForm() {
                modal.style.display = 'block';
            }

            // When the user clicks on <span> (x), close the modal
            function closeEditForm() {
                modal.style.display = 'none';
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    closeEditForm();
                }
            }
        </script>
        <?php
    } else {
        echo "<h2>No contact person found with ID: $contact_person_id</h2>";
    }

    $stmt->close(); // Close the statement
} else {
    echo "Please provide a valid contact person ID";
}

$conn->close();
?>
