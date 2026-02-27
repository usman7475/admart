<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="title" content="Karaksooq - Buy & Sell Anything Online | Best Classified Ads Platform">
<meta name="description" content="Post free classified ads on Karaksooq. Buy and sell mobiles, electronics, vehicles, property, jobs, fashion, and more. Find the best deals near you!">
<meta name="keywords" content="buy and sell, classified ads, free ads, mobiles for sale, used cars, real estate, jobs, electronics, fashion, OLX alternative, Karaksooq">
<meta name="author" content="Karaksooq">
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="1 days">
<meta name="language" content="English">
<meta name="geo.region" content="PK">
<meta name="geo.placename" content="Pakistan">
<meta name="geo.position" content="30.3753;69.3451">
<meta name="ICBM" content="30.3753, 69.3451">

<!-- Open Graph Meta Tags for Social Media (Facebook, Twitter, WhatsApp) -->
<meta property="og:type" content="website">
<meta property="og:title" content="Karaksooq - Buy & Sell Anything Online | Best Classified Ads Platform">
<meta property="og:description" content="Post free classified ads on Karaksooq and connect with thousands of buyers & sellers. Explore a wide range of categories including mobiles, cars, property, jobs, and more.">
<meta property="og:image" content="https://karaksooq.com/images/main_logo.png">
<meta property="og:url" content="https://karaksooq.com">
<meta property="og:site_name" content="Karaksooq">

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Karaksooq - Buy & Sell Anything Online">
<meta name="twitter:description" content="Find the best deals on mobiles, cars, property, jobs, and more. Post your free ad today!">
<meta name="twitter:image" content="https://karaksooq.com/images/main_logo.png">
<meta name="twitter:site" content="@karaksooq">

<!-- Canonical Tag to Avoid Duplicate Content Issues -->
<link rel="canonical" href="https://karaksooq.com">


<title>karaksooq-Home</title>
<link rel="icon" type="image/x-icon" href="admin/images/main_logo.png">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
<script src="https://kit.fontawesome.com/8a2bdd4e42.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="styles.css">
<style>
h5{
    font-size: 16px !important;
}

</style>
</head>
<body>
<?php include 'navbar.php'; ?>
<script type="text/javascript" src="main.js"></script>
<div class="main_container">
<div class="main-banner">
<img alt="Main Banner" src="admin/images/banner_3.png"/>
</div>
<div class="section">
  <h2>All Categories</h2>
  <div class="categories" id="categories-container">
    <div class="category">
    	<a href="category.php?id=11">
    	<img src="images/mobile.png" alt="Mobiles"/><p>Mobiles</p></a></div>
    <div class="category">
    	<a href="category.php?id=12"><img src="images/animals.png" alt="Animals"/><p>Animals</p></a></div>
    <div class="category">
    	<a href="category.php?id=13"><img src="images/bikes.png" alt="Motor Bikes"/><p>Motor Bikes</p></a></div>
    <div class="category">
    	<a href="category.php?id=15"><img src="images/books.png" alt="Books"/><p>Books</p></a></div>
    <div class="category">
    	<a href="category.php?id=16"><img src="images/camera.png" alt="Electronics"/><p>Electronics</p></a></div>
    <div class="category"><a href="category.php?id=17"><img src="images/clothes.png" alt="Fashion"/><p>Fashion</p></a></div>
    
    <div class="category"><a href="category.php?id=18"><img src="images/furniture.png" alt="Furniture"/><p>Furniture</p></a></div>
    <div class="category"><a href="category.php?id=19"><img src="images/jobs.png" alt="Jobs"/><p>Jobs</p></a></div>
    <div class="category"><a href="category.php?id=20"><img src="images/property_rent.png" alt="Property For Rent"/><p>For Rent</p></a></div>
    <div class="category"><a href="category.php?id=21"><img src="images/kids.png" alt="Toys & Kids"/><p>Toys & Kids</p></a></div>
    <div class="category"><a href="category.php?id=22"><img src="images/property.png" alt="Property"/><p>Property</p></a></div>
    
    <div class="category"><a href="category.php?id=23"><img src="images/services.png" alt="Services"/><p>Services</p></a></div>
    <div class="category"><a href="category.php?id=24"><img src="images/vehicals.png" alt="Vehicles"/><p>Vehicles</p></a></div>
    <div class="load__more"> 
  <button class="show-more-btn" id="show-more-btn">Show More</button>
  </div>
  </div>

</div>


<?php
include 'admin/includes/config.php';

$current_date = date('Y-m-d'); // Get today's date

// Function to fetch ads by category with a limit of 12 ads
function fetchAdsByCategory($con, $category_id, $current_date) {
$query = "SELECT ads.id, ads.name, ads.phone, ads.title, ads.description, ads.price, ads.brand, 
ads.country, ads.location, ads.currency_code,ads.image, ads.created_at, ads.expiry_date, 
tblcategory.categoryName 
FROM ads 
INNER JOIN tblcategory ON ads.category_id = tblcategory.id 
WHERE ads.expiry_date >= ? AND ads.category_id = ?
ORDER BY ads.created_at DESC
LIMIT 12"; // Limit to 12 ads

$stmt = $con->prepare($query);
$stmt->bind_param("si", $current_date, $category_id);
$stmt->execute();
return $stmt->get_result();
}

// Fetch ads for each category
$mobile_ads = fetchAdsByCategory($con, 11, $current_date);
$electronics_ads = fetchAdsByCategory($con, 16, $current_date);
$vehicles_ads = fetchAdsByCategory($con, 24, $current_date);
?>

<div class="section">
<h2>Popular Listing</h2>
<div class="items">
<?php
$query = "SELECT ads.id, ads.name, ads.phone, ads.title, ads.description, ads.price, ads.brand, 
ads.country, ads.location, ads.currency_code, ads.image, ads.created_at, ads.expiry_date, 
tblcategory.categoryName 
FROM ads 
INNER JOIN tblcategory ON ads.category_id = tblcategory.id 
WHERE ads.expiry_date >= ? 
ORDER BY ads.created_at DESC
LIMIT 12"; // Limit to 12 ads

$stmt = $con->prepare($query);
$stmt->bind_param("s", $current_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$imagePaths = explode(',', $row['image']);
$firstImage = isset($imagePaths[0]) ? $imagePaths[0] : 'default.jpg';

echo "
<div class='item'>
<a href='view_detail.php?id={$row['id']}' >
<img src='{$firstImage}' alt='Ad Image'>
<p> {$row['currency_code']}

" . number_format($row['price'], 2) . "</p>
<h5>{$row['title']}</h5><br>
{$row['location']}, {$row['country']}<br>
" . date('d M Y', strtotime($row['created_at'])) . "
</a>
</div>";
}
} else {
echo "<p>No active listings available.</p>";
}
?>
</div>
</div>

<div class="section">
<h2>Mobiles</h2>
<div class="items">
<?php
if ($mobile_ads->num_rows > 0) {
while ($row = $mobile_ads->fetch_assoc()) {
$imagePaths = explode(',', $row['image']);
$firstImage = isset($imagePaths[0]) ? $imagePaths[0] : 'default.jpg';

echo "
<div class='item'>
<a href='view_detail.php?id={$row['id']}' >
<img src='{$firstImage}' alt='Ad Image'>
<p>{$row['currency_code']}
" . number_format($row['price'], 2) . "</p>
<h5>{$row['title']}</h5><br>
{$row['location']}, {$row['country']}<br>
" . date('d M Y', strtotime($row['created_at'])) . "
</a>
</div>";
}
} else {
echo "<p>No active listings available for Mobile.</p>";
}
?>
</div>
</div>

<div class="sale">
<div class="banner-text">
<p id="typing-text"></p>
</div>
<img alt="Main sale" src="admin/images/banner_6.png"/>
</div>

<div class="section">
<h2>Electronics</h2>
<div class="items">
<?php
if ($electronics_ads->num_rows > 0) {
while ($row = $electronics_ads->fetch_assoc()) {
$imagePaths = explode(',', $row['image']);
$firstImage = isset($imagePaths[0]) ? $imagePaths[0] : 'default.jpg';

echo "
<div class='item'>
<a href='view_detail.php?id={$row['id']}' >
<img src='{$firstImage}' alt='Ad Image'>
<p>{$row['currency_code']}
 " . number_format($row['price'], 2) . "</p>
<h5>{$row['title']}</h5><br>
{$row['location']}, {$row['country']}<br>
" . date('d M Y', strtotime($row['created_at'])) . "
</a>
</div>";
}
} else {
echo "<p>No active listings available for Electronics.</p>";
}
?>
</div>
</div>

<div class="section">
<h2>Vehicles</h2>
<div class="items">
<?php
if ($vehicles_ads->num_rows > 0) {
while ($row = $vehicles_ads->fetch_assoc()) {
$imagePaths = explode(',', $row['image']);
$firstImage = isset($imagePaths[0]) ? $imagePaths[0] : 'default.jpg';

echo "
<div class='item'>
<a href='view_detail.php?id={$row['id']}' >
<img src='{$firstImage}' alt='Ad Image'>
<p> {$row['currency_code']}
 " . number_format($row['price'], 2) . "</p>
<h5>{$row['title']}</h5><br>
{$row['location']}, {$row['country']}<br>
" . date('d M Y', strtotime($row['created_at'])) . "
</a>
</div>";
}
} else {
echo "<p>No active listings available for Vehicles.</p>";
}
?>
</div>
</div>

</div>
<?php include 'footer.php'; ?>
</body>
</html>