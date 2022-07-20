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
<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="historypage(admin).css" rel="stylesheet" />
    <title>History Page (Customer)</title>
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
    <div class="wrapper">
      <h1 id="wrapper-heading">Riwayat Pesanan</h1>
      <?php $sql1   = "select * from customer_order_history;";
        $q1     = mysqli_query($koneksi,$sql1);
        $n1     = mysqli_num_rows($q1);

        if($n1>0){
          while($row = mysqli_fetch_assoc($q1)){
            $customer_first_food = $row['customer_first_food'];
            $customer_second_food = $row['customer_second_food'];
            $customer_third_food = $row['customer_third_food'];
            $customer_fourth_food = $row['customer_fourth_food'];
            $customer_fifth_food = $row['customer_fifth_food'];
            $customer_name = $row['customer_name'];
            $customer_address = $row['customer_address'];
            $customer_phone_number = $row['customer_phone_number'];
            $customer_order_notes = $row['customer_order_notes'];
            $customer_order_id = $row['customer_order_id'];
            $catering_period = $row['catering_period'];
            echo "<u><p id='wrapper-sub-heading'>ID Pesanan: $customer_order_id</p></u>";
            echo '<div class="wrapper-one">';
              echo '<ul>';
                  echo "<li id='wrapper-one-catering-period'>Periode Catering: $catering_period</li>";
                  echo "<li id='wrapper-one-total-price'>Total Harga: Rp 150.000</li>";
                  echo "<li id='wrapper-one-food-day-one'>Makanan Hari Pertama: $customer_first_food</li>";
                  echo "<li id='wrapper-one-food-day-two'>Makanan Hari Kedua: $customer_second_food</li>";
                  echo "<li id='wrapper-one-food-day-three'>Makanan Hari Ketiga: $customer_third_food</li>";
                  echo "<li id='wrapper-one-food-day-four'>Makanan Hari Keempat: $customer_fourth_food</li>";
                  echo "<li id='wrapper-one-food-day-five'>Makanan Hari Kelima: $customer_fifth_food</li>";
              echo '</ul>';
            echo '</div>';
            echo '<div class="wrapper-two">';
                echo '<div id="wrapper-two-text">Data-Data Pemesan</div>';
                echo '<div class="wrapper-two-order-history-data-box">';
                  echo '<p id="wrapper-two-order-history-data-box-name">Nama</p>';
                  echo "<input type='text' value = '$customer_name' id='wrapper-two-order-history-data-box-name-input-field'>";
                  echo '<p id="wrapper-two-order-history-data-box-delivery-address">Alamat Pengantaran</p>';
                  echo "<input type='text' value = '$customer_address' id='wrapper-two-order-history-data-box-delivery-address-input-field'>";
                  echo '<p id="wrapper-two-order-history-data-box-phone-number">Nomor Telepon</p>';
                  echo "<input type='text' value = '$customer_phone_number' id='wrapper-two-order-history-data-box-phone-number-input-field'>";
                  echo '<p id="wrapper-two-order-history-data-box-notes">Catatan</p>';
                  echo "<input type='text' value = '$customer_order_notes' id='wrapper-two-order-history-data-box-notes-input-field'>";
                echo '</div>';
            echo '</div>';
          }
        }
      ?>
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
    

