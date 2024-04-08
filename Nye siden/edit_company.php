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
        <form action="add_company.php" method="post" id="addCompanyForm">
            <!-- Your form fields for adding a new company -->
        </form>
    </div>

    <!-- List of existing companies -->
    <div class="company-list">
        <h2>Company List</h2>
        <table class="company-table">
            <thead>
                <tr>
                    <th>Company ID</th>
                    <th>Company Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                include 'db_connection.php';

                // Retrieve and display the list of companies
                $sql = "SELECT bedriftid, bedriftnavn FROM bedrift";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["bedriftid"] . "</td>";
                        echo "<td>" . $row["bedriftnavn"] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_company.php?id=" . $row["bedriftid"] . "'>Edit</a>";
                        echo "<a href='delete_company.php?id=" . $row["bedriftid"] . "'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No companies found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Additional sections for other lists and forms -->
</div>

<?php
// Include the footer
include 'footer.php';
?>
