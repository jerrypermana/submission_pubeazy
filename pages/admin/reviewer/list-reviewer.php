<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-secret"></i> Reviewer
        </h1>

    </section>
    <br>
    

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <div class="col-md-3" align="right">
                    <a href="<?php echo $base_url; ?>/index.php?p=add-reviewer" class="btn btn-block btn-primary">
                        <i class="fa fa-plus"></i> Add Reviewer
                    </a>
                </div>
                <div class="col-md-3" align="right">
                    <a href="<?php echo $base_url; ?>/index.php?p=list-reviewer" class="btn btn-block btn-primary">
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
                            <h3 class="box-title"><i class="fa fa-user-secret"></i> List Reviewer</h3>

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
                                            <span>Reviewer Login : <code>http://[alamat_website]/url.php?p=login-reviewer</code></span>
                                        </div>

                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table id="example2" class="table table-bordered table-striped dataTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30%; text-align: center;">Name</th>
                                                    <th style="width: 30%; text-align: center;">Email</th>
                                                    <th style="width: 20%; text-align: center;">Status</th>
                                                    <th style="width: 20%; text-align: center;">Actions</th>
                                                </tr>
                                            </thead>
                                            <?php


                                            $select_reviewer = mysqli_query($konek, "SELECT * FROM reviewer");
                                            while ($d_reviewer = mysqli_fetch_array($select_reviewer)) {

                                                if($d_reviewer['status_active']){
                                                    $status="<span class='label label-success'>Active</span>";

                                                }else{
                                                    $status="<span class='label label-danger'>In Active</span>";
                                                }


                                                echo "<tbody>
                                            <tr>
                                                <td >$d_reviewer[realname]</td>
                                                <td >$d_reviewer[email]</td>
                                                <td style='text-align: center;'>$status</td>
                                                <td align='center'><a href='$base_url/index.php?p=edit-reviewer&reviewerID=$d_reviewer[reviewer_id]'><button type='button' class='btn btn-default'><i class='fa fa-edit'></i> Edit</button></a>
                                            &nbsp
                                            <a href='$base_url/index.php?p=mst-hapus&reviewer_id=$d_reviewer[reviewer_id]'onClick=\"return confirm('Apakah anda yakin akan menghapus data Reviewer $d_reviewer[realname]?')\"><button type='button' class='btn btn-danger'><i class='fa fa-trash'> Hapus</i></button></a>

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

        </div>
        </div>
        <!-- Modal Popup untuk Add SUbject-->



        </div>
        </div>
    <?php
}
?>