<?php
// Database connection
include 'admin/includes/config.php';

// Fetch categories from tblcategory
$categories = $con->query("SELECT id, categoryName FROM tblcategory");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Your Ad</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Post Your Ad</h2>
    <form action="post_ad.php" method="POST" enctype="multipart/form-data">
        
        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">Your Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <!-- Phone Number -->
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Ad Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <!-- Brand -->
        <div class="mb-3">
            <label class="form-label">Brand Name</label>
            <input type="text" name="brand" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <!-- Category Selection -->
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-control" required>
                <option value="">Select Category</option>
                <?php while ($category = $categories->fetch_assoc()): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['categoryName'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Country Selection -->
        <div class="mb-3">
            <label class="form-label">Country</label>
            <select name="country" class="form-control" required>
                <option value="">Select Country</option>
                <option value="Pakistan">Pakistan</option>
                <option value="India">India</option>
                <option value="USA">USA</option>
                <option value="Australia">Australia</option>
                <option value="Canada">Canada</option>
                <option value="England">England</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="UAE">UAE</option>
                <option value="Qatar">Qatar</option>
                <option value="Jordan">Jordan</option>
                <option value="Egypt">Egypt</option>
                <option value="Oman">Oman</option>
                <option value="Turkey">Turkey</option>
            </select>
        </div>

        <!-- Location -->
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label class="form-label">Upload Images (Min: 1, Max: 3)</label>
            <input type="file" name="images[]" class="form-control" id="imageUpload" accept="image/*" multiple required>
            <div class="preview-container" id="imagePreview"></div>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="submit" class="btn btn-primary">Post Ad</button>
    </form>
</div>

<script>
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
</script>

</body>
</html>

<?php
// Handle form submission
if (isset($_POST['submit'])) {
    $name = $con->real_escape_string($_POST['name']);
    $phone = $con->real_escape_string($_POST['phone']);
    $title = $con->real_escape_string($_POST['title']);
    $description = $con->real_escape_string($_POST['description']);
    $price = $_POST['price'];
    $category_id = $_POST['category'];
    $brand = $con->real_escape_string($_POST['brand']);
    $country = $con->real_escape_string($_POST['country']);
    $location = $con->real_escape_string($_POST['location']);
    $user_id = 1; // Change this to the logged-in user's ID
    $created_at = date('Y-m-d H:i:s');

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

    $image_str = implode(",", $image_paths);

    $sql = "INSERT INTO ads (name, phone, title, description, price, category_id, brand, country, location, image, user_id, created_at) 
            VALUES ('$name', '$phone', '$title', '$description', '$price', '$category_id', '$brand', '$country', '$location', '$image_str', '$user_id', '$created_at')";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Ad posted successfully!'); window.location.href='post_ad.php';</script>";
    } else {
        echo "Error: " . $con->error;
    }
}
?>
