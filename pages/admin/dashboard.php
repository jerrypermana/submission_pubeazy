<?php
$sess_username = $_SESSION['group_session'];

if ($_SESSION['group_session'] == 'admin') {

  $cek_konferensi    = mysqli_query($konek, "SELECT * FROM conference");
  $total_konferensi  = mysqli_num_rows($cek_konferensi);

  $cek_paper         = mysqli_query($konek, "SELECT * FROM paper");
  $total_paper       = mysqli_num_rows($cek_paper);

  $cek_presenter     = mysqli_query($konek, "SELECT * FROM presenter");
  $total_presenter   = mysqli_num_rows($cek_presenter);

  $cek_peserta       = mysqli_query($konek, "SELECT * FROM peserta");
  $total_peserta     = mysqli_num_rows($cek_peserta);

  $cek_abstrak_terverifikasi       = mysqli_query($konek, "SELECT * FROM paper WHERE v_paper='1'");
  $total_abstrak    = mysqli_num_rows($cek_abstrak_terverifikasi);

  $cek_reviewer       = mysqli_query($konek, "SELECT * FROM reviewer");
  $total_reviewer     = mysqli_num_rows($cek_reviewer);

  $cek_payment       = mysqli_query($konek, "SELECT * FROM transaksi_presenter WHERE v_transfer='1'");
  $total_payment     = mysqli_num_rows($cek_payment);

  $cek_payment_peserta       = mysqli_query($konek, "SELECT * FROM transaksi_peserta WHERE v_transfer='1'");
  $total_payment_peserta     = mysqli_num_rows($cek_payment_peserta);
  ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Selamat datang <?php echo $sess_username; ?>!</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo number_format($total_konferensi, 0, ',', '.'); ?></h3>
            <p>Total Konferensi</p>
          </div>
          <div class="icon">
            <i class="ion ion-chatboxes"></i>
          </div>
          <a href="<?php echo $base_url; ?>/index.php?p=list-konferensi" class="small-box-footer">Lihat daftar konferensi <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo number_format($total_paper, 0, ',', '.'); ?></h3>
            <p>Total Paper</p>
          </div>
          <div class="icon">
            <i class="ion ion-document"></i>
          </div>
          <a href="<?php echo $base_url; ?>/index.php?p=list-paper" class="small-box-footer">Lihat daftar paper <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo number_format($total_presenter, 0, ',', '.'); ?></h3>
            <p>Total Presenter</p>
          </div>
          <div class="icon">
            <i class="ion ion-man"></i>
          </div>
          <a href="<?php echo $base_url; ?>/index.php?p=rep-presenter" class="small-box-footer">Lihat daftar presenter <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo number_format($total_peserta, 0, ',', '.'); ?></h3>
            <p>Total Peserta</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="<?php echo $base_url; ?>/index.php?p=rep-peserta" class="small-box-footer">Lihat daftar peserta <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo number_format($total_abstrak, 0, ',', '.'); ?></h3>
            <p>Total Abstrak Terverifikasi</p>
          </div>
          <div class="icon">
            <i class="ion ion-document"></i>
          </div>
          <a href="<?php echo $base_url; ?>/index.php?p=rep-abstrak" class="small-box-footer">Lihat daftar peserta <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo number_format($total_reviewer, 0, ',', '.'); ?></h3>
            <p>Total Reviewer</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="<?php echo $base_url; ?>/index.php?p=list-reviewer" class="small-box-footer">Lihat daftar peserta <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo number_format($total_payment, 0, ',', '.'); ?></h3>
            <p>Total Payment Proofs Presenter</p>
          </div>
          <div class="icon">
            <i class="ion ion-man"></i>
          </div>
          <a href="<?php echo $base_url; ?>/index.php?p=rep-payment-presenter" class="small-box-footer">Lihat daftar peserta <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo number_format($total_payment_peserta, 0, ',', '.'); ?></h3>
            <p>Total Payment Proofs Peserta</p>
          </div>
          <div class="icon">
            <i class="ion ion-man"></i>
          </div>
          <a href="<?php echo $base_url; ?>/index.php?p=rep-payment-peserta" class="small-box-footer">Lihat daftar peserta <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </section>

<?php

}
?>