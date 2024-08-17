<?php
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION['user'])) {
    print_r($_SESSION);
    header("location:login.php");
}
