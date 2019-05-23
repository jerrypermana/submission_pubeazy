<?php
if ($_SESSION['group_session'] == 'admin' || $_SESSION['group_session'] == 'reviewer') {
    ?>
<!-- Content Header (Page header) -->
<section class="content-header">
     <h1>Daftar Bukti Transfer Peserta</h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">

            <!-- general form elements -->
            <div class="box box-primary">

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">

                        <!-- form start -->
                        <!-- <div class="box"> -->
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="paper_table" data-show-refresh="true" data-classes="table table-bordered" data-pagination="true" data-id-field="id" data-page-list="[10, 25, 50, 100, ALL]" data-side-pagination="server"></table>
                            </div>
                            <!-- /.box-body -->
                        <!-- </div> -->

                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </div>
    </div>
    </div>

    <!-- /.box -->

    <!-- Input addon -->
    <script>
        $(document).ready(function() {
            $('#paper_table').bootstrapTable({
                pagination: true,
                search: true,
                pageSize: 10,
                url: 'data_api/api-tf-peserta.php',
                singleSelect: true,
                columns: [{
                        field: 'transfer_id',
                        title: 'ACTION',
                        align: 'center',
                        halign: 'center',
                        width: '20%',
                        formatter: function(value, row) {
                            return "<a href='<?php echo $base_url; ?>/index.php?p=v-transfer-peserta&id=" + value + "''><button type='button' class='btn btn-primary'><i class='fa fa-check-square-o'></i> Verify</button></a><br><br><a href='<?php echo $base_url; ?>/index.php?p=hapus&idtrans=" + value + "'onClick=\"return confirm('Apakah anda yakin akan menghapus data item')\"><button type='button' class='btn btn-danger'><i class='fa fa-trash'></i> Delete</button></a>";

                        }
                    },
                    {
                        field: 'member_id',
                        title: 'NO ANGGOTA',
                        halign: 'center',
                        align: 'left',
                        width: '20%',
                        sortable: true
                    },
                    {
                        field: 'realname',
                        title: 'NAMA PESERTA',
                        halign: 'center',
                        align: 'left',
                        width: '20%',
                        sortable: false
                    },
                    {
                        field: 'nama_konferensi',
                        title: 'KONFERENSI',
                        halign: 'center',
                        width: '30%',
                        sortable: false
                    },
                    {
                        field: 'penyelenggara',
                        title: 'PENYELENGGARA',
                        halign: 'center',
                        width: '10%',
                        align: 'center',

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
                            if (value == '0') {
                                status = "<label style='color: red;'>Belum Di-Verifikasi </label>";

                            } else {
                                status = " <strong style='color: green;'>Sudah Di-Verifikasi</strong>";

                            }
                            return status;
                        }
                    },
                    {
                        field: 'input_date',
                        title: 'DATA MASUK',
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
