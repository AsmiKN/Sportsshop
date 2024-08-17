<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('./includes/connection.php');
require_once('includes/admin_navbar.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<?php require_once('includes/common.php'); ?>
<body><br><br>
 <?php
  require_once('includes/sidenav.php');
  ?>
   <center> <h1 style="color: black;">ORDER DETAILS</h1></center>
    
        <table border="1" style="color: black; margin: auto; width: 80%; border-collapse: collapse;">

        <tr>
            <th>Sl no.</th>
            <th>Customer id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Order_id</th>
            <th>Order Status</th>
            <th>Amount</th>
        </tr>
        
        <?php
        error_reporting(E_ALL);
                    
        $get_order_details = mysqli_query($conn, "SELECT customer_table.customer_address, customer_table.cust_id, customer_table.first_name, orders.order_id,orders.order_status, orders.order_total, orders.order_status, orders.order_total
FROM customer_table
JOIN orders ON customer_table.cust_id = orders.user_id");

        $num = 1; // Initialize the row number
        while ($row_orders = mysqli_fetch_assoc($get_order_details)) {
            echo "<tr>";
            echo "<td>$num</td>";
            echo "<td>{$row_orders['cust_id']}</td>"; 
            echo "<td>{$row_orders['first_name']}</td>";
            echo "<td>{$row_orders['customer_address']}</td>";
            echo "<td>{$row_orders['order_id']}</td>";
             echo "<td>{$row_orders['order_status']}</td>";
            echo "<td>{$row_orders['order_total']}</td>";
            echo "</tr>";
            $num++; // Increment the row number
        }
        ?>
    </table>
</body>
</html>
