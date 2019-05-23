<?php
if ($_SESSION['group_session'] == 'peserta') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Konferensi
        </h1>

    </section>
    </br>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">


                <div class="col-md-12" <!-- form start -->
                    <div class="box">
                        <div class="box-header">

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">NAMA KONFERENSI</th>
                                        <th style="width: 15%;">PENYELENGGARA</th>
                                        <th style="width: 15%;">PAKET</th>
                                        <th style="width: 10%;">STATUS</th>

                                    </tr>
                                </thead>
                                <?php

                                $id_peserta =  $_SESSION['id_peserta'];
                                $select = mysqli_query($konek, "SELECT tp.transfer_id,p.id_peserta,conf.nama_konferensi,conf.penyelenggara,pk.nama_paket,tp.v_transfer
                            FROM transaksi_peserta as tp
                            LEFT JOIN peserta as p ON tp.id_peserta=p.id_peserta
                            LEFT JOIN conference as conf ON tp.konferensi_id=conf.konferensi_id
                            LEFT JOIN paket_konferensi as pk ON tp.paket_id=pk.paket_id
                            WHERE tp.id_peserta='$id_peserta'");




                                while ($row_transaksi = mysqli_fetch_array($select)) {
                                    // $epoch      = $row_paper["start_day"] ;
                                    // $dt         = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                                    // $start_day  = $dt->format('d-m-Y');
                                    // $start_time = sprintf("%02d:%02d", $row_paper["start_time"] / 60 / 60, ($row_paper["start_time"] % (60 * 60) / 60));
                                    // $end_time   = sprintf("%02d:%02d", $row_paper["end_time"] / 60 / 60, ($row_paper["end_time"] % (60 * 60) / 60));

                                    if ($row_transaksi['v_transfer'] == 0) {

                                        $status = '<p style="color: red; font-weight: bold;"> Belum Transfer</p>';
                                    } else {

                                        $status = '<p style="color: green; font-weight: bold;">Sudah Transfer</p>';
                                    }


                                    echo "<tbody>
                                            <tr>
                                                <td>$row_transaksi[nama_konferensi]</td>
                                                <td>$row_transaksi[penyelenggara] </td>
                                                <td>$row_transaksi[nama_paket] </td>

                                                 <td>$status</td>

                                              </td>
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
        <script>
            $(document).ready(function() {
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


    <?php
}
?>
