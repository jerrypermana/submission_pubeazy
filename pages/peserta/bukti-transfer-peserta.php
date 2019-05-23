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
    $query      = "SELECT tp.transfer_id,p.id_peserta,p.member_id,p.realname,conf.nama_konferensi,conf.penyelenggara,pk.nama_paket,pk.biaya,tp.v_transfer,mr.nama_ruang,
    conf.start_date,conf.end_date
FROM transaksi_peserta as tp
LEFT JOIN peserta as p ON tp.id_peserta=p.id_peserta
LEFT JOIN conference as conf ON tp.konferensi_id=conf.konferensi_id
LEFT JOIN paket_konferensi as pk ON tp.paket_id=pk.paket_id
LEFT JOIN mst_ruang as mr ON conf.ruang_id=mr.ruang_id
WHERE tp.transfer_id='$transfer_id'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    $tanggal_conf = date('d-m-Y', strtotime($row['start_date']));
    $end_conf = date('d-m-Y', strtotime($row['end_date']));

    if ($hitung == 0) {
        echo '<script>alert("Paper Tidak Di temukan")
             location.replace("' . $base_url . '../index.php?id=dashboard-peserta")</script>';
    }
    ?>
    <br>
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
                                            <th style="width: 20%; text-align: right;"><label>Nama Pengirim<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"> <input type="text" name="nama_transfer" id='nama_transfer' class="form-control" style="width: 50%"></th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Tanggal Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"> <input type="date" name="tgl_transfer" id='tgl_transfer' class="form-control" style="width: 30%"></th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Jumlah Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%;">
                                                <input type="text" name="biaya" id='biaya' class="form-control" placeholder="Rp." style="width: 30%"></th>
                                            </th>

                                        </tr>

                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Daftar Bank Yang Dikirim<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%;">
                                                <select class="form-control" name="kode_bank" style="width: 30%">
                                                    <option value='0'>----- Daftar Nama Bank -----</option>
                                                    <?php
                                                    $select_bank = mysqli_query($konek, "SELECT * FROM account_bank");

                                                    while ($row = mysqli_fetch_array($select_bank)) {

                                                        echo "<option value='$row[kode_bank]'>$row[nama_bank] - ($row[rekening])</option>";
                                                    }
                                                    ?>

                                                </select>
                                            </th>
                                            </th>

                                        </tr>


                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Unggah Bukti Transfer<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%; padding: 5px 20px;">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Masukkan Bukti Transfer</label>
                                                    &nbsp &nbsp <input type="file" name='file' id='file'>
                                                    <p class="help-block">Maximum 1 Mb.</p>
                                                </div>

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
                                                    <button type="submit" name='submit' class="btn btn-block btn-primary btn-sm">Submit</button>
                                                    <button type="reset" onclick="goBack()" class="btn btn-block btn-warning btn-sm">Cancel</button>
                                                </center>
                                            </th>
                                        </tr>

                                    </table>
                                </form>
                                <?php
                                if (isset($_POST['submit'])) {

                                    $nama               = ucwords($_POST['nama_transfer']);
                                    $username           = $_POST['username'];
                                    $tgl_transfer       = $_POST['tgl_transfer'];
                                    $jumlah_transfer    = $_POST['biaya'];
                                    $kode_bank          = $_POST['kode_bank'];
                                    $transfer_id        = $_POST['transfer_id'];
                                    $tanggal  = date('Y-m-d');
                                    $ekstensi_diperbolehkan    = array('png');
                                    $nama_file = "Transfer_" . $tanggal . "_" . $transfer_id . ".jpg";
                                    $ukuran     = $_FILES['file']['size'];
                                    $file_tmp   = $_FILES['file']['tmp_name'];

                                    if ($ukuran < 1485760) {
                                        move_uploaded_file($file_tmp, '../files/tf_peserta/' . $nama_file);


                                        $update_transfer   = "UPDATE transaksi_peserta set nama_transfer='$nama',
                                        tgl_transfer='$tgl_transfer',
                                        jumlah_transfer='$jumlah_transfer',
                                        kode_bank='$kode_bank',
                                        file_bukti='$nama_file',
                                        last_update='$tanggal'
                                        where transfer_id='$transfer_id'";

                                        // echo $update_transfer;
                                        // Insert Update paper
                                        $insert_transfer = mysqli_query($konek, $update_transfer);
                                        if ($insert_transfer) {
                                            echo '<script>alert("Transaksi Berhasil di Tambahkan")</script>';
                                        } else {
                                            echo '<script>alert("Transaksi Gagal di Tambahkan")</script>';
                                        }
                                    } else {
                                        echo '<script>alert("Ukuran File Terlalu Besar")</script>';
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


        </div>
        </div>
        <script>
            $(document).ready(function() {


                var biaya = document.getElementById("biaya");
                biaya.addEventListener("keyup", function(e) {
                    // tambahkan 'Rp.' pada saat form di ketik
                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                    biaya.value = formatRupiah(this.value);
                });

                /* Fungsi formatRupiah */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, "").toString(),
                        split = number_string.split(","),
                        sisa = split[0].length % 3,
                        biaya = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    if (ribuan) {
                        separator = sisa ? "." : "";
                        biaya += separator + ribuan.join(".");
                    }

                    biaya = split[1] != undefined ? biaya + "," + split[1] : biaya;
                    return prefix == undefined ? biaya : biaya ? "Rp. " + biaya : "";
                }


            })
        </script>
    <?php
}
?>
