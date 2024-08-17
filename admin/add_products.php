<?php
require('includes/admin_navbar.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Products</title>
</head>

<body>
    <center>
        <form action="" method="POST" enctype="multipart/form-data">
            <h1><i><u>Add Product</u></i></h1>
            <br>
            Category: <br>
            <select name="cat">
                <?php
                require('includes/connection.php');
                $q = "select * from category";
                $res = mysqli_query($conn, $q);
                while ($row = mysqli_fetch_assoc($res)) {
                    $catid = $row["cat_id"];
                    $catname = $row["cat_name"];
                    echo '<option value="' . $catid . '">' . $catname . '</option>';
                }
                ?>
            </select>
            <br><br>
            Product Name:<br>
            <input type="text" name="pname" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);">
            <br><br>
            Product Description:<br>
            <textarea id="desc" name="desc" rows="4" cols="50" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);"></textarea>
            <br><br>
            Product Price:<br>
            <input type="text" name="price">
            <br><br>
            Product Image 1:<br>
            <input type="file" name="image1" id="image1">
            <br><br>
            Product stock:<br>
            <input type="number" name="stock">
            <br><br>
            <br><br>
            <input type="submit" name="add" value="Add Product">
        </form>
        <br>
    </center>
</body>

</html>

<?php

require('../connection.php');
if (isset($_POST['add'])) {
    $category = $_POST['cat'];
    $pname = $_POST['pname'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $stock =  $_POST['stock'];

    $img1 = $_FILES['image1']['name'];
    $temp_img1 = $_FILES['image1']['tmp_name'];
    $upload_dir = "../images/";

    move_uploaded_file($temp_img1, $upload_dir . $img1);

    $q = "INSERT INTO `product` (cat_id, product_name, description, price, image1, date, stock) 
    VALUES ('$category', '$pname', '$desc', '$price', '$img1', NOW(), '$stock')";

    $r = mysqli_query($conn, $q) or die("Can't connect to the query...");

    if ($r) {
        echo '<script>alert("Successfully Added!")</script>';
    } else {
        echo '<script>alert("Addition Failed!")</script>';
    }
}
?>