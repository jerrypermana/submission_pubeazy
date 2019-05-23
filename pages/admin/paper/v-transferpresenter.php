<?php
if ($_SESSION['group_session'] == 'admin' || $_SESSION['group_session'] == 'reviewer') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            VERIFIKASI BUKTI TRANSFER PRESENTER
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
                                $query = "SELECT p.paper_id, p.abstrak, pre.afiliasi,p.judul,pre.member_id,pre.realname,tp.transfer_id,tp.biaya_conf,tp.tgl_transfer,tp.v_transfer,
                            tp.nama_transfer,tp.jumlah_transfer,tp.kode_bank,tp.file_bukti,ac.nama_bank, ac.rekening, ac.atas_nama, conf.nama_konferensi,tp.from_bank,
                            conf.start_date,conf.end_date,conf.penyelenggara, mr.nama_ruang FROM paper as p 
                            LEFT JOIN presenter as pre ON p.id_presenter=pre.id_presenter 
                            LEFT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
                            LEFT JOIN account_bank as ac ON tp.kode_bank=ac.kode_bank                            
                            LEFT JOIN conference as conf ON p.konferensi_id=conf.konferensi_id
                            LEFT JOIN mst_ruang as mr ON conf.ruang_id=mr.ruang_id
                            WHERE tp.transfer_id='$transfer_id'";
                                $hasil = mysqli_query($konek, $query);
                                $row = mysqli_fetch_array($hasil);
                                $hitung = mysqli_num_rows($hasil);


                                $tanggal_tf = date('d-m-Y', strtotime($row['tgl_transfer']));

                                if ($row["v_transfer"]  == '1') {
                                    $status = "<span class='label label-success'>Valid</span>";
                                } else if ($row["v_transfer"] == '2') {
                                    $status = "<span class='label label-danger'>Invalid</span>";
                                } else {

                                    $status = "<span class='label label-warning'>None</span>";
                                }

                                if ($hitung == 0) {
                                    echo '<script>alert("Username Tidak Di Temukan")
									location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
                                }


                                ?>
                                <!-- form start -->


                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <h4 style="text-align: center;"><?php echo $row["judul"] ?></h4>
                                        <h5 style="text-align: center;"><i>Author <?php echo $row["realname"] ?> </i> </h5>
                                        <h5 style="text-align: center;"><i><?php echo $row["afiliasi"] ?> </i> </h5>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="box-group" id="accordion">
                                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                            <div class="panel box box-primary">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                            Abstrak
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse in">
                                                    <div class="box-body">
                                                        <p style="text-align: justify;"><?php echo $row["abstrak"] ?><p>
                                                    </div>
                                                </div>
                                            </div>

                                            <form role="form" action="" method="POST" name='simpan' onSubmit='return validasi()' enctype="multipart/form-data">

                                                <div class="panel box box-danger">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                                Payment Info
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Member</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["member_id"] ?></label>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Conference</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["nama_konferensi"] ?></label>
                                                            <input type="hidden" name="conf_id" id='conf_id' class="form-control" value='<?php echo $row["konferensi_id"]; ?>'>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">organizer</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["penyelenggara"] ?></label>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Cost Cnference</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label">Rp. <?php echo $row['biaya_conf']; ?><label>
                                                        </div>
                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">Status Payment</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $status ?><label>
                                                        </div>
                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">Name Payment</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row['nama_transfer']; ?><label>

                                                        </div>
                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">Total Payment</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label">Rp. <?php echo $row['jumlah_transfer']; ?><label>
                                                        </div>

                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">From Bank</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row['from_bank']; ?><label>
                                                        </div>
                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">To Bank</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row['nama_bank'] . ' - ' . $row['rekening'] . ' - ' . $row['atas_nama']; ?><label>
                                                        </div>
                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">Transfer Date</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $tanggal_tf; ?> <label>
                                                        </div>

                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Payment Proofs</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <button type="button" class="btn btn-primary" data-target="#myModal" data-toggle="modal">Lihat Bukti</button>
                                                            <!-- Modal -->
                                                            <!-- Modal -->
                                                            <div id="myModal" class="modal fade" role="dialog">
                                                                <div class="modal-dialog modal-lg">

                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">Modal Header</h4>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <embed src="../files/tf_presenter/<?php echo $row['file_bukti']; ?>" frameborder="0" width="100%" height="400px">

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel box box-success">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                                Verifikasi
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree" class="panel-collapse collapse in">


                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Verification</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control" name='v_transfer'>
                                                                    <option value=''>---- Status ----</option>
                                                                    <option value='1'>Valid</option>
                                                                    <option value='2'>Invalid </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input type='hidden' name='paper_id' value='<?php echo $row['paper_id']; ?>'>
                                                        <div class="box-footer">
                                                            <button type="cancel" class="btn btn-default">Cancel</button>
                                                            <button type="submit" name="update" class="btn btn-info pull-right">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if (isset($_POST['update'])) {

                                $v_transfer  = $_POST['v_transfer'];
                                $paper_id  = $_POST['paper_id'];
                                $tgl         = date('Y-m-d');
                                $loi         = '0';
                                $query_update  = "UPDATE transaksi_presenter set v_transfer='$v_transfer', last_update='$tgl' where transfer_id='$transfer_id '";

                                $query_loi  = "INSERT INTO loi (paper_id, status, input_date, last_update)
                                VALUES('$paper_id ', '$loi','$tgl', '$tgl')";


                                $update_transfer = mysqli_query($konek, $query_update);
                                $insert_loi = mysqli_query($konek, $query_loi);
                                //echo $query_update;

                                if ($update_transfer and $insert_loi) {
                                    echo '<script>alert("Bukti Transfer Berhasil di Verifikasi")
                                    location.replace("' . $base_url . '/index.php?p=list-transaksi-presenter")</script>';
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

    <?php
}
?>