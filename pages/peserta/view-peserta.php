<?php
if ($_SESSION['group_session'] == 'peserta') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Upload Bukti Transfer
        </h1>

    </section>
    <?php

    $transfer_id   = $_GET['id'];
    $query      = "SELECT
          tp.transfer_id,
          p.id_peserta,
          p.member_id,
          p.realname,
          p.image,
          conf.nama_konferensi,
          conf.penyelenggara,
          pk.nama_paket,
          pk.biaya,
          tp.v_transfer,
          mr.nama_ruang,
          conf.start_date,
          conf.end_date,
          tp.transfer_id,
          tp.nama_transfer,
          tp.jumlah_transfer,
          tp.kode_bank,
          tp.tgl_transfer,
          tp.v_transfer,
          ab.nama_bank,
          ab.atas_nama,
          ab.rekening
     FROM transaksi_peserta as tp
     LEFT JOIN peserta as p ON tp.id_peserta=p.id_peserta
     LEFT JOIN conference as conf ON tp.konferensi_id=conf.konferensi_id
     LEFT JOIN paket_konferensi as pk ON tp.paket_id=pk.paket_id
     LEFT JOIN mst_ruang as mr ON conf.ruang_id=mr.ruang_id
     LEFT JOIN account_bank as ab ON tp.kode_bank=ab.kode_bank
     WHERE tp.transfer_id='$transfer_id'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    $tanggal_conf = date('d-m-Y', strtotime($row['start_date']));
    $end_conf = date('d-m-Y', strtotime($row['end_date']));
    $tanggal_tf = date('d-m-Y', strtotime($row['tgl_transfer']));

    if ($row['v_transfer'] == '0') {
        $status_tf = "<label style='color: red;'>Belum Diverifikasi </label>";
    } else {
        $status_tf = " <label style='color: green;'>Sudah Diverifikasi </label>";
    }

    if ($hitung == 0) {
        echo '<script>alert("Paper Tidak Di temukan")
             location.replace("' . $base_url . '/index.php?id=dashboard-peserta")</script>';
    }

    ?>
    </br>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- form start -->
                                <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">


                                    <table class="table table-condensed">
                                    <tr>
                                            <th style="width: 20%; text-align: right;"><label>No Anggota<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><label><?php echo $row['member_id']; ?><label>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Nama<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><label><?php echo $row['realname']; ?><label>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Konferensi<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><label><?php echo $row['nama_konferensi']; ?><label>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Penyelanggara Konferensi<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><label><?php echo $row['penyelenggara']; ?><label>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Ruang Konferensi<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><label><?php echo $row['nama_ruang']; ?><label>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Tanggal Konferensi<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><label><?php echo $tanggal_conf.' s/d '. $end_conf; ?><label>

                                            </th>
                                        </tr>

                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>No Transaksi<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <label><?php echo $row['transfer_id']; ?>
                                                    <input type="hidden" name="transfer_id" value='<?php echo $row['transfer_id']; ?>'><label></th>
                                        </tr><tr>
                                            <th style="width: 20%; text-align: right;"><label>Paket<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><label><?php echo $row['nama_paket']; ?><label></th>
                                        </tr>

                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Biaya Conference<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><label>Rp. <?php echo $row['biaya']; ?><label></th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Nama Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><label><?php echo $row['nama_transfer']; ?><label></th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Tanggal Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                            <label><?php echo $tanggal_tf; ?><label>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Jumlah Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%;">
                                            <label>Rp. <?php echo $row['jumlah_transfer']; ?><label></th>
                                            </th>

                                        </tr>

                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Bank Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%;">
                                            <label><?php echo $row['nama_bank'] . ' - ' . $row['rekening'] . ' - ' . $row['atas_nama']; ?><label>
                                            </th>
                                            </th>

                                        </tr>
                                        <tr>
                                        <th style="width: 20%; text-align: right;"><label>Status Verifikasi Transfer<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $status_tf; ?><label>
                                    </tr>

                                    <?php
                                    if ($row['v_transfer'] == 1) {
                                        echo '
                                        <tr>
                                        <th style="width: 20%; text-align: right;"><label>Cetak Tiket<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 38%">
                                        <a href="'.$base_url.'/cetak.php?transfer_id='.md5($transfer_id).'" target="new"> <button type="button" class="btn btn-warning btn-sm">Cetak Tiket Konferensi</button></a>
                                        </tr>';
                                    }
                                    ?>
                                        <tr>
                                            <th style="width: 20%"></th>
                                            <th style="width: 2%"></th>
                                            <th style="width: 78%"> </br></br></br></th>
                                        </tr>


                                    </table>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->


                <!-- /.box -->

                <!-- Input addon -->


            </div>
        </div>


<?php
}
?>
