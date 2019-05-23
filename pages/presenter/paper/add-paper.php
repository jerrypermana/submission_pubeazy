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
                <!-- Horizontal Form -->
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
                                    <option value='0'>---- Select Your Conference ---</option>
                                        <?php
                                        $select_conf = mysqli_query($konek, "SELECT * FROM conference
                                        LEFT JOIN mst_ruang as mr ON conference.ruang_id=mr.ruang_id");

                                        while ($row = mysqli_fetch_array($select_conf)) {

                                            echo "<option value='$row[konferensi_id]'>$row[nama_konferensi]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Type</label>

                                <div class="col-sm-8">
                                    <select class="form-control conf" name='type_pre' id="type_pre">
                                            <option value='0'>---- Select Your Type Conference---</option>
                                            <option value='1'>Oral Presentation</option>
                                            <option value='2'>Poster Presentation</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Judul*</label>

                                <div class="col-sm-8">
                                    <input type="text" name="judul" id='judul' class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Abstrak</label>

                                <div class="col-sm-8">
                                    <textarea class="form-control" name="abstrak" id='abstrak' rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Keyword</label>

                                <div class="col-sm-5">
                                    <select class="form-control select2" name='keyword[]'>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"></label>

                                <div class="col-sm-5">
                                    <select class="form-control select2" name='keyword[]'>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"></label>

                                <div class="col-sm-5">
                                    <select class="form-control select2" name='keyword[]'>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"></label>

                                <div class="col-sm-5">
                                    <select class="form-control select2" name='keyword[]'>
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
                                    &nbsp &nbsp <input type="file" name='file' id='file' id="exampleInputFile">
                                    <p class="help-block"> Allowed file extension : .doc, .docx or .pdf.</p>
                                    <p class="help-block">Maximum 4 Mb.</p>
                                </div>

                            </div>


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="cancel" class="btn btn-default">Cancel</button>
                            <button type="submit"name="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->


            <?php
            if (isset($_POST['submit'])) {

                $id_presenter   = $_SESSION['id_presenter'];

                $query_presenter = mysqli_query($konek, "SELECT * FROM presenter WHERE id_presenter='$id_presenter'");
                $tu = mysqli_fetch_array($query_presenter);

                $member_id      = $tu['member_id'];

                $judul          = ucwords($_POST['judul']);
                $abstrak        = $_POST['abstrak'] == '' ? '-' : $_POST['abstrak'];
                $conf_id        = $_POST['conf_id'];
                $v_paper        = '0';
                $loa            = '0';
                $lol            = '0';
                $type_pre       = $_POST['type_pre'];
                $tglinput = date('Y-m-d');
                $tglubah = date('Y-m-d');

                $ekstensi_diperbolehkan    = array('pdf', 'doc', 'docx');
                //$nama = 'Abstrak_' . $tglinput . '_' . $member_id . '.pdf';
                $nama = $_FILES['file']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));

                $nama_file = 'Abstrak_' . $tglinput . '_' . $member_id . '.' .$ekstensi .'';
                $ukuran    = $_FILES['file']['size'];
                $file_tmp = $_FILES['file']['tmp_name'];


                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    if ($ukuran < 4485760) {
                        move_uploaded_file($file_tmp, '../repository/' . $nama_file);

                        $query_paper  = "INSERT INTO paper (konferensi_id,id_presenter, type_presentation,judul, abstrak, file_paper, v_paper, input_date, last_update)
                                        VALUES('$conf_id','$id_presenter', '$type_pre','$judul', '$abstrak', '$nama_file ','$v_paper', '$tglinput', '$tglubah')";

                        // echo $query_paper;

                        $insert_paper = mysqli_query($konek, $query_paper);

                        $keyword        = $_POST['keyword'];
                        $jumlah_diisi   = count($keyword);

                        $paper_id       = mysqli_insert_id($konek);


                        for ($x = 0; $x < $jumlah_diisi; $x++) {

                            $query_keyword  = "INSERT INTO paper_keyword values('$paper_id','$keyword[$x]')";
                            $insert_keyword = mysqli_query($konek, $query_keyword);
                        }


                        if ($insert_paper and $query_keyword) {
                            echo '<script>alert("Paper Berhasil di Tambahkan")</script>';
                        } else {
                            echo '<script>alert("Paper Gagal di Tambahkan")</script>';
                        }
                    } else {
                        echo '<script>alert("Ukuran File Terlalu Besar")</script>';
                    }
                } else {
                    echo '<script>alert("Ekstensi Yang Di Upload Tidak Diperbolehkan")</script>';
                }
            }

            ?>

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