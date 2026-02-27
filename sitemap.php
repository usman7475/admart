<?php
header("Content-Type: text/xml; charset=utf-8");

include 'admin/includes/config.php';



// XML
echo "<?xml version='1.0' encoding='UTF-8'?>\n";
echo "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>\n";

// Base URL 
$site_url="";

// Static Pag
$static_pages = [
    "index.php" => "1.0",
    "post_ad.php" => "0.8",
    "search.php" => "0.9",
    "category.php" => "0.7",
    "contact_us.php" => "0.6"
];

foreach ($static_pages as $page => $priority) {
    echo "<url>\n";
    echo "<loc>$site_url/$page</loc>\n";
    echo "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
    echo "<changefreq>weekly</changefreq>\n";
    echo "<priority>$priority</priority>\n";
    echo "</url>\n";
}

// Fetch Ads from Database
$query = "SELECT id, title, created_at FROM ads ORDER BY created_at DESC";
$result = $con->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<url>\n";
        echo "<loc>$site_url/view_detail.php?id=" . $row['id'] . "</loc>\n";
        echo "<lastmod>" . date('Y-m-d', strtotime($row['created_at'])) . "</lastmod>\n";
        echo "<changefreq>daily</changefreq>\n";
        echo "<priority>0.8</priority>\n";
        echo "</url>\n";
    }
}

// Close XML and Database Connection
echo "</urlset>\n";
$con->close();
?>
