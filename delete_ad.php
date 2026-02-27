<?php
include 'admin/includes/config.php';

if (isset($_GET['id'])) {
    $ad_id = intval($_GET['id']);

    // Prepare delete query
    $query = "DELETE FROM ads WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $ad_id);

    if ($stmt->execute()) {
        echo "<script>
            
            window.location.href = 'my_ad.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to delete the ad.');
            window.location.href = 'my_ads.php';
        </script>";
    }
    $stmt->close();
} else {
    echo "<script>
        alert('Invalid request!');
        window.location.href = 'my_ads.php';
    </script>";
}
?>
