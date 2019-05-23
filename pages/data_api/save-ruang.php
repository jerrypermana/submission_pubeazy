<?php
include "../../config/koneksi.php";
//$author = $_POST['author'];
$status = true;
$ret = array(
    'success' => false,
    'msg' => 'Gagal Proses'
);

$nama_ruang     = $_POST['nama_ruang'];
$kuota          = $_POST['kuota'];
$date           = date("Y/m/d");







$query  = mysqli_query($konek, "INSERT INTO mst_ruang (nama_ruang, kuota, input_date, last_update)
        VALUES('$nama_ruang','$kuota','$date','$date')");
$status &= $query;

if ($status) {
    $ret['success'] = true;
    $ret['msg'] = "Berhasil Menambahkan Ruangan\n";
}


echo json_encode($ret);

 