<?php


if (isset($_GET['paper_id'])) {
    $paper_id = $_GET['paper_id'];


    $hapus_paper          = mysqli_query($konek, "delete from paper where paper_id='$paper_id'");



    if ($hapus) {
        echo '<script>alert("Data Berhasil Di Hapus")
				location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
    } else {
        echo '<script>alert("Data Gagal Di Hapus")
				location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
    }
}

elseif (isset($_GET['idtrans'])) {
    $id_trans = $_GET['idtrans'];


    $hapus          = mysqli_query($konek, "delete from transaksi_presenter where transfer_id='$id_trans'");



    if ($hapus) {
        echo '<script>alert("Data Berhasil Di Hapus")
				location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
    } else {
        echo '<script>alert("Data Gagal Di Hapus")
				location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
    }
}
?>

