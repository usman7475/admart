<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
 <link rel="icon" type="image/x-icon" href="admin/images/main_logo.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <script src="https://kit.fontawesome.com/8a2bdd4e42.js" crossorigin="anonymous"></script>

  <style>
    /* Unique Header */
    .unique-navbar-header {
      background-color: #fff;
      padding: 0 20px 0 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ddd;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }
    
    .unique-navbar-header img {
      height: 70px;
      
   
    }
    .main{
      width: 50%;
    }
    /* Unique Search Bar */
    .unique-navbar-search-bar {
      flex-grow: 1;
      margin: 0 20px;
      position: relative;
      max-width: 650px;
      display: flex;
      align-items: center;
    }
    
    .unique-navbar-search-bar input {
      width: 100% !important;
      padding: 10px 40px 10px 10px !important;
      border: 1px solid #ddd !important;
      border-radius: 4px !important;
      font-size: 16px;
    }
    
    .unique-navbar-search-bar input:focus {
      border-color: #012f34;
      outline: none;
      /*box-shadow: 0 0 5px rgba(1, 47, 52, 0.5);*/
    }
    
    .unique-navbar-search-bar .unique-navbar-search-icon {
      border: 1px solid #1E90FF;
          position: absolute;
    right: -22px;
    top: 50%;
    transform: translateY(-50%);
    background-color: #1E90FF;
 /*   background-color: #012f34;*/
    padding: 10px;
    color: #fff;
    cursor: pointer;
    border-radius: 4px;
    }
    
    /* Unique Icons and Buttons */
    .unique-navbar-icons {
      display: flex;
      align-items: center;
    }
    
    .unique-navbar-icons a {
      text-decoration: none;
      color: #333;
      font-size: 14px;
      margin-left: 15px;
      display: flex;
      align-items: center;
    }
    
    .unique-navbar-icons a i {
      font-size: 20px;
      margin-right: 5px;
    }
    
    .unique-navbar-myad img {
      height: 25px !important;
    }
    
    /* Unique SELL Button */
    .unique-navbar-buttonsale {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 90px;
      height: 40px;
      font-weight: bold;
      border: 5px solid transparent;
      border-radius: 25px;
      background-image: linear-gradient(#fff, #fff), linear-gradient(to right, #FFD700, #00E5FF, #1E90FF);
      background-origin: border-box;
      background-clip: content-box, border-box;
      color: #003366;
      text-decoration: none;
      margin-left: 15px;
    }
    
    .unique-navbar-buttonsale i {
      margin-right: 2px;
    }
    
    /* Unique Menu Button (For Mobile) */
    .unique-navbar-menu-btn {
      font-size: 24px;
      cursor: pointer;
      display: none;
      transition: transform 0.3s ease-in-out;
    }
    
    /* Unique Navbar Bottom Slide (For Mobile) */
    .unique-navbar-bottom {
      position: fixed;
      bottom: -100%;
      left: 0;
      width: 100%;
      background: white;
      box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);
      transition: bottom 0.4s ease-in-out;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      border-top: 2px solid #012f34;
      z-index: 3000; /* High z-index to appear above footer */
    }
    
    .unique-navbar-bottom.active {
      bottom: 0;
    }
    
    .unique-navbar-bottom .unique-navbar-search-bar {
      width: 100%;
      max-width: 400px;
      display: flex;
      margin-bottom: 15px;
    }
    
    .unique-navbar-bottom .unique-navbar-search-bar input {
      display: block;
      width: 92% !important;
      padding: 10px 40px 10px 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 16px;
    }
    
    .unique-navbar-bottom .unique-navbar-search-bar input:focus {
      border-color: #012f34;
      outline: none;
  /*    box-shadow: 0 0 5px rgba(1, 47, 52, 0.5);*/
    }
    
    .unique-navbar-bottom .unique-navbar-search-bar .unique-navbar-search-icon {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 20px;
      background-color: #1E90FF;
      padding: 13px;
      color: #fff;
      cursor: pointer;
      border-radius: 4px;
    }
    
    .unique-navbar-bottom .unique-navbar-menu-link {
      margin-top: 15px;
      text-decoration: none;
      color: #333;
      font-size: 14px;
      display: flex;
      align-items: center;
    }
    
    .unique-navbar-bottom .unique-navbar-menu-link i {
      font-size: 22px;
      margin-right: 5px;
    }
    
    /* Unique Menu Button Animation */
    .unique-navbar-menu-btn.open {
      transform: rotate(90deg);
    }
    
    /* Responsive for Mobile */
    @media (max-width: 768px) {
      .unique-navbar-search-bar, .unique-navbar-icons {
        display: none; /* Hide desktop search & icons */
      }
      
      .unique-navbar-mobilehide {
        display: none !important;
      }
      
      .unique-navbar-menu-btn {
        display: block;
      }
    }
    
    @media (min-width: 769px) {
      .unique-navbar-menu-btn {
        display: none !important;
      }
    }
  </style>
</head>
<body>
  <div class="unique-navbar-header ">
    <a href="index.php">
      <img class="main" src="admin/images/main_logo9.png" alt="Logo"/>
    </a>
    
    <!-- Search Bar (Visible in Desktop) -->
    <form method="get" action="search.php">
    <div class="unique-navbar-search-bar" style="width: 450px;">
        <input type="search" placeholder="Search..." name="search" required />

        <button type="submit" class="unique-navbar-search-icon">

            <i class="fas fa-search"></i>

        </button>
    </div>
</form>
    
    <!-- Icons & Buttons (Visible in Desktop) -->
    <div class="unique-navbar-icons unique-navbar-mobilehide" id="desktop-icons">
      <a href="post_ad.php" class="unique-navbar-buttonsale">
        <i class="fas fa-plus"></i> SELL
      </a>
      
      <!-- "My Ads" button (Only visible if user is logged in) -->
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="my_ad.php" class="unique-navbar-myad">
          <img src="admin/images/myads.svg" alt="My Ads"> My Ads
        </a>
      <?php endif; ?>
      
      <a href="<?php echo isset($_SESSION['user_id']) ? 'logout.php' : 'login.php'; ?>">
        <i class="fa-solid <?php echo isset($_SESSION['user_id']) ? 'fa-right-from-bracket' : 'fa-right-to-bracket'; ?>"></i>
        <?php echo isset($_SESSION['user_id']) ? 'Logout' : 'Login'; ?>
      </a>
    </div>
    
    <!-- Mobile Menu Button (only visible on mobile) -->
    <i class="fas fa-ellipsis-v unique-navbar-menu-btn" id="menu-btn"></i>
  </div>
  
  <!-- Bottom Navigation (Hidden by default) -->
  <div class="unique-navbar-bottom" id="nav-bottom">
 <form method="get" action="search.php">
    <div class="unique-navbar-search-bar">

      <input type="search" placeholder="Search..." name="search" required />

 <button type="submit" class="">

      <i class="fas fa-search unique-navbar-search-icon"></i>
       </button>
    </div>
    </form>
    <!-- SELL Button -->
    <a href="post_ad.php" class="unique-navbar-buttonsale">
      <i class="fas fa-plus"></i> SELL
    </a>
    
    <!-- "My Ads" button (Only visible if user is logged in) -->
    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="my_ad.php" class="unique-navbar-myad unique-navbar-menu-link">
        <img src="admin/images/myads.svg" alt="My Ads"> My Ads
      </a>
    <?php endif; ?>
    
    <a href="<?php echo isset($_SESSION['user_id']) ? 'logout.php' : 'login.php'; ?>" class="unique-navbar-menu-link">
      <i class="fa-solid <?php echo isset($_SESSION['user_id']) ? 'fa-right-from-bracket' : 'fa-right-to-bracket'; ?>"></i>
      <?php echo isset($_SESSION['user_id']) ? 'Logout' : 'Login'; ?>
    </a>
  </div>
  
  <script>
    document.getElementById('menu-btn').addEventListener('click', function() {
      var menu = document.getElementById('nav-bottom');
      this.classList.toggle('open');
      menu.classList.toggle('active');
    });
  </script>
  
</body>
</html>
