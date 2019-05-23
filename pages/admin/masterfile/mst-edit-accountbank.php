<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Account Bank
    </h1>

</section>
<br>
<?php

$bankID = $_GET['bankID'];
$query = "SELECT * FROM account_bank WHERE kode_bank='$bankID'";
$hasil = mysqli_query($konek, $query);
$row = mysqli_fetch_array($hasil);
$hitung = mysqli_num_rows($hasil);

if ($hitung == 0) {
    echo '<script>alert("Account Bank Tidak Di Temukan")
        location.replace("' . $base_url . '/index.php?p=mst-accountbank")</script>';
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
                                        <th style="width: 20%; text-align: right;"><label>Nama Bank*<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="text" name="nama_bank" class="form-control" style="width: 90%" value='<?php echo $row['nama_bank']; ?>'>
                                        <input type="hidden" name="kode_bank" class="form-control" style="width: 90%" value='<?php echo $row['kode_bank']; ?>'></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>No Rekening<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="text" name="rekening" class="form-control" style="width: 90%" value='<?php echo $row['rekening']; ?>'>
                                       
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Atas Nama<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="text" name="atas_nama" class="form-control" style="width: 90%" value='<?php echo $row['atas_nama']; ?>'>
                                       
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
                                $kode_bank                  = $_POST['kode_bank'];
                                $nama_bank                  = $_POST['nama_bank'];
                                $rekening                   = $_POST['rekening'];
                                $atas_nama                  = $_POST['atas_nama'];
                     


                               

                                $q_update  = "UPDATE account_bank set nama_bank='$nama_bank',
                                             rekening='$rekening',
                                             atas_nama='$atas_nama' where kode_bank='$kode_bank'";

                                //echo $q_update;
                              $update_bank= mysqli_query($konek, $q_update);

                                if ($update_bank) {
                                    echo '<script>alert("Account Bank Berhasil di Edit")
                                    location.replace("' . $base_url . '/index.php?p=mst-accountbank")</script>';
                                } else {
                                    echo '<script>alert("Account Bank Gagal diEdit")
                                    location.replace("' . $base_url . '/index.php?p=mst-accountbank")</script>';
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