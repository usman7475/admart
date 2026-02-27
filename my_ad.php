<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}

include 'admin/includes/config.php';
include 'navbar.php';

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user's ads with expiry_date and status
$query = "SELECT ads.id, ads.name, ads.phone, ads.title, ads.description, ads.price, ads.brand, 
ads.country, ads.location, ads.image, ads.created_at, ads.expiry_date, 
tblcategory.categoryName 
FROM ads 
INNER JOIN tblcategory ON ads.category_id = tblcategory.id 
WHERE ads.user_id = ? 
ORDER BY ads.created_at DESC";

$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Ads</title>
<link rel="icon" type="image/x-icon" href="admin/images/main_logo.png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" type="text/css" href="styles.css">
<style>
.container {
    margin-top: 120px;
}
.table img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
}
.table th {
    background-color: #012f34;
    color: white;
    text-align: center;
}
.table td {
    vertical-align: middle;
    text-align: center;
}
.status-active {
    color: green;
    font-weight: bold;
}
.status-expired {
    color: red;
    font-weight: bold;
}
</style>
</head>
<body>

<div class="container">
<h3 class="text-center mt-4">
    <strong>
My Ads</strong></h3>

<div class="table-responsive">
<table class="table table-bordered ads-table">
<thead>
<tr>
    <th>Ad-ID</th>
    <th>Image</th>
    <th>Title</th>
    <th>Brand</th>
    <th>Category</th>
    <th>Description</th>
    <th>Price</th>
    <th>Location</th>
    <th>Posted On</th>
    <th>Expiry Date</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php
$current_date = date('Y-m-d'); // Get today's date

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get the first image path
        $imagePaths = explode(',', $row['image']);
        $firstImage = isset($imagePaths[0]) ? $imagePaths[0] : 'default.jpg';

        // Check Status Based on Expiry Date
        $expiry_date = $row['expiry_date'];
        $statusClass = ($expiry_date >= $current_date) ? 'status-active' : 'status-expired';
        $statusText = ($expiry_date >= $current_date) ? 'Active' : 'Expired';

        echo "<tr>
            <td>KK {$row['id']}</td>
            <td><img src='{$firstImage}' alt='Ad Image'></td>
            <td>{$row['title']}</td>
            <td>{$row['brand']}</td>
            <td>{$row['categoryName']}</td>
            <td>{$row['description']}</td>
            <td> {$row['price']}</td>
            <td>{$row['location']}, {$row['country']}</td>
            <td>" . date('d M Y', strtotime($row['created_at'])) . "</td>
            <td>" . date('d M Y', strtotime($row['expiry_date'])) . "</td>
            <td><span class='$statusClass'>$statusText</span></td>
            <td>
                <a href='update_ads.php?id={$row['id']}'><i class='fas fa-edit text-primary'></i></a> |
                <a href='#' onclick='confirmDelete({$row['id']})'><i class='fa fa-trash text-danger'></i></a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='12' class='text-center text-danger'>No ads found.</td></tr>";
}
?>
</tbody>
</table>
</div>
</div>

<?php include 'footer.php'; ?>

<script>
function confirmDelete(ad_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'delete_ad.php?id=' + ad_id;
        }
    });
}
</script>

</body>
</html>
