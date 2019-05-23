<?php
include "../../config/koneksi.php";
//$author = $_POST['author'];
$status = true;
$ret = array(
    'success' => false,
    'msg' => 'Gagal Proses'
);

$nama       = strtoupper($_POST['subject']);

$tglinput = date("Y/m/d");
$tglubah = date("Y/m/d");




$query  = mysqli_query($konek, "INSERT INTO mst_subject (subject, input_date, last_update)
        VALUES('$nama', '$tglinput', '$tglubah')");
$status &= $query;

if ($status) {
    $ret['success'] = true;
    $ret['msg'] = "Berhasil Menambahkan Subject\n";
}


echo json_encode($ret);

 