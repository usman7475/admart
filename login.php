<?php
session_start();
include 'admin/includes/config.php'; // Include your database connection file

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailOrPhone = $_POST['emailOrPhone']; // Capture either email or phone input
    $password = $_POST['password'];

    // Check if email/phone and password are not empty
    if (!empty($emailOrPhone) && !empty($password)) {
        // Query the database to check user credentials (search by either email or phone)
        $query = "SELECT * FROM customer WHERE email = ? OR phone = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ss', $emailOrPhone, $emailOrPhone); // Bind email/phone to both parameters
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Check if user exists and password matches
        if ($user && password_verify($password, $user['password'])) {
            // Start the session and store user information
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_phone'] = $user['phone'];

            // Redirect to main page
            header('Location: index.php');
            exit();
        } else {
            // Incorrect credentials
            $error_message = "Invalid Email, Phone, or Password!";
        }
    } else {
        $error_message = "Both fields are required.";
    }
}
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

    <title>Karaksooq-Login</title>
    <link rel="icon" type="image/x-icon" href="admin/images/main_logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Add your existing styles here */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 850px;
            padding: 1px;
            flex-wrap: wrap;
            gap: 70px; /* Added gap to create space between left and right sections */
        }
        .left {
            flex: 1;
            min-width: 300px;
            text-align: center;
        }
        .left h1 {
            color: #1877f2;
            font-size: 48px;
            margin: 0;
        }
        .left p {
            font-size: 24px;
            color: #1c1e21;
        }
        .right {
            flex: 1;
            min-width: 340px;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 8px 8px rgba(0, 0, 0, 0.3);
            margin: 20px 20px;
        }
        .right input[type="text"],
        .right input[type="password"] {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 16px;
        }
        .right button {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        .right .login-btn {
            background: black;
            color: white;
            border: 2px solid #012f34;
        }
        .right .create-btn {
            background: none;
          border: 1px solid #dddfe2;
          color: #012f34;
           
        }
        .login-btn:hover {
            border: 3px solid #012f34; /* Darker shade on hover */
        }
        .create-btn:hover {
            border: 3px solid #012f34; /* Darker shade on hover */
        }
        .right a {
            display: block;
            text-align: center;
            color: #1877f2;
            text-decoration: none;
            margin: 10px 0;
        }
        .b_footer {
            text-align: center;
            font-size: 18px;
            color: #1c1e21;
            margin-top: 30px;
            margin-bottom: 120px;
        }
        .main_logo img {
            width: 250px;
            height: 90px;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .left, .right {
                max-width: 100%;
                flex: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="main_logo">
                <a href="index.php">
                <img alt="Logo" src="admin/images/main_logo9.png" /></a>
            </div>
            <p>karaksooq helps you to Sale everything.</p>
        </div>
        <div class="right">
            <!-- Display error message if any -->
            <?php if (isset($error_message)): ?>
                <div style="color: red; font-size: 16px; margin-bottom: 10px;">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <!-- Login Form -->
            <form method="POST" action="">
                <input type="text" name="emailOrPhone" placeholder="Email address or phone number" required>
                <input type="password" name="password" placeholder="Password" required>
                <button class="login-btn" type="submit">Log in</button>
            </form>
            <hr style="margin: 15px 0;">
            <a href="signup.php">
                <button class="create-btn">Create new account</button>
            </a>
        </div>
    </div>

    <!-- Small Footer Below Login Form -->
    <div class="b_footer">
        <p><strong> Sell Anything,</strong> Anytime with Karaksooq! </p>
    </div>

    <!-- Footer Include -->
    <?php include 'footer.php'; ?>
</body>
</html>
