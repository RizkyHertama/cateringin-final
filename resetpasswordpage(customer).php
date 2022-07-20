<?php 
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
error_reporting(0); // menghilangkan notif erorr php
?>

<?php 
$err    = "";
$sukses = "";
$email  = "";

if(isset($_POST['submit'])){
    $email  = $_POST['email'];
    if($email == ''){
        $err = "Silahkan masukkan email!";
    }else{
        $sql1 = "select * from customer_profile where customer_email = '$email'";
        $q1   = mysqli_query($koneksi,$sql1);
        $n1   = mysqli_num_rows($q1);

        if($n1 < 1){
            $err = "Email: <b>$email</b> tidak ditemukan.";
        }
    }

    if(empty($err)){
        $token_ganti_password   = md5(rand(0,1000));
        $judul_email            = "Permintaan Penggantian Password";
        $isi_email              = "Halo <b>$email</b>, sistem mendeteksi adanya permintaan untuk perubahan password. <br/> Silakan klik link di bawah ini untuk melakukan penggantian password!<br/>";
        $isi_email              .= url_dasar()."/resetpasswordpagetwo(customer).php?email=$email&token=$token_ganti_password";
        $isi_email              .= "<br/><br/> Hormat Kami, <br/> CATERINGIN<br/>";
        kirim_email($email,$email,$judul_email,$isi_email);

        $sql1     = "update customer_profile set customer_password_change_token = '$token_ganti_password' where customer_email = '$email'";
        mysqli_query($koneksi,$sql1);
        $sukses  ="Link untuk mengganti password sudah dikirimkan ke email Anda.";
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link href="resetpasswordpage(customer).css" rel="stylesheet" />
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
            <?php if($err){ echo "<div style='color:red; margin-top:1rem; list-style:none; font-size:1rem' id='error'>$err</div>";}?>
            <?php if($sukses){ echo "<div style='color:black; margin-top:1rem; list-style:none; font-size:1rem' id='sukses'>$sukses</div>";}?>
            <form class="reset-password-form-box" action="" method="POST">
                <p id="reset-password-form-box-email">Email</p>
                <input type="text" name="email" id="reset-password-form-box-email-input-field" value="<?php echo $email?>">
                <div class="reset-password-form-box-user-reset-password-button-wrapper">
                        <input style="border: none; line-height: 2.5rem; width: 7.5rem; height: 2.5rem; margin-top: 1.5rem; margin-bottom: 1.5rem; color:white; background-color: #5CAC0E; border-radius: 1.5rem" type="submit" name="submit" value="KIRIM" class="reset-password-form-box-user-reset-password-button-wrapper-user-reset-password-button-text">  
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