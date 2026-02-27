<?php

include 'admin/includes/config.php';

$success_message = "";
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
     $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if email already exists
        $sql_check_email = "SELECT * FROM customer WHERE email = ?";
        $stmt_check_email = $con->prepare($sql_check_email);
        $stmt_check_email->bind_param("s", $email);
        $stmt_check_email->execute();
        $result_email = $stmt_check_email->get_result();

        // Check if phone number already exists
        $sql_check_phone = "SELECT * FROM customer WHERE phone = ?";
        $stmt_check_phone = $con->prepare($sql_check_phone);
        $stmt_check_phone->bind_param("s", $phone);
        $stmt_check_phone->execute();
        $result_phone = $stmt_check_phone->get_result();

        if ($result_email->num_rows > 0) {
            $error_message = "Email already exists!";
        } elseif ($result_phone->num_rows > 0) {
            $error_message = "Phone number already exists!";
        } else {
            // Insert new user
            $sql = "INSERT INTO customer (name,email, phone, password, created_at) VALUES (?,?, ?, ?, NOW())";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssss",$name, $email, $phone, $hashed_password);

            if ($stmt->execute()) {
                $success_message = "Successfully signed up!";
            } else {
                $error_message = "Error: " . $con->error;
            }
        }
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

    <title>Karaksooq-Sign Up</title>
    <link rel="icon" type="image/x-icon" href="admin/images/main_logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
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
            gap: 70px;
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
        .right input {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 16px;
        }
        .error {
            border: 2px solid red !important;
        }
        .error-message {
            color: red;
            font-size: 14px;
        }
         .main_logo img{
            
      width: 250px;
      height: 90px;
    
        }
        .right button {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            border: 1px solid #dddfe2;
        }
        .login-btn {
           background: black;
           color: white;
           border: 2px solid #012f34;
        }
        .create-btn {
            background: none;
            color: #012f34;
        }
        .login-btn:hover, .create-btn:hover {
            border: 3px solid #012f34;
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
        }
        .popup {
            display: <?php echo $success_message ? 'block' : 'none'; ?>;
            position: fixed;
            top: 10%;
            left: 50%;
    transform: translate(-10%, -50%);
            background: #28a745;
            color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .popuperror{

             display: <?php echo $error_message ? 'block' : 'none'; ?>;
            position: fixed;
            top: 10%;
            left: 50%;
    transform: translate(-10%, -50%);
            background: red;
            color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);

        }
        .popup .close {
            cursor: pointer;
            font-size: 20px;
            float: right;
            margin-left: 10px;
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

<?php if ($success_message): ?>
    <div class="popup">
        <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
        <?php echo $success_message; ?>
    </div>
<?php endif; ?>



<?php if ($error_message): ?>
    <div class="popuperror">
        <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>

<div class="container" style="margin-bottom: 100px !important;">
    <div class="left">
        <div class="main_logo">
           <a href="index.php">
          <img alt="Logo" src="admin/images/main_logo9.png" /></a>
        </div>
        <p>karaksooq helps you to Sale everything.</p>
    </div>
    <div class="right">
        <form id="signupForm" method="POST">
              <input type="text" name="name" minlength="5" maxlength="15" placeholder="Your name">

            <input type="email" name="email" placeholder="Email address">
            <span class="error-message" id="emailError"><?php echo $error_message == 'Email already exists!' ? $error_message : ''; ?></span>

            <input type="number" name="phone" placeholder="Phone number">
            <span class="error-message" id="phoneError"><?php echo $error_message == 'Phone number already exists!' ? $error_message : ''; ?></span>

            <input type="password" name="password" minlength="5" maxlength="8" placeholder="Password" required>
            <span class="error-message" id="passwordError"></span>

            <input type="password" name="confirm_password" minlength="5" maxlength="8" placeholder="Confirm Password" required>
            <span class="error-message" id="confirmPasswordError"></span>

            <button type="submit" class="login-btn">Sign up</button>
        </form>
        <hr style="margin: 15px 0;">
        <p>Already have an account?</p>
        <a href="login.php">
            <button class="create-btn">Sign in</button>
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
document.getElementById("signupForm").addEventListener("submit", function(event) {
    let isValid = true;

    const email = document.querySelector("[name='email']");
    const phone = document.querySelector("[name='phone']");
    const password = document.querySelector("[name='password']");
    const confirmPassword = document.querySelector("[name='confirm_password']");

    if (!email.value.includes("@")) {
        email.classList.add("error");
        document.getElementById("emailError").innerText = "Invalid email";
        isValid = false;
    }
    if (phone.value.length < 11 || phone.value.length > 15) {
        phone.classList.add("error");
        document.getElementById("phoneError").innerText = "Phone must be 11-15 digits";
        isValid = false;
    }
    if (password.value !== confirmPassword.value) {
        confirmPassword.classList.add("error");
        document.getElementById("confirmPasswordError").innerText = "Passwords do not match";
        isValid = false;
    }

    if (!isValid) event.preventDefault();
});
</script>

</body>
</html>
