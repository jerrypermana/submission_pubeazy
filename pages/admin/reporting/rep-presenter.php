<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pelaporan Daftar Presenter
        </h1>

    </section>
    </br>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">


                <div class="col-md-12">

                    <!-- form start -->
                    <div class="box">
                        <div class="box-header">
                            <br>
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-2" align="right">
                                <a href="admin/reporting/rep-presenter-pdf.php" target="_blank" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
                            </div>
                            <div class="col-md-2" align="right">
                                <a href="admin/reporting/rep-presenter-pdf.php" target="_blank" class="btn btn-default"><i class="fa fa-fw fa-file-excel-o"></i> Download Excel</a>

                            </div>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">NO ANGGOTA</th>
                                        <th style="width: 20%;">NAMA</th>
                                        <th style="width: 20%;">EMAIL</th>
                                        <th style="width: 20%;">HANDPHONE</th>
                                        <th style="width: 20%;">INPUT DATE</th>

                                    </tr>
                                </thead>
                                <?php

                                $select = mysqli_query($konek, "SELECT * FROM presenter");



                                while ($row_pre = mysqli_fetch_array($select)) {


                                    echo "<tbody>
                                            <tr>
                                                <td>$row_pre[member_id]</td>
                                                <td>$row_pre[realname]</td>
                                                <td>$row_pre[email]</td>
                                                <td>$row_pre[no_hp]</td>                                               
                                               <td>$row_pre[input_date]</td>                                              
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
        <script>
            $(function() {
                $('#example1').DataTable()
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                })
            })
        </script>

        <!-- /.box -->

        <!-- Input addon -->


        </div>
        </div>

        </div>
        </div>
    <?php
}
?>