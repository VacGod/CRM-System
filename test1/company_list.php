<?php include 'header.php'; ?>

<div class="container">
    <h1>Customer Management</h1>

    <!-- Search and filter -->
    <div class="search-container">
        <input type="text" class="search-input" id="searchInput" onkeyup="searchCompanies()" placeholder="Search for companies...">
        <select class="filter-select" id="filterSelect" onchange="filterCompanies()">
            <option value="all">All</option>
            <option value="alphabetical">Alphabetical</option>
            <option value="size">Size</option>
            <!-- Add more filter options as needed -->
        </select>
    </div>

    <!-- List of existing companies -->
    <div class="customer-list" id="customerList">
        <h2>Company List</h2>
        <?php 
        // Include the database connection file
        include 'db_connection.php';

        // Retrieve and display the list of companies
        $sql = "SELECT bedriftid, bedriftnavn FROM bedrift";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='list-item'>";
                echo "<strong>" . $row["bedriftnavn"] . "</strong><br>";
                echo "<strong>ID: </strong>" . $row["bedriftid"] . "<br>";
                // Add any other details you want to display
                echo "</div>";
            }
        } else {
            echo "No companies found";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>

<script>
    function searchCompanies() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById('customerList');
        li = ul.getElementsByClassName('list-item');

        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("strong")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>




<?php include 'footer.php'; ?>
