<?php
include "../../config/koneksi.php";
//$author = $_POST['author'];
$status = true;
$ret = array(
    'success' => false,
    'msg' => 'Gagal Proses'
);

$paket      = strtoupper($_POST['nama_paket']);
$biaya      = $_POST['biaya'];





$query  = mysqli_query($konek, "INSERT INTO paket_konferensi(nama_paket,biaya)
        VALUES('$paket','$biaya')");
$status &= $query;

if ($status) {
    $ret['success'] = true;
    $ret['msg'] = "Berhasil Menambahkan Package\n";
}


echo json_encode($ret);

 