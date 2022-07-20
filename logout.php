<?php
session_start();
unset($_SESSION['customer_profile_customer_email']);
unset($_SESSION['customer_profile_customer_name']);
session_destroy();
header("location:index.php");
?>