<!-- Koneksi ke database -->

<?php
$host    = "localhost";
$user    = "root";
$pass    = "";
$db      = "cateringin";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if(!$koneksi){
    die("Maaf, koneksi gagal tersambung.");
}