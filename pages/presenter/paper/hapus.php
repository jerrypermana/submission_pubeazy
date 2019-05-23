<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $hapus          = mysqli_query($konek, "delete from paper where paper_id='$id'");



    if ($hapus) {
        echo '<script>alert("Data Berhasil Di Hapus")
				location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
    } else {
        echo '<script>alert("Data Gagal Di Hapus")
				location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
    }
}
?>

