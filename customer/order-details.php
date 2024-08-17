<?php
if (!isset($_SESSION))
    session_start();
require_once("includes/connection.php");
require_once("includes/validate.php");
$message = "";

$itemCounter = 0;
$csid = $_SESSION['csid'];
if (!isset($_GET['orderid'])) { //same page used to view order info . make ?orderid = id
    // get cart detail
    $cartinfo = mysqli_query($conn, "SELECT c.user_id,c.product_id,c.qty,p.product_name,p.price,p.stock as available_stock
FROM cart c
INNER JOIN product p ON c.product_id = p.product_id
WHERE c.user_id = '$csid'") or die(mysqli_error($conn));
    if (mysqli_num_rows($cartinfo) > 0) { // check if cart in empty
        //create entry in order table
        $ordertime = date("Y-m-d H:i:s");
        $qryorder = mysqli_query($conn, "INSERT INTO orders(user_id,ordered_on) VALUES('$csid','$ordertime')") or die(mysqli_error($conn));
        $orderid = mysqli_insert_id($conn);
        $total = 0;
        while ($rwcart = mysqli_fetch_assoc($cartinfo)) {
            //check if stock is available
            if ($rwcart['available_stock'] > 0) {
                //move to order table and delete from cart
                $product_id = $rwcart['product_id'];
                $qty = ($rwcart['qty'] <= $rwcart['available_stock']) ? $rwcart['qty'] : $rwcart['available_stock'];
                $price = $rwcart['price'];
                $item_total = $rwcart['price'] * $qty;
                mysqli_query($conn, "INSERT INTO order_item(order_id,product_id,qty,price) VALUES('$orderid','$product_id','$qty','$price')");
                mysqli_query($conn, "UPDATE product SET stock = stock - $qty WHERE product_id = '$product_id'") or die(mysqli_error($conn));
                $total += $item_total;
                $itemCounter++;
            }
        }

        //delete from cart
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$csid'");
        if ($itemCounter > 0) {
            //update total in order table
            mysqli_query($conn, "UPDATE orders set order_total = '$total' WHERE order_id = '$orderid'");
        } else {
            //item not created bcs cart item not having enough stock
            mysqli_query($conn, "DELETE FROM orders WHERE order_id = '$orderid'");
            $message = "Items out of stock";
        }
    } else {
        $message = "Cart is empty";
    }
} else {
    $orderid = $_GET['orderid'];
}
//select order details to print reciept
$qryorder = mysqli_query($conn, "SELECT o.order_id,o.user_id,o.order_status,o.ordered_on,o.order_total,c.first_name,c.last_name,c.customer_address
FROM orders o
INNER JOIN customer_table c ON o.user_id = c.cust_id
WHERE order_id = '$orderid'");
$rworder = mysqli_fetch_assoc($qryorder);

$qryitems = mysqli_query($conn, "SELECT o.qty,o.price,o.qty*o.price AS item_total,p.product_name
FROM order_item o
INNER JOIN product p ON o.product_id = p.product_id
WHERE o.order_id = '$orderid'");
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
                    <h1 class="page-header col-12 col-md-6">Order details</h1>
                    <p>Order # <?php echo $rworder['order_id']; ?></p>
                    <p>Customer: <?php echo $rworder['first_name'] . " " . $rworder['last_name']; ?></p>
                    <p>Ordered placeon: <?php echo $rworder['ordered_on']; ?></p>
                    <p>Status: <?php echo $rworder['order_status']; ?></p>
                    <p class="mb-1">Delivery to:</p>
                    <p><?php echo nl2br($rworder['customer_address']); ?></p>
                    <table class="table">
                        <tr>
                            <th>Items</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                        <?php while ($rowitm = mysqli_fetch_assoc($qryitems)) { ?>
                            <tr>
                                <td><?php echo $rowitm['product_name']; ?></td>
                                <td><?php echo $rowitm['price']; ?></td>
                                <td><?php echo $rowitm['qty']; ?></td>
                                <td><?php echo $rowitm['item_total']; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3">Total</td>
                            <td><?php echo $rworder['order_total']; ?></td>
                        </tr>
                    </table>
                    <p><?php echo $message; ?></p>
                </div>
            </div>
        </div>

    </div>

</body>

<script>
    window.print();
</script>

</html>