<?php
session_start();
include_once('includes/config.php');
if(strlen($_SESSION["edmsid"])==0)
{   
header('location:logout.php');
} else {

if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$emailid=$_POST['email'];

$npwd=md5($_POST['password']);
$ret=mysqli_query($con,"select id from tblregistration where emailId='$emailid' ");
$count=mysqli_num_rows($ret);
if($count==0){
$query=mysqli_query($con,"insert into tblregistration(firstName,lastName,emailId,userPassword) values('$fname','$lname','$emailid','$npwd')");
if($query){
echo "<script>alert('New User Added Successfully!');</script>"; 
echo "<script>window.location.href ='add-user.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>"; 
echo "<script>window.location.href ='add-user.php'</script>";
}} else {
echo "<script>alert('Email Id already registered.Please try again.');</script>"; 
echo "<script>window.location.href ='add-user.php'</script>";
}
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
<body>
<?php include_once('includes/header.php'); ?>
<div id="layoutSidenav">
<?php include_once('includes/leftbar.php'); ?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
<h1 class="mt-4">Add Admin</h1>
<ol class="breadcrumb mb-4">
<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
<li class="breadcrumb-item active">Add Admin</li>
</ol>
<div class="card mb-4">
<div class="card-body">
<form method="post" >
<div class="row mb-3">
<label for="cpass" class="col-md-2 col-form-label">First Name</label>
<div class="col-md-6">
<input type="text" class="form-control"  name="fname" required="required">
</div>
</div>
<div class="row mb-3">
<label for="cpass" class="col-md-2 col-form-label">Last Name</label>
<div class="col-md-6">
<input type="text" class="form-control"  name="lname" required="required">
</div>
</div>
<div class="row mb-3">
<label  class="col-md-2 col-form-label">Email</label>
<div class="col-md-6">
<input type="email" class="form-control"  name="email" required="required">
</div>
</div>
<div class="row mb-3">
<label for="newpass" class="col-md-2 col-form-label">Password</label>
<div class="col-md-6">
<input type="password" class="form-control"  name="password" required>
</div>
</div>

<div class="row">
<div class="col-md-8 text-center">
<input type="submit" style="float: right;" name="submit" class="btn btn-primary" value="Submit">
</div>
</div>
</form>
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
<?php } ?>
