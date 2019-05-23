<?php
include "../../config/koneksi.php";
//$author = $_POST['author'];
$status = true;
$ret = array(
    'success' => false,
    'msg' => 'Gagal Proses'
);

$jam     = strtoupper($_POST['jam']);






$query  = mysqli_query($konek, "INSERT INTO jadwal_jam (jam)
        VALUES('$jam')");
$status &= $query;

if ($status) {
    $ret['success'] = true;
    $ret['msg'] = "Berhasil Menambahkan Jadwal Jam\n";
}


echo json_encode($ret);

 