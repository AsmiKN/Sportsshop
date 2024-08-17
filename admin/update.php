<!DOCTYPE html>
<html>
<head>
    <title>Update Products</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
      
            <h2>UPDATE PRODUCT DETAILS</h2>

            Product NAME:<br>
            <input type="text" name="pname" required="TRUE" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);"
            value="<?php echo $row['product_name']?>"><br>

            Product Description:<br>
            <input type="text" name="desc" required="TRUE" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);"
            value="<?php echo $row['description']?>"><br>

            
            Product price:<br>
            <input type="number" name="price" required="TRUE" value="<?php echo $row['price']?>"><br>

          
            Product Image 1:<br>
            <img class="img" src="./images/<?php echo $row['image1'] ?>" width="50px"><br>

            NEW IMAGE 1:<br>
            <input type="file" name="img1"><br>

           Product stock:<br>
            <input type="text" name="stock" required="TRUE" value="<?php echo $row['stock']?>"><br>

            <input type="submit" class="btn" name="update" value="SAVE">
            <input type="reset" class="btn" name="reset" value="CANCEL ">
       
    </form>
</body>
</html>
<?php


