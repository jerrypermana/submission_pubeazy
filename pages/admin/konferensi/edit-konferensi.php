<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Conference
    </h1>

</section>
<br>
<?php

$conf_id = $_GET['id'];
$query = "SELECT * FROM conference LEFT JOIN mst_ruang as mr ON conference.ruang_id=mr.ruang_id WHERE konferensi_id='$conf_id'";
$hasil = mysqli_query($konek, $query);
$row = mysqli_fetch_array($hasil);
$hitung = mysqli_num_rows($hasil);

if ($hitung == 0) {
    echo '<script>alert("ID Konferensi Tidak Di Temukan")
        location.replace("' . $base_url . '/index.php?p=list-konferensi")</script>';
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
                    <h3 class="box-title">Quick Example</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- form start -->
                            <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">


                                <table class="table table-condensed">
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Name Conference*<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="text" name="nama_konferensi" id='nama_konferensi' class="form-control" style="width: 90%" value='<?php echo $row['nama_konferensi']; ?>'>
                                        <input type="hidden" name="konferensi_id" class="form-control" style="width: 90%" value='<?php echo $conf_id; ?>'></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Organizer*<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="text" name="penyelenggara" id='penyelenggara' class="form-control" style="width: 90%" value='<?php echo $row['penyelenggara']; ?>'></th>
                                    </tr>
                                    <tr>
                                            <th style="width: 20%; text-align: right;"><label>Start Date Conference*<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><input type="date" name="start_date" id='start_date' class="form-control" style="width: 30%" value='<?php echo $row['start_date']; ?>'></th>
                                        </tr>
                                        
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>End Date Conference*<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><input type="date" name="end_date" id='end_date' class="form-control" style="width: 30%" value='<?php echo $row['end_date']; ?>''></th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Ruang*<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                                <select class="form-control" name="ruang" style="width: 50%;">
                                                <option value='<?php echo $row['ruang_id']; ?>'><?php echo $row['nama_ruang']; ?></option>
                                                    <?php
                                                $query_ruang = mysqli_query($konek, "SELECT * FROM mst_ruang");
                                                while ($row_ruang = mysqli_fetch_array($query_ruang)) {

                                                    echo "<option value='$row_ruang[ruang_id]'>$row_ruang[nama_ruang]</option>";
                                                }

                                                ?>

                                                </select>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Show Dashboard*<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%">
                                        <?php
                                        if($row['show_dashboard'] != '0'){
                                            echo'<input type="radio" name="show" value="1" checked> Show Dashboard <br>
                                               <input type="radio" name="show" value="0"> Hidden Dashboard';
                                        }else{
                                            echo'<input type="radio" name="show" value="1"> Show Dashboard <br>
                                               <input type="radio" name="show" value="0" checked> Hidden Dashboard';

                                        }

                                        ?>
                                               
                                        </tr>


                                    <tr>
                                        <th style="width: 20%"></th>
                                        <th style="width: 2%"></th>
                                        <th style="width: 78%"> </br></br></br></th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            <center>
                                                <button type="submit" name='submit' class="btn btn-block btn-primary btn-sm">Update</button>
                                                <button type="reset" onclick="goBack()" class="btn btn-block btn-warning btn-sm">Cancel</button>
                                            </center>
                                        </th>
                                    </tr>

                                </table>
                            </form>
                            <script type='text/javascript'>
                                function validasi() {


                                    if (simpan.nama_konferensi.value == "") {
                                        alert("Nama Konferensi Tidak Boleh KOSONG ");
                                        simpan.nama_konferensi.focus();
                                        return false;
                                    }
                                    if (simpan.penyelenggara.value == "") {
                                        alert("Penyelenggara Tidak Boleh KOSONG");
                                        simpan.penyelenggara.focus();
                                        return false;
                                    }
                                    return true;
                                }
                            </script>
                            <?php
                            if (isset($_POST['submit'])) {
                                $conf_id                = $_POST['konferensi_id'];
                                $nama_konferensi        = ucwords($_POST['nama_konferensi']);
                                $penyelenggara          = ucwords($_POST['penyelenggara']);
                                $start_date             = $_POST['start_date'];
                                $end_date               = $_POST['end_date'];
                                $ruang                  = $_POST['ruang'];
                                $show                  = $_POST['show'];
                                $tglubah                = date('Y-m-d');



                               

                                $q_update  = "UPDATE conference set nama_konferensi='$nama_konferensi ',
                                    penyelenggara='$penyelenggara',
                                    start_date='$start_date',
                                    end_date='$end_date',
                                    ruang_id='$ruang',
                                    show_dashboard='$show',
                                    last_update='$tglubah'
                                    where konferensi_id='$conf_id'";

                                //echo $q_update;
                               $update_conference = mysqli_query($konek, $q_update);

                                if ($update_conference) {
                                    echo '<script>alert("Nama Konferensi Berhasil di Edit")
                                    location.replace("' . $base_url . '/index.php?p=list-konferensi")</script>';
                                } else {
                                    echo '<script>alert("Nama Konferensi Gagal diEdit")
                                    location.replace("' . $base_url . '/index.php?p=add-konferensi")</script>';
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