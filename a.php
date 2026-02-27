<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <style>
    /* General Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .login-container h2 {
      margin-bottom: 20px;
      font-size: 24px;
      color: #333;
    }

    .login-container p {
      margin-bottom: 30px;
      color: #666;
      font-size: 14px;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-size: 14px;
      color: #333;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }

    .form-group input:focus {
      outline: none;
      border-color: #007bff;
    }

    .btn-login {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-login:hover {
      background-color: #0056b3;
    }

    .forgot-password {
      display: block;
      margin-top: 15px;
      color: #007bff;
      text-decoration: none;
      font-size: 14px;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    .signup-link {
      margin-top: 20px;
      font-size: 14px;
      color: #666;
    }

    .signup-link a {
      color: #007bff;
      text-decoration: none;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>
    <p>Welcome back! Please log in to your account.</p>
    <form>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn-login">Log In</button>
      <a href="#" class="forgot-password">Forgot Password?</a>
    </form>
    <div class="signup-link">
      Don't have an account? <a href="#">Sign Up</a>
    </div>
  </div>
</body>

</html>