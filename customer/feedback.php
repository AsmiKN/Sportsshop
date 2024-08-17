<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("includes/connection.php");
require_once("includes/validate.php");
require('includes/customer_navbar.php'); 
 require_once("includes/common.php");
?>

// Sanitize input
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
$c_id = isset($_SESSION['cid']) ? $_SESSION['cid'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your additional styles go here */
        .main {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #258cd1;
        }

        .confirmation {
            margin-top: 20px;
            text-align: center;
            color: green;
        }
    </style>
</head>

<body>
    <div class="main">
        <h1>Please Write Your Valuable Feedback</h1>
        <form action="" method="post">
            <textarea name="content" cols="30" rows="10" placeholder="Write Here" required></textarea>
            <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
            <input type="hidden" name="c_id" value="<?php echo $c_id ?>">
            <input type="submit" name="submit" value="POST">
        </form>

        <?php
        require('../connection.php');
        if (isset($_POST['submit'])) {
            $content = $_POST['content'];

            $q = "INSERT INTO feedback(order_id, customer_id, feedback,date) VALUES ($order_id, $c_id,'$content',NOW())";

            if (mysqli_query($conn, $q)) {
                echo "<script>alert('Feedback Sent!')</script>";
                echo "<script>window.open('my_orders.php','_self')</script>";
            } else {
                echo "<p class='confirmation' style='color: red;'>Failed to submit feedback.</p>";
            }
        }
        ?>
    </div>
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>