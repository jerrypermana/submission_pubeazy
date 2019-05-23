<?php
if ($_SESSION['group_session'] == 'presenter') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Upload Payment Proofs
        </h1>

    </section>

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
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Name Paper</label>

                                        <div class="col-sm-8">
                                            <select class="form-control conf" name='paper_id' id="paper_id">
                                                <option value="0">---- Select Your Paper ----</option>
                                                <?php

                                                $id_presenter   = $_SESSION['id_presenter'];
                                                $select_conf = mysqli_query($konek, "SELECT * FROM paper WHERE id_presenter='$id_presenter'");

                                                while ($row = mysqli_fetch_array($select_conf)) {

                                                    echo "<option value='$row[paper_id]'>$row[judul]</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <?php
                                    $select = mysqli_query($konek, "SELECT p.id_presenter, tp.transfer_id, pre.member_id FROM paper as p 
                                    LEFT JOIN presenter as pre ON p.id_presenter=pre.id_presenter 
                                    LEFT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
                                    LEFT JOIN conference as conf ON p.konferensi_id=conf.konferensi_id
                                    WHERE pre.id_presenter='$id_presenter'");

                                    $row_p = mysqli_fetch_array($select)

                                    ?>
                                    <input type="hidden" name="id_presenter" id='id_presenter' value='<?php echo $row_p['id_presenter']; ?>'>
                                    <input type="hidden" name="transfer_id" value='<?php echo $row_p['transfer_id']; ?>'>
                                    <input type="hidden" name="member_id" value='<?php echo $row_p['member_id']; ?>'>


                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Name Payment*</label>

                                        <div class="col-sm-4">
                                            <input type="text" name="nama_transfer" id='nama_transfer' class="form-control" placeholder="Your Name Payment">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Transfer Date*</label>

                                        <div class="col-sm-4">
                                            <input type="date" name="tgl_transfer" id='tgl_transfer' class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">From Bank*</label>

                                        <div class="col-sm-4">
                                            <input type="text" name="from_bank" id='from_bank' class="form-control" placeholder="Your Bank. Example : BNI">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Destination Bank *</label>

                                        <div class="col-sm-4">
                                            <select class="form-control conf" name='kode_bank' id="kode_bank">
                                                <option value="0">---- Select Your Destination Bank ----</option>
                                                <?php

                                                $id_presenter   = $_SESSION['id_presenter'];
                                                $select_bank = mysqli_query($konek, "SELECT * FROM account_bank");

                                                while ($row_bank = mysqli_fetch_array($select_bank)) {

                                                    echo "<option value='$row_bank[kode_bank]'>$row_bank[nama_bank]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Paid Amount *</label>

                                        <div class="col-sm-4">
                                            <input type="text" name="biaya" id='biaya' class="form-control" placeholder="Rp.">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Payment Proofs *</label>

                                        <div class="col-sm-5">
                                            <label for="exampleInputFile">Masukkan Bukti Transfer</label>
                                            &nbsp &nbsp <input type="file" name='file' id='file'>
                                            <p class="help-block">Maximum 1 Mb.</p>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default">Cancel</button>
                                        <button type="submit" name='submit' class="btn btn-info pull-right">Submit</button>
                                    </div>



                                </form>
                                <?php
                                if (isset($_POST['submit'])) {

                                    $nama               = ucwords($_POST['nama_transfer']);
                                    $id_presenter       = $_POST['id_presenter'];
                                    $paper_id           = $_POST['paper_id'];
                                    $tgl_transfer       = $_POST['tgl_transfer'];
                                    $jumlah_transfer    = $_POST['biaya'];
                                    $kode_bank          = $_POST['kode_bank'];
                                    $from_bank          = $_POST['from_bank'];
                                    $member_id          = $_POST['member_id'];
                                    $transfer_id        = $_POST['transfer_id'];
                                    $tanggal  = date('Y-m-d');
                                    $ekstensi_diperbolehkan    = array('png');
                                    $nama_file = "Transfer_" . $tanggal . "_" . $member_id . ".jpg";
                                    $ukuran     = $_FILES['file']['size'];
                                    $file_tmp   = $_FILES['file']['tmp_name'];

                                    if ($ukuran < 1485760) {
                                        move_uploaded_file($file_tmp, '../files/tf_presenter/' . $nama_file);
                                        $update_transfer   = "UPDATE transaksi_presenter set nama_transfer='$nama',
                                            tgl_transfer='$tgl_transfer',
                                            jumlah_transfer='$jumlah_transfer',
                                            kode_bank='$kode_bank',
                                            from_bank='$from_bank',
                                            file_bukti='$nama_file',
                                            last_update='$tanggal'
                                            where transfer_id='$transfer_id'";

                                        //echo $update_transfer;
                                        // Insert Update paper
                                        $insert_transfer = mysqli_query($konek, $update_transfer);
                                        if ($insert_transfer) {
                                            echo '<script>alert("Upload Payment Proof Success")</script>';
                                        } else {
                                            echo '<script>alert("Upload Payment Proof Failed !")</script>';
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