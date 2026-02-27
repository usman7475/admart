<?php  
session_start();
if (!isset($_SESSION['user_id'])) {
header('location: index.php');
exit();
}

// Include database connection
include 'admin/includes/config.php';
$user_id = $_SESSION['user_id'];

// Check if an ad ID is provided via URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
die("Invalid ID.");
}
$ad_id = intval($_GET['id']);

// Fetch the ad data for the given ID
$sql = "SELECT * FROM ads WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $ad_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
die("No record found.");
}
$ad = $result->fetch_assoc();

// Fetch categories from tblcategory for the select dropdown
$categories = $con->query("SELECT id, categoryName FROM tblcategory");

// --- If the form is submitted, update the record ---
if (isset($_POST['submit'])) {
// Sanitize inputs
$name        = $con->real_escape_string($_POST['name']);
$phone       = $con->real_escape_string($_POST['phone']);
$title       = $con->real_escape_string($_POST['title']);
$description = $con->real_escape_string($_POST['description']);
$price       = $_POST['price'];
$category_id = $_POST['category'];
$brand       = $con->real_escape_string($_POST['brand']);
$country     = $con->real_escape_string($_POST['country']);
$location    = $con->real_escape_string($_POST['location']);
// Get the updated date from the input field (type="date")



// --- Image Upload Handling ---
// Define two variables:
// $upload_dir: the actual folder path (one level behind)
// $db_upload_dir: the folder path to be stored in the database (without "../")
$upload_dir    = "uploads/";    // Actual folder path
$db_upload_dir = "uploads/";        // Path saved in DB

// Get the existing images from the hidden input (this value is updated by JS removals)
$existingStr = isset($_POST['existingImages']) ? $_POST['existingImages'] : $ad['image'];
// Convert to array (filtering out empty strings)
$existingArray = array_filter(explode(",", $existingStr));
$existingCount = count($existingArray);

// Process any new uploads
$newImagePaths = [];
if (!empty($_FILES['images']['name'][0])) {
foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
if (!empty($_FILES['images']['name'][$key])) {
// Generate a unique file name for the image
$image_name = time() . "_" . basename($_FILES['images']['name'][$key]);
$image_path = $upload_dir . $image_name;
if (move_uploaded_file($tmp_name, $image_path)) {
// Store the path with the $db_upload_dir prefix
$newImagePaths[] = $db_upload_dir . $image_name;
}
}
}
}
$newCount = count($newImagePaths);

// Check that the total does not exceed 3 images
$totalImages = $existingCount + $newCount;
if ($totalImages > 3) {
echo "<script>alert('You can upload a maximum of 3 images in total.'); window.history.back();</script>";
exit;
}

// Merge existing and new images
$mergedImages = array_merge($existingArray, $newImagePaths);
$image_str = implode(",", $mergedImages);

// --- City Check ---
$city_check = $con->query("SELECT city FROM cities WHERE country='$country' AND city='$location'");
if ($city_check->num_rows == 0) {
echo "<script>alert('Please select a city from the suggested list!'); window.history.back();</script>";
exit;
}

// --- Update the ad record using a prepared statement ---
$update_sql = "UPDATE ads 
SET name = ?, phone = ?, title = ?, description = ?, price = ?, category_id = ?, brand = ?, country = ?, location = ?, image = ?
WHERE id = ?";
$stmt_update = $con->prepare($update_sql);
if (!$stmt_update) {
die("Prepare failed: " . $con->error);
}
// Bind parameters: "ssssdissssssi"
$stmt_update->bind_param("ssssdissssi", 
$name, 
$phone, 
$title, 
$description, 
$price, 
$category_id, 
$brand, 
$country, 
$location, 
$image_str, 
 $ad_id
);
if ($stmt_update->execute()) {
echo "<script>alert('Ad updated successfully!'); window.location.href='my_ad.php';</script>";
} else {
echo "Error updating record: " . $stmt_update->error;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Karaksooq - UPDATE YOUR AD</title>
<link rel="icon" type="image/x-icon" href="admin/images/main_logo.png">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
/* Basic styles for the form and preview */
.widthset{
    width: 98% !important;
}
.preview-container {
display: flex;
gap: 10px;
flex-wrap: wrap;
margin-top: 10px;
}
.image-preview {
position: relative;
width: 100px;
height: 100px;
border: 1px solid #ddd;
display: flex;
align-items: center;
justify-content: center;
overflow: hidden;
}
.image-preview img {
width: 100%;
height: 100%;
object-fit: cover;
}
.remove-image {
position: absolute;
top: 3px;
right: 3px;
background: red;
color: white;
border: none;
cursor: pointer;
font-size: 14px;
width: 20px;
height: 20px;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
}
body {
font-family: 'Roboto', sans-serif;
background-color: #f5f5f5;
margin: 0;
padding: 0;
}
.container {
max-width: 1200px;
margin: 20px auto;
padding: 20px;
background-color: #fff;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.header {
display: flex;
justify-content: space-between;
align-items: center;
padding-bottom: 20px;
border-bottom: 1px solid #e0e0e0;
}
.header i {
font-size: 24px;
cursor: pointer;
}
.header h1 {
font-size: 24px;
font-weight: 500;
margin: 0;
}
.category {
display: flex;
align-items: center;
margin-bottom: 20px;
}
.category img {
width: 40px;
height: 40px;
margin-right: 10px;
}
.category div {
display: flex;
flex-direction: column;
}
.category div span:first-child {
font-weight: 500;
}
.category div span:last-child {
color: #888;
}
.category a {
margin-left: auto;
color: #007bff;
text-decoration: none;
}
.form-group {
margin-bottom: 20px;
}
.form-group label {
display: block;
font-weight: 500;
margin-bottom: 5px;
}
.form-group input, .form-group textarea, .form-group select  {
width: 100%;
padding: 10px;
border: 1px solid #e0e0e0;
border-radius: 4px;
font-size: 14px;
}
.form-group textarea {
resize: vertical;
}
.form-group .input-group {
display: flex;
align-items: center;
}
.form-group .input-group input {
flex: 1;
}
.form-group .input-group span {
padding: 10px;
background-color: #e0e0e0;
border: 1px solid #e0e0e0;
border-right: 0;
border-radius: 4px 0 0 4px;
}
.upload-images {
display: flex;
flex-wrap: wrap;
gap: 10px;
}
.upload-images .upload-btn, .upload-images .image-placeholder {
width: 60px;
height: 60px;
border: 1px solid #e0e0e0;
border-radius: 4px;
display: flex;
justify-content: center;
align-items: center;
cursor: pointer;
}
.upload-images .upload-btn {
background-color: #f0f0f0;
}
.upload-images .image-placeholder img {
width: 24px;
height: 24px;
}
.help-box {
background-color: #f9f9f9;
padding: 20px;
border: 1px solid #e0e0e0;
border-radius: 4px;
}
.help-box h2 {
font-size: 18px;
font-weight: 500;
margin-top: 0;
}
.help-box ul {
padding-left: 20px;
}
.help-box ul li {
margin-bottom: 10px;
}
.help-box ul li a {
color: #007bff;
text-decoration: none;
}
.form-footer {
display: flex;
justify-content: flex-end;
}
.form-footer button {
padding: 10px 20px;
background: black;
color: white;

border: none;
border-radius: 4px;
cursor: pointer;
font-size: 14px;
border: 1px solid #dddfe2;
}

button:hover{
border: 3px solid #012f34; /* Darker shade on hover */
}
.toggle-switch {
display: flex;
align-items: center;
}
.toggle-switch input {
display: none;
}
.toggle-switch label {
position: relative;
width: 40px;
height: 20px;
background-color: #e0e0e0;
border-radius: 20px;
cursor: pointer;
}
.toggle-switch label::after {
content: '';
position: absolute;
top: 2px;
left: 2px;
width: 16px;
height: 16px;
background-color: #fff;
border-radius: 50%;
transition: 0.3s;
}
.toggle-switch input:checked + label {
background-color: #007bff;
}
.toggle-switch input:checked + label::after {
left: 22px;
}
@media (max-width: 768px) {
.container {
padding: 20px;
margin: 10px;
}
.widthset{
    width: 96% !important;
}
.header h1 {
font-size: 20px;
}
.form-footer {
justify-content: center;
}
}
a{
color: black;
}
.city-suggestions {
margin-top: 5px;
border: 1px solid #ddd;
border-radius: 4px;
max-height: 150px;
overflow-y: auto;
}
.city-suggestions div {
padding: 10px;
cursor: pointer;
border-bottom: 1px solid #ddd;
}
.city-suggestions div:hover {
background-color: #f5f5f5;
}
</style>
</head>
<body>
<div class="container">
<div class="header">
<a href="my_ad.php"><i class="fas fa-arrow-left"></i></a>
<h1>Karaksooq - UPDATE AD</h1>
<i class="fas fa-video"></i>
</div>
<!-- The form is pre-populated with data from the ad record -->
<!-- Hidden input to hold current existing images (paths without "../") -->
<form action="update_ads.php?id=<?= $ad_id ?>" method="POST" enctype="multipart/form-data">
<input type="hidden" name="existingImages" id="existingImages" value="<?= htmlspecialchars($ad['image']); ?>">
<br>
<div class="form-group">
<label>Upload Images (Min: 1, Max: 3)</label>
<div class="upload-images">
<input type="file" name="images[]" class="form-control" id="imageUpload" accept="image/*" multiple>
<div class="preview-container" id="imagePreview"></div>
<div class="image-placeholder">
<img alt="Placeholder Icon" height="24" src="https://storage.googleapis.com/a1aa/image/sgPUTLVtHe_6nEBlndF5qUCP4zmo-dM4VLT8Mb5KDns.jpg" width="24"/>
</div>
</div>
<small>For the cover picture we recommend using the landscape mode.</small>
</div>
<!-- Display existing images with removal option -->
<div class="form-group">
<label>Existing Images</label>
<div class="existing-images" id="existingImagesContainer">
<?php 
$existing = $ad['image'];
if (!empty($existing)) {
$imgs = explode(",", $existing);
foreach ($imgs as $key => $img) {
// Each existing image gets a data attribute containing its path (without "../")
echo '<div class="image-preview" data-img="'.htmlspecialchars($img).'" id="existingImg-'.$key.'">';
echo '<img src="'.htmlspecialchars($img).'" alt="Existing Image">';
echo '<button class="remove-image" onclick="removeExistingImage(this)">×</button>';
echo '</div>';
}
} else {
echo 'No existing images.';
}
?>
</div>
</div>
<div class="form-group">
<label for="brand">Brand*</label>
<div class="input-group">
<span><i class="fas fa-search"></i></span>
<input type="text" name="brand" class="form-control" placeholder="Type here Brand name" required value="<?= htmlspecialchars($ad['brand']); ?>">
</div>
</div>
<div class="form-group">
<label for="ad-title">Ad Title*</label>
<input id="ad-title" name="title" minlength="1" maxlength="70" placeholder="Mention key features (e.g. brand, model)" type="text" 
class="widthset" required value="<?= htmlspecialchars($ad['title']); ?>">
<small>1/70</small>
</div>
<div class="form-group">
<label>Select Category*</label>
<select name="category" class="form-control" required>
<option value="">Select Category</option>
<?php while ($cat = $categories->fetch_assoc()): ?>
<option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $ad['category_id']) ? "selected" : ""; ?>>
<?= $cat['categoryName'] ?>
</option>
<?php endwhile; ?>
</select>
</div>
<div class="form-group">
<label for="description">Description*</label>
<textarea id="description" name="description" 
class="widthset" minlength="1" maxlength="4096" placeholder="Describe the item you're selling" rows="5" required><?= htmlspecialchars($ad['description']); ?></textarea>
<small>Include condition, features and reason for selling</small>
<small>0/4096</small>
</div>
<div class="form-group">
<label>Select Country*</label>
<select name="country" id="country" class="form-control" required>
<option value="">Select Country</option>
<option value="Pakistan" <?= ($ad['country'] == "Pakistan") ? "selected" : ""; ?>>Pakistan</option>
<option value="India" <?= ($ad['country'] == "India") ? "selected" : ""; ?>>India</option>
<option value="United States" <?= ($ad['country'] == "United States") ? "selected" : ""; ?>>United States</option>
<option value="Australia" <?= ($ad['country'] == "Australia") ? "selected" : ""; ?>>Australia</option>
<option value="Canada" <?= ($ad['country'] == "Canada") ? "selected" : ""; ?>>Canada</option>
<option value="United Kingdom" <?= ($ad['country'] == "United Kingdom") ? "selected" : ""; ?>>United Kingdom</option>
<option value="Saudi Arabia" <?= ($ad['country'] == "Saudi Arabia") ? "selected" : ""; ?>>Saudi Arabia</option>
<option value="United Arab Emirates" <?= ($ad['country'] == "United Arab Emirates") ? "selected" : ""; ?>>United Arab Emirates</option>
<option value="Qatar" <?= ($ad['country'] == "Qatar") ? "selected" : ""; ?>>Qatar</option>
<option value="Jordan" <?= ($ad['country'] == "Jordan") ? "selected" : ""; ?>>Jordan</option>
<option value="Egypt" <?= ($ad['country'] == "Egypt") ? "selected" : ""; ?>>Egypt</option>
<option value="Oman" <?= ($ad['country'] == "Oman") ? "selected" : ""; ?>>Oman</option>
<option value="Turkey" <?= ($ad['country'] == "Turkey") ? "selected" : ""; ?>>Turkey</option>
</select>
</div>
<!-- Location with suggestions -->
<div class="form-group">
<label for="location">Location*</label>
<div class="input-group">
<span><i class="fas fa-search"></i></span>
<input id="location" placeholder="Type your City" name="location" type="text" required value="<?= htmlspecialchars($ad['location']); ?>">
</div>
<div id="city-suggestions" class="city-suggestions"></div>
</div>
<div class="form-group">
<label for="price">Price*</label>
<div class="input-group">
<span>Rs</span>
<input id="price" name="price" placeholder="Enter Price" type="number" required value="<?= htmlspecialchars($ad['price']); ?>">
</div>
</div>
<div class="form-group">
<label for="name">Name*</label>
<input type="text" name="name" minlength="5" 
class="widthset" maxlength="15" placeholder="Your Name" required value="<?= htmlspecialchars($ad['name']); ?>">
</div>
<div class="form-group">
<label for="phone-number">Mobile Phone Number*</label>
<div class="input-group">
<input type="number" name="phone" minlength="11" maxlength="15" placeholder="Enter phone number" required value="<?= htmlspecialchars($ad['phone']); ?>">
</div>
</div>


<div class="form-footer">
<button type="submit" name="submit">Update now</button>
</div>
</form>
</div>



<script>
// --- Image Upload & Preview Handling for New Images ---
let selectedFiles = [];
let inputFiles = [];

$("#imageUpload").change(function(e) {
let files = Array.from(e.target.files);
if (selectedFiles.length + files.length > 3) {
alert("You can upload a maximum of 3 images.");
return;
}
files.forEach(file => {
selectedFiles.push(file);
inputFiles.push(file);
});
displayPreview();
updateFileInput();
});

function displayPreview() {
$("#imagePreview").html("");
selectedFiles.forEach((file, index) => {
let reader = new FileReader();
reader.onload = function(e) {
let imgHtml = `
<div class="image-preview" id="img-${index}">
<img src="${e.target.result}">
<button class="remove-image" onclick="removeImage(${index})">&times;</button>
</div>
`;
$("#imagePreview").append(imgHtml);
};
reader.readAsDataURL(file);
});
}

function removeImage(index) {
selectedFiles.splice(index, 1);
inputFiles.splice(index, 1);
displayPreview();
updateFileInput();
}

function updateFileInput() {
let dataTransfer = new DataTransfer();
inputFiles.forEach(file => dataTransfer.items.add(file));
$("#imageUpload")[0].files = dataTransfer.files;
}

// --- Existing Images Removal Handling ---
function removeExistingImage(btn) {
// Get the image-preview container that was clicked
let container = $(btn).closest('.image-preview');
// Get the image path from the data attribute
let imgPath = container.data('img');
// Update the hidden input "existingImages"
let existingStr = $("#existingImages").val();
let existingArray = existingStr ? existingStr.split(",") : [];
// Remove the image that matches the path
existingArray = existingArray.filter(function(val) { return val !== imgPath; });
$("#existingImages").val(existingArray.join(","));
// Remove the DOM element
container.remove();
}

// --- On page load, set data attributes for existing images ---
$(document).ready(function() {
// For each existing image preview, add a data attribute from its img src (strip the "../" prefix)
$(".existing-images .image-preview").each(function() {
let src = $(this).find("img").attr("src");
src = src.replace("../", "");
$(this).attr("data-img", src);
});
});

// --- City Suggestions ---
$("#country").change(function() {
let country = $(this).val();
if (country) {
$.ajax({
url: "fetch_cities.php",
type: "POST",
data: { country: country },
success: function(response) {
$("#city-suggestions").html(response);
}
});
} else {
$("#city-suggestions").html("");
}
});

$("#location").on("input", function() {
let searchTerm = $(this).val().toLowerCase();
$("#city-suggestions div").each(function() {
let city = $(this).text().toLowerCase();
if (city.includes(searchTerm)) {
$(this).show();
} else {
$(this).hide();
}
});
});

$(document).on("click", "#city-suggestions div", function() {
$("#location").val($(this).text());
$("#city-suggestions").html("");
});
</script>
</body>
</html>
