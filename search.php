<?php
// Include database connection
include 'admin/includes/config.php';

// Check if a search query is provided via URL
if (!isset($_GET['search']) || empty($_GET['search'])) {
    echo "<p class='no-results'>Please enter a search query.</p>";
    exit;
}

// Sanitize the search query
$search_query = trim($_GET['search']);
$current_date = date('Y-m-d'); // Get today's date

// Fetch ads that match the search query and are not expired
$sql = "SELECT ads.id, ads.title, ads.description, ads.price, ads.brand, 
               ads.country, ads.location, ads.image, ads.created_at, ads.expiry_date, 
               tblcategory.categoryName 
        FROM ads 
        INNER JOIN tblcategory ON ads.category_id = tblcategory.id 
        WHERE (ads.title LIKE ? OR ads.description LIKE ? OR ads.brand LIKE ? OR ads.location LIKE ? OR tblcategory.categoryName LIKE ?) 
        AND ads.expiry_date >= ? 
        ORDER BY ads.created_at DESC";

$stmt = $con->prepare($sql);
$search_param = "%{$search_query}%";
$stmt->bind_param("ssssss", $search_param, $search_param, $search_param, $search_param, $search_param, $current_date);
$stmt->execute();
$result = $stmt->get_result();
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

    <title>Search Results</title>
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
            <h5>Search Results for: <?php echo htmlspecialchars($search_query); ?></h5>
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
                    echo "<p class='no-results'>No results found for: " . htmlspecialchars($search_query) . "</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>