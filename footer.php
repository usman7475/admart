<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="footer, address, phone, icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    footer {
      margin-top: 280px;
      position: relative;
      bottom: 0;
      background-color: #fff;
      width: 100%;
      padding: 30px 20px;
      font: inherit;
    }
span{
  color: #1E90FF;
}
    .footer-distributed {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: flex-start;
      text-align: left;
    }

    .footer-left {
      flex: 1 1 30%;
      margin-bottom: 20px;
    }

    .footer-left img {
      width: 50%;
      height: 70px;
    }

    .footer-links {
      margin: 20px 0;
      color: #333;
    }

    .footer-links a {
      text-decoration: none;
      color: #333;
      margin-right: 10px;
    }

    .footer-links a:hover {
      text-decoration: underline;
      color: #1E90FF !important;
    }

    .footer-company-name {
      color: ;
      font-size: 14px;
    }

    .footer-center {
      flex: 1 1 35%;
      margin-bottom: 20px;
    }

    .footer-center i {
      background-color: #33383b;
      color: #fff;
      font-size: 20px;
      width: 40px;
      height: 40px;
      text-align: center;
      line-height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .footer-center p {
      color: #333;
      margin: 0;
      display: flex;
      align-items: center;
    }

    .footer-right {
      flex: 1 1 30%;
      margin-bottom: 20px;
    }

    .footer-company-about {
      color: #333;
      font-size: 14px;
      margin-bottom: 20px;
    }

    .footer-company-about span {
      font-size: 16px;
      display: block;
      margin-bottom: 10px;
    }

    .footer-icons a {
      display: inline-block;
      width: 40px;
      height: 40px;
      color: black;
      font-size: 20px;
      line-height: 40px;
      text-align: center;
      margin-right: 5px;
      border-radius: 50%;
      padding: 10px !important;
    }

    /* Country Section Styles */
    .footer-countries {
      flex: 1 1 30%;
      margin-bottom: 20px;
    }

    .footer-countries h4 {
      font-size: 16px;
      margin-bottom: 10px;
      color: #333;
    }

    .footer-countries ul {
      list-style: none;
      padding: 0;
    }

    .footer-countries ul li {
      margin-bottom: 5px;
    }

    .footer-countries ul li a {
      text-decoration: none;
      color: #333;
    }

    .footer-countries ul li a:hover {
      text-decoration: underline;
      color: #1E90FF !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .footer-distributed {
        flex-direction: column;
        text-align: center;
      }

      .footer-left,
      .footer-center,
      .footer-right {
        flex: 1 1 100%;
        margin-bottom: 20px;
      }

      .footer-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
      }

      .footer-company-name {
        margin-top: 20px;
      }

      /* Center align image and links in mobile view */
      .footer-left img {
        margin: 0 auto; /* Center the image */
        display: block;
      }

      .footer-links {
        justify-content: center; /* Center the links */
      }

      /* Mobile mode: 2 countries per row */
      .footer-countries ul {
        columns: 2; /* Mobile mode: 2 columns */
      }
    }

    @media (max-width: 480px) {
      .footer-left {
        padding-left: 0 !important; /* Remove extra padding */
      }
    }
  </style>
</head>

<body>
  <footer class="footer-distributed">

    <div class="footer-left">
      <a href="index.php">
        <img alt="Logo" src="admin/images/main_logo9.png" />
      </a>
      <p class="footer-links">
        <a href="index.php">Home</a> |
        <a href="contact_us.php">Contact</a>
      </p>
    </div>

    <!-- Country Section -->
    <div class="footer-countries">
      <span> <strong> Countries<br></strong></span>
      <br>
      <ul>
        <li><a href="country.php?country=Pakistan">Pakistan</a></li>
        <li><a href="country.php?country=India">India</a></li>
        <li><a href="country.php?country=United States">United States</a></li>
        <li><a href="country.php?country=Australia">Australia</a></li>
        <li><a href="country.php?country=Canada">Canada</a></li>
        <li><a href="country.php?country=United Kingdom">United Kingdom</a></li>
        <li><a href="country.php?country=Saudi Arabia">Saudi Arabia</a></li>
        <li><a href="country.php?country=United Arab Emirates">United Arab Emirates</a></li>
        <li><a href="country.php?country=Qatar">Qatar</a></li>
        <li><a href="country.php?country=Jordan">Jordan</a></li>
        <li><a href="country.php?country=Egypt">Egypt</a></li>
        <li><a href="country.php?country=Oman">Oman</a></li>
        <li><a href="country.php?country=Turkey">Turkey</a></li>
      </ul>
    </div>

    <div class="footer-right">
      <p class="footer-company-about">
        <span> <strong> About the Site</strong></span>
        We are offering Easy Buy and Sale System. Where everyone can apply for Registration and Sale Your Product.
        Everyone can purchase everything available on our online store.
      </p>
      <div class="footer-icons">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#<!-- https://wa.me/61***** -->" target="_blank"><i class="fa fa-whatsapp"></i></a>
        <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
        <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
        <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>

    <p class="footer-company-name">© <?php echo date("Y"); ?> All rights reserved</p>
  </footer>
</body>

</html>