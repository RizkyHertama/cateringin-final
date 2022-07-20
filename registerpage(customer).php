<?php 
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
error_reporting(0); // menghilangkan notif erorr php
?>
 
<?php 
$email        = "";
$nama_lengkap = "";
$err          = "";
$sukses       = "";
$alamat       = "";
$telepon      = "";
$password     = "";
$konfirmasi_password = "";

if(isset($_POST['simpan'])){
    $email               = $_POST['email'];
    $nama_lengkap        = $_POST['nama_lengkap'];
    $alamat              = $_POST['alamat'];
    $telepon             = $_POST['telepon'];
    $password            = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    //ngecek kalo data dalam from pendaftaran kosong
    if($email ==  '' or $nama_lengkap == '' or $konfirmasi_password == '' or $password == '' or
    $alamat  == '' or  $telepon == ''){
        $err .= "<li>Silahkan isi semua data!</li>";
    }

    //cek di bagian db, apakah email sudah digunakan?
    if($email != ''){
        $sql1 = "select customer_email from customer_profile where customer_email = '$email'";
        $q1 =  mysqli_query($koneksi, $sql1);
        $n1   = mysqli_num_rows($q1);
        
        if($n1 > 0){
            $err .= "<li>Email yang kamu masukkan sudah terdaftar.</li>";
        }

        //validasi email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){            
            $err .= "<li>Email yang kamu masukkan tidak valid.</li>";
        }
    }

    //cek apakah password sesuai dengan konfirmasi password
    if($password != $konfirmasi_password){
        $err .= "<li>Password dan konfirmasi password tidak sesuai.</li>";
    }

    //validasi pengisian password
    if(strlen($password) < 6){
        $err .= "<li>Panjang karakter minimal untuk password adalah 6 karakter.";
    }

    if(empty($err)){
        $status         = md5(rand(0, 1000));
        $judul_email    = "Aktivasi Akun CATERINGIN";
        $isi_email      = "Halo <b>$nama_lengkap</b>. <br/><br/> Akun yang kamu miliki dengan email <b>$email</b> telah siap digunakan. <br/><br/>";
        $isi_email      .= "Selanjutnya, silahkan melakukan proses aktivasi akun melalui link di bawah ini: <br/></br>";
        $isi_email      .= url_dasar()."/verifikasi.php?email=$email&kode=$status";
        $isi_email      .= "<br/><br/> Hormat kami, <br/> CATERINGIN <br/>";
        
        //function dari php mailer
        kirim_email($email, $nama_lengkap, $judul_email, $isi_email);

        $sql1 = "insert into customer_profile(customer_email, customer_name, customer_password, customer_status, customer_phone_number, customer_address) values ('$email', '$nama_lengkap',  md5($password), '$status', '$telepon', '$alamat')";
        $q1   = mysqli_query($koneksi, $sql1);

        if($q1){
            $sukses = "Proses berhasil, silahkan periksa email kamu untuk melakukan aktivasi akun!";
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
    <link rel="stylesheet" href="register(customer).css">
    <title>Register Page (Customer)</title>
    </head>
    <body>
        <div class="header">
            <a href="index.php">
                <img id="cateringin-logo" src="pictures/cateringinlogo.png" alt="Image Not Loaded">
            </a>
        </div>
        <div class="register-form">
            <h1 id="register-form-title">Pendaftaran Akun</h1>
            <?php if($err){ echo "<div style='text-align:center; color:red; margin-top:1rem; list-style:none; font-size:1rem' id='error'>$err</div>";}?>
            <?php if($sukses){ echo "<div style='text-align:center; color:black; margin-top:1rem; list-style:none; font-size:1rem' id='sukses'>$sukses</div>";}?>
            <form class="register-form-box" action="" method="POST">
                <p id="register-form-box-name">Nama</p>
                <input type="text" name="nama_lengkap" id="register-form-box-name-input-field" value="<?php echo $nama_lengkap?>">
                <p class="register-form-box-address">Alamat</p>
                <input type="text" name="alamat" id="register-form-box-address-input-field" value="<?php echo $alamat?>">
                <p id="register-form-box-phone-number">Nomor Telepon</p>
                <input type="text" name="telepon" id="register-form-box-phone-number-input-field" value="<?php echo $telepon?>">
                <p id="register-form-box-email">Email</p>
                <input type="text" name="email" id="register-form-box-email-input-field" value="<?php echo $email?>">
                <p id="register-form-box-password">Password</p>
                <input type="password" name="password" id="register-form-box-password-input-field">
                <p id="register-form-box-password-confirmation">Konfirmasi Password</p>
                <input type="password" name="konfirmasi_password" id="register-form-box-password-confirmation-input-field">
                <div class="register-form-box-user-register-button-wrapper">
                        <input style="border: none; line-height: 2.5rem; width: 7.5rem; height: 2.5rem; margin-top: 1.5rem; margin-bottom: 1.5rem; color:white; background-color: #5CAC0E; border-radius: 1.5rem" type="submit" name="simpan" value="DAFTAR" class="register-form-box-user-register-button-wrapper-user-register-button-text">  
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
    </body>
</html>


