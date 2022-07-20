<?php
session_start();
include_once("../inc/inc_koneksi.php");
include_once("../inc/inc_fungsi.php");
error_reporting(0); // menghilangkan notif erorr php
?>

<?php 

$username   = "";
$password   = "";
$err        = "";

if(isset($_POST['Login'])){
    $username       = $_POST['username'];
    $password       = $_POST['password'];

    if($username == '' or $password == ''){
        $err    = "Silahkan masukkan semua data!";
    }else{
        $sql1   = "select * from admin_profile where username = '$username'";
        $q1     = mysqli_query($koneksi,$sql1);
        $r1     = mysqli_fetch_array($q1);
        $n1     = mysqli_num_rows($q1);

        if($n1 < 1){
            $err = "Username tidak ditemukan.";
            // elseif($r1['password'] != md5($password))
        }elseif($r1['password'] != $password){
            $err = "Password yang Anda masukkan tidak sesuai.";
        }else{
            $_SESSION['admin_profile_username']     = $username;
            header("location:afterloginhomepage(admin).php");
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
    <link href="login(admin).css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Login Page (Admin)</title>
    </head>
    <body>
        <div class="header">
            <a href="beforeloginhomepage(admin).php">
                <img id="cateringin-logo" src="../pictures/cateringinlogo.png" alt="Image Not Loaded">
            </a>
        </div>
        <div class="login-form">
            <h1 id="login-form-title">Masuk (Login)</h1>
            <?php if($err){ echo "<div style='color:red; margin-top:1rem; list-style:none; font-size:1rem' id='error'>$err</div>";}?>
            <form class="login-form-box" action="" method="POST">
                <p id="login-form-box-username">Username</p>
                <input type="text" name="username" id="login-form-box-username-input-field" value="<?php echo $username?>">
                <p id="login-form-box-password">Password</p>
                <input type="password" name="password" id="login-form-box-password-input-field">
                <div class="login-form-box-admin-login-button-wrapper">
                        <input style="border: none; line-height: 2.5rem; width: 7.5rem; height: 2.5rem; margin-top: 1.5rem; margin-bottom: 1.5rem; color:white; background-color: #5CAC0E; border-radius: 1.5rem" type="submit" name="Login" value="MASUK" class="login-form-box-admin-login-button-wrapper-admin-login-button-text">  
                </div>
            </form>
        </div>
        <div class="footer">
            <div class="footer-social-media">
                <div class="footer-social-media-instagram"><img src="../pictures/instagramlogo.png" alt="Image Not Loaded"></div>
                <div class="footer-social-media-facebook"><img src="../pictures/facebooklogo.png" alt="Image Not Loaded"></div>
                <div class="footer-social-media-twitter"><img src="../pictures/twitterlogo.png" alt="Image Not Loaded"></div>
            </div>
            <span id="footer-copyright-text">COPYRIGHT 2022 CATERINGIN</span>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    </body>
</html>



