<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Pengguna Sistem
        </h1>

    </section>
    </br>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <div class="col-md-3" align="right">
                    <button type="button" class="btn btn-block btn-primary" data-target="#ModalAddAdmin" data-toggle="modal"> <i class="fa fa-plus"></i> Tambah Pengguna Sistem</button>

                </div>
                <div class="col-md-3" align="right">
                    <a href="<?php echo $base_url; ?>/index.php?p=mst-admin" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> Daftar Pengguna Sistem
                    </a>
                </div>
                <div class="col-md-6">
                </div>

                <br>
                <br>
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-user-secret"></i> List Pengguna Sistem</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                        <br>
                                        <div class="callout callout-info">
                                            <span>Pengguna Sistem Login : <code>http://[alamat_website]/url.php?p=admin-login</code></span>
                                        </div>

                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table id="example2" class="table table-bordered table-striped dataTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30%; text-align: center;">Name</th>
                                                    <th style="width: 30%; text-align: center;">Email</th>
                                                    <th style="width: 20%; text-align: center;">Group Session</th>
                                                    <th style="width: 20%; text-align: center;">Actions</th>
                                                </tr>
                                            </thead>
                                            <?php


                                            $select_login = mysqli_query($konek, "SELECT * FROM login");
                                            while ($d_login = mysqli_fetch_array($select_login)) {



                                                echo "<tbody>
                                                <tr>
                                                    <td >$d_login[email]</td>
                                                    <td >$d_login[realname]</td>
                                                    <td >$d_login[group_session]</td>
                                                    <td align='center'>
                                                <a href='$base_url/index.php?p=mst-edit-admin&adminID=$d_login[admin_id]'><button type='button' class='btn btn-default'><i class='fa fa-edit'></i> Edit</button></a>
                                                &nbsp
                                                <a href='$base_url/index.php?p=mst-hapus&admin_id=$d_login[admin_id]'onClick=\"return confirm('Apakah anda yakin akan menghapus data Admin $d_login[realname] ?')\"><button type='button' class='btn btn-danger'><i class='fa fa-trash'> Hapus</i></button></a>
                                                </td>
                                                </tr>
                                            </tbody>";
                                            };
                                            ?>


                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>



            </div>
        </div>


        <!-- /.box -->

        <!-- Input addon -->


        <!-- Modal Popup untuk Add SUbject-->
        <div id="ModalAddAdmin" name='myform' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Tambahkan Pengguna Sistem</h4>
                    </div>

                    <div class="modal-body">
                        <form action='<?php echo $base_url; ?>/index.php?p=save-admin' method="POST">

                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Masukkan Email..." required />
                                <br>
                                <label for="Modal Name">Nama Lengkap</label>
                                <input type="text" name="realname" class="form-control" placeholder="Masukkan Nama Lengkap..." required />
                                <br>
                                <label for="Modal Name">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan Password..." required />
                                <br>


                            </div>



                            <div class="modal-footer">
                                <button class="btn btn-success" id="btn" type="submit" name='submit'>
                                    Confirm
                                </button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="$('#add_admin')[0].reset();">
                                    Cancel
                                </button>
                            </div>

                        </form>



                    </div>


                </div>
            </div>
        </div>

        <!-- TUTUP MODAL SUBJECT -->
        <!-- <script>
                                        $(document).ready(function() {

                 
                                            $('#add_admin').submit(function(e) {
                                                            data = $('#add_admin').serialize();
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "data_api/save-admin.php",
                                                                data: data,
                                                                dataType: "json",
                                                                success: function(result) {
                                                                    if (result.success) {
                                                                        alert(result.msg);
                                                                        $('#ModalAddAdmin').modal('hide');
                                                                        $('#add_admin')[0].reset();
                                                                    }
                                                                }
                                                            });
                                                            e.preventDefault();
                                                        });
                                        })
                                    </script> -->

    <?php
}
?>