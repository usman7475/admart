<div id="layoutSidenav_nav">
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
<div class="sb-sidenav-menu">
<div class="nav">
<div class="sb-sidenav-menu-heading">Core</div>
<a class="nav-link" href="dashboard.php">
<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
Dashboard
</a>
<a class="nav-link" href="messages.php">
<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
Messages
</a>
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomer" aria-expanded="false" aria-controls="collapseCustomer">
<div class="sb-nav-link-icon"> <i class="fas fa-folder-open "></i></div>
Category Section
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>

<div class="collapse" id="collapseCustomer" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link" href="add-category.php">Add </a>
<a class="nav-link" href="manage-categories.php">Manage </a>

</nav>
</div>



<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomer3" aria-expanded="false" aria-controls="collapseCustomer">
<div class="sb-nav-link-icon"> <i class="fas fa-folder-open "></i></div>
Ads Section
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>

<div class="collapse" id="collapseCustomer3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<!-- <a class="nav-link" href="adds.php">Add Ads</a> -->
<a class="nav-link" href="manage-ads.php">Manage Ads</a>

</nav>
</div>



<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomer2" aria-expanded="false" aria-controls="collapseCustomer2">
<div class="sb-nav-link-icon"><i class="fas fa-user "></i></div>
Customer Section
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseCustomer2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link" href="add-notes.php">Add </a>
<a class="nav-link" href="manage-notes.php">Manage </a>

</nav>
</div>






<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin">
<div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
Admin Section
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseAdmin" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link" href="add-user.php">Add </a>
<a class="nav-link" href="manage-user.php">Manage </a>
</nav>
</div>


<div class="sb-sidenav-menu-heading">Profile Setting</div>
<a class="nav-link" href="my-profile.php">
<div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
My Profile
</a>
<a class="nav-link" href="change-password.php">
<div class="sb-nav-link-icon"><i class="fa fa-cog"></i></div>
Change Password
</a>
  <a class="nav-link" href="logout.php">
            <div class="sb-nav-link-icon"><i class="fa fa-sign-out"></i></div>
         Logout
        </a>





</div>
</div>
<?php
$id = intval($_SESSION["edmsid"]);
$query = mysqli_query($con, "select * from tblregistration where id='$id'");
while($row = mysqli_fetch_array($query)) {
$fullname = $row['firstName']." ".$row['lastName'];
}
?>

<div class="sb-sidenav-footer">
<div class="small">Logged in as:</div>
<?php echo $fullname?>
</div>
</nav>
</div>
