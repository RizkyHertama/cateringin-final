<?php 
session_start();
unset($_SESSION['admin_profile_username']);
session_destroy();
header("location:beforeloginhomepage(admin).php");
?>