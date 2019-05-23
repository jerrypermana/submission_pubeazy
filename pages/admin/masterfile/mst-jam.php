<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-clock-o"></i> Time Schedule
        </h1>

    </section>
    </br>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-primary" data-target="#ModalAddJam" data-toggle="modal"> <i class="fa fa-plus"></i> Add Time</button>
                </div>
                <div class="col-md-3">

                    <a href="<?php echo $base_url; ?>/index.php?p=mst-jam" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List Time
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
                            <h3 class="box-title"><i class="fa fa-user-secret"></i> List Time Schedule</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th style="width: 30%; text-align: center;">JAM</th>
                                        <th style="width: 10%; text-align: center;">ACTION</th>
                                    </tr>
                                </thead>
                                <?php


                                $select = mysqli_query($konek, "SELECT * FROM jadwal_jam");
                                while ($row_jam = mysqli_fetch_array($select)) {
                                    echo "<tbody>
                                            <tr>
                                                <td >$row_jam[jam]</td>
                                                <td align='center'><a href='$base_url/index.php?p=mst-edit-jam&jamID=$row_jam[jam_id]'><button type='button' class='btn btn-default'><i class='fa fa-edit'></i> Edit</button></a>
                                            &nbsp
                                            <a href='$base_url/index.php?p=mst-hapus&jamID=$row_jam[jam_id]'onClick=\"return confirm('Apakah anda yakin akan menghapus data Jam $row_jam[jam] ?')\"><button type='button' class='btn btn-danger'><i class='fa fa-trash'> Hapus</i></button></a>

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
        
        <!-- /.box -->


        <!-- /.box -->

        <!-- Input addon -->


        
        <!-- Modal Popup untuk Add SUbject-->
        <div id="ModalAddJam" name='myform' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Tambahkan Jadwal Jam</h4>
                    </div>

                    <div class="modal-body">
                        <form id="add_jam" method="POST">

                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Jam</label>
                                <input type="text" name="jam" class="form-control" placeholder="Masukkan Jadwal Jam..." required />

                            </div>



                            <div class="modal-footer">
                                <button class="btn btn-success" id="btn" type="submit">
                                    Confirm
                                </button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="$('#add_jam')[0].reset();">
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

                $(function() {
                    $('#example1').DataTable()
                    $('#example2').DataTable({
                        'paging': true,
                        'lengthChange': false,
                        'searching': true,
                        'ordering': true,
                        'info': true,
                        'autoWidth': false
                    })
                })

                $('#add_jam').submit(function(e) {
                    data = $('#add_jam').serialize();
                    $.ajax({
                        type: "POST",
                        url: "data_api/save-jam.php",
                        data: data,
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                alert(result.msg);
                                $('#ModalAddJam').modal('hide');
                                $('#add_jam')[0].reset();
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