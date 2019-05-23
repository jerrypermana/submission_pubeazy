<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-file-o"></i> Reporting Full Paper
        </h1>

    </section>
    </br>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- <div class="col-md-3">
                    <a href="admin/reporting/rep-fullpaper-pdf.php" target="_blank" class="btn btn-block btn-primary"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
                </div>
                <div class="col-md-3">
                    <a href="admin/reporting/rep-fullpaper-excel.php" target="_blank" class="btn btn-block btn-primary"><i class="fa fa-file-excel-o"></i> Download Excel</a>
                </div>
                <div class="col-md-6">
                </div>

                <br>
                <br> -->


                <div class="col-md-12">

                    <!-- form start -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-file-o"></i> List Full Paper</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table id="full_paper" data-show-refresh="true" data-classes="table table-bordered" data-pagination="true" data-id-field="id" data-page-list="[10, 25, 50, 100, ALL]" data-side-pagination="server"></table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#full_paper').bootstrapTable({
                    pagination: true,
                    search: true,
                    pageSize: 10,
                    url: 'data_api/api-fullpaper.php',
                    singleSelect: true,
                    columns: [{
                            field: 'realname',
                            title: 'Author',
                            align: 'left',
                            halign: 'center',
                            width: '20%',
                            formatter: function(value,row) {
                                return "<b> " + row.realname +" <br> " + row.member_id +" <br> " + row.afiliasi+" </b>";

                            }
                        },
                        {
                            field: 'judul',
                            title: 'Title',
                            halign: 'center',
                            width: '40%',
                            sortable: true
                        },
                        
                        {
                            field: 'v_akhir',
                            title: 'Status',
                            halign: 'center',
                            align: 'center',
                            width: '10%',
                            sortable: true,
                            formatter: function(value) {
                                if (value == '1') {
                                    status = "<span class='label label-success'>Approved</span>";

                                } else if (value == '2') {
                                    status = "<span class='label label-warning'>Rejected</span>";

                                } else if (value == '3') {

                                    status = "<span class='label label-danger'>Revision required</span>";
                                } else {

                                    status = "<span class='label label-warning'>None</span>";
                                }
                                return status;
                            }
                        },
                        {
                        field: 'file_fullpaper',
                        title: 'File',
                        align: 'center',
                        halign: 'center',
                        width: '10%',
                        formatter: function(value, row) {
                            return "<a href='../repository/" + value + "''><button type='button' class='btn btn-primary'><i class='fa fa-download'></i> Download</button></a>";

                        }
                    }

                    ],
                    onLoadSuccess: function(e) {
                        //				$('#total_record').html(e.total);
                        $('.fixed-table-pagination').addClass('panel-footer clearfix ');
                    }
                });
            });

          
        </script>

    <?php
}
?>