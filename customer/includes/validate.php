<?php
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION['csid'])) {
    header("location: ../login.php");
}
