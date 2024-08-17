<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('connection.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['psw'];
    $email = $_POST['email'];
    $repassword = $_POST['repsw'];

    // Check if passwords match
    if ($password !== $repassword) {
        echo "<script>alert('Password and confirm password do not match');</script>";
    } else {
        // Construct the SQL query and insert data into the database
        $query = "INSERT INTO customer_table(first_name, last_name, phone_no,customer_address, pswrd, email) 
                  VALUES ('$fname', '$lname', '$phone','$address', '$password', '$email')";
        $result = mysqli_query($conn, $query) or die("Insertion Error: " . mysqli_error($conn));


        if ($result) {
            echo "<script>alert('Registration Success');</script>";
            echo "<script>window.open('login.php', '_self')</script>";
        } else {
            echo "<script>alert('Registration Failed');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 50px;
            font-family: Arial, sans-serif;
            background-image: url('img1.jpg');
            /* Replace 'background-image.jpg' with the path to your image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: rgba(256, 256, 256, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(2, 2, 2, 0.1);
            width: 500px;

        }

        h2 {
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .login-link {
            margin-top: 25px;
            color: #333;
            text-decoration: none;
        }
    </style>
    <title>Registration Form</title>
</head>

<body>

    <form method="POST">
        <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>
            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="first Name" name="fname" id="fname" required>

            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="last Name" name="lname" id="lname" required>


            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>

            <label for="phoneno"><b>Phone Number</b></label>
            <input type="text" placeholder="EnterPhone" name="phone" id="phoneno" required>

            <label for="address"><b>Address</b></label>
            <textarea name="address" id="address" cols="30" rows="3" required></textarea>


            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

            <label for="psw-repeat"><b>Confirm Password</b></label>
            <input type="password" placeholder="confirm Password" name="repsw" id="psw-repeat" required>
            <hr>
            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

            <button type="submit" name="submit" class="registerbtn">Register</button>
        </div>
    </form>

</body>

</html>