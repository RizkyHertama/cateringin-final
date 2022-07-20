<?php
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
error_reporting(0); 
?>

<?php
$err    = "";


if(!isset($_GET['email']) or !isset($_GET['kode'])){
    $err = "Data yang diperlukan untuk verifikasi tidak tersedia.";
}
else{
    $email = $_GET['email'];
    $kode   = $_GET['kode'];

    $sql1   = "select * from customer_profile where customer_email = '$email'";
    $q1   = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);

    if($r1['customer_status'] == $kode){
        $sql2 = "update customer_profile set customer_status = '1' where customer_email = '$email' ";
        mysqli_query($koneksi, $sql2);
        echo '<script type="text/javascript">
        alert("Akun telah aktif. Silahkan login di halaman login!");
        window.location.href = "loginpage(customer).php";
        </script>';
    
    }else{
        $err = "Kode tidak valid";
    }
}
?>

<h3>Halaman Verifikasi</h3> 
<?php if($err){ echo "<div class='error'>$err</div>";} ?>
