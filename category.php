<?php
// Include database connection
include 'admin/includes/config.php';

// Check if a category ID is provided via URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
echo "<p class='no-results'>Something went wrong!</p>";
exit;
}

// Sanitize the category ID
$category_id = intval($_GET['id']); // Ensure it's an integer
$current_date = date('Y-m-d'); // Get today's date

// Fetch the category name for the given ID
$category_query = "SELECT categoryName FROM tblcategory WHERE id = ?";
$category_stmt = $con->prepare($category_query);
$category_stmt->bind_param("i", $category_id);
$category_stmt->execute();
$category_result = $category_stmt->get_result();

if ($category_result->num_rows === 0) {
echo "<p class='no-results'>Invalid category ID.</p>";
exit;
}

$category_row = $category_result->fetch_assoc();
$category_name = $category_row['categoryName']; // Get the category name

// Fetch ads that belong to the given category and are not expired
$sql = "SELECT ads.id, ads.title, ads.description, ads.price, ads.brand, 
ads.country, ads.location, ads.image, ads.created_at, ads.expiry_date, 
tblcategory.categoryName 
FROM ads 
INNER JOIN tblcategory ON ads.category_id = tblcategory.id 
WHERE ads.category_id = ? AND ads.expiry_date >= ? 
ORDER BY ads.created_at DESC";

$stmt = $con->prepare($sql);
$stmt->bind_param("is", $category_id, $current_date);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Category - <?php echo htmlspecialchars($category_name); ?></title>
<link rel="icon" type="image/x-icon" href="admin/images/main_logo.png">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="styles.css">
<style>
body {
font-family: 'Roboto', sans-serif;
margin: 0;
padding: 0;
background-color: #f4f4f4;
}
.container {
width: 90%;
max-width: 1200px;
margin: 120px auto;
padding: 20px 0;
}
.section {
background-color: #fff;
padding: 20px;
border-radius: 5px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.section h5 {
margin: 0 0 20px;
font-size: 18px;
color: #333;
}
.items {
display: flex;
flex-wrap: wrap;
gap: 20px;
}
.item {
width: calc(25% - 20px);
background-color: #f9f9f9;
padding: 10px;
border: 1px solid #ddd;
border-radius: 5px;
text-align: center;
}
.item img {
width: 100%;
height: 150px;
object-fit: cover;
border-radius: 5px;
}
.item p {
margin: 10px 0;
font-size: 16px;
color: #333;
}
.item h5 {
margin: 10px 0;
font-size: 14px;
color: #555;
}
.item small {
display: block;
font-size: 12px;
color: #777;
}
.no-results {
text-align: center;
font-size: 14px;
color: #666;
margin: 20px 0;
}
@media (max-width: 768px) {
.item {
width: calc(50% - 20px);
}
}
@media (max-width: 480px) {
.item {
width: 100%;
}
}
</style>
</head>
<body>
<div class="header">
<?php include 'navbar.php'; ?>
</div>

<div class="container">
<div class="section">
<h5><strong>Category:  </strong> <?php echo htmlspecialchars($category_name); ?></h5>
<div class="items">
<?php
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// Get the first image path
$images = explode(',', $row['image']);
$firstImage = isset($images[0]) ? $images[0] : 'default.jpg';

echo "
<div class='item'>
<a href='view_detail.php?id={$row['id']}' style='text-decoration: none; color: inherit;'>
<img src='{$firstImage}' alt='Ad Image'>
<p>Rs. " . number_format($row['price'], 2) . "</p>
<h5>{$row['title']}</h5>
<small>{$row['categoryName']}</small>
<small>{$row['location']}, {$row['country']}</small>
<small>" . date('d M Y', strtotime($row['created_at'])) . "</small>
</a>
</div>";
}
} else {
echo "<p class='no-results'>No results found for   $category_name </p>";
}
?>
</div>
</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>