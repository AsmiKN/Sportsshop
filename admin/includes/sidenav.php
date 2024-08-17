<div class="sidenav">
    <a href="admin_home.php">Home</a>
    <a href="category.php">Category</a>
    <button class="dropdown-btn">Products
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="products.php">List</a>
        <a href="new-product.php">Create</a>
    </div>

    <a href="view_order.php">Orders</a>
    <a href="login.php">Logout</a>

</div>

<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>