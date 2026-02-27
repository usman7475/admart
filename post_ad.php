<?php
session_start();

if (!isset($_SESSION['user_id'])) {         // Condition Check: if session is not set.
    header('location: login.php');         // If not set, the user is sent back to the login page.
}

// Database connection
include 'admin/includes/config.php';

// Fetch categories from tblcategory
$categories = $con->query("SELECT id, categoryName FROM tblcategory");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Karaksooq - Post Your Ad</title>
    <link rel="icon" type="image/x-icon" href="admin/images/main_logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
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
        .form-group input, .form-group textarea, .form-group select {
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
        .cross:hover{
           border: 1px solid red;
        }
  </style>
 </head>
 <body>
  <div class="container">
   <div class="header">
    <a href="index.php">
    <i class="fas fa-arrow-left">
    </i>
</a>
    <h1>
     Karaksooq-POST YOUR AD
    </h1>
    <i class="fas fa-video">
    </i>
   </div>

   <div class="form-group">

<form action="post_ad.php" method="POST" enctype="multipart/form-data">
<br>
    <label>
     Upload Images (Min: 1, Max: 3)
    </label>
    <div class="upload-images">
    <input type="file" name="images[]" class="form-control" id="imageUpload" accept="image/*" multiple required>
            <div class="preview-container" id="imagePreview"></div>
     <div class="image-placeholder">
      <img alt="Placeholder Icon" height="24" src="https://storage.googleapis.com/a1aa/image/sgPUTLVtHe_6nEBlndF5qUCP4zmo-dM4VLT8Mb5KDns.jpg" width="24"/>
     </div>
     
    </div>
    <small>
     For the cover picture we recommend using the landscape mode.
    </small>
   </div>
   <div class="form-group">
    <label for="brand">
     Brand*
    </label>
    <div class="input-group">
     <span>
      <i class="fas fa-search">
      </i>
     </span>
   <input type="text" name="brand" class="form-control" placeholder="Type here Brand name" required>
    </div>
   </div>
   <div class="form-group">
    <label for="ad-title">
     Ad title*
    </label>

    <input id="ad-title" name="title" minlength="1" maxlength="40" placeholder="Mention the key features of your item (e.g. brand, model, age, type)" type="text" required>
    <small>
     1/40
    </small>
   </div>

   <div class="form-group">
    <label for="ad-title">
     Select Category*
    </label>

    <select name="category" class="form-control" required>
                <option value="">Select Category</option>
                <?php while ($category = $categories->fetch_assoc()): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['categoryName'] ?></option>
                <?php endwhile; ?>
            </select>
   
   </div>
   <div class="form-group">
    <label for="description">
     Description*
    </label>
    <textarea id="description" name="description" minlength="1" maxlength="4096"  placeholder="Describe the item you're selling" rows="5"  required></textarea>
    <small>
     Include condition, features and reason for selling
    </small>
    <small>
     0/4096
    </small>
   </div>


 <div class="form-group">
    <label for="ad-title">
     Select Country*
    </label>

              <select name="country" id="country" class="form-control" required>
                <option value="">Select Country</option>
                <option value="Pakistan">Pakistan</option>
                <option value="India">India</option>
              <option value="United States">United States</option> 
                <option value="Australia">Australia</option>
                <option value="Canada">Canada</option>
            <option value="United Kingdom">United Kingdom</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
             <option value="United Arab Emirates">United Arab Emirates</option> 
                <option value="Qatar">Qatar</option>
                <option value="Jordan">Jordan</option>
                <option value="Egypt">Egypt</option>
                <option value="Oman">Oman</option>
                <option value="Turkey">Turkey</option>
            </select>
        

</div>
    <!-- Location -->
        <div class="form-group">
            <label for="location">Location*</label>
            <div class="input-group">
                <span><i class="fas fa-search"></i></span>
                <input id="location" placeholder="Type your City" name="location" type="text" required>
            </div>
            <div id="city-suggestions" class="city-suggestions"></div>
        </div>
   <div class="form-group">
    <label for="price">
     Price*
    </label>
    <div class="input-group">
     <span id="currency-sign">
      Rs
     </span>
     <input id="price" name="price" placeholder="Enter Price" type="number" required>
     <input type="hidden" id="currency_code" name="currency_code" value="PKR">
    </div>
</div>
   <div class="form-group">
    <label for="name">
     Name*
    </label>
 <input type="text" name="name" minlength="5" maxlength="15" placeholder="Your Name" required>
      <!-- <input type="text" name="username" id="name" placeholder="Your Name" required/> -->
   
   </div>
   <div class="form-group">
    <label for="phone-number">
     Mobile Phone Number*
    </label>
    <div class="input-group">
   <!--  <input type="number" name="userphone" id="phone-number" placeholder="Enter phone number" required/> -->
 <input type="number" name="phone" minlength="11" maxlength="15"  placeholder="Enter phone number" required>
    
    </div>
   </div>

  <!--  <div class="form-group toggle-switch">
    <input id="show-phone" type="checkbox"/>
    <label for="show-phone">
    </label>
    <span>
     Show my phone number in ads
    </span>
   </div> -->

   <div class="form-footer">
    <button type="submit" name="submit">
     Post now
    </button>
   
   </div>
  </div> </form>
  <div class="container help-box">
   <h2>
    Need help getting started?
   </h2>
   <ul>
    <li>
     <a href="#">
      Contact Us
     </a>
    </li>
   
   </ul>
   <p>
    You can always come back to change your ad
   </p>
  </div>



<script>
    // Image Upload and Preview Script
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
                        <button class="remove-image cross" onclick="removeImage(${index})">&times;</button>
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

    // Fetch cities based on selected country
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

    // Filter cities based on user input
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

    // Select city from suggestions
    $(document).on("click", "#city-suggestions div", function() {
        $("#location").val($(this).text());
        $("#city-suggestions").html("");
    });

    // ...existing code...
// Currency mapping
const countryCurrency = {
    "Pakistan": { sign: "₨", code: "PKR" },
    "India": { sign: "₹", code: "INR" },
    "United States": { sign: "$", code: "USD" },
    "Australia": { sign: "AU$", code: "AUD" },
    "Canada": { sign: "CA$", code: "CAD" },
    "United Kingdom": { sign: "£", code: "GBP" },
    "Saudi Arabia": { sign: "SR", code: "SAR" },
    "United Arab Emirates": { sign: "AED", code: "AED" },
    "Qatar": { sign: "QR", code: "QAR" },
    "Jordan": { sign: "JD", code: "JOD" },
    "Egypt": { sign: "EGP", code: "EGP" },
    "Oman": { sign: "OMR", code: "OMR" },
    "Turkey": { sign: "₺", code: "TRY" }
};

$("#country").change(function() {
    let country = $(this).val();
    if (countryCurrency[country]) {
        $("#currency-sign").text(countryCurrency[country].sign);
        $("#currency_code").val(countryCurrency[country].code);
    } else {
        $("#currency-sign").text("Rs");
        $("#currency_code").val("PKR");
    }
    // ...existing AJAX for cities...
});
// ...existing code...
</script>

<?php
// Handle form submission
if (isset($_POST['submit'])) {
    $name = $con->real_escape_string($_POST['name']);
    $phone = $con->real_escape_string($_POST['phone']);
    $title = $con->real_escape_string($_POST['title']);
    $description = $con->real_escape_string($_POST['description']);
    $price = $_POST['price'];
    $currency_code = isset($_POST['currency_code']) ? $con->real_escape_string($_POST['currency_code']) : 'PKR';
    $category_id = $_POST['category'];
    $brand = $con->real_escape_string($_POST['brand']);
    $country = $con->real_escape_string($_POST['country']);
    $location = $con->real_escape_string($_POST['location']);
    $user_id = $_SESSION['user_id'];

    $created_at = date('Y-m-d');
    $expiry_date = date('Y-m-d', strtotime($created_at . ' + 30 days'));

    // Validate city
    $city_check = $con->query("SELECT city FROM cities WHERE country='$country' AND city='$location'");
    if ($city_check->num_rows == 0) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid City',
                text: 'Please select a city from the suggested list!',
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit;
    }

    // Image Upload Handling
    $image_paths = [];
    $upload_dir = "uploads/";

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        if (!empty($_FILES['images']['name'][$key])) {
            $image_name = time() . "_" . $_FILES['images']['name'][$key];
            $image_path = $upload_dir . $image_name;

            if (move_uploaded_file($tmp_name, $image_path)) {
                $image_paths[] = $image_path;
            }
        }
    }

    if (empty($image_paths)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please upload at least one image!',
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit;
    }

    $image_str = implode(",", $image_paths);

    // Insert into database
 
$sql = "INSERT INTO ads (name, phone, title, description, price, currency_code, category_id, brand, country, location, image, user_id, created_at, expiry_date) 
        VALUES ('$name', '$phone', '$title', '$description', '$price', '$currency_code', '$category_id', '$brand', '$country', '$location', '$image_str', '$user_id', '$created_at', '$expiry_date')";

    if ($con->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Congratulations!',
                text: 'Your ad was posted successfully!',
                confirmButtonText: 'Go to My Ads'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'my_ad.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while posting your ad. Please try again.',
            });
        </script>";
    }
}
?>
</body>
</html>