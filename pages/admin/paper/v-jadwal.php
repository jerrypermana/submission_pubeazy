<?php
if ($_SESSION['group_session'] == 'admin' || $_SESSION['group_session'] == 'reviewer') {
    ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Lihat Paper
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

                            $paper_id = $_GET['id'];
                            $query = "SELECT p.paper_id,p.judul, p.abstrak, p.v_paper,pre.realname, p.file_paper,tp.biaya_conf,tp.transfer_id,tp.v_transfer, 
                            pj.start_day,pj.end_day,pj.start_time,pj.end_time,
                            pj.v_jadwal, mst_ruang.nama_ruang, loa.loa_id
                            FROM paper as p 
                            INNER JOIN presenter as pre ON p.username=pre.username 
                            INNER JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
                            inner JOIN paper_jadwal as pj ON p.paper_id=pj.paper_id
                            inner JOIN mst_ruang ON pj.ruang_id=mst_ruang.ruang_id
                            INNER JOIN loa ON p.paper_id=loa.paper_id 
                            WHERE p.paper_id='$paper_id'";
                            $hasil = mysqli_query($konek, $query);
                            $row = mysqli_fetch_array($hasil);
                            $hitung = mysqli_num_rows($hasil);


                            $select_keyword = mysqli_query($konek, "SELECT mk.keyword_id, mk.keyword as keyword FROM paper LEFT JOIN paper_keyword as pk ON paper.paper_id=pk.paper_id
                                          LEFT JOIN mst_keyword as mk ON pk.keyword_id=mk.keyword_id WHERE paper.paper_id='$paper_id'");

                            // $dataArray = [];
                            while ($rowKey = mysqli_fetch_assoc($select_keyword)) {
                                $resultKey[] = $rowKey['keyword'];
                            }

                            $select_subject = mysqli_query($konek, "SELECT ms.subject_id, ms.subject as subject FROM paper 
                            LEFT JOIN paper_subject as ps ON paper.paper_id=ps.paper_id
                            LEFT JOIN mst_subject as ms ON ps.subject_id=ms.subject_id WHERE paper.paper_id='$paper_id'");

                            //$dataArraySub = [];
                            while ($rowSub = mysqli_fetch_assoc($select_subject)) {
                                $resultSub[] = $rowSub['subject'];
                            }

                            if ($row['v_paper'] == '0') {
                                $status_Ver = "<label style='color: red;'>Belum Di-Verifikasi </label>";
                            } else {
                                $status_Ver = " <label style='color: green;'>Sudah Di-Verifikasi</label>";
                            }

                            if ($row['v_transfer'] == '0') {
                                $status_tf = "<label style='color: red;'>Belum Transfer </label>";
                            } else {
                                $status_tf = " <label style='color: green;'>Sudah Transfer</label>";
                            }

                            $epoch      = $row["start_day"];
                            $dt         = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                            $start_day  = $dt->format('d-m-Y');
                            $start_time = sprintf("%02d:%02d", $row["start_time"] / 60 / 60, ($row["start_time"] % (60 * 60) / 60));
                            $end_time   = sprintf("%02d:%02d", $row["end_time"] / 60 / 60, ($row["end_time"] % (60 * 60) / 60));

                            if ($hitung == 0) {
                                echo '<script>alert("Username Tidak Di Temukan")
									location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
                            }


                            ?>
                            <!-- form start -->
                            <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">


                                <table class="table table-condensed">
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Pengarang<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $row['realname']; ?><label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Judul<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $row['judul']; ?><label>

                                                    <input type="hidden" name="paper_id" id='paper_id' class="form-control" style="width: 90%" value=' <?php echo $row['paper_id']; ?>'>

                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>abstrak<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <textarea class="form-control" name="abstrak" id='abstrak' rows="5" style="width: 90%"><?php echo $row['abstrak']; ?></textarea>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>File Paper<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%;">
                                            <button type="button" class="btn btn-primary" data-target="#myModal" data-toggle="modal">Lihat Paper</button>
                                            <!-- Modal -->
                                            <!-- Modal -->
                                            <div id="myModal" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-lg">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">View Paper</h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <embed src="../repository/<?php echo $row['file_paper']; ?>" frameborder="0" width="100%" height="400px">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Keyword<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%;">
                                            <label>
                                                <?php


                                                echo implode(", ", $resultKey);
                                                ?>

                                            </label>


                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Subject<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%;">
                                            <label>
                                                <?php


                                                echo implode(", ", $resultSub);
                                                ?>

                                            </label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>No Transaksi<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $row['transfer_id']; ?><label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Biaya Conference<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label>Rp. <?php echo $row['biaya_conf']; ?><label>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Status Verifikasi Paper<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $status_Ver; ?><label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Status Verifikasi Transfer<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $status_tf; ?><label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>File Paper<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%;">
                                            <button type="button" class="btn btn-primary" data-target="#myModal" data-toggle="modal">Lihat Paper</button>
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

                                                            <embed src="../repository/<?php echo $row['file_paper']; ?>" frameborder="0" width="100%" height="400px">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Ruang<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $row['nama_ruang']; ?><label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Tanggal<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $start_day ?><label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Jam<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $start_time . ' s/d ' . $end_time . ' WIB' ?><label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Verifikasi Jadwal<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%;">
                                            <input type="radio" name="v_jadwal" value="1"> Di-Setujui
                                            <br>
                                            <input type="radio" name="v_jadwal" value="0"> tidak Di-Setujui
                                            <input type="hidden" name="loa" value='<?php echo $row['loa_id']?>'>

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

                                $paper_id   = $_POST['paper_id'];
                                $tgl        = date('Y-m-d');
                                $v_jadwal   = $_POST['v_jadwal'];
                                $loa        = $_POST['loa'];
                                $status_loa = '1';

                                $query_update  = "UPDATE paper_jadwal set 
                                        v_jadwal='$v_jadwal'
                                        where paper_id='$paper_id'";

                            


                                $update_paper = mysqli_query($konek, $query_update);

                                // echo $query_loa;
                                // echo $query_update;

                                if ($update_paper) {
                                    echo '<script>alert("Paper Berhasil di Edit")</script>';
                                } else {
                                    echo '<script>alert("Paper Gagal di Edit")</script>';
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


            $('.select2').select2({
                minimumInputLength: 2,
                allowClear: true,
                placeholder: 'Search Keywords ...',
                ajax: {
                    url: '../data_api/ajax_keyword.php',
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,

                        }
                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    }

                }

            });


        })
    </script>
    <?php 
}
?> 