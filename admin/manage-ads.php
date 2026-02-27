<?php
session_start();
include_once('includes/config.php');

// Check if user is logged in
if (strlen($_SESSION["edmsid"]) == 0) {
header('location:logout.php');
exit;
}

// For deleting an ad
if (isset($_GET['del']) && isset($_GET['id'])) {
$catid = intval($_GET['id']); // Prevent SQL Injection
mysqli_query($con, "DELETE FROM ads WHERE id ='$catid'");
echo "<script>alert('Ad Deleted Successfully!');</script>";
echo "<script>window.location.href='manage-ads.php'</script>";
exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Manage Ads - Karaksooq</title>
<link rel="icon" type="image/x-icon" href="images/main_logo.png">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<style>
/* Custom CSS for Table */
table {
width: 100%;
border-collapse: collapse;
}

th,
td {
padding: 12px;
text-align: left;
border-bottom: 1px solid #ddd;
}

th {
background-color: #f8f9fa;
font-weight: bold;
}

td img {
max-width: 80px;
height: auto;
}

/* Responsive Table */
@media (max-width: 768px) {
table {
display: block;
overflow-x: auto;
white-space: nowrap;
}

th,
td {
min-width: 150px; /* Adjust as needed */
}
}
</style>
</head>

<body class="sb-nav-fixed">
<?php include_once('includes/header.php'); ?>
<div id="layoutSidenav">
<?php include_once('includes/leftbar.php'); ?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
<h1 class="mt-4">Manage Ads</h1>
<ol class="breadcrumb mb-4">
<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
<li class="breadcrumb-item active">Manage Ads</li>
</ol>
<div class="card mb-4">
<div class="card-header">
<i class="fas fa-table me-1"></i>
Ads Details
</div>
<div class="card-body">
<table id="datatablesSimple">
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
<th>Expiry</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$query = "SELECT ads.id, ads.name, ads.phone, ads.title, ads.description, ads.price, 
ads.brand, ads.country, ads.location, ads.image, ads.created_at, ads.expiry_date, 
tblcategory.categoryName 
FROM ads 
INNER JOIN tblcategory ON ads.category_id = tblcategory.id 
ORDER BY ads.created_at DESC";

$result = $con->query($query);

if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// Get the first image path
$imagePaths = explode(',', $row['image']); // Split by commas
$firstImage = isset($imagePaths[0]) ? $imagePaths[0] : 'default.jpg'; // Use 'default.jpg' if no image exists

// Check Expiry Status
$currentDate = date('Y-m-d'); // Get today's date
$expiryDate = $row['expiry_date']; // Get expiry date from DB
$status = ($expiryDate >= $currentDate) ? "<span class='text-success fw-bold'>Active</span>" : "<span class='text-danger fw-bold'>Expired</span>";

echo "<tr>
<td>KK {$row['id']}</td>
<td><img src='../$firstImage' width='80' height='80' alt='Ad Image'></td>
<td>{$row['title']}</td>
<td>{$row['brand']}</td>
<td>{$row['categoryName']}</td>
<td>{$row['description']}</td>
<td>{$row['price']}</td>
<td>{$row['location']}, {$row['country']}</td>
<td>" . date('d M Y', strtotime($row['created_at'])) . "</td>
<td>" . date('d M Y', strtotime($row['expiry_date'])) . "</td>
<td>{$status}</td>
<td>
<a href='edit-ad.php?id={$row['id']}'><i class='fas fa-edit text-primary'></i></a> | 
<a href='manage-ads.php?id={$row['id']}&del=delete' onClick='return confirm(\"Are you sure you want to delete?\")'>
<i class='fa fa-trash text-danger' aria-hidden='true'></i>
</a>
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
</div>
</main>
<?php include_once('includes/footer.php'); ?>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>