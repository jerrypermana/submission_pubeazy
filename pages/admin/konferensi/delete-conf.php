<?php


if (isset($_GET['confID'])) {
    $confID = $_GET['confID'];


    $hapus          = mysqli_query($konek, "delete from conference where konferensi_id='$confID'");



    if ($hapus) {
        echo '<script>alert("Data Berhasil Di Hapus")
				location.replace("' . $base_url . '/index.php?p=list-konferensi")</script>';
    } else {
        echo '<script>alert("Data Gagal Di Hapus")
				location.replace("' . $base_url . '/index.php?p=list-konferensi")</script>';
    }
}

?>

