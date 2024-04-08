<?php 
// Include the header file
include 'header.php'; 

// Include the database connection file
include 'db_connection.php';

// Remove company
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['company_id'])) {
    $company_id = $_GET['company_id'];

    // Prepare and bind the statement
    $sql = "DELETE FROM bedrift WHERE bedriftid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $company_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            echo "Company removed successfully";
        } else {
            echo "No company found with ID: $company_id";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "";
}

// Retrieve and display the list of companies
$sql = "SELECT bedriftid, bedriftnavn FROM bedrift";
$result = $conn->query($sql);

?>

<div class="container">
    <h1>Search</h1>

    <!-- Search and filter -->
    <div class="search-container">
        <input type="text" class="search-input" id="searchInput" onkeyup="searchCompanies()" placeholder="Search for companies...">
    </div>

    <!-- List of existing companies -->
    <div class="company-list" id="companyList">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='list-item' id='company_" . $row["bedriftid"] . "'>";
                echo "<div class='company-info'>";
                echo "<span class='company-name'>" . $row["bedriftnavn"] . "</span>";
                echo "<strong> - ID: </strong>" . $row["bedriftid"];
                echo "</div>";
                echo "<button class='edit-button' onclick='editCompany(" . $row["bedriftid"] . ")'>Edit</button>";
                echo "</div>";
            }
        } else {
            echo "No companies found";
        }
        ?>
    </div>
</div>

<!-- The Modal -->
<div id="editModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Company Details</h2>
        <form id="editForm">
            <label for="edit_company">Company Name:</label>
            <input type="text" id="edit_company" name="edit_company" required>
            <button type="submit">Save Changes</button>
            <button type="button" id="removeCompanyBtn">Remove Company</button>
        </form>
    </div>
</div>

<?php 
// Close the database connection
$conn->close();
?>

<script>
    function searchCompanies() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById('companyList');
        li = ul.getElementsByClassName('list-item');

        for (i = 0; i < li.length; i++) {
            a = li[i].querySelector('.company-info .company-name');
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    function editCompany(companyId) {
        var modal = document.getElementById("editModal");
        modal.style.display = "block";
        
        // Set the data-company-id attribute to the modal content
        var modalContent = document.querySelector('.modal-content');
        modalContent.setAttribute('data-company-id', companyId);

        // You can fetch the company details via AJAX and populate the form fields here
    }

    // Get the modal
    var modal = document.getElementById("editModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    // When the user clicks the remove company button, remove the company
    document.getElementById('removeCompanyBtn').addEventListener('click', function() {
        if (confirm('Are you sure you want to remove this company?')) {
            var companyId = document.querySelector('.modal-content').getAttribute('data-company-id');

            // AJAX request to remove the company
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'remove_company.php?company_id=' + companyId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        // Check if the removal was successful
                        if (xhr.responseText.trim() === 'success') {
                            // Remove the company element from the page
                            document.getElementById('company_' + companyId).remove();
                            alert('Company removed successfully');
                            // Close the modal
                            modal.style.display = "none";
                        } else {
                            alert('Error removing company');
                        }
                    } else {
                        alert('Error: ' + xhr.status);
                    }
                }
            };
            xhr.send();
        }
    });
</script>
