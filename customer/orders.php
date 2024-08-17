<?php
if (!isset($_SESSION))
    session_start();
require_once("includes/connection.php");
require_once("includes/validate.php");
$message = "";

$csid = $_SESSION['csid'];

//select order details
$qryorder = mysqli_query($conn, "SELECT o.order_id,o.user_id,o.order_status,o.ordered_on,o.order_total,c.first_name,c.last_name
FROM orders o
INNER JOIN customer_table c ON o.user_id = c.cust_id
WHERE user_id = '$csid'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
                    <h1 class="page-header col-12 col-md-6">My orders</h1>
                    <table class="table">
                        <tr>
                            <th>Order #</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php while ($rworder = mysqli_fetch_assoc($qryorder)) { ?>
                  <tr>
                                <td><?php echo $rworder['order_id']; ?></td>
                                <td><?php echo $rworder['ordered_on']; ?></td>
                                <td><?php echo $rworder['order_status']; ?></td>
                                <td>
                                    <?php echo '<a href="order-details.php?orderid=' . $rworder['order_id'] . '"><button class="btn btn-sm btn-primary"></i> view order</button></a>'; ?>
                                </td>
                                
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>

</html>

