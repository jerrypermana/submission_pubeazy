<!DOCTYPE html>



<!-- end menu BAR-->

<!--  body -->
<?php
$domain = $_SERVER['SERVER_NAME'];
$base_url = "http://" . $domain . "/submission_pubeazy/pages";
include "header.php";
if (isset($_GET["p"])) {
  $id = $_GET["p"];

  //ADMIN//
  if ($id == "dashboard") {
    include 'admin/dashboard.php';
  } elseif ($id == "list-konferensi") {
    include 'admin/konferensi/list-konferensi.php';
  } elseif ($id == "add-konferensi") {
    include 'admin/konferensi/add-konferensi.php';
  } elseif ($id == "edit-konferensi") {
    include 'admin/konferensi/edit-konferensi.php';
  } elseif ($id == "delete-conf") {
    include 'admin/konferensi/delete-conf.php';
  } elseif ($id == "v-paper") {
    include 'admin/paper/v-paper.php';
  } elseif ($id == "list-jadwal") {
    include 'admin/paper/list-jadwal.php';
  } elseif ($id == "v-jadwal") {
    include 'admin/paper/v-jadwal.php';
  } elseif ($id == "list-v-akhir") {
    include 'admin/paper/list-v-akhir.php';
  } elseif ($id == "v-akhir") {
    include 'admin/paper/v-akhir.php';
  } elseif ($id == "list-paper") {
    include 'admin/paper/list-paper.php';
  } elseif ($id == "adm-edit-paper") {
    include 'admin/paper/adm-edit-paper.php';
  } elseif ($id == "list-transaksi-presenter") {
    include 'admin/paper/list-transaksi-presenter.php';
  } elseif ($id == "v-transferpresenter") {
    include 'admin/paper/v-transferpresenter.php';
  } elseif ($id == "paper-review") {
    include 'admin/paper/paper-review.php';
  } elseif ($id == "add-review") {
    include 'admin/paper/add-review.php';
  }
  //ADMIN MODUL PESERTA//
  elseif ($id == "list-transaksi-peserta") {
    include 'admin/peserta/list-transaksi-peserta.php';
  } elseif ($id == "v-transfer-peserta") {
    include 'admin/peserta/v-transfer-peserta.php';
  } //ADMIN MODUL MASTER FILE//
  elseif ($id == "mst-subject") {
    include 'admin/masterfile/mst-subject.php';
  } elseif ($id == "mst-keyword") {
    include 'admin/masterfile/mst-keyword.php';
  } elseif ($id == "mst-jam") {
    include 'admin/masterfile/mst-jam.php';
  } elseif ($id == "mst-edit-jam") {
    include 'admin/masterfile/mst-edit-jam.php';
  } elseif ($id == "mst-accountbank") {
    include 'admin/masterfile/mst-accountbank.php';
  } elseif ($id == "mst-edit-accountbank") {
    include 'admin/masterfile/mst-edit-accountbank.php';
  } elseif ($id == "mst-admin") {
    include 'admin/masterfile/mst-admin.php';
  } elseif ($id == "mst-edit-admin") {
    include 'admin/masterfile/mst-edit-admin.php';
  } elseif ($id == "save-admin") {
    include 'admin/masterfile/save-admin.php';
  } elseif ($id == "mst-ruang") {
    include 'admin/masterfile/mst-ruang.php';
  } elseif ($id == "mst-edit-ruang") {
    include 'admin/masterfile/mst-edit-ruang.php';
  } elseif ($id == "mst-presenter") {
    include 'admin/masterfile/mst-presenter.php';
  } elseif ($id == "mst-edit-presenter") {
    include 'admin/masterfile/mst-edit-presenter.php';
  }elseif ($id == "mst-peserta") {
    include 'admin/masterfile/mst-peserta.php';
  } elseif ($id == "mst-edit-peserta") {
    include 'admin/masterfile/mst-edit-peserta.php';
  } elseif ($id == "mst-paket") {
    include 'admin/masterfile/mst-paket.php';
  } elseif ($id == "mst-edit-paket") {
    include 'admin/masterfile/mst-edit-paket.php';
  }   elseif ($id == "mst-hapus") {
    include 'admin/masterfile/mst-hapus.php';
  }
  //MODUL PELAPORAN//
  elseif ($id == "rep-presenter") {
    include 'admin/reporting/rep-presenter.php';
  } elseif ($id == "rep-fullpaper") {
    include 'admin/reporting/rep-fullpaper.php';
  } elseif ($id == "rep-peserta") {
    include 'admin/reporting/rep-peserta.php';
  } elseif ($id == "rep-abstrak") {
    include 'admin/reporting/rep-abstrak.php';
  } elseif ($id == "rep-view-abstrak") {
    include 'admin/reporting/rep-view-abstrak.php';
  } elseif ($id == "rep-poster") {
    include 'admin/reporting/rep-poster.php';
  } elseif ($id == "rep-loi") {
    include 'admin/reporting/rep-loi.php';
  } elseif ($id == "rep-loa") {
    include 'admin/reporting/rep-loa.php';
  } elseif ($id == "rep-payment-presenter") {
    include 'admin/reporting/rep-payment-presenter.php';
  } elseif ($id == "rep-payment-peserta") {
    include 'admin/reporting/rep-payment-peserta.php';
  } elseif ($id == "rep-ppt") {
    include 'admin/reporting/rep-ppt.php';
  } //MODUL REVIEWER//
  elseif ($id == "list-reviewer") {
    include 'admin/reviewer/list-reviewer.php';
  } elseif ($id == "add-reviewer") {
    include 'admin/reviewer/add-reviewer.php';
  } elseif ($id == "edit-reviewer") {
    include 'admin/reviewer/edit-reviewer.php';
    //ADMIN HAPUS MASTER FILE//
  } elseif ($id == "hapus") {
    include 'admin/paper/hapus.php';
  }
  //ADMIN SYSTEM SETTING//
 
  elseif ($id == "system-setting") {
    include 'admin/system-setting/system-setting.php';
  } 

  // START MODUL PRESENTER
  elseif ($id == "dashboard-presenter") {
    include 'presenter/dashboard-presenter.php';
  } elseif ($id == "add-paper") {
    include 'presenter/paper/add-paper.php';
  } elseif ($id == "pre-edit-paper") {
    include 'presenter/paper/edit-paper.php';
  } elseif ($id == "view-paper") {
    include 'presenter/paper/view-paper.php';
  } elseif ($id == "pre-list-paper") {
    include 'presenter/paper/list-paper.php';
  } elseif ($id == "bukti-transfer") {
    include 'presenter/paper/bukti-transfer.php';
  } elseif ($id == "pilih-jadwal") {
    include 'presenter/paper/pilih-jadwal.php';
  } elseif ($id == "add-jadwal") {
    include 'presenter/paper/add-jadwal.php';
  } elseif ($id == "add-ppt") {
    include 'presenter/paper/add-ppt.php';
  } elseif ($id == "edit-presenter") {
    include 'presenter/paper/edit-presenter.php';
  } elseif ($id == "hapus") {
    include 'presenter/paper/hapus.php';
  }
  //START MODUL PESERTA
  elseif ($id == "dashboard-peserta") {
    include 'peserta/dashboard-peserta.php';
  } elseif ($id == "view-peserta") {
    include 'peserta/view-peserta.php';
  } elseif ($id == "bukti-transfer-peserta") {
    include 'peserta/bukti-transfer-peserta.php';
  } elseif ($id == "list-transfer") {
    include 'peserta/list-transfer.php';
  } elseif ($id == "edit-peserta") {
    include 'peserta/edit-peserta.php';
  } elseif ($id == "invoice-peserta") {
    include 'peserta/invoice-peserta.php';
  } elseif ($id == "hapus") {
    include 'paper/hapus.php';
  } elseif ($id == "konferensi") {
    include 'peserta/konferensi.php';
  } elseif ($id == "daftar-konferensi") {
    include 'peserta/daftar-konferensi.php';
  } //START MODUL REVIEWER
  elseif ($id == "dashboard-reviewer") {
    include 'reviewer/dashboard-reviewer.php';
  } elseif ($id == "list-paper-reviewer") {
    include 'reviewer/paper-review/list-paper-reviewer.php';
  } elseif ($id == "v-paper-reviewer") {
    include 'reviewer/paper-review/v-paper-reviewer.php';
  } elseif ($id == "edit-profile-reviewer") {
    include 'reviewer/paper-review/edit-profile-reviewer.php';
  } else {
    include 'index.php';
  }
}
include "footer.php"
?>
<!-- End  body -->


<!-- CONTENT-WRAPPER SECT ION END- ->