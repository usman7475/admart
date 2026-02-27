<?php
include 'admin/includes/config.php';
include 'navbar.php';

// Define success message variable
$success_message = "";

// Initialize form data variables
$full_name = $email = $enquiry_type = $enquiry = $mobile = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$full_name = trim($_POST['full-name']);
$email = trim($_POST['email']);
$enquiry_type = trim($_POST['enquiry-type']);
$enquiry = trim($_POST['enquiry']);
$mobile = trim($_POST['mobile'] ?? '');

// Validate that a valid enquiry type is selected
if ($enquiry_type === 'Select') {
$success_message = "Please select a valid enquiry type.";
} else {
// Insert data into the database
$sql = "INSERT INTO enquiries (full_name, email, enquiry_type, enquiry, mobile) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssss", $full_name, $email, $enquiry_type, $enquiry, $mobile);

if ($stmt->execute()) {
// Clear form data after successful submission
$full_name = $email = $enquiry_type = $enquiry = $mobile = "";
$success_message = "Your message has been sent successfully.";
} else {
$success_message = "There was an error processing your request. Please try again.";
}

$stmt->close();
}
}

$con->close();
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

<title>Contact Us</title>
<link rel="icon" type="image/x-icon" href="admin/images/main_logo.png">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
<style>
body {
font-family: 'Roboto', sans-serif;
background-color: #f5f5f5;
margin: 0;
padding: 0;
}
.container {
margin-top: 200px !important;
margin: 50px auto;
max-width: 600px;
padding: 20px;
background-color: #e8f0e8;
border-radius: 5px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
h1 {
font-size: 24px;
color: #2c2c2c;
}
p {
font-size: 14px;
color: #666;
}
label {
display: block;
margin-top: 15px;
font-weight: bold;
color: #2c2c2c;
}
input[type="text"], input[type="email"], select, textarea {
width: 100%;
padding: 10px;
margin-top: 5px;
border: 1px solid #ccc;
border-radius: 4px;
box-sizing: border-box;
}
textarea {
height: 100px;
}
.info-text {
font-size: 12px;
color: #666;
margin-top: 5px;
}
.data-protection {
font-size: 12px;
color: #666;
margin-top: 20px;
}
.submit-btn {
display: block;
width: 100%;
padding: 10px;
background-color: #2c2c2c;
color: #fff;
border: none;
border-radius: 4px;
font-size: 16px;
cursor: pointer;
margin-top: 20px;
}
.submit-btn:hover {
background-color: #444;
}
.success-message {
color: green;
font-weight: bold;
margin-bottom: 15px;
}
.error-message {
color: red;
font-weight: bold;
margin-bottom: 15px;
}
.line{
    position: absolute;
 background-color: #ffc107;    
  /*  background-color: #23085a;*/
    width: 45px;
    height: 4px;   
}
</style>
</head>
<body>
<div class="container">
<h1 >Send a Message</h1>
<hr class="line"><br>
<p>If you would like to contact us, please provide your personal details and details of your request.</p>
<p>All the fields marked with an asterisk are mandatory.</p>

<?php if (!empty($success_message)): ?>
<div class="<?= strpos($success_message, 'successfully') !== false ? 'success-message' : 'error-message' ?>">
<?= htmlspecialchars($success_message) ?>
</div>
<?php endif; ?>

<form method="POST" action="">
<label for="full-name">* Full name</label>
<input id="full-name" name="full-name" required type="text" value="<?= htmlspecialchars($full_name) ?>" />

<label for="email">* Email address</label>
<input id="email" name="email" required type="email" value="<?= htmlspecialchars($email) ?>" />

<label for="enquiry-type">* What is your enquiry about?</label>
<select id="enquiry-type" name="enquiry-type" required>
<option value="Select" <?= $enquiry_type === 'Select' ? 'selected' : '' ?>>Select</option>
<option value="Ads" <?= $enquiry_type === 'Ads' ? 'selected' : '' ?>>Ads</option>
<option value="Validity" <?= $enquiry_type === 'Validity' ? 'selected' : '' ?>>Validity</option>
<option value="General" <?= $enquiry_type === 'General' ? 'selected' : '' ?>>General</option>
</select>

<label for="enquiry">* Enquiry</label>
<textarea id="enquiry" name="enquiry" required><?= htmlspecialchars($enquiry) ?></textarea>

<label for="mobile">Mobile</label>
<input id="mobile" name="mobile" type="text" value="<?= htmlspecialchars($mobile) ?>" />
<p class="data-protection">
We collect your personal data to facilitate the processing of your ad submission, including contacting you to manage your ad details or respond to related inquiries. Your data will remain confidential and will not be shared with any third parties. By submitting your ad, you consent to us processing your personal information for these purposes.
</p>
<p class="data-protection">
<strong>Data Protection</strong><br />
We comply with applicable data protection laws to ensure your information is handled securely and responsibly. You have the right to request a copy of the data we hold about you and to ask for corrections if there are any inaccuracies. If you have concerns about how your personal information has been used, you also have the right to file a complaint with a privacy regulator.
</p>
<button class="submit-btn" type="submit">Submit</button>
</form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>