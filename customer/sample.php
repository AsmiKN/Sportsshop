<?php
if (!isset($_SESSION))
    session_start();
require_once("includes/connection.php");
require_once("includes/validate.php");
$message = "";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample</title>
    <?php
    require_once("includes/common.php");
    ?>
</head>

<body>
    <?php
    require('includes/customer_navbar.php'); ?>
    <div class="page-container">
        <!-- write your code here -->
    </div>
</body>

</html>