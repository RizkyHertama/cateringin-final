<?php
session_start();
include_once("../inc/inc_koneksi.php");
include_once("../inc/inc_fungsi.php");
error_reporting(0); // menghilangkan notif erorr php
?>

<?php
if (!isset($_SESSION['admin_profile_username'])){
  header("location:login(admin).php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link href="profile&logoutpage(admin).css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Profile & Logout Page (Admin)</title>
</head>
<body>

<nav id="header" class="navbar fixed-top navbar-expand-lg navbar-dark bg-white">
            <div class="container-fluid">
              <a id="cateringin-logo-wrapper" class="navbar-brand" href="afterloginhomepage(admin).php">
                  <img src="../pictures/cateringinlogo.png" alt="Image Not Loaded">
              </a>
              <button id="burger-icon" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 text-center">
                  <li class="nav-item" id="home-menu">
                    <a id="nav-item-link" class="nav-link active" aria-current="page" href="afterloginhomepage(admin).php">BERANDA</a>
                  </li>
                  <li class="nav-item" id="history-menu">
                    <a id="nav-item-link" class="nav-link active" aria-current="page" href="historypage(admin).php">RIWAYAT</a>
                  </li>
                </ul>
              </div>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 text-center">
                  <li class="nav-item" id="profile-menu">
                    <a style="text-decoration: none; color: black;" href="profile&logoutpage(admin).php">
                        ADMIN
                    </a> 
                  </li>
                </ul>
              </div>
            </div>
        </nav> 
        <br> <br> <br>

        <div class="wrapper">
        <div class="user-profile-form-wrapper">
            <h1 id="user-profile-form-title">Profil Admin</h1>
            <div class="user-profile-form">
              <form class="user-profile-form-box" action="" method="POST">
                <p id="user-profile-form-box-name">Nama</p>
                <input type="text" name="nama_lengkap" value="CATERINGIN (ADMIN)" disabled id="user-profile-form-box-name-input-field">
                <p id="user-profile-form-box-address">Alamat</p>
                <input type="text" name="alamat" value="CATERINGIN Tower 123, Jakarta"  disabled id="user-profile-form-box-address-input-field">
                <p id="user-profile-form-box-telephone-number">Nomor Telepon</p>
                <input type="text" name="telepon" value="021-12345678"  disabled id="user-profile-form-box-telephone-number-input-field">             
                <p id="user-profile-form-box-email">Email</p>
                <input type="text" name="email" value="websitecateringin@gmail.com" disabled id="user-profile-form-box-email-input-field">
              </form>
            </div>
          </div>     
          <div class="log-out-button-wrapper">
            <div class="log-out-button-wrapper-log-out-button">
              <p id="log-out-button-wrapper-log-out-button-text">  
                <?php if(isset($_SESSION['admin_profile_username'])){
                        echo "<a style='color: white; text-decoration:none;' href='".url_dasar()."/logout(admin).php'>KELUAR</a>";
                }?>
              </p>
            </div>
          </div>
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