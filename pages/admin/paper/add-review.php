<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3 class="box-title">Add Reviewer Paper</h3>

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

                                $paper_id = $_GET['paperID'];
                                $query = "SELECT paper.judul,paper.input_date,paper.v_paper,paper.abstrak,paper.file_paper,paper.paper_id,pre.realname,
                                pre.afiliasi,pre.member_id,conf.nama_konferensi,conf.konferensi_id,conf.penyelenggara ,status.status,
                                tp.biaya_conf,paper.komentar,reviewer.realname as reviewer,pr.review_id,pr.paper_reviewer_id
                                FROM paper 
                                LEFT JOIN transaksi_presenter as tp ON paper.paper_id=tp.paper_id
                                LEFT JOIN conference as conf ON paper.konferensi_id=conf.konferensi_id
                                LEFT JOIN presenter as pre ON paper.id_presenter=pre.id_presenter
                                LEFT JOIN status ON paper.v_paper=status.status_id
                                LEFT JOIN paper_reviewer as pr ON paper.paper_id=pr.paper_id 
                                LEFT join reviewer ON pr.review_id=reviewer.reviewer_id 
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

                                    $status = "<span class='label label-warning'>None</span>";
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

                                $dataArraySub = [];
                                while ($rowSub = mysqli_fetch_assoc($select_subject)) {
                                    array_push($dataArraySub, $rowSub);
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

                                            <form role="form" action="" method="POST" name='simpan' onSubmit='return validasi()' enctype="multipart/form-data">

                                                <div class="panel box box-danger">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                                Detail Information
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
                                                            <label class="col-sm-2 control-label">Keyword</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo implode(", ", $resultKey); ?></label>
                                                        </div>
                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">Created</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["input_date"] ?></label>
                                                        </div>

                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Status</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $status; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel box box-warning">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                                Review Paper
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo" class="panel-collapse collapse in">
                                                        <div class="box-body">

                                                            <label class="col-sm-2 control-label">Reviewer</label>
                                                            <div class="col-sm-5">

                                                                <select class="form-control conf" name="reviewer">
                                                                    <?php if ($row['review_id'] != NULL) {
                                                                        echo "<option value='$row[review_id]'>$row[reviewer]</option>";
                                                                    } else {
                                                                        echo "<option value=''>---- Select Reviewer ----</option>";
                                                                    }
                                                                    ?>




                                                                    <?php
                                                                    $query_reviewer = mysqli_query($konek, "SELECT * FROM reviewer");
                                                                    while ($row_reviewer = mysqli_fetch_array($query_reviewer)) {

                                                                        echo "<option value='$row_reviewer[reviewer_id]'>$row_reviewer[realname]</option>";
                                                                    }

                                                                    ?>

                                                                </select>
                                                                
                                                                <input type="hidden" name="paper_reviewer_id" id='paper_reviewer_id' class="form-control" value='<?php echo $row['paper_reviewer_id']; ?>'>
                                                                <input type="hidden" name="paper_id" id='paper_id' class="form-control" value='<?php echo $row['paper_id']; ?>'>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="box-footer">
                                                        <?php if ($row['review_id'] == NULL) {
                                                            echo '<button type="submit" name="submit" class="btn btn-info">Submit</button>';
                                                        } else {
                                                            echo '<button type="submit" name="update" class="btn btn-info">Update</button>';
                                                        }
                                                        ?>
                                                        
                                                        <button type="cancel" class="btn btn-default pull-right">Cancel</button>

                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <?php
                            if (isset($_POST['submit'])) {

                                $paper_id       = $_POST['paper_id'];
                                $review_id      = $_POST['reviewer'];
                                $dateNow        = date('Y-m-d');




                                $query_review_paper = "INSERT INTO paper_reviewer (paper_id,review_id,input_date,last_update) 
                                VALUES ('$paper_id','$review_id','$dateNow','$dateNow')";

                                $insert_review = mysqli_query($konek, $query_review_paper);



                                if ($insert_review ) {
                                    echo '<script>alert("Paper Review Berhasil di Tambahkan")</script>';
                                } else {
                                    echo '<script>alert("Paper Review Gagal")</script>';
                                }
                            }

                            if (isset($_POST['update'])) {

                                $paper_id           = $_POST['paper_id'];
                                $review_id          = $_POST['reviewer'];
                                $dateNow            = date('Y-m-d');
                                $paper_reviewer_id  = $_POST['paper_reviewer_id'];




                                $update_review_paper = "UPDATE paper_reviewer set paper_id='$paper_id',review_id='$review_id',last_update='$dateNow'
                                WHERE paper_reviewer_id='$paper_reviewer_id'";


                                //echo  $update_review_paper;
                                $update_review = mysqli_query($konek, $update_review_paper);



                                if ($update_review) {
                                    echo '<script>alert("Paper Review Berhasil di Update")</script>';
                                } else {
                                    echo '<script>alert("Paper Review Gagal")</script>';
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