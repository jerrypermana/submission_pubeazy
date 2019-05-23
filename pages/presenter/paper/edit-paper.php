<?php
if ($_SESSION['group_session'] == 'presenter') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Upload Paper
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
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">




                                <?php

                                $paper_id = $_GET['id'];
                                $query = "SELECT paper.id_presenter,paper.paper_id,paper.judul,paper.abstrak,paper.komentar, mr.nama_ruang,conf.konferensi_id,
                                conf.nama_konferensi,conf.start_date,conf.end_date,conf.penyelenggara, paper.file_paper FROM paper LEFT JOIN paper_keyword as pk ON paper.paper_id=pk.paper_id
                                LEFT JOIN mst_keyword as mk ON pk.keyword_id=mk.keyword_id
                                LEFT JOIN conference as conf ON paper.konferensi_id=conf.konferensi_id
                                LEFT JOIN mst_ruang as mr ON conf.ruang_id=mr.ruang_id
                                WHERE paper.paper_id='$paper_id'";
                                $hasil = mysqli_query($konek, $query);
                                $row = mysqli_fetch_array($hasil);
                                $hitung = mysqli_num_rows($hasil);


                                $tanggal_conf = date('d-m-Y', strtotime($row['start_date']));

                                $select_keyword = mysqli_query($konek, "SELECT mk.keyword_id, mk.keyword as keyword FROM paper LEFT JOIN paper_keyword as pk ON paper.paper_id=pk.paper_id
                                          LEFT JOIN mst_keyword as mk ON pk.keyword_id=mk.keyword_id WHERE paper.paper_id='$paper_id'");

                                $dataArray = [];
                                while ($rowKey = mysqli_fetch_assoc($select_keyword)) {
                                    array_push($dataArray, $rowKey);
                                }

                                $select_subject = mysqli_query($konek, "SELECT ms.subject_id, ms.subject as subject FROM paper 
                                                                LEFT JOIN paper_subject as ps ON paper.paper_id=ps.paper_id
                                                                LEFT JOIN mst_subject as ms ON ps.subject_id=ms.subject_id WHERE paper.paper_id='$paper_id'");

                                //$dataArraySub = [];
                                while ($rowSub = mysqli_fetch_assoc($select_subject)) {
                                    $resultSub[] = $rowSub['subject'];
                                }




                                if ($hitung == 0) {
                                    echo '<script>alert("Username Tidak Di Temukan")
									location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
                                }


                                ?>

                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Upload Paper</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">
                                    <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label">Nama Konferensi</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control conf" name='conf_id' id="conf_id">
                                                        <option value='<?php echo $row['konferensi_id']; ?>'><?php echo $row['nama_konferensi']; ?></option>
                                                        <?php
                                                        $select_conf = mysqli_query($konek, "SELECT * FROM conference");

                                                        while ($row_conf = mysqli_fetch_array($select_conf)) {

                                                            echo "<option value='$row_conf[konferensi_id]'>$row_conf[nama_konferensi]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-2 control-label">Judul*</label>

                                                <div class="col-sm-8">
                                                    <input type="hidden" name="paper_id" id='paper_id' class="form-control" value=' <?php echo $row['paper_id']; ?>'>
                                                    <input type="text" name="judul" id='judul' class="form-control" value=' <?php echo $row['judul']; ?>'>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-2 control-label">Abstrak</label>

                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="abstrak" id='abstrak' rows="5"><?php echo $row['abstrak']; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-2 control-label">Keyword</label>

                                                <div class="col-sm-5">
                                                    <select class="form-control select2" name='keyword[]'">
                                                            <?php
                                                            if (isset($dataArray[0])) {

                                                                echo "<option value='" . $dataArray[0]['keyword_id'] . "'>" . $dataArray[0]['keyword'] . "</option>";
                                                                // echo $dataArray[0]['keyword'];
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class=" form-group">
                                                        <label for="inputPassword3" class="col-sm-2 control-label"></label>

                                                        <div class="col-sm-5">
                                                            <select class="form-control select2" id='key1' name='keyword[]'">
                                                        <?php
                                                        if (isset($dataArray[1])) {

                                                            echo "<option value='" . $dataArray[1]['keyword_id'] . "'>" . $dataArray[1]['keyword'] . "</option>";
                                                            // echo $dataArray[0]['keyword'];
                                                        }
                                                        ?>
                                                    </select>
                                                    </div>

                                                </div>

                                                <div class=" form-group">
                                                                <label for="inputPassword3" class="col-sm-2 control-label"></label>

                                                                <div class="col-sm-5">
                                                                    <select class="form-control select2" name='keyword[]'>
                                                                        <?php
                                                                        if (isset($dataArray[2])) {

                                                                            echo "<option value='" . $dataArray[2]['keyword_id'] . "'>" . $dataArray[2]['keyword'] . "</option>";
                                                                            // echo $dataArray[0]['keyword'];
                                                                        }
                                                                        ?>

                                                                    </select>
                                                                </div>

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label"></label>

                                                            <div class="col-sm-5">
                                                                <select class="form-control select2" name='keyword[]'>
                                                                    <?php
                                                                    if (isset($dataArray[3])) {

                                                                        echo "<option value='" . $dataArray[3]['keyword_id'] . "'>" . $dataArray[3]['keyword'] . "</option>";
                                                                        // echo $dataArray[0]['keyword'];
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label"></label>

                                                            <div class="col-sm-5">
                                                                <button type="button" class="btn btn-primary" data-target="#ModalAdd" data-toggle="modal">Tambah Keyword</button>
                                                            </div>

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">Upload Paper</label>

                                                            <div class="col-sm-5">
                                                                <label for="exampleInputFile">Masukkan File Paper</label>
                                                                &nbsp &nbsp <input type="file" name='file' id='file' id="exampleInputFile" value='<?php echo $row['file_paper']; ?>'>
                                                                <p class="help-block">Maximum 4 Mb.</p>
                                                            </div>

                                                        </div>


                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <button type="reset" class="btn btn-default">Cancel</button>
                                                    <button type="submit" name='update' class="btn btn-info pull-right">Update</button>
                                                </div>
                                                <!-- /.box-footer -->
                                    </form>
                                </div>
                                <!-- /.box -->



                                <?php
                                if (isset($_POST['update'])) {

                                    $id_presenter   = $_SESSION['id_presenter'];
                                    $query_presenter = mysqli_query($konek, "SELECT * FROM presenter WHERE id_presenter='$id_presenter'");
                                    $tu = mysqli_fetch_array($query_presenter);

                                    $member_id      = $tu['member_id'];

                                    $paper_id   = $_POST['paper_id'];
                                    $judul      = ucwords($_POST['judul']);
                                    $abstrak    = $_POST['abstrak'] == '' ? '-' : $_POST['abstrak'];
                                    $tglubah    = date('Y-m-d');

                                    $ekstensi_diperbolehkan    = array('pdf');
                                    $nama = 'Paper_' . $tglubah . '_' . $member_id . '.pdf';
                                    //$nama = $_FILES['file']['name'];
                                    $x = explode('.', $nama);
                                    $ekstensi = strtolower(end($x));
                                    $ukuran    = $_FILES['file']['size'];
                                    $file_tmp = $_FILES['file']['tmp_name'];


                                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                                        if ($ukuran < 4485760) {
                                            move_uploaded_file($file_tmp, '../repository/' . $nama);

                                            $query_pape_update  = "UPDATE paper set judul='$judul',
                                        abstrak='$abstrak',
                                        file_paper='$nama',
                                        last_update='$tglubah'
                                        where paper_id='$paper_id'";




                                            $insert_paper = mysqli_query($konek, $query_pape_update);
                                            $keyword        = $_POST['keyword'];
                                            $jumlah_diisi   = count($keyword);

                                            $delete_key = mysqli_query($konek, "DELETE FROM paper_keyword WHERE paper_id='$paper_id'");


                                            for ($x = 0; $x < $jumlah_diisi; $x++) {

                                                $query_keyword  = "INSERT INTO paper_keyword values('$paper_id','$keyword[$x]')";
                                                $update_keyword = mysqli_query($konek, $query_keyword);
                                            }



                                            if ($insert_paper and $update_keyword) {
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->


                <!-- /.box -->

                <!-- Input addon -->


            </div>
        </div>
        <!-- Modal -->
        <!-- Modal Popup untuk Add-->
        <div id="ModalAdd" name='myform' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Tambahkan Keyword</h4>
                    </div>

                    <div class="modal-body">
                        <form id="add_keyword" method="POST">

                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Keyword</label>
                                <input type="text" name="keyword" class="form-control" placeholder="Masukkan Nama Keyword ..." required />
                                <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>" />
                            </div>



                            <div class="modal-footer">
                                <button class="btn btn-success" id="btn" type="submit">
                                    Confirm
                                </button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="$('#add_keyword')[0].reset();">
                                    Cancel
                                </button>
                            </div>

                        </form>



                    </div>


                </div>
            </div>
        </div>
        <!-- TUTUP Modal -->
        </div>
        </div>

        <script>
            $(document).ready(function() {

                $('#add_keyword').submit(function(e) {
                    data = $('#add_keyword').serialize();
                    $.ajax({
                        type: "POST",
                        url: "data_api/save-keyword.php",
                        data: data,
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                alert(result.msg);
                                $('#ModalAdd').modal('hide');
                                $('#add_author')[0].reset();
                            }
                        }
                    });
                    e.preventDefault();
                });

                $('.select2').select2({
                    minimumInputLength: 2,
                    allowClear: true,
                    placeholder: 'Search Keywords ...',
                    ajax: {
                        url: 'data_api/ajax_keyword.php',
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

                $('.conf').select2()


            })
        </script>
    <?php
}
?>