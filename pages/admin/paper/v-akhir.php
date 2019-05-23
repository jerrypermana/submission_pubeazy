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

                                $paper_id = $_GET['idpaper'];
                                $query = "SELECT pj.jadwal_id,p.paper_id,p.judul, p.abstrak, p.v_paper,p.id_presenter,pre.realname, p.file_paper,
                                p.file_fullpaper,p.full_paper,tp.biaya_conf,tp.transfer_id,tp.v_transfer,conf.nama_konferensi,conf.start_date,
                                conf.penyelenggara, mr.nama_ruang,jj.jam,pre.member_id,pre.afiliasi ,pj.date,jj.jam,tp.file_bukti
                                FROM paper as p 
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


                                $tanggal_conf = date('d-m-Y', strtotime($row['date']));

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

                                if ($row["v_transfer"]  == '1') {
                                    $status = "<span class='label label-success'>Valid</span>";
                                } else if ($row["v_transfer"] == '2') {
                                    $status = "<span class='label label-danger'>Invalid</span>";
                                } else {

                                    $status = "<span class='label label-warning'>None</span>";
                                }



                                if ($hitung == 0) {
                                    echo '<script>alert("Username Tidak Di Temukan")
                                location.replace("' . $base_url . '/index.php?p=dashboard-presenter")</script>';
                                }


                                ?>

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
                                                                Information Detail
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo" class="panel-collapse collapse">
                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">Keyword</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-4 control-label"><?php echo implode(", ", $resultKey); ?><label>
                                                        </div>
                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">Subject</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-4 control-label"><?php echo implode(", ", $resultSub); ?><label>
                                                        </div>
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
                                                            <label class="col-sm-2 control-label">Organizer</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["penyelenggara"] ?></label>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Conference Room</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["nama_ruang"] ?></label>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Schedule Date</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $tanggal_conf; ?></label>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Schedule Time</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["jam"] ?></label>
                                                        </div>

                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">Status Payment</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-4 control-label"><?php echo $status ?><label>
                                                        </div>


                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">File</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <button type="button" class="btn btn-primary btn-sm" data-target="#myModal" data-toggle="modal"><i class="fa fa-file-o"></i> Payment Proofs</button>
                                                            <a href="../repository/<?php echo $row['file_paper']; ?>"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-file-o"></i> Paper</button></a>
                                                            <a href="../repository/<?php echo $row['file_fullpaper']; ?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-o"></i> Full Paper</button></a>
                                                            <!-- Modal Payment-->
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
                                                        <?php

                                                        $query_pj = "SELECT * FROM paper_jadwal as pj 
                                                        LEFT JOIN paper as p ON pj.paper_id=p.paper_id
                                                        WHERE p.paper_id='$paper_id'";
                                                        $hasil_pj = mysqli_query($konek, $query_pj);
                                                        $row_pj = mysqli_fetch_array($hasil_pj);

                                                        ?>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Kuota</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="kuota" id='kuota' class="form-control" placeholder="Insert quota of participants" value='<?php echo $row_pj['kuota']; ?>'>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Upload Full Upload</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control" name='full_paper'>
                                                                    <?php
                                                                    if($row_pj['v_akhir'] == '1'){
                                                                       echo"<option value='$row_pj[full_paper]'>Valid</option>";
                                                                    }else{
                                                                        echo"<option value='$row_pj[full_paper]'>In Valid</option>";
                                                                    }
                                                                    ?>
                                                                    <option value=''>---- Status ----</option>
                                                                    <option value='1'>Valid</option>
                                                                    <option value='2'>Invalid </option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Verification</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control" name='v_akhir'>
                                                                <?php
                                                                    if($row_pj['v_akhir'] == '1'){
                                                                       echo"<option value='$row_pj[v_akhir]'>Accepted</option>";
                                                                    }elseif($row_pj['v_akhir'] == '2'){
                                                                        echo"<option value='$row_pj[v_akhir]'>Reject</option>";
                                                                    }else{
                                                                        echo"<option value='$row_pj[v_akhir]'>Revision Required</option>";
                                                                    }
                                                                    ?>
                                                                    <option value=''>---- Status ----</option>
                                                                    <?php
                                                                    $select_status = mysqli_query($konek, "SELECT * FROM status");

                                                                    while ($row_stat = mysqli_fetch_array($select_status)) {

                                                                        echo "<option value='$row_stat[status_id]'>$row_stat[status]</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                            <input type="hidden" name="jadwal_id" value='<?php echo $row['jadwal_id']; ?>''>
                                                            <input type="hidden" name='paper_id' value='<?php echo $row['paper_id']; ?>'>

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








                                <!-- form start -->

                                <?php
                                if (isset($_POST['update'])) {

                                    $paper_id   = $_POST['paper_id'];
                                    $jadwal_id   = $_POST['jadwal_id'];
                                    $v_akhir    = $_POST['v_akhir'];
                                    $fullpaper  = $_POST['full_paper'];
                                    $kuota      = $_POST['kuota'];
                                    $tglubah    = date('Y-m-d');



                                    $query_paper_update  = "UPDATE paper set v_akhir='$v_akhir',
                                        full_paper='$fullpaper',
                                        last_update='$tglubah'
                                        where paper_id='$paper_id'";

                                    $query_jadwalpaper = "UPDATE paper_jadwal set kuota='$kuota'
                                    where jadwal_id='$jadwal_id'";

                                    $query_loa  = "INSERT INTO loa (paper_id, status, tanggal_verifikasi, input_date, last_update)
                                    VALUES('$paper_id','$v_akhir', '$tglubah','$tglubah', '$tglubah')";

                                    $insert_paper = mysqli_query($konek, $query_paper_update);
                                    $insert_jadwalpaper = mysqli_query($konek, $query_jadwalpaper);
                                    $insert_loa = mysqli_query($konek, $query_loa);

                                    // echo $query_paper_update.'<br>'.$query_jadwalpaper;


                                    if ($insert_paper and $insert_jadwalpaper) {
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

    <?php
}
?>