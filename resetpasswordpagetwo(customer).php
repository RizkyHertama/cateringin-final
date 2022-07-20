<?php 
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
error_reporting(0); // menghilangkan notif erorr php
?>

<?php 

$err    = "";
$sukses = "";

$email  = $_GET['email'];
$token  = $_GET['token'];

if($token == '' or $email == ''){
    $err .= "<li>Link tidak valid. Email dan token tidak tersedia.</li>";
    header("location:resetpasswordpage(customer).php");
    exit();
}else{
    $sql1 ="select * from customer_profile where customer_email = '$email' and customer_password_change_token = '$token'";
    $q1   = mysqli_query($koneksi,$sql1);
    $n1   = mysqli_num_rows($q1);

    if($n1 < 1){
        $err .= "<li>Link tidak valid. Email dan token tidak sesuai.</li>";
        header("location:resetpasswordpage(customer).php");
        exit();
    }
}

if(isset($_POST['submit'])){
    $password   = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if($password == '' or $konfirmasi_password == ''){
        $err .= "<li>Silahkan masukkan password baru serta konfirmasi password!</li>";
    }elseif($konfirmasi_password != $password){
        $err .= "<li>Konfirmasi password tidak sesuai dengan password.</li>";
    }elseif(strlen($password)<6){
        $err .= "<li>Jumlah karakter yang diperbolehkan untuk password minimal 6 karakter.</li>";
    }

    if(empty($err)){
        $sql1 = "update customer_profile set customer_password_change_token = '', customer_password=md5($password) where customer_email = '$email'";
        mysqli_query($koneksi,$sql1);
        $sukses = "<li>Password telah berhasil diganti. Silahkan <a href='".url_dasar()."/loginpage(customer).php'>Login</a>.</li>";
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link href="resetpasswordpagetwo(customer).css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Reset Password Page (Customer)</title>
    </head>
    <body>
        <div class="header">
            <a href="index.php">
                <img id="cateringin-logo" src="pictures/cateringinlogo.png" alt="Image Not Loaded">
            </a>
        </div>
        <div class="reset-password-form">
            <h1 id="reset-password-form-title">Reset Password</h1>
            <?php if($err){ echo "<div style='text-align:center; color:red; margin-top:1rem; list-style:none; font-size:1rem' id='error'>$err</div>";}?>
            <?php if($sukses){ echo "<div style='text-align:center; color:black; margin-top:1rem; list-style:none; font-size:1rem' id='sukses'>$sukses</div>";}?>
            <form class="reset-password-form-box" action="" method="POST">
                <p id="reset-password-form-box-password">Password</p>
                <input type="password" name="password" id="reset-password-form-box-password-input-field">
                <p id="reset-password-form-box-password-confirmation">Konfirmasi Password</p>
                <input type="password" name="konfirmasi_password" id="reset-password-form-box-password-confirmation-input-field">
                <div class="reset-password-form-box-user-reset-password-button-wrapper">
                        <input style="border:none; line-height: 2.5rem; width: 11.25rem; height: 2.5rem; margin-top: 1.5rem; margin-bottom: 1.5rem; color:white; background-color: #5CAC0E; border-radius: 1.5rem" type="submit" name="submit" value="RESET PASSWORD" class="reset-password-form-box-user-reset-password-button-wrapper-user-reset-password-button-text">  
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