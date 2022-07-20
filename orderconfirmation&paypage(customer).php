<?php
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
error_reporting(0); 
?>

<?php
if (!isset($_SESSION['customer_profile_customer_email'])){
  header("location:loginpage(customer).php");
  exit();
}
?>

<?php
$nextmonday = date( 'd-m-Y', strtotime( 'monday next week' ) );
$nextfriday = date( 'd-m-Y', strtotime( 'friday next week' ) );
$catering_period = "Senin, ".$nextmonday." - "." Jumat, ".$nextfriday;

date_default_timezone_set('Asia/Jakarta');
$date = date('m/d/Y h:i:s a', time());

$customer_name   ="";
$customer_address   ="";
$customer_phone_number   ="";
$customer_order_notes  ="";
$error      ="";
$customer_email      = $_SESSION['customer_profile_customer_email'];
$customer_first_food      = $_SESSION['customer_order_history_customer_first_food'];
$customer_second_food      = $_SESSION['customer_order_history_customer_second_food'];
$customer_third_food      = $_SESSION['customer_order_history_customer_third_food'];
$customer_fourth_food      = $_SESSION['customer_order_history_customer_fourth_food'];
$customer_fifth_food      = $_SESSION['customer_order_history_customer_fifth_food'];
$customer_email = $_SESSION['customer_profile_customer_email'];
$result = "";
$result2 = "";

if(isset($_POST['simpan'])){
  $customer_name   = $_POST['customer_name'];
  $customer_address   = $_POST['customer_address'];
  $customer_phone_number   = $_POST['customer_phone_number'];
  $customer_order_notes   = $_POST['customer_order_notes'];

  if($customer_name == '' or $customer_address == '' or $customer_phone_number == '' or  $customer_order_notes == ''){
    $error .= "<li>Silahkan isi semua data!</li>";
  }

  if(empty($error)){
      $sql1 = "insert into customer_order_history(customer_email, customer_name, customer_address, customer_phone_number, customer_order_notes, customer_first_food, customer_second_food, customer_third_food, customer_fourth_food, customer_fifth_food, catering_period) values 
      ('$customer_email', '$customer_name', '$customer_address', '$customer_phone_number', '$customer_order_notes', '$customer_first_food','$customer_second_food', '$customer_third_food', '$customer_fourth_food', '$customer_fifth_food', '$catering_period')";
      $q1 = mysqli_query($koneksi,$sql1);
      $_SESSION['customer_order_history_customer_name'] = $customer_name;
      $_SESSION['customer_order_history_customer_address'] = $customer_address;
      $_SESSION['customer_order_history_customer_phone_number'] = $customer_phone_number;
      $_SESSION['customer_order_history_customer_order_notes'] = $customer_order_notes;
      header("location:historypage(customer).php");
      exit();
  }

}
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="orderconfirmation&paypage(customer).css" rel="stylesheet" />
    <title>Order Confirmation & Pay Page (Customer)</title>
    </head>
    <body>
    <nav id="header" class="navbar fixed-top navbar-expand-lg navbar-dark bg-white">
            <div class="container-fluid">
              <a id="cateringin-logo-wrapper" class="navbar-brand" href="afterloginhomepage(customer).php">
                  <img src="pictures/cateringinlogo.png" alt="Image Not Loaded">
              </a>
              <button id="burger-icon" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 text-center">
                  <li class="nav-item" id="home-menu">
                    <a id="nav-item-link" class="nav-link active" aria-current="page" href="afterloginhomepage(customer).php">BERANDA</a>
                  </li>
                  <li class="nav-item" id="order-menu">
                    <a id="nav-item-link" class="nav-link active" aria-current="page" href="orderpage(customer).php">PESAN</a>
                  </li>
                  <li class="nav-item" id="history-menu">
                    <a id="nav-item-link" class="nav-link active" aria-current="page" href="historypage(customer).php">RIWAYAT</a>
                  </li>
                </ul>
              </div>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 text-center">
                  <li class="nav-item" id="user-name-menu">
                      <?php 
                        if(isset($_SESSION['customer_profile_customer_name'])){
                            echo "<a style='color: black; text-decoration:none;' href='".url_dasar()."/profile&topuppage(customer).php'>".$_SESSION['customer_profile_customer_name']."</a>";
                        }
                      ?> 
                  </li>
                </ul>
              </div>
            </div>
    </nav>   
    <br> <br> <br> <br> 
    <div class="wrapper">
      <h1 id="wrapper-heading"> Konfirmasi Pemesanan Catering & Pembayaran</h1>
      <u><p id="wrapper-sub-heading">Pesananmu di CATERINGIN</p></u>
      <div class="wrapper-one">
        <li id="wrapper-one-row-one">Periode Catering: <?php echo $catering_period?></li>
        <li id="wrapper-one-row-two">Total Harga: IDR 150000</li>
      </div>
      <div class="wrapper-two-outer-wrapper">
        <div class="wrapper-two-wrapper">
          <div class="wrapper-two-wrapper-row-one">
            <div class="wrapper-two-wrapper-row-one-food-one">
              <p id="wrapper-two-wrapper-row-one-food-one-bigger-text">Makanan Hari Pertama</p>
              <img id="wrapper-two-wrapper-row-one-food-one-image" src="pictures/<?php echo $_SESSION['customer_order_history_customer_first_food']?>.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-one-food-one-smaller-text"><?php echo $_SESSION['customer_order_history_customer_first_food']?></p>
            </div>
            <div class="wrapper-two-wrapper-row-one-food-two">
              <p id="wrapper-two-wrapper-row-one-food-two-bigger-text">Makanan Hari Kedua</p>
              <img id="wrapper-two-wrapper-row-one-food-two-image" src="pictures/<?php echo $_SESSION['customer_order_history_customer_second_food']?>.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-one-food-two-smaller-text"><?php echo $_SESSION['customer_order_history_customer_second_food']?></p>
            </div>
            <div class="wrapper-two-wrapper-row-one-food-three">
              <p id="wrapper-two-wrapper-row-one-food-three-bigger-text">Makanan Hari Ketiga</p>
              <img id="wrapper-two-wrapper-row-one-food-three-image" src="pictures/<?php echo $_SESSION['customer_order_history_customer_third_food']?>.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-one-food-three-smaller-text"><?php echo $_SESSION['customer_order_history_customer_third_food']?></p>
            </div>
          </div>
          <div class="wrapper-two-wrapper-row-two">
            <div class="wrapper-two-wrapper-row-two-food-one">
              <p id="wrapper-two-wrapper-row-two-food-one-bigger-text">Makanan Hari Keempat</p>
              <img id="wrapper-two-wrapper-row-two-food-one-image" src="pictures/<?php echo $_SESSION['customer_order_history_customer_fourth_food']?>.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-two-food-one-smaller-text"><?php echo $_SESSION['customer_order_history_customer_fourth_food']?></p>
            </div>
            <div class="wrapper-two-wrapper-row-two-food-two">
              <p id="wrapper-two-wrapper-row-two-food-two-bigger-text">Makanan Hari Kelima</p>
              <img id="wrapper-two-wrapper-row-two-food-two-image" src="pictures/<?php echo $_SESSION['customer_order_history_customer_fifth_food']?>.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-two-food-two-smaller-text"><?php echo $_SESSION['customer_order_history_customer_fifth_food']?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="wrapper-three">
        <p id="wrapper-three-text">Isilah Data-Data Pemesananmu!</p>
        <?php if($error){ echo "<div style='color:red; margin-top:1rem; list-style:none; font-size:1rem' id='error'>$error</div>";}?>
        <form class="wrapper-three-order-data-box" action="" method="POST">
          <p id="wrapper-three-order-data-box-name">Nama</p>
          <input type="text" name="customer_name" value="<?php echo $customer_name?>" id="wrapper-three-order-data-box-name-input-field">
          <p id="wrapper-three-order-data-box-delivery-address">Alamat Pengantaran</p>
          <input type="text" name="customer_address" value="<?php echo $customer_address?>" id="wrapper-three-order-data-box-delivery-address-input-field">
          <p id="wrapper-three-order-data-box-phone-number">Nomor Telepon</p>
          <input type="text" name="customer_phone_number" value="<?php echo $customer_phone_number?>" id="wrapper-three-order-data-box-phone-number-input-field">
          <p id="wrapper-three-order-data-box-notes">Catatan</p>
          <input type="text" name="customer_order_notes" value="<?php echo $customer_order_notes?>" id="wrapper-three-order-data-box-notes-input-field">
          <?php $sql1   = "select * from `customer_top_up_history` where `customer_email` = '$customer_email' ";
                      $q1     = mysqli_query($koneksi,$sql1);
                      $n1     = mysqli_num_rows($q1);
                      $customer_top_up_amount = 0;

                      $sql2   = "select `customer_order_id`
                      from `customer_order_history`
                      where `customer_email` = '$customer_email'";
                      $q2     = mysqli_query($koneksi,$sql2);
                      $n2     = mysqli_num_rows($q2);
                     
                      if($n1>0){
                        $count = 0;
                        while($row = mysqli_fetch_assoc($q1)){
                          $customer_gopay_phone_number = $row['customer_gopay_phone_number'];
                          $customer_top_up_amount += $row['customer_top_up_amount'];
                        }
                        if($n2==0){
                          echo "<p id='wrapper-three-order-data-box-your-balance-now'> Saldo Anda Sekarang: IDR $customer_top_up_amount</p>";
                        }
                        else{
                          while($row = mysqli_fetch_assoc($q2)){
                            $customer_order_id = $row['customer_order_id'];
                            $count++;
                          }
                          $result = $customer_top_up_amount-($count*150000);
                          echo "<p id='wrapper-three-order-data-box-your-balance-now'> Saldo Anda Sekarang: IDR $result</p>";
                        }
                      }
                      else{
                          $result2 = 0;
                          echo "<p id='wrapper-three-order-data-box-your-balance-now'>Saldo Anda Sekarang: IDR 0</p>";
                      }
                  ?>  
              <div class="wrapper-three-order-data-box-order-and-pay-button-wrapper">
                <input style="border: none; line-height: 2.5rem; width: 15rem; height: 2.5rem; margin-top: 1.5rem; margin-bottom: 1.5rem; color:white; background-color: #5CAC0E; border-radius: 1.5rem" type="submit" name="simpan" value="PESAN DAN BAYAR" class="wrapper-three-order-data-box-order-and-pay-button-wrapper-order-and-pay-button-text">  
              </div>
        </form>
      </div>
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