<?php
if (!isset($_SESSION))
    session_start();
require_once("includes/connection.php");
require_once("includes/validate.php");
$message = "";


$csid = $_SESSION['csid'];

// get cart detail
$cartinfo = mysqli_query($conn, "SELECT c.user_id,c.product_id,c.qty,p.product_name,p.price,p.stock as available_stock
FROM cart c
INNER JOIN product p ON c.product_id = p.product_id
WHERE c.user_id = '$csid'") or die(mysqli_error($conn));

$itemsincart = 0;

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

                    <h1 class="page-header col-12 col-md-6">My Cart</h1>
                    <p><?php echo $message; ?></p>

                    <table class="table table-striped">
                        <?php
                        $cartToatal = 0;
                        while ($rwcart = mysqli_fetch_assoc($cartinfo)) {
                            if ($rwcart['available_stock'] > 0) {
                                $qty = ($rwcart['qty'] <= $rwcart['available_stock']) ? $rwcart['qty'] : $rwcart['available_stock'];
                                $item_total = $rwcart['price'] * $qty;
                        ?>
                                <tr>
                                    <td><?php echo $rwcart['product_name'] . ' x ' . $qty; ?></td>
                                    <td>INR <?php echo $item_total; ?></td>
                                </tr>

                        <?php
                                $cartToatal += $item_total;
                                $itemsincart++;
                            }
                        }
                        ?>
                        <tr>
                            <td>Total</td>
                            <td>INR <?php echo  $cartToatal; ?></td>
                        </tr>
                    </table>
                    <?php if ($itemsincart > 0) {
                        echo '<a href="order-details.php"><button class="btn btn-sm btn-primary"></i> Place order</button></a>';
                    } ?>
                </div>
                <div class="col-12 col-md-6"></div>
            </div>
        </div>

    </div>
</body>

</html>