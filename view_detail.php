<?php include 'navbar.php'; ?>
<?php
// Include database connection
include 'admin/includes/config.php';

// Check if an ad ID is provided via URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
die("Invalid ID.");
}
$ad_id = intval($_GET['id']); // Sanitize the ID

// Fetch the ad data for the given ID
$sql = "SELECT ads.*, tblcategory.categoryName 
FROM ads 
INNER JOIN tblcategory ON ads.category_id = tblcategory.id 
WHERE ads.id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $ad_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
die("No record found.");
}
$ad = $result->fetch_assoc(); // Fetch the ad details
?>

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

<title><?php echo htmlspecialchars($ad['title']); ?></title>
<link rel="icon" type="image/x-icon" href="admin/images/main_logo.png">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
<style>
body {
font-family: 'Roboto', sans-serif;
margin: 0;
padding: 0;
background-color: #f4f4f4 !important;
}
.container {
width: 90%;
max-width: 1200px;
margin: 90px auto;
padding: 20px 0;
}
.header, .footer {
background-color: #fff;
padding: 10px 0;
border-bottom: 1px solid #e0e0e0;
}
.header img {
height: 40px;
}
.header .nav {
display: flex;
align-items: center;
justify-content: space-between;
}
.header .nav a {
text-decoration: none;
color: #333;
margin: 0 10px;
}
.header .nav .search-bar {
flex-grow: 1;
margin: 0 20px;
}
.header .nav .search-bar input {
width: 100%;
padding: 10px;
border: 1px solid #e0e0e0;
border-radius: 5px;
}
.header .nav .user-actions {
display: flex;
align-items: center;
}
.header .nav .user-actions a {
margin: 0 10px;
color: #333;
}
.header .nav .user-actions .sell-btn {
background-color: #ffce32;
padding: 10px 20px;
border-radius: 5px;
color: #fff;
text-decoration: none;
}
.breadcrumb {
font-size: 14px;
color: #666;
margin: 20px 0;
}
.breadcrumb a {
color: #007bff;
text-decoration: none;
}
.breadcrumb a:hover {
text-decoration: underline;
}
.main-content {
display: flex;
flex-wrap: wrap;
gap: 20px;
}
.main-content .left-column, .main-content .right-column {
background-color: #fff;
padding: 20px;
border: 1px solid #e0e0e0;
border-radius: 5px;
}
.main-content .left-column {
flex: 2;
}
.main-content .right-column {
flex: 1;
}
.carousel {
position: relative;
width: 100%;
height: 500px;
overflow: hidden;
border-radius: 5px;
}
.carousel img {
width: 100%;
height: 400px; /* Fixed height */
object-fit: cover; /* Ensures images maintain aspect ratio */
display: none;
}
.carousel img.active {
display: block;
}
.carousel .controls {
position: absolute;
top: 50%;
width: 100%;
display: flex;
justify-content: space-between;
transform: translateY(-50%);
}
.carousel .controls button {
background-color: rgba(0, 0, 0, 0.5);
border: none;
color: #fff;
padding: 10px;
cursor: pointer;
}
.carousel .zoom-icon {
position: absolute;
top: 10px;
right: 10px;
background-color: rgba(0, 0, 0, 0.5);
color: #fff;
padding: 5px 10px;
border-radius: 50%;
cursor: pointer;
}
.main-content .left-column .price {
font-size: 24px;
font-weight: 700;
color: #333;
margin: 20px 0;
}
.main-content .left-column .details, .main-content .left-column .features {
margin: 20px 0;
}
.main-content .left-column .details table, .main-content .left-column .features table {
width: 100%;
border-collapse: collapse;
}
.main-content .left-column .details table th, .main-content .left-column .details table td, .main-content .left-column .features table th, .main-content .left-column .features table td {
padding: 10px;
border: 1px solid #e0e0e0;
text-align: left;
}
.main-content .left-column .description {
margin: 20px 0;
}
.main-content .left-column .description p {
margin: 10px 0;
}
.main-content .right-column .contact {
margin: 20px 0;
}
.main-content .right-column .contact button {
width: 100%;
padding: 10px;
background-color: #007bff;
color: #fff;
border: none;
border-radius: 5px;
cursor: pointer;
}
.main-content .right-column .contact button i {
margin-right: 5px;
}
.main-content .right-column .location {
margin: 20px 0;
}
.main-content .right-column .location p {
margin: 10px 0;
}
.main-content .right-column .location i {
margin-right: 5px;
}
.footer {
text-align: center;
padding: 20px 0;
font-size: 14px;
color: #666;
}
.footer a {
color: #007bff;
text-decoration: none;
}
.footer a:hover {
text-decoration: underline;
}
@media (max-width: 768px) {
.main-content {
flex-direction: column;
}
.main-content .left-column, .main-content .right-column {
flex: 1;
}
}
@media (max-width: 480px) {
.header .nav {
flex-direction: column;
align-items: flex-start;
}
.header .nav .search-bar {
margin: 10px 0;
}
}

/* Full Screen Popup Styles */
.fullscreen-popup {
display: none;
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: rgba(0, 0, 0, 0.9);
z-index: 1000;
justify-content: center;
align-items: center;
}
.fullscreen-popup img {
max-width: 90%;
max-height: 90%;
}
.fullscreen-popup .close-icon {
position: absolute;
top: 20px;
right: 20px;
color: #fff;
font-size: 30px;
cursor: pointer;
}
</style>
</head>
<body>

<div class="container">
<!-- Breadcrumb -->
<div class="breadcrumb">
<a href="index.php">Home</a> &raquo; <a href="category.php?id=<?php echo $ad['category_id']; ?>"><?php echo htmlspecialchars($ad['categoryName']); ?></a> &raquo; <?php echo htmlspecialchars($ad['title']); ?>
</div>
<div class="main-content">
<!-- Left Column -->
<div class="left-column">
<!-- Carousel for Images -->
<div class="carousel">
<?php
$images = explode(',', $ad['image']);
foreach ($images as $index => $image) {
echo "<img src='{$image}' alt='Ad Image' data-index='{$index}'>";
echo "<div class='zoom-icon' onclick='openFullscreen({$index})'><i class='fas fa-search-plus'></i></div>";
}
?>
<div class="controls">
<button id="prev">❮</button>
<button id="next">❯</button>
</div>
</div>
<!-- Price -->
<div class="price">
Rs <?php echo number_format($ad['price'], 2); ?>
</div>
<!-- Details Table -->
<div class="details">
<h2>Details</h2>
<table>
<tr>
<th>Title</th>
<td><?php echo htmlspecialchars($ad['title']); ?></td>
</tr>
<tr>
<th>Category</th>
<td><?php echo htmlspecialchars($ad['categoryName']); ?></td>
</tr>
<tr>
<th>Brand</th>
<td><?php echo htmlspecialchars($ad['brand']); ?></td>
</tr>
<tr>
<th>Country</th>
<td><?php echo htmlspecialchars($ad['country']); ?></td>
</tr>
<tr>
<th>Location</th>
<td><?php echo htmlspecialchars($ad['location']); ?></td>
</tr>
<tr>
<th>Created At</th>
<td><?php echo date('d M Y', strtotime($ad['created_at'])); ?></td>
</tr>
</table>
</div>
<!-- Description -->
<div class="description">
<h2>Description</h2>
<p><?php echo nl2br(htmlspecialchars($ad['description'])); ?></p>
</div>
</div>
<!-- Right Column -->
<div class="right-column">
<!-- Seller Information -->
<div class="contact">
<h2>Seller Information</h2>
<p>Name: <?php echo htmlspecialchars($ad['name']); ?></p>
<p id="phone-number" style="display: none;">Phone: <?php echo htmlspecialchars($ad['phone']); ?></p><br>
<!-- Show/Hide Phone Button -->
<button id="show-phone"><i class="fas fa-phone"></i> Show Phone Number</button>
</div>
<!-- Location Section -->
<div class="location">
<h2>Location</h2>
<p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($ad['location']); ?></p>

<hr>
<p>AD ID: KK<?php echo htmlspecialchars($ad['id']); ?></p>
</div>
</div>
</div>
</div>
<?php include 'footer.php'; ?>

<!-- Full Screen Popup -->
<div class="fullscreen-popup" id="fullscreen-popup">
<img id="fullscreen-image" src="" alt="Fullscreen Image">
<div class="close-icon" onclick="closeFullscreen()">×</div>
</div>

<script>
// Carousel Script
let currentIndex = 0;
const images = document.querySelectorAll('.carousel img');
const totalImages = images.length;

function showImage(index) {
images.forEach((img, i) => {
img.classList.toggle('active', i === index);
});
}

document.getElementById('next').addEventListener('click', () => {
currentIndex = (currentIndex + 1) % totalImages;
showImage(currentIndex);
});

document.getElementById('prev').addEventListener('click', () => {
currentIndex = (currentIndex - 1 + totalImages) % totalImages;
showImage(currentIndex);
});

// Show the first image initially
showImage(currentIndex);

// Show/Hide Phone Number Script
const showPhoneButton = document.getElementById('show-phone');
const phoneNumber = document.getElementById('phone-number');

showPhoneButton.addEventListener('click', () => {
if (phoneNumber.style.display === 'none') {
phoneNumber.style.display = 'block';
showPhoneButton.innerHTML = '<i class="fas fa-phone"></i> Hide Phone Number';
} else {
phoneNumber.style.display = 'none';
showPhoneButton.innerHTML = '<i class="fas fa-phone"></i> Show Phone Number';
}
});

// Full Screen Popup Script
function openFullscreen(index) {
const fullscreenPopup = document.getElementById('fullscreen-popup');
const fullscreenImage = document.getElementById('fullscreen-image');
fullscreenImage.src = images[index].src;
fullscreenPopup.style.display = 'flex';
}

function closeFullscreen() {
const fullscreenPopup = document.getElementById('fullscreen-popup');
fullscreenPopup.style.display = 'none';
}
</script>
</body>
</html>