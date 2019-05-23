<?php
include "../../config/koneksi.php";
//$author = $_POST['author'];
$status = true;
$ret = array(
    'success' => false,
    'msg' => 'Gagal Proses'
);

$nama_bank     = $_POST['nama_bank'];
$rekening      = $_POST['rekening'];
$atas_nama     = $_POST['atas_nama'];






$query  = mysqli_query($konek, "INSERT INTO account_bank (nama_bank, rekening, atas_nama)
        VALUES('$nama_bank','$rekening','$atas_nama')");
$status &= $query;

if ($status) {
    $ret['success'] = true;
    $ret['msg'] = "Berhasil Menambahkan Account Bank\n";
}


echo json_encode($ret);

 