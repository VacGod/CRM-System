<?php 
// Include the header file
include 'header.php'; 
include 'db_connection.php'; 

// Remove company logic here, moved up for better flow control
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['company_id'])) {
    $company_id = filter_input(INPUT_GET, 'company_id', FILTER_SANITIZE_NUMBER_INT);
    $stmt = $conn->prepare("DELETE FROM bedrift WHERE bedriftid = ?");
    $stmt->bind_param("i", $company_id);

    if ($stmt->execute()) {
        echo "<script>alert('Company removed successfully');</script>";
    } 
    $stmt->close();
}
?>

<link rel="stylesheet" href="styles.css">
<script defer src="script.js"></script>

<div class="container">
    <h1>Search</h1>
    <div class="search-container">
        <input type="text" class="search-input" id="searchInput" onkeyup="searchCompanies()" placeholder="Search for companies...">
    </div>
    <div class="company-list" id="companyList">
        <?php
        $result = $conn->query("SELECT bedriftid, bedriftnavn FROM bedrift");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='list-item' id='company_" . $row["bedriftid"] . "'>";
                echo "<div class='company-info'>";
                echo "<span class='company-name'>" . htmlspecialchars($row["bedriftnavn"]) . "</span>";
                echo " - ID: " . $row["bedriftid"];
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No companies found.";
        }
        ?>
    </div>
</div>

<script>
    function searchCompanies() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toUpperCase();
        let companyList = document.getElementById('companyList');
        let items = companyList.getElementsByClassName('list-item');

        for (let i = 0; i < items.length; i++) {
            let name = items[i].querySelector('.company-info .company-name').textContent;
            if (name.toUpperCase().indexOf(filter) > -1) {
                items[i].style.display = "";
            } else {
                items[i].style.display = "none";
            }
        }
    }
</script>

<?php $conn->close(); ?>
