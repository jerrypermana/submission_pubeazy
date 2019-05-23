<?php
if ($_SESSION['group_session'] == 'presenter') {
    ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Lihat Paper
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
                            <?php

                            $paper_id = $_GET['id'];
                            $query = "SELECT p.paper_id,p.judul, p.abstrak, p.v_paper,p.id_presenter,pre.realname,pre.member_id, p.file_paper,p.file_fullpaper,p.full_paper,p.v_akhir,tp.biaya_conf,tp.transfer_id,tp.v_transfer, 
                            conf.nama_konferensi,conf.tanggal,conf.penyelenggara, mr.nama_ruang,jj.jam FROM paper as p 
                            LEFT JOIN presenter as pre ON p.id_presenter=pre.id_presenter 
                            LEFT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
                            LEFT JOIN conference as conf ON p.konferensi_id=conf.konferensi_id
                            LEFT JOIN mst_ruang as mr ON conf.ruang_id=mr.ruang_id
                            LEFT JOIN paper_jadwal as pj ON p.paper_id=pj.paper_id
                            LEFT JOIN jadwal_jam as jj ON pj.jam_id=jj.jam_id
                            WHERE p.paper_id='$paper_id'";
                            $hasil = mysqli_query($konek, $query);
                            $row = mysqli_fetch_array($hasil);
                            $hitung = mysqli_num_rows($hasil);

                            $query_jadwal = "SELECT * FROM paper_jadwal as pj 
                            LEFT JOIN paper as p ON pj.paper_id=p.paper_id
                            LEFT JOIN jadwal_jam as jj ON pj.jam_id=jj.jam_id
                            WHERE p.paper_id='$paper_id'";
                            $hasil_jadwal = mysqli_query($konek, $query_jadwal);
                            $row_jadwal = mysqli_fetch_array($hasil_jadwal);
                            $hitung_jadwal = mysqli_num_rows($hasil_jadwal);

                            if($hitung > 0){
                                $tanggal_conf = date('d-m-Y', strtotime($row['tanggal']));
                                $jam          = $row['jam'];
                                
                            }else{
                                $tanggal  ="Belum Di-Isi";
                                $jam ="Belum Di-Isi";
                                

                            }

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



                            if ($hitung == 0) {
                                echo '<script>alert("Username Tidak Di Temukan")
									location.replace("' . $base_url . '/index.php?p=dashboard-presenter")</script>';
                            }


                            ?>
                            <!-- form start -->
                            <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">


                                <table class="table table-condensed">
                                <tr>
                                        <th style="width: 20%; text-align: right;"><label>Nama Konferensi<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $row['nama_konferensi']; ?><label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>No Anggota<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $row['member_id']; ?><label>
                                    </tr>
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
                                        <th style="width: 20%; text-align: right;"><label>Ruang<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $row['nama_ruang']; ?><label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Tanggal<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $tanggal_conf; ?><label>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Jam<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $jam; ?><label>
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
                                        <th style="width: 20%; text-align: right;"><label>File Full Paper<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%;">
                                        <?php
                                        if($row['full_paper'] == '1'){
                                           echo '<button type="button" class="btn btn-warning" data-target="#myModal1" data-toggle="modal">Lihat Full Paper</button>';
                                        }else{
                                           echo '<label>Belum Di-Upload<label>';
                                        }
                                        ?>
                                            <!-- Modal -->
                                            <!-- Modal -->
                                            <div id="myModal1" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-lg">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">View Full Paper</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                            <embed src="../repository/<?php echo $row['file_fullpaper']; ?>" frameborder="0" width="100%" height="400px">
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                    </tr>
                                    <?php
                                    if ($row['v_transfer'] == 1 && $hitung_jadwal > 0) {
                                        echo '<tr>
                                        <th style="width: 20%; text-align: right;"><label>Download LOI (Letter Of Invitation)<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 38%">
                                        <a href="download-loi.php?id=' . $paper_id . '"> <button type="button" class="btn btn-warning btn-sm">Download (Letter of Invitation)</button></a>
                                    </tr>';
                                    }
                                    ?>
                                    <?php
                                    if ($row['v_akhir'] == 1) {
                                    echo'<tr>
                                        <th style="width: 20%; text-align: right;"><label>Download LOA (Letter Of Accepted)<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 38%">
                                            <a href="download-loa.php?id='.$paper_id.'"> <button type="button" class="btn btn-primary btn-sm">Download (Letter of Accepted)</button></a>
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

    </div>
    </div>

    <?php 
}
?> 