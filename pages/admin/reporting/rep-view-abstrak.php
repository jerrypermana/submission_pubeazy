<?php
if ($_SESSION['group_session'] == 'admin' || $_SESSION['group_session'] == 'reviewer') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3 class="box-title"><i class="fa fa-eye"></i> View Abstrak</h3>

    </section>
    </br>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php

                                $paper_id = $_GET['idpaper'];
                                $query = "SELECT paper.judul,paper.input_date,paper.v_paper,paper.abstrak,paper.file_paper,paper.paper_id,pre.realname,
                                pre.afiliasi,pre.member_id,conf.nama_konferensi,conf.konferensi_id,conf.penyelenggara ,status.status,tp.biaya_conf,paper.komentar
                                FROM paper 
                                LEFT JOIN transaksi_presenter as tp ON paper.paper_id=tp.paper_id
                                LEFT JOIN conference as conf ON paper.konferensi_id=conf.konferensi_id
                                LEFT JOIN presenter as pre ON paper.id_presenter=pre.id_presenter
                                LEFT JOIN status ON paper.v_paper=status.status_id
                                WHERE paper.paper_id='$paper_id'";
                                $hasil = mysqli_query($konek, $query);
                                $row = mysqli_fetch_array($hasil);
                                $hitung = mysqli_num_rows($hasil);

                                if ($row["v_paper"]  == '1') {
                                    $status = "<span class='label label-success'>$row[status]</span>";
                                } else if ($row["v_paper"] == '2') {
                                    $status = "<span class='label label-warning'>$row[status]</span>";
                                } else if ($row["v_paper"]  == '3') {

                                    $status = "<span class='label label-danger'>$row[status]</span>";
                                } else {

                                    $status = "<span class='label label-warning'>$row[status]</span>";
                                }
                                // $select_keyword = mysqli_query($konek, "SELECT mk.keyword_id, mk.keyword as keyword FROM paper LEFT JOIN paper_keyword as pk ON paper.paper_id=pk.paper_id
                                //           LEFT JOIN mst_keyword as mk ON pk.keyword_id=mk.keyword_id WHERE paper.paper_id='$paper_id'");

                                // $dataArray = [];
                                // while ($rowKey = mysqli_fetch_assoc($select_keyword)) {
                                //     array_push($dataArray, $rowKey);
                                // }

                                $select_keyword = mysqli_query($konek, "SELECT mk.keyword_id, mk.keyword as keyword FROM paper LEFT JOIN paper_keyword as pk ON paper.paper_id=pk.paper_id
                                          LEFT JOIN mst_keyword as mk ON pk.keyword_id=mk.keyword_id WHERE paper.paper_id='$paper_id'");

                                // $dataArray = [];
                                while ($rowKey = mysqli_fetch_assoc($select_keyword)) {
                                    $resultKey[] = $rowKey['keyword'];
                                }


                                $select_subject = mysqli_query($konek, "SELECT ms.subject_id, ms.subject as subject FROM paper 
                                LEFT JOIN paper_subject as ps ON paper.paper_id=ps.paper_id
                                LEFT JOIN mst_subject as ms ON ps.subject_id=ms.subject_id WHERE paper.paper_id='$paper_id'");

                                while ($rowSub = mysqli_fetch_assoc($select_subject)) {
                                    $resultSub[] = $rowSub['subject'];
                                }




                                if ($hitung == 0) {
                                    echo '<script>alert("Username Tidak Di Temukan")
									location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
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


                                        </div>
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
                                        <label class="col-sm-2 control-label">Status</label>
                                        <label class="col-sm-1 control-label">:</label>
                                        <label class="col-sm-9 control-label"><?php echo $status; ?></label>
                                    </div>
                                </div>

                                <!-- /.box-body -->
                            </div>

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