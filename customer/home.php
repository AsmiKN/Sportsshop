<?php
if (!isset($_SESSION))
  session_start();
require_once("includes/connection.php");
require_once("includes/validate.php");

// get products
$result = mysqli_query($conn, "SELECT product_id,product_name, description,price,image1,stock
FROM product");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sportzone</title>
  <?php
  require_once("includes/common.php");
  ?>
</head>

<body>
  <?php
  require('includes/customer_navbar.php'); ?>
  <div class="page-container">
    <p for="">Welcome <?php echo $_SESSION['name'] ?></p>
    <div class="container-fluid">
      <div class="product-list row">
        <?php while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="col-16 col-md-2 product-card">
<div class="product-info">
  <div class="img-container">
    <img src="../images/products/' . $row['image1'] . '" alt="" class="product-img">
  </div>
  <h2 class="product-title">' . $row['product_name'] . '</h2>';
          echo ($row['stock'] > 0) ? '<label for="" class="text-success">In stock</label>' : '<label for="" class="text-danger">Out of stock</label>';
          echo '<p class="price">INR ' . $row['price'] . '</p>';
          if ($row['stock'] > 0) {
            echo '<a href="product.php?id=' . $row['product_id'] . '" target="_blank"><button class="btn-cart"><i class="las la-cart-plus"></i> View more</button></a>';
          } else {
            echo '<a href="#" target="_blank" disabled><button class="btn-cart" disabled><i class="las la-cart-plus"></i> View more</button></a>';
          }
          echo '</div>
</div>';
        } ?>




      </div>
    </div>

  </div>
</body>

</html>