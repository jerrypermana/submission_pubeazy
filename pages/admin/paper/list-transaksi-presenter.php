<?php
if ($_SESSION['group_session'] == 'admin' || $_SESSION['group_session'] == 'reviewer' ) {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">


    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3>
                            Daftar Bukti Transfer Presenter
                        </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">

                        </div>
                        <br>
                        <br>
                        <div class="col-md-12">

                            <!-- form start -->
                            <div class="box">

                                <div class="box-header">

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="paper_table" data-show-refresh="true" data-classes="table table-bordered" data-pagination="true" data-id-field="id" data-page-list="[10, 25, 50, 100, ALL]" data-side-pagination="server"></table>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
   

        <!-- /.box -->

        <!-- Input addon -->
        <script>
            $(document).ready(function() {
                $('#paper_table').bootstrapTable({
                    pagination: true,
                    search: true,
                    pageSize: 10,
                    url: 'data_api/list-tf-presenter.php',
                    singleSelect: true,
                    columns: [
                        {
                            field: 'transfer_id',
                            title: 'SETTING',
                            align: 'center',
                            halign: 'center',
                            width: '20%',
                            formatter: function(value, row) {
                                return "<a href='<?php echo $base_url; ?>/index.php?p=v-transferpresenter&id=" + value + "''><button type='button' class='btn btn-primary'><i class='fa fa-check-square-o'></i> Verify</button></a><br><br><a href='<?php echo $base_url; ?>/index.php?p=hapus&idtrans=" + value + "'onClick=\"return confirm('Apakah anda yakin akan menghapus data item')\"><button type='button' class='btn btn-danger'><i class='fa fa-trash'></i> Delete</button></a>";

                            }
                        },
                        {
                            field: 'member_id',
                            title: 'NO ANGGOTA',
                            halign: 'center',
                            width: '10%',
                            align: 'center',

                            sortable: false
                        },
                        {
                            field: 'transfer_id',
                            title: 'NO TRANSAKSI',
                            halign: 'center',
                            width: '10%',
                            align: 'center',

                            sortable: false
                        },

                        {
                            field: 'realname',
                            title: 'PRESENTER',
                            halign: 'center',
                            align: 'left',
                            width: '20%',
                            sortable: false
                        },
                        {
                            field: 'judul',
                            title: 'JUDUL',
                            halign: 'center',
                            width: '30%',
                            sortable: false
                        },


                        {
                            field: 'v_transfer',
                            title: 'STATUS TRANSAKSI',
                            halign: 'center',
                            align: 'center',
                            width: '15%',
                            sortable: true,
                            formatter: function(value) {
                            if (value == '1') {
                                status = "<span class='label label-success'>Valid</span>";

                            } else if(value == '2')  {
                                status = "<span class='label label-danger'>Invalid</span>";

                            } else{
                                status = "<span class='label label-warning'>None</span>";
                            }
                            return status;
                        }
                        },
                        {
                            field: 'tgl_transfer',
                            title: 'TANGGAL TRANSFER',
                            align: 'center',
                            halign: 'center',
                            width: '10%',
                            sortable: true,
                            formatter: tglIndo

                        }

                    ],
                    onLoadSuccess: function(e) {
                        //				$('#total_record').html(e.total);
                        $('.fixed-table-pagination').addClass('panel-footer clearfix ');
                    }
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
