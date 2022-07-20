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
$customer_first_food   ="";
$customer_second_food   ="";
$customer_third_food   ="";
$customer_fourth_food   ="";
$customer_fifth_food   ="";
$error      = "";
$customer_email = $_SESSION['customer_profile_customer_email'];
$customer_top_up_amount = $_SESSION['customer_top_up_amount'];

$monday = date( 'd-m-Y', strtotime( 'monday this week' ) );
$tuesday = date( 'd-m-Y', strtotime( 'tuesday this week' ) );
$wednesday = date( 'd-m-Y', strtotime( 'wednesday this week' ) );
$thursday = date( 'd-m-Y', strtotime( 'thursday this week' ) );
$friday = date( 'd-m-Y', strtotime( 'friday this week' ) );
$nextmonday = date( 'd-m-Y', strtotime( 'monday next week' ) );
$nextfriday = date( 'd-m-Y', strtotime( 'friday next week' ) );

date_default_timezone_set('Asia/Jakarta');
$date = date('m/d/Y h:i:s a', time());

$newDate = date('l');
if($newDate == 'Monday' || $newDate == 'Tuesday' ||
$newDate == 'Wednesday'|| $newDate == 'Thursday' || $newDate == 'Friday'){
  $status = "Dibuka";
}
else{
  $status = "Ditutup";
}

if($status == "Ditutup"){
  echo '<script type="text/javascript">
  alert("Mohon maaf, saat ini pemesanan sedang ditutup. Pemesanan dibuka kembali hari Senin sampai dengan Jumat.");
  window.location.href = "afterloginhomepage(customer).php";
  </script>';
}

if(isset($_POST['simpan'])){
  // $customer_top_up_amount = $_POST['customer_top_up_amount'];
  $customer_first_food   = $_POST['customer_first_food'];
  $customer_second_food   = $_POST['customer_second_food'];
  $customer_third_food   = $_POST['customer_third_food'];
  $customer_fourth_food   = $_POST['customer_fourth_food'];
  $customer_fifth_food  = $_POST['customer_fifth_food'];
  
  if($customer_first_food == '' or $customer_second_food == '' or $customer_third_food == '' or $customer_fourth_food == '' or $customer_fifth_food  == ''){
      $error .= "<li>Silahkan input makanan untuk lima hari!</li>";
  }
  
  if($customer_first_food == ''){
    $error .= "<li>Makanan hari pertama belum Anda isi.</li>";
  }

  if($customer_first_food != '' and $customer_first_food != 'Nasi Goreng' and $customer_first_food != 'Mie Goreng Aceh' and $customer_first_food != 'Nasi Uduk' and
  $customer_first_food != 'Nasi Gudeg' and $customer_first_food != 'Nasi Bogana' and $customer_first_food != 'Nasi Liwet'){
      $error .= "<li>Makanan hari pertama yang Anda masukkan tidak ada di menu kami.</li>";
  }

  if($customer_second_food == ''){
    $error .= "<li>Makanan hari kedua belum Anda isi.</li>";
  }

  if($customer_second_food != '' and $customer_second_food != 'Nasi Goreng' and $customer_second_food != 'Mie Goreng Aceh' and $customer_second_food != 'Nasi Uduk' and
  $customer_second_food != 'Nasi Gudeg' and $customer_second_food != 'Nasi Bogana' and $customer_second_food != 'Nasi Liwet'){
      $error .= "<li>Makanan hari kedua yang Anda masukkan tidak ada di menu kami.</li>";
  }

  if($customer_third_food == ''){
    $error .= "<li>Makanan hari ketiga belum Anda isi.</li>";
  }

  if($customer_third_food != '' and $customer_third_food != 'Nasi Goreng' and $customer_third_food != 'Mie Goreng Aceh' and $customer_third_food != 'Nasi Uduk' and
  $customer_third_food != 'Nasi Gudeg' and $customer_third_food != 'Nasi Bogana' and $customer_third_food != 'Nasi Liwet'){
      $error .= "<li>Makanan hari ketiga yang Anda masukkan tidak ada di menu kami.</li>";
  }

  if($customer_fourth_food == ''){
    $error .= "<li>Makanan hari keempat belum Anda isi.</li>";
  }

  if($customer_fourth_food != '' and $customer_fourth_food != 'Nasi Goreng' and $customer_fourth_food != 'Mie Goreng Aceh' and $customer_fourth_food != 'Nasi Uduk' and
  $customer_fourth_food != 'Nasi Gudeg' and $customer_fourth_food != 'Nasi Bogana' and $customer_fourth_food != 'Nasi Liwet'){
      $error .= "<li>Makanan hari keempat yang Anda masukkan tidak ada di menu kami.</li>";
  }

  if($customer_fifth_food == ''){
    $error .= "<li>Makanan hari kelima belum Anda isi.</li>";
  }

  if($customer_fifth_food != '' and $customer_fifth_food != 'Nasi Goreng' and $customer_fifth_food != 'Mie Goreng Aceh' and $customer_fifth_food != 'Nasi Uduk' and
  $customer_fifth_food != 'Nasi Gudeg' and $customer_fifth_food != 'Nasi Bogana' and $customer_fifth_food != 'Nasi Liwet'){
      $error .= "<li>Makanan hari kelima yang Anda masukkan tidak ada di menu kami.</li>";
  }
    
  if($customer_top_up_amount<150000){
    $error .= "<li>Saldo Anda kurang. Silahkan isi saldo!</li>";
  }

  if(empty($error)){
      $_SESSION['customer_order_history_customer_first_food'] = $customer_first_food;
      $_SESSION['customer_order_history_customer_second_food'] = $customer_second_food;
      $_SESSION['customer_order_history_customer_third_food'] = $customer_third_food;
      $_SESSION['customer_order_history_customer_fourth_food'] = $customer_fourth_food;
      $_SESSION['customer_order_history_customer_fifth_food'] = $customer_fifth_food;
      header("location:orderconfirmation&paypage(customer).php");
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
    <link href="orderpage(customer).css" rel="stylesheet" />
    <title>Order Page (Customer)</title>
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
      <h1 id="wrapper-heading">Pemesanan Menu Catering</h1>
      <u><p id="wrapper-sub-heading">Pilihlah 5 Makanan untuk 5 Hari (1 Hari 1 Makanan)!</p></u>
      <div class="wrapper-one">
        <ul>
          <li id="wrapper-one-row-one">Periode Catering: Senin, <?php print "$nextmonday"?> - Jumat, <?php print "$nextfriday"?></li>
          <li id="wrapper-one-row-two">Waktu Pemesanan Catering Periode Ini:</li>
          <p id="wrapper-one-row-three">Senin, <?php print "$monday"?> - Jumat, <?php print "$friday"?></p>
          <li style="margin-bottom: 0.25rem" id="wrapper-one-row-four">Harga 5 Hari Catering: Rp 150.000</li>
          <li id="wrapper-one-row-five">Status pemesanan catering: <?php print "$status"?></li>
        </ul>
      </div>
      <div class="wrapper-two-outer-wrapper">
        <div class="wrapper-two-wrapper">
          <div class="wrapper-two-wrapper-row-one">
            <div class="wrapper-two-wrapper-row-one-food-one">
              <img id="wrapper-two-wrapper-row-one-food-one-image" src="pictures/Mie Goreng Aceh.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-one-food-one-text">Mie Goreng Aceh</p>
            </div>
            <div class="wrapper-two-wrapper-row-one-food-two">
              <img id="wrapper-two-wrapper-row-one-food-two-image" src="pictures/Nasi Bogana.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-one-food-two-text">Nasi Bogana</p>
            </div>
            <div class="wrapper-two-wrapper-row-one-food-three">
              <img id="wrapper-two-wrapper-row-one-food-three-image" src="pictures/Nasi Goreng.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-one-food-three-text">Nasi Goreng</p>
            </div>
          </div>
          <div class="wrapper-two-wrapper-row-two">
            <div class="wrapper-two-wrapper-row-two-food-one">
              <img id="wrapper-two-wrapper-row-two-food-one-image" src="pictures/Nasi Uduk.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-two-food-one-text">Nasi Uduk</p>
            </div>
            <div class="wrapper-two-wrapper-row-two-food-two">
              <img id="wrapper-two-wrapper-row-two-food-two-image" src="pictures/Nasi Liwet.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-two-food-two-text">Nasi Liwet</p>
            </div>
            <div class="wrapper-two-wrapper-row-two-food-three">
              <img id="wrapper-two-wrapper-row-two-food-three-image" src="pictures/Nasi Gudeg.png" alt="Image Not Loaded">
              <p id="wrapper-two-wrapper-row-two-food-three-text">Nasi Gudeg</p>
            </div>
          </div>
        </div>
      </div>
      <div class="wrapper-three">
        <p id="wrapper-three-text">Isilah Pilihan Makananmu!</p>
        <?php if($error){ echo "<div style='color:red; margin-top:1rem; list-style:none; font-size:1rem' id='error'>$error</div>";}?>
        <form class="wrapper-three-menu-choice-box" action="" method="POST">
          <p id="wrapper-three-menu-choice-box-first-day-menu">Makanan Hari Pertama</p>
          <input type="text" name="customer_first_food" value="<?php echo $customer_first_food?>" id="wrapper-three-menu-choice-box-first-day-menu-input-field">
          <p id="wrapper-three-menu-choice-box-second-day-menu">Makanan Hari Kedua</p>
          <input type="text" name="customer_second_food" value="<?php echo $customer_second_food?>" id="wrapper-three-menu-choice-box-second-day-menu-input-field">
          <p id="wrapper-three-menu-choice-box-third-day-menu">Makanan Hari Ketiga</p>
          <input type="text" name="customer_third_food" value="<?php echo $customer_third_food?>" id="wrapper-three-menu-choice-box-third-day-menu-input-field">
          <p id="wrapper-three-menu-choice-box-fourth-day-menu">Makanan Hari Keempat</p>
          <input type="text" name="customer_fourth_food" value="<?php echo $customer_fourth_food?>" id="wrapper-three-menu-choice-box-fourth-day-menu-input-field">
          <p id="wrapper-three-menu-choice-box-fifth-day-menu">Makanan Hari Kelima</p>
          <input type="text" name="customer_fifth_food" value="<?php echo $customer_fifth_food?>" id="wrapper-three-menu-choice-box-fifth-day-menu-input-field">
          <?php 
            $sql1   = "select * from `customer_top_up_history` where `customer_email` = '$customer_email' ";
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
                echo "<p id='wrapper-three-menu-choice-box-your-balance-now'> Saldo Anda Sekarang: IDR $customer_top_up_amount</p>";
                $_SESSION['customer_top_up_amount'] = $customer_top_up_amount;
              }
              else{
                while($row = mysqli_fetch_assoc($q2)){
                  $customer_order_id = $row['customer_order_id'];
                  $count++;
                }
                $result = $customer_top_up_amount-($count*150000);
                echo "<p id='wrapper-three-menu-choice-box-your-balance-now'> Saldo Anda Sekarang: IDR $result</p>";
                $_SESSION['customer_top_up_amount'] = $result;
              }
            }
            else{
                $resulttwo = 0;
                echo "<p id='wrapper-three-menu-choice-box-your-balance-now'>Saldo Anda Sekarang: IDR 0</p>";
                $_SESSION['customer_top_up_amount'] = 0;
            }
          ?>
          <div class="wrapper-three-menu-choice-box-continue-order-button-wrapper">
                <input style="border: none; line-height: 2.5rem; width: 15rem; height: 2.5rem; margin-top: 1.5rem; margin-bottom: 1.5rem; color:white; background-color: #5CAC0E; border-radius: 1.5rem" type="submit" name="simpan" value="LANJUTKAN PEMESANAN" class="wrapper-three-menu-choice-box-continue-order-button-wrapper-continue-order-button-text">  
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
    
