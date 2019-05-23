<?php
if ($_SESSION['group_session'] == 'presenter') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">


    </section>

    <?php

    $id_presenter = $_SESSION['id_presenter'];
    $query = "SELECT p.paper_id,p.judul, p.abstrak, p.v_paper,p.id_presenter,pre.realname, p.file_fullpaper,tp.biaya_conf,tp.transfer_id,tp.v_transfer, 
    conf.konferensi_id,conf.nama_konferensi,conf.start_date,conf.end_date,conf.penyelenggara, mr.nama_ruang,pre.afiliasi,pre.member_id,
    status.status,loi.id_loi
    FROM paper as p 
    LEFT JOIN presenter as pre ON p.id_presenter=pre.id_presenter
    LEFT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
    LEFT JOIN conference as conf ON p.konferensi_id=conf.konferensi_id
    LEFT JOIN mst_ruang as mr ON conf.ruang_id=mr.ruang_id
    LEFT JOIN status ON p.v_paper=status.status_id
    LEFT JOIN loi ON p.paper_id=loi.paper_id
    WHERE tp.v_transfer='1' AND pre.id_presenter='$id_presenter'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    $tanggal_conf = date('d-m-Y', strtotime($row['start_date']));
    $end_conf = date('d-m-Y', strtotime($row['end_date']));



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

        $status = "<span class='label label-warning'>$row[status]</span>";
    }

    if ($row["v_transfer"]  == '1') {
        $status_tf = "<span class='label label-success'>Valid</span>";
    } else if ($row["v_transfer"] == '2') {
        $status_tf = "<span class='label label-danger'>Invalid</span>";
    } else {

        $status_tf = "<span class='label label-warning'>None</span>";
    }

    $q_paper = "SELECT * FROM paper WHERE paper.v_paper='1' AND paper.id_presenter='$id_presenter'";
    $d_paper = mysqli_query($konek, $q_paper);
    $h_paper = mysqli_num_rows($d_paper);

    if ($hitung == 0) {
        echo '<script>alert("Bukti Transfer Belum diVerifikasi Admin")
        location.replace("' . $base_url . '/index.php?p=pre-list-paper")</script>';
    }


    ?>
    </br>
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
                                        <label class="col-sm-2 control-label">No Transaction</label>
                                        <label class="col-sm-1 control-label">:</label>
                                        <label class="col-sm-9 control-label">Rp. <?php echo $row['transfer_id']; ?><label>
                                    </div>
                                    <div class="box-body">
                                        <label class="col-sm-2 control-label">Cost Conference</label>
                                        <label class="col-sm-1 control-label">:</label>
                                        <label class="col-sm-9 control-label">Rp. <?php echo $row['biaya_conf']; ?><label>
                                    </div>
                                    <div class="box-body">
                                        <label class="col-sm-2 control-label">Status Verification Paper</label>
                                        <label class="col-sm-1 control-label">:</label>
                                        <label class="col-sm-9 control-label"><?php echo $status_ver; ?><label>
                                    </div>
                                    <div class="box-body">
                                        <label class="col-sm-2 control-label">Status Verification Payment Proofs</label>
                                        <label class="col-sm-1 control-label">:</label>
                                        <label class="col-sm-9 control-label"><?php echo $status_tf; ?><label>
                                    </div>


                                </div>
                            </div>
                            <div class="panel box box-success">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Add Schedule
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse in">
                                    <form role="form" action="" method="POST" name='simpan' onSubmit='return validasi()' enctype="multipart/form-data">

                                        <div class="box-body">

                                            <label class="col-sm-2 control-label">Date Schedule</label>
                                            <div class="col-sm-5">
                                                <select class="form-control conf" name='date' id='date'>
                                                    <option value=''>---- Select Your Date Conference ----</option>
                                                    <option value='<?php echo $tanggal_conf; ?>'> <?php echo $row['start_date']; ?></option>
                                                    <?php
                                                    $select_date = "SELECT start_date,end_date FROM conference
                                                    WHERE konferensi_id=$row[konferensi_id]";
                                                    $hasil_date = mysqli_query($konek, $select_date);
                                                    $d_date = mysqli_fetch_array($hasil_date);

                                                    $start_date = $d_date['start_date'];
                                                    $end_date   = $d_date['end_date'];
                                                    //echo $select_date;

                                                    while (strtotime($start_date) < strtotime($end_date)) {

                                                        $start_date = date("Y-m-d", strtotime("+1 day", strtotime($start_date)));

                                                        echo "<option value='$start_date'> $start_date</option>";
                                                    }


                                                    ?>
                                                </select>

                                                <input type="hidden" name="conf_id" id='conf_id' class="form-control" value=' <?php echo $row['konferensi_id']; ?>'>
                                            </div>
                                        </div>


                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Time Schedule</label>
                                            <div class="col-sm-5">
                                                <select class="form-control conf" name='jam' id="jam">
                                                    <option value=''>---- Select Your Time Conference ----</option>

                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="paper_id" id='paper_id' class="form-control" value=' <?php echo $row['paper_id']; ?>'>
                                        <input type="hidden" name="id_loi" id='id_loi' class="form-control" value=' <?php echo $row['id_loi']; ?>'>

                                        <?php
                                        $query_jadwal = "SELECT pj.date,pj.jam_id,p.paper_id,jj.jam
                                        FROM paper as p 
                                        LEFT JOIN presenter as pre ON p.id_presenter=pre.id_presenter
                                        LEFT JOIN paper_jadwal as pj ON p.paper_id=pj.paper_id
                                        LEFT JOIN jadwal_jam as jj ON pj.jam_id=jj.jam_id
                                        WHERE pre.id_presenter='$id_presenter'";
                                        $hasil_jadwal = mysqli_query($konek, $query_jadwal);
                                        $row_jadwal = mysqli_fetch_array($hasil_jadwal);
                                        $hitung_jadwal = mysqli_num_rows($hasil_jadwal);

                                        if ($hitung_jadwal > 0) {
                                            echo '
                                            <div class="box-body">
                                            <label class="col-sm-2 control-label">Date Schedule</label>                                          
                                            <label class="col-sm-2 control-label">: ' . $row_jadwal['date'] . '<label>
                                             </div>
                                             <div class="box-body">
                                            <label class="col-sm-2 control-label">Time Schedule</label>                                          
                                            <label class="col-sm-2 control-label">: ' . $row_jadwal['jam'] . '<label>
                                             </div>';
                                        }
                                        ?>

                                        <input type='hidden' name='paper_id' value='<?php echo $row['paper_id']; ?>'>
                                        <div class="box-footer">
                                            <button type="cancel" class="btn btn-default">Cancel</button>
                                            <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <?php

                            if (isset($_POST['submit'])) {

                                $date       = $_POST['date'];
                                $jam        = $_POST['jam'];
                                $select_jadwal = "SELECT * FROM paper_jadwal where date='$date' AND jam_id='$jam'";
                                $jadwal         = mysqli_query($konek, $select_jadwal);
                                $r_jadwal       = mysqli_fetch_array($jadwal);
                                $h_jadwal       = mysqli_num_rows($jadwal);

                                if ($h_jadwal != '1') {
                                    $paper_id   = $_POST['paper_id'];
                                    $jam        = $_POST['jam'];
                                    $date       = $_POST['date'];
                                    $id_loi     = $_POST['id_loi'];
                                    $status_loi  = '1';
                                    $nowdate    = date('Y-m-d');

                                    $query_jadwal = "INSERT INTO paper_jadwal (paper_id,date,jam_id)
                                VALUES('$paper_id','$date','$jam')";

                                    $query_update_loi = "UPDATE loi set status='$status_loi',tanggal_verifikasi='$nowdate' where id_loi='$id_loi'";

                                    $insert_jadwal  = mysqli_query($konek, $query_jadwal);
                                    $update_loi     = mysqli_query($konek, $query_update_loi);

                                    if ($insert_jadwal) {
                                        echo '<script>alert("Add Schedule Success")</script>';
                                    } else {
                                        echo '<script>alert("Add Schedule Failed!")</script>';
                                    }
                                } else {

                                    echo '<script>alert("the schedule has been used")</script>';
                                }
                            }
                            ?>

                            <div class="panel box box-success">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Upload Full Paper
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse in">
                                    <form role="form" action="" method="POST" name='simpan' onSubmit='return validasi()' enctype="multipart/form-data">

                                        <input type="hidden" name="paper_id" id='paper_id' class="form-control" value=' <?php echo $row['paper_id']; ?>'>
                                        <input type="hidden" name="member_id" id='member_id' class="form-control" value=' <?php echo $row['member_id']; ?>'>

                                        <div class="box-body">
                                            <label class="col-sm-2 control-label">Upload Full Paper</label>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Masukkan File Full Paper</label>
                                                    &nbsp &nbsp <input type="file" name='file' id='file' id="exampleInputFile" value='<?php echo $row['file_fullpaper']; ?>'>
                                                    <p class="help-block"> Allowed file extension : .doc, .docx or .pdf.</p>
                                                    <p class="help-block"> Maximum 4 Mb.</p>
                                                    <!-- <label>Allowed file extension : .doc, .docx or .pdf</label> -->
                                                </div>
                                            </div>
                                        </div>

                                        <input type='hidden' name='paper_id' value='<?php echo $row['paper_id']; ?>'>
                                        <div class="box-footer">
                                            <button type="cancel" class="btn btn-default">Cancel</button>
                                            <button type="submit" name="update" class="btn btn-info pull-right">Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                <!-- general form elements -->
                <script>
                    $(function() {
                        $("#date").change(function() {
                            var getValue = $(this).val();
                            if (getValue == 0) {
                                $("#jam").html("<option>-- Select Your Time Conference --</option>");
                            } else {
                                $.getJSON('data_api/ajax_changeTime.php', {
                                    'start_date': getValue
                                }, function(data) {
                                    var showData;
                                    $.each(data, function(index, value) {
                                        showData += "<option value='" + value.jam_id + "'>" + value.jam + "</option>";
                                    })
                                    $("#jam").html(showData)
                                })
                            }
                        })

                    })
                </script>

                <!-- /.box-header -->
                <?php
                if (isset($_POST['update'])) {

                    $paper_id   = $_POST['paper_id'];
                    $member_id   = $_POST['member_id'];
                    $tgl         = date('Y-m-d');

                    $ekstensi_diperbolehkan    = array('pdf', 'doc', 'docx');
                    //$nama = 'FullPaper_' . $tgl . '_' . $member_id . '.pdf';
                    $nama = $_FILES['file']['name'];
                    $x = explode('.', $nama);
                    $ekstensi = strtolower(end($x));
                    $nama_file = 'FullPaper_' . $tgl . '_' . $member_id . '.' . $ekstensi . '';

                    $ukuran    = $_FILES['file']['size'];
                    $file_tmp = $_FILES['file']['tmp_name'];

                    if ($file_tmp != '') {
                        $fullpaper  = '1';
                    } else {
                        $fullpaper  = '0';
                    }

                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                        if ($ukuran < 4485760) {
                            move_uploaded_file($file_tmp, '../repository/' . $nama_file);

                            $query_update  = "UPDATE paper set 
                                        file_fullpaper='$nama_file',full_paper='$fullpaper',last_update='$tgl'
                                        where paper_id='$paper_id'";




                            $update_paper = mysqli_query($konek, $query_update);

                            // echo $query_update;
                            // echo $nama_file;

                            if ($update_paper) {
                                echo '<script>alert("Paper Berhasil di Edit")</script>';
                            } else {
                                echo '<script>alert("Paper Gagal di Edit")</script>';
                            }
                        } else {
                            echo '<script>alert("Ukuran File Terlalu Besar")</script>';
                        }
                    } else {
                        echo '<script>alert("Ekstensi Yang Di Upload Tidak Diperbolehkan")</script>';
                    }
                }

                ?>
                <!-- /.AKHIR -->

            </div>
        </div>

        </div>
        </div>
    <?php
}
?>