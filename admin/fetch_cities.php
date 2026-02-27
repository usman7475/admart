<?php
// Database connection
include 'admin/includes/config.php';

if (isset($_POST['country'])) {
    $country = $con->real_escape_string($_POST['country']);

    // Fetch cities from the database based on the selected country
    $query = "SELECT city FROM cities WHERE country = '$country'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>" . $row['city'] . "</div>";
        }
    } else {
        echo "<div>No cities found for this country.</div>";
    }
}
?>