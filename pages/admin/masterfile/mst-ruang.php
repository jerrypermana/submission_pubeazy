<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-home"></i> Room Conference
        </h1>

    </section>
    <br>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-primary" data-target="#ModalAddRuang" data-toggle="modal"> <i class="fa fa-plus"></i> Add Room Conference</button>

                </div>
                <div class="col-md-3">

                    <a href="<?php echo $base_url; ?>/index.php?p=mst-ruang" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List Room Conference
                    </a>
                </div>
                <div class="col-md-6">
                </div>

                <br>
                <br>


                <div class="col-md-12">

                    <!-- form start -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-home"></i> List Room Conference</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%; text-align: center;">NAMA RUANG</th>
                                            <th style="width: 20%; text-align: center;">KUOTA</th>
                                            <th style="width: 20%; text-align: center;">INPUT DATE</th>
                                            <th style="width: 20%; text-align: center;">LAST UPDATE</th>
                                            <th style="width: 20%; text-align: center;">ACTION</th>
                                        </tr>
                                    </thead>
                                    <?php


                                    $select = mysqli_query($konek, "SELECT * FROM mst_ruang");




                                    while ($row_ruang = mysqli_fetch_array($select)) {




                                        echo "<tbody>
                                            <tr>
                                                <td >$row_ruang[nama_ruang]</td>
                                                <td >$row_ruang[kuota]</td>
                                                <td >$row_ruang[input_date]</td>
                                                <td >$row_ruang[last_update]</td>
                                                <td align='center'><a href='$base_url/index.php?p=mst-edit-ruang&ruangID=$row_ruang[ruang_id]'><button type='button' class='btn btn-default'><i class='fa fa-edit'></i> Edit</button></a>
                                                &nbsp
                                               <a href='$base_url/index.php?p=mst-hapus&ruangID=$row_ruang[ruang_id]'onClick=\"return confirm('Apakah anda yakin akan menghapus data Jam $row_ruang[nama_ruang] ?')\"><button type='button' class='btn btn-danger'><i class='fa fa-trash'> Hapus</i></button></a>
                                                </td>
                                            </tr>
                                        </tbody>";
                                    };
                                    ?>

                                   
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->


        <!-- /.box -->

        <!-- Modal Popup untuk Add SUbject-->
        <div id="ModalAddRuang" name='myform' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Tambahkan Account Bank</h4>
                    </div>

                    <div class="modal-body">
                        <form id="add_ruang" method="POST">

                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Nama Ruang</label>
                                <input type="text" name="nama_ruang" class="form-control" placeholder="Masukkan Nama Ruangan..." required />
                                <br>
                                <label for="Modal Name">Kuota Ruangan</label>
                                <input type="text" name="kuota" class="form-control" placeholder="Masukkan Kuota Ruangan..." required />
                                <br>

                            </div>



                            <div class="modal-footer">
                                <button class="btn btn-success" id="btn" type="submit">
                                    Confirm
                                </button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="$('#add_ruang')[0].reset();">
                                    Cancel
                                </button>
                            </div>

                        </form>



                    </div>


                </div>
            </div>
        </div>

        <!-- TUTUP MODAL SUBJECT -->
        <script>
            $(document).ready(function() {


                $('#add_ruang').submit(function(e) {
                    data = $('#add_ruang').serialize();
                    $.ajax({
                        type: "POST",
                        url: "data_api/save-ruang.php",
                        data: data,
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                alert(result.msg);
                                $('#ModalAddRuang').modal('hide');
                                $('#add_ruang')[0].reset();
                            }
                        }
                    });
                    e.preventDefault();
                });
            })
        </script>
     
    <?php
}
?>