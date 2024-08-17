<?php
if (!isset($_SESSION))
  session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require('connection.php');

if (isset($_POST['login'])) {
  $input_email = $_POST['username'];
  $input_password = $_POST['password'];


  // Customer Login Check
  $customer_query = "SELECT cust_id,first_name,last_name 
  FROM customer_table 
  WHERE email = '$input_email' and pswrd = '$input_password' 
  LIMIT 1";
  $customer_result = mysqli_query($conn, $customer_query);
  if (mysqli_num_rows($customer_result) == 1) {
    $customer_row = mysqli_fetch_assoc($customer_result);
    $_SESSION['name'] = $customer_row['first_name'];
    $_SESSION['csid'] = $customer_row['cust_id'];
    header("Location: customer/home.php");
  } else {
    echo "<script>alert('Invalid username or password!')</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Login Form</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
      background: url('img1.jpg') center/cover no-repeat;
      /* Replace 'background-image.jpg' with your image file */
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 8px;
      width: 300px;
    }

    .login-form {
      display: flex;
      flex-direction: column;
    }

    h1 {
      text-align: center;
    }

    label {
      margin-top: 10px;
    }

    input {
      padding: 8px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #4caf50;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    .register-link {
      text-align: center;
      margin-top: 10px;
    }

    .register-link a {
      color: #3498db;
      text-decoration: none;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    .signup-link {
      text-align: center;
      margin-top: 10px;
    }

    .signup-link a {
      color: #4caf50;
      text-decoration: none;
      font-weight: bold;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }

    <style>

    /* Add some styles to the body for better overall appearance */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
      background: url('img1.jpg') center/cover no-repeat;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Update login-container styles for better visibility */
    .login-container {
      background: rgba(255, 255, 255, 0.9);
      /* Slightly more opaque background */
      padding: 30px;
      /* Increased padding for better spacing */
      border-radius: 10px;
      /* Rounded corners for a modern look */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* Add a subtle box shadow for depth */
      width: 350px;
      /* Slightly wider container */
    }

    /* Update login-form styles for better spacing */
    .login-form {
      display: flex;
      flex-direction: column;
      align-items: center;
      /* Center form items */
    }

    /* Style the input fields for better appearance */
    input {
      padding: 12px;
      /* Increased padding for better input field height */
      margin: 10px 0;
      /* Increased margin for better spacing between fields */
      border: 1px solid #ddd;
      /* Lighter border color for a softer look */
      border-radius: 6px;
      width: 100%;
      /* Full width */
    }

    /* Style the submit button */
    button {
      background-color: #3498db;
      /* Blue color for the button */
      color: white;
      padding: 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2980b9;
      /* Darker blue on hover */
    }

    /* Style the registration link */
    .register-link {
      text-align: center;
      margin-top: 15px;
      /* Increased margin for better separation */
    }

    .register-link a {
      color: #3498db;
      text-decoration: none;
      font-weight: bold;
    }

    .register-link a:hover {
      */ text-decoration: underline;
    }
  </style>

  </style>
</head>

<body>
  <div class="login-container">
    <form class="login-form" method="POST">
      <h1>Login</h1>
      <label for="username"><b>Email ID</b></label>
      <input type="text" id="username" name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" id="password" name="password" required>

      <button type="submit" name="login">Login</button>

      <p>Don't have an Account?<a href="register.php">Sign up</a> here</p>
    </form>
  </div>



</body>

</html>