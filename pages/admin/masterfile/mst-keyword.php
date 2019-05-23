<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
            <i class="fa fa-key"></i> Keyword
        </h1>
    </section>
    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <div class="col-md-3">
                <button type="button" class="btn btn-block btn-primary" data-target="#ModalAdd" data-toggle="modal"> <i class="fa fa-plus"></i> Tambah Keyword</button>
                </div>
                <div class="col-md-3">
                    <a href="<?php echo $base_url; ?>/index.php?p=mst-keyword" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> Daftar Keyword
                    </a>
                </div>
                <div class="col-md-6">
                </div>

                <br>
                <br>
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-user-secret"></i> List Keyword</h3>

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


        <!-- Modal Popup untuk Add Keyword-->
        <div id="ModalAdd" name='myform' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Tambahkan Keyword</h4>
                    </div>

                    <div class="modal-body">
                        <form id="add_keyword" method="POST">

                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Keyword</label>
                                <input type="text" name="keyword" class="form-control" placeholder="Masukkan Nama Keyword ..." required />
                                <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>" />
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
        <!-- TUTUP Modal -->
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    minimumInputLength: 2,
                    allowClear: true,
                    placeholder: 'Search Keywords ...',
                    ajax: {
                        url: 'data_api/ajax_keyword.php',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,

                            }
                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        }

                    }

                });

            })
        </script>
        <!-- TUTUP MODAL SUBJECT -->
        <!-- /.box -->

        <!-- Input addon -->
        <script>
            $(document).ready(function() {
                $('#paper_table').bootstrapTable({
                    pagination: true,
                    search: true,
                    pageSize: 10,
                    url: 'data_api/api-list-keyword.php',
                    singleSelect: true,
                    columns: [{
                            field: 'keyword',
                            title: 'Keyword',
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
                            field: 'keyword_id',
                            title: 'SETTING',
                            align: 'center',
                            halign: 'center',
                            width: '20%',
                            formatter: function(value, row) {
                                return "<a href='<?php echo $base_url; ?>/index.php?p=mst-hapus&keywordID=" + value + "'onClick=\"return confirm('Apakah anda yakin akan menghapus data Keyword " + row.keyword + " ?')\"><button type='button' class='btn btn-default'><i class='fa fa-trash'></i></button></a>";

                            }
                        }
                    ],
                    onLoadSuccess: function(e) {
                        //				$('#total_record').html(e.total);
                        $('.fixed-table-pagination').addClass('panel-footer clearfix ');
                    }
                });


                $('#add_keyword').submit(function(e) {
                    data = $('#add_keyword').serialize();
                    $.ajax({
                        type: "POST",
                        url: "data_api/save-keyword.php",
                        data: data,
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                alert(result.msg);
                                $('#ModalAdd').modal('hide');
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