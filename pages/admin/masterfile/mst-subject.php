<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-inbox"></i> Subject
        </h1>

    </section>
    <br>
    <!-- Main content -->
    <section class="content">


        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-primary" data-target="#ModalAddSub" data-toggle="modal"> <i class="fa fa-plus"></i> Tambah Subject</button>
                </div>
                <div class="col-md-3">
                    <a href="<?php echo $base_url; ?>/index.php?p=mst-subject" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> Daftar Subject
                    </a>
                </div>
                <div class="col-md-6">
                </div>

                <br>
                <br>
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-user-secret"></i> List Subject</h3>

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
                                        <!-- <div class="callout callout-info">
                                            <span>Pengguna Sistem Login : <code>http://[alamat_website]/url.php?p=admin-login</code></span>
                                        </div> -->

                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <div class="box-body">
                                            <table id="paper_table" data-show-refresh="true" data-classes="table table-bordered" data-pagination="true" data-id-field="id" data-page-list="[10, 25, 50, 100, ALL]" data-side-pagination="server"></table>
                                        </div>
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


        <!-- Modal Popup untuk Add SUbject-->
        <div id="ModalAddSub" name='myform' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Tambahkan Subject</h4>
                    </div>

                    <div class="modal-body">
                        <form id="add_subject" method="POST">

                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Masukkan Nama Subject..." required />

                            </div>



                            <div class="modal-footer">
                                <button class="btn btn-success" id="btn" type="submit">
                                    Confirm
                                </button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="$('#add_keyword')[0].reset();">
                                    Cancel
                                </button>
                            </div>

                        </form>



                    </div>


                </div>
            </div>
        </div>

        <!-- TUTUP MODAL SUBJECT -->
        <!-- /.box -->

        <!-- Input addon -->
        <script>
            $(document).ready(function() {
                $('#paper_table').bootstrapTable({
                    pagination: true,
                    search: true,
                    pageSize: 10,
                    url: 'data_api/api-list-subject.php',
                    singleSelect: true,
                    columns: [{
                            field: 'subject',
                            title: 'Subject',
                            width: '50%',
                            halign: 'center',
                            align: 'left',
                            sortable: true
                        },
                        {
                            field: 'input_date',
                            title: 'Tanggal Masuk',
                            align: 'center',
                            halign: 'center',
                            width: '20%',
                            sortable: true,
                            formatter: tglIndo
                        },

                        {
                            field: 'last_update',
                            title: 'Tanggal Ubah',
                            align: 'center',
                            halign: 'center',
                            width: '10%',
                            sortable: true,
                            formatter: tglIndo
                        },
                        {
                            field: 'subject_id',
                            title: 'SETTING',
                            align: 'center',
                            halign: 'center',
                            width: '20%',
                            formatter: function(value, row) {
                                return "<a href='<?php echo $base_url; ?>/index.php?p=mst-hapus&subjectID=" + value + "'onClick=\"return confirm('Apakah anda yakin akan menghapus data Subject " + row.subject + " ?')\"><button type='button' class='btn btn-default'><i class='fa fa-trash'></i></button></a>";

                            }
                        }
                    ],
                    onLoadSuccess: function(e) {
                        //				$('#total_record').html(e.total);
                        $('.fixed-table-pagination').addClass('panel-footer clearfix ');
                    }
                });


                $('#add_subject').submit(function(e) {
                    data = $('#add_subject').serialize();
                    $.ajax({
                        type: "POST",
                        url: "data_api/save-subject.php",
                        data: data,
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                alert(result.msg);
                                $('#ModalAddSub').modal('hide');
                                $('#add_author')[0].reset();
                            }
                        }
                    });
                    e.preventDefault();
                });
            });

            function tglIndo(value) {
                var tanggal = new Date(value).getDate();
                var bulan = new Date(value).getMonth() + 1;
                var tahun = new Date(value).getYear();

                tahun = (tahun < 1000) ? tahun + 1900 : tahun;
                tanggal = tanggal < 10 ? '0' + tanggal : tanggal;
                bulan = bulan < 10 ? '0' + bulan : bulan;

                return tanggal + "-" + bulan + "-" + tahun;
            }
        </script>
    <?php
}
?>