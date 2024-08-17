<?php
if (!isset($_SESSION))
    session_start();
require_once("includes/connection.php");
require_once("includes/validate.php");
$product_id = $_GET['id'];
$message = "";

// get product details
$result = mysqli_query($conn, "SELECT product_id,product_name, description,price,image1,stock
FROM product
WHERE product_id = '$product_id'");
$row_product = mysqli_fetch_assoc($result);
$stock = $row_product['stock'];
$csid = $_SESSION['csid'];
// handle click on add to cart button
if (isset($_POST['prid'])) {
    // check if already in cart
    $check_cart = mysqli_query($conn, "SELECT * from cart 
    WHERE user_id = '$csid' AND product_id = '$product_id'") or die(mysqli_error($conn));

    $cartrow = mysqli_fetch_assoc($check_cart);
    if (mysqli_num_rows($check_cart) > 0) {
        // alreay in cart
        //if stock is 0 - purchased by another use, then remove from cart
        if ($stock == 0) {
            mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$csid' AND product_id = '$product_id'") or die(mysqli_error($conn));
            $message = "Item out of stock, removed from cart";
        } else {
            $newqty = ($cartrow['qty'] < $stock) ? $cartrow['qty'] + 1 : $stock;
            mysqli_query($conn, "UPDATE cart SET qty = $newqty
        WHERE user_id = '$csid' AND product_id = '$product_id'") or die(mysqli_error($conn));
            $message = "Item qty updated";
        }
    } else {
        //not in cart
        // add new entry to cart
        mysqli_query($conn, "INSERT INTO cart(user_id,product_id,qty) VALUES('$csid','$product_id','1')") or die(mysqli_error($conn));
        $message = "Item Added";
    }
}



// handle click on remove button
if (isset($_POST['removed_product'])) {
    // check if already in cart
    $rmvdid = $_POST['removed_product'];
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$csid' AND product_id = '$rmvdid'") or die("Failed to remove");
    $message = "Item removed";
}

// get cart detail
$cartinfo = mysqli_query($conn, "SELECT c.user_id,c.product_id,c.qty,p.product_name,p.price,p.price*c.qty AS item_total
FROM cart c
INNER JOIN product p ON c.product_id = p.product_id
WHERE c.user_id = '$csid'") or die(mysqli_error($conn));

$itemsincart = mysqli_num_rows($cartinfo);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <?php
    require_once("includes/common.php");
    ?>
</head>

<body>
    <?php
    require('includes/customer_navbar.php'); ?>
    <div class="page-container">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1 class="page-header col-12 col-md-6"><?php echo $row_product['product_name']; ?></h1>
                    <?php echo '<img src="../images/products/' . $row_product['image1'] . '" alt="" class="img-product-large">'; ?>
                    <?php echo ($row_product['stock'] > 0) ? '<p for="" class="text-success mt-2">In stock</p>' : '<p for="" class="text-danger mt-2">Out of stock</p>'; ?>
                    <h4>About this item</h4>
                    <p class="justified">INR <?php echo $row_product['price'] ?></p>
                    <p class="justified"><?php echo $row_product['description'] ?></p>
                    <?php
                    if ($row_product['stock'] > 0) { ?>
                        <form action="#" method="post">
                            <input type="hidden" name="prid" value="<?php echo $product_id; ?>">
                            <button class="btn-cart"><i class="las la-cart-plus"></i> Add to cart</button>
                        </form>
                    <?php } else { ?>
                        <button class="btn btn-danger btn-sm">Not available</button>
                    <?php }
                    ?>
                </div>
                <div class="col-12 col-md-6">

                    <h1 class="page-header col-12 col-md-6">Cart</h1>

                    <table class="table table-striped">
                        <?php
                        $cartToatal = 0;
                        while ($rwcart = mysqli_fetch_assoc($cartinfo)) { ?>
                            <tr>
                                <td><?php echo $rwcart['product_name'] . ' x ' . $rwcart['qty']; ?></td>
                                <td>INR <?php echo $rwcart['item_total']; ?></td>
                                <td>
                                    <form action="#" method="post">
                                        <input type="hidden" name="removed_product" value="<?php echo $rwcart['product_id']; ?>">
                                        <button class="btn btn-sm btn-danger"> Remove</button>
                                    </form>
                                </td>
                            </tr>

                        <?php
                            $cartToatal += $rwcart['item_total'];
                        }
                        ?>
                        <tr>
                            <td>Total</td>
                            <td>INR <?php echo  $cartToatal; ?></td>
                            <td></td>
                        </tr>
                    </table>
                    <?php if ($itemsincart > 0) {
                        echo '<a href="order-details.php"><button class="btn btn-sm btn-primary"></i> Place order</button></a>';
                    } ?>
                </div>
            </div>
        </div>

    </div>
</body>

</html>