<?php 
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
error_reporting(0); // menghilangkan notif erorr php
?>

<?php

$customer_email      = "";
$customer_password   = "";
$err        = "";

if(isset($_POST['login'])){
    $customer_email      = $_POST['customer_email'];
    $customer_password   = $_POST['customer_password'];

    if($customer_email == '' or $customer_password == ''){
        $err .= "<li>Silahkan isi semua data!</li>";
    }else{
        $sql1   = "select * from customer_profile where customer_email = '$customer_email'";
        $q1     = mysqli_query($koneksi,$sql1);
        $r1     = mysqli_fetch_array($q1);
        $n1     = mysqli_num_rows($q1);

        if($r1['status'] == '1' && $n1 > 0){
            $err .= "<li>Akun yang kamu miliki belum aktif.</li>";
        }

        // && $r1['status'] == '1'
        //md5
        if($r1['customer_password'] != md5($customer_password) && $n1 >0){
            $err .= "<li>Password tidak sesuai.</li>";
        }

        if($n1 < 1){
            $err .= "<li>Akun tidak ditemukan.</li>";
        }

        if(empty($err)){
            $_SESSION['customer_profile_customer_email'] = $customer_email;
            $_SESSION['customer_profile_customer_name'] = $r1['customer_name'];
            
            header("location:afterloginhomepage(customer).php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link href="loginpage(customer).css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Login Page (Customer)</title>
    </head>
    <body>
        <div class="header">
            <a href="index.php">
                <img id="cateringin-logo" src="pictures/cateringinlogo.png" alt="Image Not Loaded">
            </a>
        </div>
        <div class="login-form">
            <h1 id="login-form-title">Masuk (Login)</h1>
            <?php if($err){ echo "<div style='color:red; margin-top:1rem; list-style:none; font-size:1rem' id='error'>$err</div>";}?>
            <form class="login-form-box" action="" method="POST">
                <p id="login-form-box-email">Email</p>
                <input type="text" name="customer_email" id="login-form-box-email-input-field" value="<?php echo $customer_email?>">
                <p id="login-form-box-password">Password</p>
                <input type="password" name="customer_password" id="login-form-box-password-input-field">
                <p id="login-form-box-have-not-got-an-account">
                    Belum Punya Akun? 
                    <a id="register-account" href='<?php echo url_dasar()?>/registerpage(customer).php'>Daftar Akun</a>
                </p>
                <p id="login-form-box-forgot-password">
                    Lupa Password? 
                    <a id="reset-password" href='<?php echo url_dasar()?>/resetpasswordpage(customer).php'>
                        Reset Password
                    </a>
                </p>
                <div class="login-form-box-user-login-button-wrapper">
                        <input style="border: none; line-height: 2.5rem; width: 7.5rem; height: 2.5rem; margin-top: 1.5rem; margin-bottom: 1.5rem; color:white; background-color: #5CAC0E; border-radius: 1.5rem" type="submit" name="login" value="MASUK" class="login-form-box-user-login-button-wrapper-user-login-button-text">  
                </div>
            </form>
        </div>
        <div class="footer">
            <div class="footer-social-media">
                <div class="footer-social-media-instagram"><img src="pictures/instagramlogo.png" alt="Image Not Loaded"></div>
                <div class="footer-social-media-facebook"><img src="pictures/facebooklogo.png" alt="Image Not Loaded"></div>
                <div class="footer-social-media-twitter"><img src="pictures/twitterlogo.png" alt="Image Not Loaded"></div>
            </div>
            <span id="footer-copyright-text">COPYRIGHT 2022 CATERINGIN</span>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    </body>
</html>