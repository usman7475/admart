<?php 
session_start();
include_once('includes/config.php');

if(strlen($_SESSION["edmsid"]) == 0) {
header('location:logout.php');
} else {

// For deleting
if(isset($_GET['del'])) {
$nid = $_GET['id'];
$userid = $_SESSION["edmsid"];
mysqli_query($con, "DELETE FROM tblregistration WHERE id='$nid'");
echo "<script>alert('Data Deleted');</script>";
echo "<script>window.location.href='manage-user.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Karaksooq</title>
<link rel="icon" type="image/x-icon" href="images/main_logo.png">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<?php include_once('includes/header.php'); ?>
<div id="layoutSidenav">
<?php include_once('includes/leftbar.php'); ?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
<h1 class="mt-4">Manage Admin</h1>
<ol class="breadcrumb mb-4">
<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
<li class="breadcrumb-item active">Manage Admin</li>
</ol>
<div class="card mb-4">
<div class="card-header">
<i class="fas fa-table me-1"></i>
Admin Details
</div>
<div class="card-body">
<div class="table-responsive">
<table id="datatablesSimple" class="table table-bordered">
<thead>
<tr>
<th>#</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 
$userid = $_SESSION["edmsid"];
$query = mysqli_query($con, "SELECT * FROM tblregistration");
$cnt = 1;
while($row = mysqli_fetch_array($query)) {
?>  
<tr>
<td><?php echo htmlentities($cnt); ?></td>
<td><?php echo htmlentities($row['firstName']); ?></td>
<td><?php echo htmlentities($row['lastName']); ?></td>
<td><?php echo htmlentities($row['emailId']); ?></td>
<td>
<a href="manage-user.php?id=<?php echo $row['id']; ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
</td>
</tr>
<?php 
$cnt++; 
} 
?>
</tbody>
</table>
</div>
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
<?php 
} 
?>
