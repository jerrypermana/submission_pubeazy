<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-home"></i> Edit Room Conference
        </h1>

    </section>
    <br>
    <?php

    $ruangID = $_GET['ruangID'];
    $query = "SELECT * FROM mst_ruang WHERE ruang_id='$ruangID'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    if ($hitung == 0) {
        echo '<script>alert("Room Conference Undefined")
        location.replace("' . $base_url . '/index.php?p=mst-ruang")</script>';
    }
    ?>

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
                                <!-- form start -->
                                <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">


                                    <table class="table table-condensed">
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Nama Ruang*<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><input type="text" name="nama_ruang" class="form-control" style="width: 90%" value='<?php echo $row['nama_ruang']; ?>'>
                                                <input type="hidden" name="ruang_id" class="form-control" style="width: 90%" value='<?php echo $row['ruang_id']; ?>'></th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Kuota*<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><input type="text" name="kuota" class="form-control" style="width: 90%" value='<?php echo $row['kuota']; ?>'>

                                        </tr>
                                        

                                        <tr>
                                            <th style="width: 20%"></th>
                                            <th style="width: 2%"></th>
                                            <th style="width: 78%"> </br></br></br></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3">
                                                <center>
                                                    <button type="submit" name='update' class="btn btn-block btn-primary btn-sm">Update</button>
                                                    <button type="reset" onclick="goBack()" class="btn btn-block btn-warning btn-sm">Cancel</button>
                                                </center>
                                            </th>
                                        </tr>

                                    </table>
                                </form>

                                <?php
                                if (isset($_POST['update'])) {
                                    $ruang_id                   = $_POST['ruang_id'];
                                    $nama_ruang                 = $_POST['nama_ruang'];
                                    $kuota                      = $_POST['kuota'];
                                    $nowDate                    = date('Y-m-d');





                                    $q_update  = "UPDATE mst_ruang set nama_ruang='$nama_ruang',
                                             kuota='$kuota',
                                             last_update='$nowDate' where ruang_id='$ruang_id'";

                                    //echo $q_update;
                                    $update_room = mysqli_query($konek, $q_update);

                                    if ($update_room) {
                                        echo '<script>alert("Room Conference Berhasil di Edit")
                                    location.replace("' . $base_url . '/index.php?p=mst-ruang")</script>';
                                    } else {
                                        echo '<script>alert("Room Conference Gagal diEdit")
                                    location.replace("' . $base_url . '/index.php?p=mst-ruang")</script>';
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