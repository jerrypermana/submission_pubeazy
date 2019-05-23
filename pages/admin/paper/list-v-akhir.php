<?php
if ($_SESSION['group_session'] == 'admin' || $_SESSION['group_session'] == 'reviewer') {
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
                        List Verifikasi Akhir
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
                url: 'data_api/api-list-v-akhir.php',
                singleSelect: true,
                columns: [

                    {
                        field: 'paper_id',
                        title: 'Verifikasi',
                        align: 'center',
                        halign: 'center',
                        width: '20%',
                        formatter: function(value, row) {
                            return "<a href='<?php echo $base_url; ?>/index.php?p=v-akhir&idpaper=" + value + "''><button type='button' class='btn btn-primary'><i class='fa fa-check-square-o'></i> Verify</button></a>";

                        }
                    },
                    {
                        field: 'member_id',
                        title: 'NO ANGGOTA',
                        halign: 'center',
                        align: 'left',
                        width: '10%',
                        sortable: false
                    },
                    {
                        field: 'nama_konferensi',
                        title: 'KONFERENSI',
                        halign: 'center',
                        width: '20%',
                        sortable: false
                    },
                    {
                        field: 'realname',
                        title: 'PENGARANG',
                        halign: 'center',
                        align: 'left',
                        width: '10%',
                        sortable: false
                    },
                    {
                        field: 'judul',
                        title: 'JUDUL',
                        halign: 'center',
                        width: '20%',
                        sortable: false
                    },

                    {
                        field: 'v_akhir',
                        title: 'VERIFIKASI AKHIR',
                        halign: 'center',
                        align: 'center',
                        width: '10%',
                        sortable: true,
                        formatter: function(value) {
                            if (value == '0') {
                                status = "<label style='color: red;'>Belum Di-Verifikasi </label>";

                            } else {
                                status = "<label style='color: green;'>Sudah Di-Verifikasi</label>";

                            }
                            return status;
                        }
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
