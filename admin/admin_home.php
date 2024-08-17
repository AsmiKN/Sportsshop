<?php
if (!isset($_SESSION))
  session_start();
require_once('includes/validate.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <?php require_once('includes/common.php');
  require_once('includes/connection.php'); ?>
  <style>
    body {
      background-image: url(./images/$img1.jpg);
      background-size: cover;
    }
  </style>
</head>

<body>
  <?php
  require_once('includes/admin_navbar.php');
  require_once('includes/sidenav.php');
  ?>
  <div class="page-container">

  </div>



</body>

</html>