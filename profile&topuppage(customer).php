<?php
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
error_reporting(0); // menghilangkan notif erorr php
?>

<?php
if (!isset($_SESSION['customer_profile_customer_email'])){
  header("location:loginpage(customer).php");
  exit();
}
?>

<?php 
$customer_email = "";
$customer_name   = "";
$customer_address  = "";
$customer_phone_number  = "";
$err            = "";
$sukses         = "";

if(isset($_POST['simpan'])){
    $customer_name     = $_POST['customer_name'];
    $customer_address  = $_POST['customer_address'];
    $customer_phone_number = $_POST['customer_phone_number'];


    if($customer_name == ''){
        $err .= "<li>Silahkan masukkan nama!</li>";
    }

    if($customer_address == ''){
      $err .= "<li>Silahkan masukkan alamat!</li>";
  }

  if($customer_phone_number == ''){
    $err .= "<li>Silahkan masukkan nomor telepon!</li>";
}

  //jika gaada error
    if(empty($err)){
        $sql1 = "update customer_profile set customer_name = '".$customer_name."', customer_address = '".$customer_address."' , customer_phone_number = '".$customer_phone_number."' where customer_email = '".$_SESSION['customer_profile_customer_email']."'";
        mysqli_query($koneksi,$sql1);
        $sukses = "Berhasil memperbaharui profil.";
    }
}
?>

<?php 
$customer_email              = $_SESSION['customer_profile_customer_email'];
$customer_gopay_phone_number = "";
$customer_top_up_amount  = "";
$errdua                = "";
$suksesdua             = "";

if(isset($_POST['isisaldo'])){
  
    $customer_top_up_amount     = $_POST['customer_top_up_amount'];
    $customer_gopay_phone_number  = $_POST['customer_gopay_phone_number'];

    if($customer_top_up_amount == ''){
      $errdua .= "<li>Silahkan masukkan jumlah saldo!</li>";
    }

    if($customer_top_up_amount <= 0){
      $errdua .= "<li>Silahkan masukkan jumlah saldo yang valid!</li>";
    }

    if($customer_gopay_phone_number == ''){
       $errdua .= "<li>Silahkan masukkan Nomor Telepon GoPay Anda!</li>";
    }

  //jika gaada error
    if(empty($errdua)){
        $sql1 = "insert into customer_top_up_history(customer_email, customer_gopay_phone_number, customer_top_up_amount) values ('$customer_email', '$customer_gopay_phone_number', '$customer_top_up_amount')";
        $q1   = mysqli_query($koneksi, $sql1);
        $suksesdua = "Berhasil melakukan pengisian saldo.";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link href="profile&topuppage(customer).css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Profile and Top Up Page (Customer)</title>
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
                  <li class="nav-item" id="user-name">
                  <?php if(isset($_SESSION['customer_profile_customer_name'])){
                        echo "<a style='color: black; text-decoration:none;' href='".url_dasar()."/profile&topuppage(customer).php'>".$_SESSION['customer_profile_customer_name']."</a>";
                    }
          	      ?>
                  </li>
                </ul>
              </div>
            </div>
        </nav> 
        <br> <br> <br>
        <div class="wrapper">
          <div class="user-profile-form-wrapper">
            <h1 id="user-profile-form-title">Profil Pelanggan</h1>
            <?php if($err){ echo "<div style='color:red; text-align:center; margin-top:1rem; list-style:none; font-size:1rem' id='error'>$err</div>";}?>
		        <?php if($sukses) {echo "<div style='color:black; text-align:center; margin-top:1rem; list-style:none; font-size:1rem' id='sukses'>$sukses</div>";} ?>            
            <div class="user-profile-form">
              <form class="user-profile-form-box" action="" method="POST">
                <?php $sql1   = "select * from customer_profile where customer_email = '$customer_email'";
                      $q1     = mysqli_query($koneksi,$sql1);
                      $n1     = mysqli_num_rows($q1);
                      $_SESSION['customer_top_up_amount'] = "";
                      if($n1>0){
                        while($row = mysqli_fetch_assoc($q1)){
                          $customer_name = $row['customer_name'];
                          $customer_address = $row['customer_address'];
                          $customer_phone_number = $row['customer_phone_number'];
                          $customer_email = $row['customer_email'];
                          echo '<p id="user-profile-form-box-name">Nama</p>';
                          echo "<input type='text' name='customer_name' value='$customer_name' id='user-profile-form-box-name-input-field'>";
                          echo '<p id="user-profile-form-box-address">Alamat Tinggal</p>';
                          echo "<input type='text' name='customer_address' value='$customer_address' id='user-profile-form-box-address-input-field'>";
                          echo '<p id="user-profile-form-box-telephone-number">Nomor Telepon</p>';
                          echo "<input type='text' name='customer_phone_number' value='$customer_phone_number' id='user-profile-form-box-telephone-number-input-field'>";
                          echo '<p id="user-profile-form-box-email">Email</p>';
                          echo "<input type='text' disabled name='customer_email' value='$customer_email' id='user-profile-form-box-email-input-field'>";
                      }}
                echo '<div class="user-profile-form-box-user-profile-button-wrapper">';
                    echo '<input style="border:none; line-height: 2.5rem; width: 7.5rem; height: 2.5rem; margin-top: 1.5rem; margin-bottom: 1.5rem; color:white; background-color: #5CAC0E; border-radius: 1.5rem" type="submit" name="simpan" value="UPDATE" class="user-profile-form-box-user-profile-button-wrapper-user-profile-button-text">'; 
                echo '</div>';
                ?>
              </form>
            </div>
          </div>
          <div class="user-top-up-form-wrapper">
            <h1 id="user-top-up-form-title">Isi Saldo</h1>
            <?php if($errdua){ echo "<div style='color:red; text-align:center; margin-top:1rem; list-style:none; font-size:1rem' id='error'>$errdua</div>";}?>
		        <?php if($suksesdua) {echo "<div style='color:black; text-align:center; margin-top:1rem; list-style:none; font-size:1rem' id='sukses'>$suksesdua</div>";} ?>            
            <div class="user-top-up-form">
              <form class="user-top-up-form-box" action="" method="POST">
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
                          echo "<p id='user-top-up-form-box-your-balance-now'> Saldo Anda Sekarang: IDR $customer_top_up_amount</p>";
                          echo '<p id="user-top-up-form-box-gopay-phone-number">Nomor Telepon GoPay</p>';
                          echo "<input type='text' name='customer_gopay_phone_number' value='$customer_gopay_phone_number' id='user-top-up-form-box-gopay-phone-number-input-field'>";
                          echo '<p id="user-top-up-form-box-balance-amount">Jumlah Saldo</p>';
                          echo "<input type='text' name='customer_top_up_amount' id='user-top-up-form-box-balance-amount-input-field'>";
                          $_SESSION['customer_top_up_amount'] = $customer_top_up_amount;
                        }
                        else{
                          while($row = mysqli_fetch_assoc($q2)){
                            $customer_order_id = $row['customer_order_id'];
                            $count++;
                          }
                          $result = $customer_top_up_amount-($count*150000);
                          echo "<p id='user-top-up-form-box-your-balance-now'> Saldo Anda Sekarang: IDR $result</p>";
                          echo '<p id="user-top-up-form-box-gopay-phone-number">Nomor Telepon GoPay</p>';
                          echo "<input type='text' name='customer_gopay_phone_number' value='$customer_gopay_phone_number' id='user-top-up-form-box-gopay-phone-number-input-field'>";
                          echo '<p id="user-top-up-form-box-balance-amount">Jumlah Saldo</p>';
                          echo "<input type='text' name='customer_top_up_amount' id='user-top-up-form-box-balance-amount-input-field'>";
                          $_SESSION['customer_top_up_amount'] = $result;
                        }
                      }
                      else{
                          echo '<p id="user-top-up-form-box-your-balance-now">Saldo Anda Sekarang: IDR 0</p>';
                          echo '<p id="user-top-up-form-box-gopay-phone-number">Nomor Telepon GoPay</p>';
                          echo '<input type="text" name="customer_gopay_phone_number" id="user-top-up-form-box-gopay-phone-number-input-field">';
                          echo '<p id="user-top-up-form-box-balance-amount">Jumlah Saldo</p>';
                          echo '<input type="text" name="customer_top_up_amount" id="user-top-up-form-box-balance-amount-input-field">';
                          $_SESSION['customer_top_up_amount'] = 0;
                      }
                      echo '<div class="user-top-up-form-box-user-top-up-button-wrapper">';
                          echo '<input style="border:none; line-height: 2.5rem; width: 7.5rem; height: 2.5rem; margin-top: 1.5rem; margin-bottom: 1.5rem; color:white; background-color: #5CAC0E; border-radius: 1.5rem" type="submit" name="isisaldo" value="ISI SALDO" class="user-top-up-form-box-user-top-up-button-wrapper-user-top-up-button-text">';  
                      echo '</div>';
                  ?>  
              </form>  
            </div>
          </div>      
          <div class="log-out-button-wrapper">
            <div class="log-out-button-wrapper-log-out-button">
              <p id="log-out-button-wrapper-log-out-button-text">  
                <?php if(isset($_SESSION['customer_profile_customer_name'])){
                        echo "<a style='color: white; text-decoration:none;' href='".url_dasar()."/logout.php'>KELUAR</a>";
                }?>
              </p>
            </div>
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