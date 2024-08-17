<?php
require_once('includes/validate.php');
require_once('includes/connection.php');

/**
 * Check if the form is submitted and do the process
 */
$message = "";
if (isset($_POST['txt-pname'])) {  //check if the form is submitted
  $pname = $_POST['txt-pname'];
  $pdescription = $_POST['txt-description'];
  $pcat = $_POST['sel-category'];
  $pstock = $_POST['txt-stock'];
  $price = $_POST['txt-price'];

  $err_flag = false;

  if ($pname == '') {
    $message .= "Invalid name <br>";
    $err_flag = true;
  }

  if ($pdescription == '') {
    $message .= "Invalid description <br>";
    $err_flag = true;
  }

  if ($price <= 0) {
    $message .= "price can not be 0 or less <br>";
    $err_flag = true;
  }

  if (!$err_flag) {
    $target_dir = "../images/products/"; //folder to store category image
    $filename = basename($_FILES["file-pimg"]["name"]); //get uploaded file
    $target_file = $target_dir . $filename;
    // Check if image file is a actual image or fake image
    if (move_uploaded_file($_FILES["file-pimg"]["tmp_name"], $target_file)) {

      $qry_insert = "INSERT INTO product(cat_id,product_name,`description`,price,image1,stock) 
      VALUES('$pcat','$pname','$pdescription','$price','$filename','$pstock')";

      if (mysqli_query($conn, $qry_insert))
        $message = "Product added<br>";
      else
        $message .= "Failed add product<br>: " . mysqli_error($conn);
    } else {
      $message .= "Failed to upload file<br>";
    }
  }
}

// get categories
$result = mysqli_query($conn, "SELECT cat_id,cat_name from category order by cat_name") or die(mysqli_error($conn));
$options = "";
while ($row = mysqli_fetch_assoc($result)) {
  $options .= '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New product</title>

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
        <div class="col-12 col-md-2"></div>
        <div class="col-12 col-md-8">

          <h1 class="page-header col-12 col-md-6">New product</h1>
          <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group mb-2">
              <label class="mb-1" for="">Name</label>
              <input type="text" name="txt-pname" class="form-control">
            </div>

            <div class="form-group mb-2">
              <label class="mb-1" for="">Description</label>
              <textarea name="txt-description" cols="30" rows="3" class="form-control"></textarea>
            </div>

            <div class="form-group mb-2">
              <label class="mb-1" for="">Category</label>
              <select name="sel-category" class="form-select">
                <?php echo $options; ?>
              </select>
            </div>

            <div class="form-group mb-2">
              <label class="mb-1" for="">Image</label>
              <input type="file" name="file-pimg" class="form-control">
            </div>

            <div class="form-group mb-2">
              <label class="mb-1" for="">Price</label>
              <input type="number" name="txt-price" class="form-control" min="0.25" step="0.25">
            </div>

            <div class="form-group mb-2">
              <label class="mb-1" for="">Stock</label>
              <input type="number" name="txt-stock" class="form-control" min="1" step="1">
            </div>

            <div class="form-group mb-2">
              <button class="btn btn-sm btn-primary">Save</button>
            </div>
            <label for="" id="message"><?php echo $message; ?></label>
          </form>
        </div>
        <div class="col-12 col-md-2"></div>
      </div>
    </div>
  </div>



</body>

</html>