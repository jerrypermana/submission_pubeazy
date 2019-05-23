<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Profile Presenter
        </h1>

    </section>

    <?php

    $id_presenter   = $_GET['presenterID'];
    $query      = "SELECT * FROM presenter WHERE id_presenter='$id_presenter'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    if ($hitung == 0) {
        echo '<script>alert("ID Anggota Tidak Di Temukan")
             location.replace("' . $base_url . '../index.php?id=mst-presenter")</script>';
    }


    if ($row['image'] == "") {
        $foto = '../files/peserta/no_photo.png';
    } else {
        $foto = '../files/presenter/' . $row['image'] . '';
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">
                                <h4 class="box-title">Update Profile</h4>
                            </a></li>
                        <li><a href="#tab_2" data-toggle="tab">
                                <h4 class="box-title">Update Password</h4>
                            </a></li>

                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab_1">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo $foto; ?>" alt="User profile picture" style=" height: 150px; width: 150px; ">
                                <h3 class="profile-username text-center" style="padding-top: 30px;padding-bottom: 30px;"><?php echo $row['realname']; ?></h3>
                            </div>

                            <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Realname</label>

                                        <div class="col-sm-5">
                                            <input type="text" name="nama" id='nama' class="form-control" value='<?php echo $row['realname']; ?>'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-5">
                                            <input type="text" name="email" id='email' class="form-control" value='<?php echo $row['email']; ?>'>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Afiliasi*</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="afiliasi" id='afiliasi' class="form-control" value='<?php echo $row['afiliasi']; ?>'>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Country Afiliasi*</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="negara_afiliasi" id='negara_afiliasi' class="form-control" value='<?php echo $row['negara_afiliasi']; ?>' required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Address Afiliasi*</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="alamat_afiliasi" id='alamat_afiliasi' class="form-control" value='<?php echo $row['alamat_afiliasi']; ?>'>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">URL Orcid*</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="url_orcid" id='url_orcid' class="form-control" value='<?php echo $row['url_orcid']; ?>'>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">URL Sinta</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="url_profil" id='url_profil' class="form-control" value='<?php echo $row['url_profil']; ?>'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">No Handphone</label>

                                        <div class="col-sm-3">
                                            <input type="text" name="hp" id='hp' class="form-control" value='<?php echo $row['no_hp']; ?>'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Address</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="address" id='address' class="form-control" value='<?php echo $row['address']; ?>'>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Gender</label>

                                        <div class="col-sm-8">
                                            <?php
                                            if ($row['gender'] == '1') {
                                                echo '<input type="radio" name="gender" value="1"   value="' . $row['gender'] . '" checked> Male
                                                <br>
											            <input type="radio" name="gender" value="0"   value="' . $row['gender'] . '"> Female';
                                            } else {
                                                echo '<input type="radio" name="gender" value="1"   value="' . $row['gender'] . '"> Male 
											<br>
												<input type="radio" name="gender" value="0"   value="' . $row['gender'] . '" checked> Female
											';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Image Profile</label>

                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Insert Image Profile</label>
                                                &nbsp &nbsp <input type="file" name='image' id='image' id="exampleInputFile">
                                                <p class="help-block">Maximum 1 Mb.</p>
                                            </div>
                                        </div>
                                    </div>






                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="update" class="btn btn-info ">Submit</button>
                                    <button type="cancel" class="btn btn-default pull-right">Cancel</button>

                                </div>
                                <!-- /.box-footer -->
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

                                </table>
                                <div class="box-footer">
                                    <button type="submit" name="update_pass" class="btn btn-info ">Submit</button>
                                    <button type="cancel" onclick="goBack()" class="btn btn-default pull-right">Cancel</button>

                                </div>
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
                <f <!-- SCRIPT VALIDASI FORM EDIT TABEL -->
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
                            if (simpan.afiliasi.value == "") {
                                alert("Afiliasi Tidak Boleh KOSONG");
                                simpan.afiliasi.focus();
                                return false;
                            }
                            if (simpan.negara_afiliasi.value == "") {
                                alert("Negara Afiliasi Tidak Boleh KOSONG");
                                simpan.negara_afiliasi.focus();
                                return false;
                            }
                            if (simpan.alamat_afiliasi.value == "") {
                                alert("Alamat Afiliasi Tidak Boleh KOSONG");
                                simpan.alamat_afiliasi.focus();
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

                        $query_presenter = mysqli_query($konek, "SELECT * FROM presenter WHERE id_presenter='$id_presenter'");
                        $tu = mysqli_fetch_array($query_presenter);

                        $member_id        = $tu['member_id'];

                        $nama             = ucwords($_POST['nama']);
                        $afiliasi         = ucwords($_POST['afiliasi']);
                        $negara           = $_POST['negara_afiliasi'] == '' ? '-' : ucwords($_POST['negara_afiliasi']);
                        $alamat           = $_POST['alamat_afiliasi'] == '' ? '-' : ucwords($_POST['alamat_afiliasi']);
                        $url_orcid        = $_POST['url_orcid'] == '' ? '-' : $_POST['url_orcid'];
                        $url_profil       = $_POST['url_profil'] == '' ? '-' : $_POST['url_profil'];
                        $email            = $_POST['email'] == '' ? '-' : $_POST['email'];
                        $hp               = $_POST['hp'] == '' ? '-' : $_POST['hp'];
                        $address          = $_POST['address'] == '' ? '-' : $_POST['address'];
                        $gender             = $_POST['gender'];
                        //$password         = md5($_POST['password']);
                        $tglubah          = date("Y/m/d");
                        $image            = "IMAGE_" . $member_id . ".jpg";
                        $upload           = move_uploaded_file($_FILES['image']['tmp_name'], "../files/presenter/$image");

                        $query_edit = "UPDATE presenter set realname='$nama', email='$email', afiliasi='$afiliasi', negara_afiliasi='$negara', alamat_afiliasi='$alamat',
                url_orcid='$url_orcid', url_profil='$url_profil', no_hp='$hp', image='$image',gender='$gender',address='$address',last_update='$tglubah' WHERE id_presenter='$id_presenter'";

                        //echo $query_edit;
                        $update = mysqli_query($konek, $query_edit);
                        if ($update) {
                            echo '<script>alert("Profil Pengguna Berhasil di Edit")
                 location.replace("' . $base_url . '/index.php?p=mst-presenter")</script>';
                        } else {

                            echo '<script>alert("Profil Pengguna Gagal di Edit")
                 location.replace("' . $base_url . '/index.php?p=mst-presenter")</script>';
                        }
                    }

                    if (isset($_POST['update_pass'])) {
                        $password         = md5($_POST['password']);

                        $query_pas = "UPDATE presenter set password='$password' WHERE id_presenter='$id_presenter'";
                        $update_pass = mysqli_query($konek, $query_pas);

                        //echo $query_pas;
                        if ($update_pass) {
                            echo '<script>alert("Password Pengguna Berhasil di Ubah")
                 location.replace("' . $base_url . '/index.php?p=mst-presenter")</script>';
                        } else {

                            echo '<script>alert("Password Pengguna Pengguna Gagal di Ubah")
                 location.replace("' . $base_url . '/index.php?p=mst-presenter")</script>';
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