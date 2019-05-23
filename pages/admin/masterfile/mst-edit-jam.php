<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit jadwal Jam
    </h1>

</section>
<br>
<?php

$jam_id = $_GET['jamID'];
$query = "SELECT * FROM jadwal_jam WHERE jam_id='$jam_id'";
$hasil = mysqli_query($konek, $query);
$row = mysqli_fetch_array($hasil);
$hitung = mysqli_num_rows($hasil);

if ($hitung == 0) {
    echo '<script>alert("Jadwal Jam Tidak Di Temukan")
        location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
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
                                        <th style="width: 20%; text-align: right;"><label>Jam*<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="text" name="jam" id='jam' class="form-control" style="width: 90%" value='<?php echo $row['jam']; ?>'>
                                        <input type="hidden" name="jam_id" class="form-control" style="width: 90%" value='<?php echo $row['jam_id']; ?>'></th>
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
                                $jam_id                 = $_POST['jam_id'];
                                $jam                    = $_POST['jam'];
                     


                               

                                $q_update  = "UPDATE jadwal_jam set jam='$jam' where jam_id='$jam_id'";

                                //echo $q_update;
                              $update_jam= mysqli_query($konek, $q_update);

                                if ($update_jam) {
                                    echo '<script>alert("Jadwal Jam Berhasil di Edit")
                                    location.replace("' . $base_url . '/index.php?p=mst-jam")</script>';
                                } else {
                                    echo '<script>alert("Jadwal Jam Gagal diEdit")
                                    location.replace("' . $base_url . '/index.php?p=mst-jam")</script>';
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