<?php
include "classes/class.phpmailer.php";
include "../config/koneksi.php";

	
    $q_email        = "SELECT * FROM mst_email where email_id='1'";
    $hasil_email    = mysqli_query($konek, $q_email);
    $d_email        = mysqli_fetch_array($hasil_email);

 
$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "$d_email['SMTP_Host']"; //host masing2 provider email
$mail->SMTPDebug = 2;
$mail->Port = $d_email['SMTP_Port'];
$mail->SMTPAuth = true;
$mail->Username = "$d_email['SMTP_User']"; //user email
$mail->Password = "$d_email['SMTP_Pass']"; //password email 
$mail->SetFrom("pubeazy.conf@gmail.com","Nama pengirim"); //set email pengirim
$mail->Subject = "Testing"; //subyek email
$mail->AddAddress("jerrypermanaa@gmail.com","nama email tujuan");  //tujuan email
$mail->MsgHTML("Testing...");
if($mail->Send()) echo "Message has been sent";
else echo "Failed to sending message";

?>