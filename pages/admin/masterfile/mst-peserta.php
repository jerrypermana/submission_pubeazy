<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> Participants
        </h1>

    </section>
    <br>
    

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <div class="col-md-3" align="right">
                    <a href="<?php echo $base_url; ?>/index.php?p=mst-peserta" class="btn btn-block btn-primary">
                        <i class="fa fa-refresh"></i> Refresh
                    </a>
                </div>
                <div class="col-md-6">
                </div>

                <br>
                <br>
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-user"></i> List Participants</h3>

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
                                            <span>Participants Login : <code>http://[alamat_website]/url.php?p=login</code></span>
                                        </div>

                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table id="example2" class="table table-bordered table-striped dataTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%; text-align: center;">Member ID</th>
                                                    <th style="width: 20%; text-align: center;">Name</th>
                                                    <th style="width: 20%; text-align: center;">Email</th>
                                                    <th style="width: 20%; text-align: center;">Afiliasi</th>
                                                    <th style="width: 20%; text-align: center;">Actions</th>
                                                </tr>
                                            </thead>
                                            <?php


                                            $select_peserta = mysqli_query($konek, "SELECT * FROM peserta");
                                            while ($d_peserta = mysqli_fetch_array($select_peserta)) {

                                               


                                                echo "<tbody>
                                            <tr>
                                                <td >$d_peserta[member_id]</td>
                                                <td >$d_peserta[realname]</td>
                                                <td >$d_peserta[email]</td>
                                                <td >$d_peserta[instansi]</td>
                                                <td align='center'><a href='$base_url/index.php?p=mst-edit-peserta&pesertaID=$d_peserta[id_peserta]'><button type='button' class='btn btn-default'><i class='fa fa-edit'></i> Edit</button></a>
                                            &nbsp
                                            <a href='$base_url/index.php?p=mst-hapus&peserta_id=$d_peserta[id_peserta]'onClick=\"return confirm('Apakah anda yakin akan menghapus data Participant $d_peserta[realname]?')\"><button type='button' class='btn btn-danger'><i class='fa fa-trash'> Hapus</i></button></a>

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

                
            })
        </script>


    <?php
}
?>