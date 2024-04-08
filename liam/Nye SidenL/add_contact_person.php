<?php
// Include the database connection file
include 'db_connection.php';


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $company_id = $_POST['company_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Prepare and bind the statement to insert a new contact person
    $stmt = $conn->prepare("INSERT INTO kontaktperson (bedrift_id, fornavn, etternavn, epost, telefon) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $company_id, $first_name, $last_name, $email, $phone);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Contact person added successfully');</script>";
    } else {
        echo "<script>alert('Error adding contact person');</script>";
        echo $stmt->error; // Output any MySQL errors
    }
    $stmt->close(); // Close the statement
}
?>

<link rel="stylesheet" href="styles.css">

<div class="container">
    <h1>Add Contact Person</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="company_id">Enter Company ID:</label>
        <input type="number" name="company_id" required><br>
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required><br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="phone">Phone:</label>
        <input type="tel" name="phone" required><br>
        <!-- Additional input fields for contact person details -->
        <button type="submit">Add Contact Person</button>
    </form>
</div>

<?php $conn->close(); ?>
