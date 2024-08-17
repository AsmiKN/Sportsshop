<?php
require_once('includes/validate.php');
require_once('includes/connection.php');

/**
 * Check if the form is submitted and do the process
 */
$message = "";
if (isset($_POST['txt-catname'])) {  //check if the form is submitted
  $catname = $_POST['txt-catname'];  //get category name
  if ($catname !== '') { //validate category name
    $target_dir = "../images/category/"; //folder to store category image
    $filename = basename($_FILES["file-cat"]["name"]); //get uploaded file
    $target_file = $target_dir . $filename;
    // Check if image file is a actual image or fake image
    if (move_uploaded_file($_FILES["file-cat"]["tmp_name"], $target_file)) {
      $qry_insert = "INSERT INTO category(cat_name,cat_image) VALUES('$catname','$filename')";
      if (mysqli_query($conn, $qry_insert))
        $message = "Categoy added";
      else
        $message = "Failed add category: " . mysqli_error($conn);
    } else {
      $message = "Failed to upload file";
    }
  } else {
    $message = "Category name can not be empty";
  }
};

//display categories from database
$qry_cat = "SELECT cat_id,cat_name,cat_image
from category
order by cat_name";
$result = mysqli_query($conn, $qry_cat) or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category</title>

  <?php require_once('includes/common.php'); ?>
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
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
          <h1 class="page-header col-12 col-md-6">Category</h1>
          <table class="table table-striped w-100">
            <thead>
              <tr>
                <th>Name</th>
                <th>Image</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($rwcat = mysqli_fetch_assoc($result)) {
                echo '<tr>
                      <td>' . $rwcat['cat_name'] . '</td>
                      <td><img src="../images/category/' . $rwcat['cat_image'] . '" class="table-image"</td>
                      </tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="col-12 col-md-6">

          <h1 class="page-header col-12 col-md-6">Add Category</h1>
          <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group mb-2">
              <label for="">Name</label>
              <input type="text" name="txt-catname" class="form-control">
            </div>

            <div class="form-group mb-2">
              <label for="">Image</label>
              <input type="file" name="file-cat" class="form-control">
            </div>
            <div class="form-group mb-2">
              <button class="btn btn-sm btn-primary">Save</button>
            </div>
            <label for="" id="message"><?php echo $message; ?></label>
          </form>
        </div>
      </div>
    </div>
  </div>



</body>

</html>