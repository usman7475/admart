<?php
session_start();
include 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Hash the input password using MD5
$hashedPassword = md5($password);

// Query to fetch user data
$query = "SELECT * FROM tblregistration WHERE emailId='$email' AND userPassword='$hashedPassword'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
$user = mysqli_fetch_assoc($result);

// Start session and redirect
$_SESSION['edmsid'] = $user['id'];
$_SESSION['uemail'] = $user['emailId'];
header("Location: dashboard.php");
exit();
} else {
// Invalid email or password
header("Location: index.php?login=error");
exit();
}
}

// Close connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Karaksooq</title>
<link rel="icon" type="image/x-icon" href="images/main_logo.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
body {
margin: 0;
height: 100vh;
/*font-family: Consolas, Monaco, Lucida Console, monospace;*/
display: flex;
justify-content: center;
align-items: center;
background: radial-gradient(closest-side at 60% 55%, gray, #ffc107, #009B4D);
/*#c82333*/
animation: gradient 60s ease infinite;
background-size: 400% 400%;
}

@keyframes gradient {
0% { background-position: 0% 50%; }
50% { background-position: 100% 50%; }
100% { background-position: 0% 50%; }
}

.login-container {
/*background-color: #FAF5E9;*/
padding: 2rem;
border-radius: 10px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
max-width: 400px;
width: 90%; /* Adjusted for mobile responsiveness */
}

.login-container h2 {
margin-bottom: 1.5rem;
text-align: center;
color: black;
}

.form-control {
border-radius: 25px 0 0 25px;
padding: 10px 15px;
}

.input-group .form-control:focus {
box-shadow: none;
border-color: #FFCC00 !important;
}

.btn-primary {
    color: black;
background-color: #FFCC00;
border: 1px solid #FFCC00;
border-radius: 25px;
padding: 10px 20px;
width: 100%;
}

.btn-primary:hover {
       color: black;
background-color: #ffdb4d;
border: 1px solid #ffdb4d;
border-radius: 25px;
padding: 10px 20px;
width: 100%;
}

.signup-link {
margin-top: 10px;
text-align: center;
}

.alert {
margin-top: 10px;
text-align: center;
}

#email:focus {
box-shadow: none;
border-color: #FFCC00 !important;
}

/* Responsive Design */
@media (max-width: 576px) {
.login-container {
padding: 1.5rem;
}

.login-container h2 {
font-size: 1.5rem;
}

.form-control {
padding: 8px 12px;
}

.btn-primary {
padding: 8px 16px;
}
}

.header img{
     height: 140px;
      width: 100%;
}
</style>
</head>
<body>
 
<div class="login-container">
<div class="header">
 <h2> 
<img class="main" src="images/main_logo9.png" alt="Logo"/>
  </h2>
</div> 
<h2>Admin Login!</h2>
<!-- Display success or error messages -->
<?php if (isset($_GET['login']) && $_GET['login'] == 'success'): ?>
<div class="alert alert-success">
Login successful! Welcome back, <strong><?php echo $_SESSION['firstName']; ?></strong>.
</div>
<?php elseif (isset($_GET['login']) && $_GET['login'] == 'error'): ?>
<div class="alert alert-danger">
Invalid Email or Password!
</div>
<?php endif; ?>
<form method="POST" action="index.php">
<div class="form-group">
<label for="email">Email:</label>
<input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
</div>
<div class="form-group">
<label for="password">Password:</label>
<div class="input-group">
<input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
<div class="input-group-append">
<span class="input-group-text" onclick="togglePassword()">
<i id="password-icon" class="fas fa-eye"></i>
</span>
</div>
</div>
</div>
<button type="submit" class="btn btn-primary">Login</button>
</form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function togglePassword() {
const passwordField = document.getElementById('password');
const passwordIcon = document.getElementById('password-icon');
if (passwordField.type === 'password') {
passwordField.type = 'text';
passwordIcon.classList.remove('fa-eye');
passwordIcon.classList.add('fa-eye-slash');
} else {
passwordField.type = 'password';
passwordIcon.classList.remove('fa-eye-slash');
passwordIcon.classList.add('fa-eye');
}
}
</script>
</body>
</html>