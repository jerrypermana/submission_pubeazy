<?php
include "../../config/koneksi.php";
//$author = $_POST['author'];
$status = true;
$ret = array(
    'success' => false,
    'msg' => 'Gagal Proses'
);

$username   = $_POST['username'];
$nama       = strtoupper($_POST['keyword']);

$tglinput = date("Y/m/d");
$tglubah = date("Y/m/d");




$query  = mysqli_query($konek, "INSERT INTO mst_keyword (keyword, input_date, last_update)
        VALUES('$nama', '$tglinput', '$tglubah')");
$status &= $query;

if ($status) {
    $ret['success'] = true;
    $ret['msg'] = "Berhasil Menambahkan Keyword \n";
}


echo json_encode($ret);

 