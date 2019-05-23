<?php
if ($_SESSION['group_session'] == 'presenter') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">


    </section>

    <?php

    $id_presenter = $_SESSION['id_presenter'];
    $query = "SELECT p.paper_id,p.judul, p.abstrak, p.v_paper,p.id_presenter,pre.realname,pre.afiliasi, p.file_fullpaper,tp.biaya_conf,tp.transfer_id,tp.v_transfer, 
    conf.konferensi_id,conf.nama_konferensi,conf.start_date,conf.end_date,conf.penyelenggara, mr.nama_ruang,pre.member_id,p.input_date,p.v_akhir,
    status.status,loi.id_loi
    FROM paper as p 
    LEFT JOIN presenter as pre ON p.id_presenter=pre.id_presenter
    LEFT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
    LEFT JOIN conference as conf ON p.konferensi_id=conf.konferensi_id
    LEFT JOIN mst_ruang as mr ON conf.ruang_id=mr.ruang_id
    LEFT JOIN status ON p.v_paper=status.status_id
    LEFT JOIN loi ON p.paper_id=loi.paper_id
    WHERE pre.id_presenter='$id_presenter'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);


    $input_date = date('d-m-Y', strtotime($row['input_date']));

    $query_jadwal = "SELECT * FROM paper_jadwal as pj 
    LEFT JOIN paper as p ON pj.paper_id=p.paper_id
    LEFT JOIN jadwal_jam as jj ON pj.jam_id=jj.jam_id
    WHERE p.paper_id='$row[paper_id]'";
    $hasil_jadwal = mysqli_query($konek, $query_jadwal);
    $row_jadwal = mysqli_fetch_array($hasil_jadwal);
    $hitung_jadwal = mysqli_num_rows($hasil_jadwal);

    if ($hitung > 0) {
        $tanggal_conf = date('d-m-Y', strtotime($row['start_date']));
        $end_conf = date('d-m-Y', strtotime($row['end_date']));
        $jam            = $row_jadwal['jam'];
    } else {
        $tanggal_conf   = "Belum Di-Isi";
        $end_conf   = "Belum Di-Isi";
        $jam            = "Belum Di-Isi";
    }

    $select_keyword = mysqli_query($konek, "SELECT mk.keyword_id, mk.keyword as keyword FROM paper LEFT JOIN paper_keyword as pk ON paper.paper_id=pk.paper_id
              LEFT JOIN mst_keyword as mk ON pk.keyword_id=mk.keyword_id WHERE paper.paper_id='$row[paper_id]'");

    // $dataArray = [];

    while ($rowKey = mysqli_fetch_assoc($select_keyword)) {
        $resultKey[] = $rowKey['keyword'];
    }



    $select_subject = mysqli_query($konek, "SELECT ms.subject_id, ms.subject as subject FROM paper 
            LEFT JOIN paper_subject as ps ON paper.paper_id=ps.paper_id
            LEFT JOIN mst_subject as ms ON ps.subject_id=ms.subject_id WHERE paper.paper_id='$row[paper_id]'");

    //$dataArraySub = [];
    while ($rowSub = mysqli_fetch_assoc($select_subject)) {
        $resultSub[] = $rowSub['subject'];
    }

    if ($row["v_paper"]  == '1') {
        $status_ver = "<span class='label label-success'>$row[status]</span>";
    } else if ($row["v_paper"] == '2') {
        $status_ver = "<span class='label label-warning'>$row[status]</span>";
    } else if ($row["v_paper"]  == '3') {

        $status_ver = "<span class='label label-danger'>$row[status]</span>";
    } else {

        $status_ver = "<span class='label label-warning'>not yet approved</span>";
    }

    if ($row["v_transfer"]  == '1') {
        $status_tf = "<span class='label label-success'>Valid</span>";
    } else if ($row["v_transfer"] == '2') {
        $status_tf = "<span class='label label-danger'>Invalid</span>";
    } else {

        $status_tf = "<span class='label label-warning'>None</span>";
    }



    if ($hitung == 1) {


        ?>
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

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
                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Keyword</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <label class="col-sm-9 control-label"><?php echo implode(", ", $resultKey); ?></label>
                                        </div>
                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Subject</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <label class="col-sm-9 control-label"><?php echo implode(", ", $resultSub); ?></label>
                                        </div>
                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Created</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <label class="col-sm-9 control-label"><?php echo $input_date; ?></label>
                                        </div>
                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Status</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <label class="col-sm-9 control-label"><?php echo $status_ver; ?><label>
                                        </div>
                                    </div>
                                </div>



                                <div class="panel box box-danger">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                Information Detail
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Member ID</label>
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
                                            <label class="col-sm-2 control-label">Room Conference</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <label class="col-sm-9 control-label"><?php echo $row["nama_ruang"] ?></label>
                                        </div>
                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Date Conference</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <label class="col-sm-9 control-label"><?php echo $tanggal_conf . ' s/d ' . $end_conf; ?><label>
                                        </div>
                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Time Conference</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <label class="col-sm-9 control-label"><?php echo $jam; ?><label>
                                        </div>


                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">No Transaction</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <label class="col-sm-9 control-label"><?php echo $row['transfer_id']; ?><label>
                                        </div>
                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Cost Conference</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <label class="col-sm-9 control-label">Rp. <?php echo $row['biaya_conf']; ?><label>
                                        </div>

                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Status Verification Payment Proofs</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <label class="col-sm-9 control-label"><?php echo $status_tf; ?><label>
                                        </div>


                                    </div>
                                </div>
                                <div class="panel box box-danger">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                Download
                                            </a>
                                        </h4>
                                    </div>


                                    <div id="collapseThree" class="panel-collapse collapse in" aria-expanded="true" style="">
                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Letter Of Invititation (LOI)</label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <?php
                                            if ($row['v_transfer'] == 1 && $hitung_jadwal > 0) {
                                                echo '<label class="col-sm-9 control-label">
                                            <a href="download-loi.php?id=' . $row['paper_id']  . '" target="_blank"> <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download (Letter of Invitation)</button></a>
                                            </label>';
                                            } else {
                                                echo '<label class="col-sm-9 control-label">
                                            Letter Of Invititation Belum Di Terbitkan
                                            </label>';
                                            }
                                            ?>

                                        </div>
                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Letter Of Accepted <LOA></label>
                                            <label class="col-sm-1 control-label">:</label>
                                            <?php
                                            if ($row['v_akhir'] == 1) {
                                                echo '<label class="col-sm-9 control-label">
                                            <a href="download-loa.php?id=' . $row['paper_id']  . '" target="_blank"> <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-download"></i> Download (Letter of Accepted)</button></a>
                                            </label>';
                                            } else {
                                                echo '<label class="col-sm-9 control-label">
                                            Letter Of Accepted Belum Di Terbitkan
                                            </label>';
                                            }
                                            ?>
                                        </div>
                                    </div>



                                </div>



                            </div>

                        </div>
                    </div>

                    <!-- /.AKHIR -->

                </div>
            </div>
        <?php
    } else {
        ?>
            <section class="content">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3></h3>
                                <p>Upload Paper</p>
                                <br>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a href="<?php echo $base_url; ?>/index.php?p=add-paper" class="small-box-footer">More <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3></h3>
                                <p>Payment</p>
                                <br>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a href="<?php echo $base_url; ?>/index.php?p=bukti-transfer" class="small-box-footer">More <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3></h3>
                                <p>Add Schedule</p>
                                <br>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file"></i>
                            </div>
                            <a href="<?php echo $base_url; ?>/index.php?p=add-jadwal" class="small-box-footer">More <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3></h3>
                                <p>Profile</p>
                                <br>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="<?php echo $base_url; ?>/index.php?p=edit-presenter" class="small-box-footer">More <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
  

                
                <!-- // echo '<script>
                                                                alert("Username Tidak Di Temukan")
                                                                // location.replace("' . $base_url . '/index.php?p=add-paper")
                                                            </script>'; -->
            <?php
        }
        ?>


            
        <?php
    }
    ?>