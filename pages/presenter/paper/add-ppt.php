<?php
if ($_SESSION['group_session'] == 'presenter') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-file-powerpoint-o"></i> Upload Paper
        </h1>

    </section>
    </br>

    <?php

    $id_presenter=$_SESSION['id_presenter'];
    $query = "SELECT * FROM paper as p
    LEFT JOIN presenter as pre ON p.id_presenter=pre.id_presenter
    WHERE pre.id_presenter='$id_presenter' AND p.v_akhir='1'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    if ($hitung == 0) {
        echo '<script>alert("Full Paper Belum Di Verifikasi")
		location.replace("' . $base_url . '/index.php?p=dashboard-presenter")</script>';
    }

    ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Upload Power Point (PPT)</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">
                        <div class="box-body">


                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Upload Power Point</label>

                                <div class="col-sm-5">
                                    <label for="exampleInputFile">Masukkan File Paper</label>
                                    &nbsp &nbsp <input type="file" name='file' id='file' id="exampleInputFile">
                                    <p class="help-block">Maximum 4 Mb.</p>
                                </div>
                                <input type="hidden" name="paper_id" value='<?php echo $row['paper_id']; ?>' </div> </div> <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="cancel" class="btn btn-default">Cancel</button>
                                    <button type="submit" name="update" class="btn btn-info pull-right">Submit</button>
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
                    $paper_id       = $_POST['paper_id'];
                    $tgl            = date('Y-m-d');


                    $ekstensi_diperbolehkan    = array('ppt','pptx');
                    //$nama = 'Abstrak_' . $tglinput . '_' . $member_id . '.pdf';
                    $nama = $_FILES['file']['name'];
                    $x = explode('.', $nama);
                    $ekstensi = strtolower(end($x));

                    $nama_file = 'PPT_' . $tgl . '_' . $member_id . '.' . $ekstensi . '';
                    $ukuran    = $_FILES['file']['size'];
                    $file_tmp = $_FILES['file']['tmp_name'];


                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                        if ($ukuran < 4485760) {
                            move_uploaded_file($file_tmp, '../repository/' . $nama_file);

                            $query_paper  = "UPDATE paper set file_ppt='$nama_file' WHERE paper.paper_id='$paper_id'";

                            // echo $query_paper;

                            $insert_ppt = mysqli_query($konek, $query_paper);


                            if ($insert_ppt) {
                                echo '<script>alert("Power Point Berhasil di Tambahkan")</script>';
                            } else {
                                echo '<script>alert("Power Point di Tambahkan")</script>';
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

                <!-- TUTUP Modal -->

            </div>
        </div>
            </div>

    <?php
}
?>