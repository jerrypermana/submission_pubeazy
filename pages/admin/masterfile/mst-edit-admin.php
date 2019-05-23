<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Pengguna Sistem
        </h1>

    </section>
    <br>
    <?php

    $adminID = $_GET['adminID'];
    $query = "SELECT * FROM login WHERE admin_id='$adminID'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    if ($hitung == 0) {
        echo '<script>alert("Pengguna Sistem Tidak Di Temukan")
        location.replace("' . $base_url . '/index.php?p=mst-admin")</script>';
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
                                            <th style="width: 20%; text-align: right;"><label>Email<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><input type="text" name="email" class="form-control" style="width: 90%" value='<?php echo $row['email']; ?>'>
                                                <input type="hidden" name="admin_id" class="form-control" style="width: 90%" value='<?php echo $row['admin_id']; ?>'>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Nama Lengkap*<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><input type="text" name="realname" class="form-control" style="width: 90%" value='<?php echo $row['realname']; ?>'>

                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Password*<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><input type="password" name="password" class="form-control" style="width: 90%" value='<?php echo $row['password']; ?>'>
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
                                    $email                   = $_POST['email'];
                                    $admin_id                = $_POST['admin_id'];
                                    $realname                = $_POST['realname'];
                                    $password                = md5($_POST['password']);






                                    $q_update  = "UPDATE login set 
                                            email='$email',
                                            realname='$realname',
                                            password='$password'
                                             where admin_id='$admin_id'";

                                    //echo $q_update;
                                    $update_admin = mysqli_query($konek, $q_update);

                                    if ($update_admin) {
                                        echo '<script>alert("Pengguna Sistem Berhasil di Edit")
                                    location.replace("' . $base_url . '/index.php?p=mst-admin")</script>';
                                    } else {
                                        echo '<script>alert("Pengguna Sistem Gagal diEdit")
                                    location.replace("' . $base_url . '/index.php?p=mst-admin")</script>';
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

      

    <?php
}
?>