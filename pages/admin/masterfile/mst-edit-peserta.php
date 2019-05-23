<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Update Profile Participants
        </h1>

    </section>

    <?php

    $id_peserta     = $_GET['pesertaID'];
    $query          = "SELECT * FROM peserta WHERE id_peserta='$id_peserta'";
    $hasil          = mysqli_query($konek, $query);
    $row            = mysqli_fetch_array($hasil);
    $hitung         = mysqli_num_rows($hasil);

    if ($hitung == 0) {
        echo '<script>alert("ID Anggota Tidak Di Temukan")
             location.replace("' . $base_url . '/index.php?p=mst-peserta")</script>';
    }

    if ($row['image'] == ""){
         $foto = '../files/peserta/no_photo.png';
    } else {
         $foto = '../files/peserta/'.$row['image'].'';
    }

    ?>
    </br>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_0" data-toggle="tab">
                                <h4 class="box-title">Profile Participant</h4>
                            </a></li>
                        <li><a href="#tab_1" data-toggle="tab">
                                   <h4 class="box-title">Update Profile</h4>
                               </a></li>
                        <li><a href="#tab_2" data-toggle="tab">
                                <h4 class="box-title">Update Password</h4>
                            </a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_0">

                             <div class="box-body box-profile">
                                   <img class="profile-user-img img-responsive img-circle" src="<?php echo $foto; ?>" alt="User profile picture" style=" height: 150px; width: 150px; ">

                                   <h3 class="profile-username text-center" style="padding-top: 30px;padding-bottom: 30px;"><?php echo $row['realname']; ?></h3>

                                   <ul class="list-group list-group-unbordered">
                                     <li class="list-group-item">
                                       <b>Nomor Anggota</b> <a class="pull-right"><?php echo $row['member_id']; ?></a>
                                     </li>
                                     <li class="list-group-item">
                                       <b>Email</b> <a class="pull-right"><?php echo $row['email']; ?></a>
                                     </li>
                                     <li class="list-group-item">
                                       <b>Nomor HP</b> <a class="pull-right"><?php echo $row['no_hp']; ?></a>
                                     </li>
                                   </ul>

                                 </div>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_1">
                            <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">
                                <table class="table table-condensed">
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>No Anggota<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%">
                                            <label><?php echo $row['member_id']; ?></label>

                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Nama Lengkap<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="text" name="nama" id='nama' class="form-control" style="width: 50%" value='<?php echo $row['realname']; ?>'></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Email<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="text" name="email" id='email' class="form-control" style="width: 50%" value='<?php echo $row['email']; ?>'></th>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Afiliasi<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="text" name="instansi" id='instansi' class="form-control" style="width: 50%" value='<?php echo $row['instansi']; ?>'></th>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>No Handphone<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="text" name="hp" id='hp' class="form-control" style="width: 30%" value='<?php echo $row['no_hp']; ?>'></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Unggah Foto Peserta<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%; padding: 5px 20px;">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Pilih Foto</label>
                                                &nbsp &nbsp <input type="file" name='file' id='file'>
                                                <p class="help-block">Maximum 1 Mb.</p>
                                            </div>

                                        </th>
                                    </tr>


                                    <tr>
                                        <th colspan="3">
                                            <center>
                                                <button type="submit" name='update' class="btn btn-block btn-primary btn-sm">Submit</button>
                                                <button type="reset" onclick="goBack()" class="btn btn-block btn-warning btn-sm">Cancel</button>
                                            </center>
                                        </th>
                                    </tr>

                                </table>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <form role="form" action="" method="POST" name='simpan_pass' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">
                                <table class="table table-condensed">
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Password<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="password" name="password" id='password' class="form-control" style="width: 30%"></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%; text-align: right;"><label>Ulangi Password<label></th>
                                        <th style="width: 2%">:</th>
                                        <th style="width: 78%"><input type="password" name="repassword" id='repassword' class="form-control" style="width: 30%"></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%"></th>
                                        <th style="width: 2%"></th>
                                        <th style="width: 78%"> </br></br></br></th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            <center>
                                                <button type="submit" name='update_pass' class="btn btn-block btn-primary btn-sm">Submit</button>
                                                <button type="reset" onclick="goBack()" class="btn btn-block btn-warning btn-sm">Cancel</button>
                                            </center>
                                        </th>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.AKHIR -->
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <!--SCRIPT VALIDASI FORM EDIT TABEL -->
                    <script type='text/javascript'>
                        function validasi() {


                            if (simpan.nama.value == "") {
                                alert("Nama Tidak Boleh KOSONG");
                                simpan.nama.focus();
                                return false;
                            }
                            if (isNaN(parseInt(simpan.nama.value)) == false) {
                                alert("Nama harus berisi HURUF");
                                simpan.nama.focus();
                                return false;
                            }
                            if (simpan.instansi.value == "") {
                                alert("instansi Tidak Boleh KOSONG");
                                simpan.instansi.focus();
                                return false;
                            }

                            if (simpan.hp.value == "") {
                                alert("No Handphone Tidak Boleh KOSONG");
                                simpan.hp.focus();
                                return false;
                            }

                            var baru = simpan_pass.password.value;
                            var lagi = simpan_pass.repassword.value;

                            if (baru != lagi) {
                                alert('Password baru tidak cocok,\nCek ulang password baru Anda!');
                                return false;
                            }


                            return true;
                        }
                    </script>

                    <!-- /.UPDATE DATA TABLE PRESENTER-->
                    <?php

                    if (isset($_POST['update'])) {
                        $nama             = ucwords($_POST['nama']);
                        $instansi         = ucwords($_POST['instansi']);
                        $email            = $_POST['email'] == '' ? '-' : $_POST['email'];
                        $hp               = $_POST['hp'] == '' ? '-' : $_POST['hp'];
                        $tglubah          = date("Y/m/d");

                        $ekstensi_diperbolehkan    = array('png');
                        $nama_file  = "id_peserta_" . $id_peserta . ".jpg";
                        $ukuran     = $_FILES['file']['size'];
                        $file_tmp   = $_FILES['file']['tmp_name'];

                        if ($ukuran < 1485760) {
                            move_uploaded_file($file_tmp, '../files/peserta/' . $nama_file);

                            $query_edit = "UPDATE peserta set realname='$nama', email='$email', instansi='$instansi', no_hp='$hp', last_update='$tglubah', image = '$nama_file' WHERE id_peserta='$id_peserta'";

                        // echo $query_edit;
                        // echo $move;
                           $update = mysqli_query($konek, $query_edit);
                           if ($update) {
                               echo '<script>alert("Profil Pengguna Berhasil di Edit")
                                location.replace("' . $base_url . '/index.php?p=mst-peserta")</script>';
                           } else {

                               echo '<script>alert("Profil Pengguna Gagal di Edit")
                             location.replace("' . $base_url . '/index.php?p=mst-peserta")</script>';
                           }

                        } else {
                            echo '<script>alert("Ukuran Foto Terlalu Besar")</script>';
                        }


                    }

                    if (isset($_POST['update_pass'])) {
                        $password         = md5($_POST['password']);

                        $query_pas = "UPDATE peserta set password='$password' WHERE id_peserta='$id_peserta'";
                        $update_pass = mysqli_query($konek, $query_pas);

                        //echo $query_pas;
                        if ($update_pass) {
                            echo '<script>alert("Password Pengguna Berhasil di Ubah")
                 location.replace("' . $base_url . '/index.php?p=mst-peserta")</script>';
                        } else {

                            echo '<script>alert("Password Pengguna Pengguna Gagal di Ubah")
                 location.replace("' . $base_url . '/index.php?p=mst-peserta")</script>';
                        }
                    }

                    ?>

                    <!-- /.box -->

                    <!-- Input addon -->


            </div>
        </div>

    <?php
}
?>
