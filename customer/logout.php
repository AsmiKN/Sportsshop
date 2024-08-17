<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['cid']);
session_destroy();
header('location:../index.php');
?>