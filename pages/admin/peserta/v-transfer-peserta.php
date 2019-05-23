<?php
if ($_SESSION['group_session'] == 'admin' || $_SESSION['group_session'] == 'reviewer') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            VERIFIKASI BUKTI TRANSFER PESERTA
        </h1>

    </section>
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
                                <?php

                                $transfer_id = $_GET['id'];
                                $query = "SELECT tp.transfer_id,p.id_peserta,p.realname,p.member_id,conf.nama_konferensi,conf.penyelenggara,pk.nama_paket,pk.biaya,tp.v_transfer,mr.nama_ruang,conf.start_date,
                            tp.transfer_id,tp.nama_transfer,tp.jumlah_transfer,tp.file_bukti,tp.kode_bank,tp.tgl_transfer,tp.v_transfer,ab.nama_bank,ab.atas_nama,ab.rekening
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

                                if ($hitung == 0) {
                                    echo '<script>alert("ID Transaksi Peserta Tidak Di Temukan")
									location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
                                }


                                ?>
                                <!-- form start -->
                                <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">


                                    <table class="table table-condensed">
                                    <tr>
                                            <th style="width: 20%; text-align: right;"><label>No Anggota<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <label><?php echo $row['member_id']; ?><label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Nama Peserta<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <label><?php echo $row['realname']; ?><label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Konferensi<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <label><?php echo $row['nama_konferensi']; ?><label>

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
                                            <th style="width: 78%"><label><?php echo $tanggal_conf; ?><label>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>No Transaksi<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <label><?php echo $row['transfer_id']; ?>
                                                    <input type="hidden" name="transfer_id" value='<?php echo $row['transfer_id']; ?>'><label></th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Paket<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><label><?php echo $row['nama_paket']; ?><label></th>
                                        </tr>

                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Biaya Conference<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <label>Rp. <?php echo $row['biaya']; ?><label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Nama Pengirim<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <label><?php echo $row['nama_transfer']; ?><label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Jumlah Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <label>Rp. <?php echo $row['jumlah_transfer']; ?><label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Tanggal Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <label><?php echo $row['tgl_transfer']; ?><label>
                                            </th>
                                        </tr>

                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Bank Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <label><?php echo $row['nama_bank'] . ' - ' . $row['rekening'] . ' - ' . $row['atas_nama']; ?><label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Bukti Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%;">
                                                <button type="button" class="btn btn-primary" data-target="#myModal" data-toggle="modal">Lihat Bukti</button>
                                                <!-- Modal -->
                                                <!-- Modal -->
                                                <div id="myModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-lg">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Bukti Transaksi</h4>
                                                            </div>
                                                            <div class="modal-body">

                                                                <embed src="../files/tf_peserta/<?php echo $row['file_bukti']; ?>" frameborder="0" width="100%" height="400px">

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                        </tr>


                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Verifikasi Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%;">

                                                <?php
                                                if ($row['v_transfer'] == '1') {
                                                    echo '<input type="radio" name="v_transfer" value="1" value="' . $row['v_transfer'] . '" checked> Sudah Transfer </label> </br>
                                                      <input type="radio" name="v_transfer" value="0" value="' . $row['v_transfer'] . '"> Belum Transfer </label>';
                                                } else {
                                                    echo '<input type="radio" name="v_transfer" value="1" value="' . $row['v_transfer'] . '"> Sudah Transfer </label> </br>
                                                      <input type="radio" name="v_transfer" value="0" value="' . $row['v_transfer'] . '" checked> Belum Transfer </label>';
                                                }
                                                ?>

                                            </th>
                                        </tr>

                                        <tr>
                                            <th style="width: 20%"></th>
                                            <th style="width: 2%"></th>
                                            <th style="width: 78%"> </br></br></br></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3">
                                                <center>
                                                    <button type="submit" name='update' class="btn btn-block btn-primary btn-sm">Submit</button>
                                                    <button type="reset" onclick="goBack()" class="btn btn-block btn-warning btn-sm">Cancel</button>
                                                </center>
                                            </th>
                                        </tr>

                                    </table>
                                </form>
                                <?php
                                if (isset($_POST['update'])) {

                                    $v_transfer  = $_POST['v_transfer'];
                                    $transfer_id  = $_POST['transfer_id'];
                                    $tgl         = date('Y-m-d');
                                    $loi         = '1';
                                    $query_update  = "UPDATE transaksi_peserta set v_transfer='$v_transfer', last_update='$tgl' where transfer_id='$transfer_id '";




                                    $update_transfer = mysqli_query($konek, $query_update);


                                    if ($update_transfer) {
                                        echo '<script>alert("Bukti Transfer Berhasil di Verifikasi")
                                    location.replace("' . $base_url . '/index.php?p=list-transaksi-peserta")</script>';
                                    } else {
                                        echo '<script>alert("Bukti Transfer Gagal")</script>';
                                    }
                                }


                                ?>

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
