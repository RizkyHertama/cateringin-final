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

<!doctype html>
<html>
  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet"> 
    <link href="afterloginhomepage(admin).css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>After Login Home Page (Admin)</title>
  </head>
  <body>

      <nav id="header" class="navbar fixed-top navbar-expand-lg navbar-dark bg-white" id="navbarcolor">
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
      <br><br><br><br>

        <div class="wrapper-top">
            <div class="wrapper-top-one">
              <h1 id="wrapper-top-one-heading">Nikmati Berbagai Menu Spesial!</h1>
              <p id="wrapper-top-one-text">CATERINGIN hadir untuk menyediakan berbagai menu catering yang 
                 lezat, sehat, dan bergizi buat kamu! Pesen CATERINGIN sekarang juga!!</p>
              <div class="wrapper-top-one-order-button">
                <div class="wrapper-top-one-order-button-order-button">
                  <a class="order-button-link" href="#">
                    <p id="wrapper-top-one-order-button-order-button-text">PESAN SEKARANG</p>
                  </a>
                </div>
              </div>
            </div>
            <div class="wrapper-top-two">
              <div class="wrapper-top-two-food-image-one">
                <img src="../pictures/wrappertwofoodimageone.png" alt="Image Not Loaded">
              </div>
              <div class="wrapper-top-two-food-image-two">
                <img src="../pictures/wrappertwofoodimagetwo.png" alt="Image Not Loaded">
              </div>
              <div class="wrapper-top-two-food-image-three">
                <img src="../pictures/wrappertwofoodimagethree.png" alt="Image Not Loaded">
              </div>
              <div class="wrapper-top-two-food-image-four">
                <img src="../pictures/wrappertwofoodimagefour.png" alt="Image Not Loaded">
              </div>
              <div class="wrapper-top-two-food-image-five">
                <img src="../pictures/wrappertwofoodimagefive.png" alt="Image Not Loaded">
              </div>
            </div>
        </div> 
        <div class="wrapper-bottom">
          <h1 id="wrapper-bottom-heading">Layanan Kami</h1>
          <div class="wrapper-bottom-box-wrapper">
            <div class="wrapper-bottom-box-wrapper-box-one">
                <div class="wrapper-bottom-box-wrapper-box-one-icon">
                  <img src="../pictures/famouscateringicon.png" alt="Image Not Loaded">
                </div>
                <h3 id="wrapper-bottom-box-wrapper-box-one-sub-heading">Catering Ternama</h3>
                <p id="wrapper-bottom-box-wrapper-box-one-text">CATERINGIN adalah layanan catering ternama yang sudah sangat berpengalaman!</p>
            </div>    
            <div class="wrapper-bottom-box-wrapper-box-two">
                <div class="wrapper-bottom-box-wrapper-box-two-icon">
                  <img src="../pictures/customizablecateringicon.png" alt="Image Not Loaded">
                </div>
                <h3 id="wrapper-bottom-box-wrapper-box-two-sub-heading">Custom Menu Catering</h3>
                <p id="wrapper-bottom-box-wrapper-box-two-text">Di CATERINGIN, kamu bisa nentuin menu cateringmu untuk lima hari! Catering selalu dimulai di hari Senin dan berakhir di hari Jumat.</p>
            </div>
            <div class="wrapper-bottom-box-wrapper-box-three">
                <div class="wrapper-bottom-box-wrapper-box-three-icon">
                  <img src="../pictures/deliveryicon.png" alt="Image Not Loaded">
                </div>
                <h3 id="wrapper-bottom-box-wrapper-box-three-sub-heading">Pengiriman Catering</h3>
                <p id="wrapper-bottom-box-wrapper-box-three-text">Habis milih menu catering, kami akan anterin makananmu selama 5 hari! Kamu tinggal nunggu dan makanan dateng deh!</p>
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


