<?php
require_once('includes/validate.php');
require_once('includes/connection.php');

/**
 * Check if the form is submitted and do the process
 */
$message = "";
if (isset($_POST['txt-stock'])) {  //check if the form is submitted
  $newStock = $_POST['txt-stock'];
  $product = $_POST['sel-product'];
  if ($newStock > 0) {
    if (mysqli_query($conn, "UPDATE product SET stock = stock + " . $newStock . " WHERE product_id = $product")) {
      $message .= "Product updated";
    }
  }
};

//display categories from database
$qry_product = "SELECT pr.product_id,pr.product_name,pr.`description`,pr.price,pr.image1,pr.stock,ct.cat_name
FROM product pr
INNER JOIN category ct
ON pr.cat_id = ct.cat_id
ORDER BY pr.product_name";
$result = mysqli_query($conn, $qry_product) or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category</title>

  <?php require_once('includes/common.php'); ?>
</head>

<body>
  <?php
  require_once('includes/admin_navbar.php');
  require_once('includes/sidenav.php');
  ?>
  <div class="page-container">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-8">
          <h1 class="page-header col-12 col-md-6">Products</h1>
          <table class="table table-striped w-100">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Image</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $productOptions = "";
              while ($rw = mysqli_fetch_assoc($result)) {
                echo '<tr>
                      <td>' . $rw['product_name'] . '</td>
                      <td>' . $rw['description'] . '</td>
                      <td>' . $rw['cat_name'] . '</td>
                      <td>' . $rw['stock'] . '</td>
                      <td>' . $rw['price'] . '</td>
                      <td><img src="../images/products/' . $rw['image1'] . '" class="table-image"</td>
                      </tr>';

                $productOptions .= '<option value="' . $rw['product_id'] . '">' . $rw['product_name'] . '</option>';
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="col-12 col-md-4">

          <h1 class="page-header col-12 col-md-6">Add Stock</h1>
          <form action="#" method="post">
            <div class="form-group mb-2">
              <label class="mb-1" for="">Product</label>
              <select name="sel-product" id="" class="form-select">
                <?php echo $productOptions; ?>
              </select>
            </div>
            <div class="form-group mb-2">
              <label class="mb-1" for="">New stock</label>
              <input type="number" name="txt-stock" class="form-control" min="1" step="1">
            </div>
            <div class="form-group mb-2">
              <button class="btn btn-sm btn-primary">Update</button>
            </div>
            <label for="" id="message"><?php echo $message; ?></label>
          </form>
        </div>
      </div>
    </div>
  </div>



</body>

</html>