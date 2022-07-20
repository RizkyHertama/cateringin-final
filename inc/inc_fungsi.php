<?php
function url_dasar(){
    //$_SERVER['SERVER_NAME'] : menyimpan alamat website
    //$_SERVER['SCRIPT_NAME'] : menyimpan direktori website
    $url_dasar = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);
    return $url_dasar;
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function kirim_email($email_penerima, $nama_penerima, $judul_email, $isi_email){
    
$email_pengirim   = "websitecateringin@gmail.com";
$nama_pengirim    = "CATERINGIN [noreply]";
    
//Load Composer's autoloader
require  getcwd().'/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->SMTPDebug = 0;
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $email_pengirim;                     //SMTP username
    $mail->Password   = 'gelkcwjnrhmliexh';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email_pengirim, $nama_pengirim);
    $mail->addAddress($email_penerima,  $nama_penerima);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $judul_email;
    $mail->Body    = $isi_email;

    $mail->send();
    return "sukses";
} catch (Exception $e) {
    return "gagal: {$mail->ErrorInfo}";
}
}