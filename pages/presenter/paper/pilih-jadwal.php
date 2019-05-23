<?php
if ($_SESSION['group_session'] == 'presenter') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Paper
        </h1>

    </section>
    <br>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">


                <div class="col-md-12">
                     <!-- form start -->
                    <div class="box">
                        <div class="box-header">

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr><th style="width: 10%;">ACTION</th>
                                        <th style="width: 15%;">NO ANGGOTA</th>
                                        <th style="width: 30%;">KONFERENSI</th>
                                        <th style="width: 15%;">PENGARANG</th>
                                        <th style="width: 30%;">JUDUL</th>
                                        <th style="width: 10%;">STATUS VERIFIKASI</th>
                                        <th style="width: 10%;">STATUS TRANSFER</th>
                                        
                                    </tr>
                                </thead>
                                <?php

                                $id_presenter =  $_SESSION['id_presenter'];
                                $select = mysqli_query($konek, "SELECT p.paper_id,p.judul, p.abstrak,pre.member_id, p.v_paper,pre.realname, 
                            tp.biaya_conf,tp.transfer_id,tp.v_transfer,conf.nama_konferensi
                            FROM paper as p 
                            LEFT JOIN presenter as pre ON p.id_presenter=pre.id_presenter
                            LEFT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
                            LEFT JOIN conference as conf ON p.konferensi_id=conf.konferensi_id
                            WHERE v_transfer='1' AND pre.id_presenter='$id_presenter'");




                                while ($row_paper = mysqli_fetch_array($select)) {
                                    // $epoch      = $row_paper["start_day"] ;
                                    // $dt         = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                                    // $start_day  = $dt->format('d-m-Y');
                                    // $start_time = sprintf("%02d:%02d", $row_paper["start_time"] / 60 / 60, ($row_paper["start_time"] % (60 * 60) / 60));
                                    // $end_time   = sprintf("%02d:%02d", $row_paper["end_time"] / 60 / 60, ($row_paper["end_time"] % (60 * 60) / 60));

                                    if ($row_paper['v_paper'] == 0) {

                                        $status = '<p style="color: red; font-weight: bold;"> Belum Verifikasi</p>';
                                    } else {

                                        $status = '<p style="color: green; font-weight: bold;">Sudah Verifikasi</p>';
                                    }

                                    if ($row_paper['v_transfer'] == 0) {

                                        $status_tf = '<p style="color: red; font-weight: bold;"> Belum Verifikasi</p>';
                                    } else {

                                        $status_tf = '<p style="color: green; font-weight: bold;">Sudah Verifikasi</p>';
                                    }

                                    echo "<tbody>
                                            <tr>
                                            <td align='center'><a href='$base_url/index.php?p=add-jadwal&id=$row_paper[paper_id]'><button type='button' class='btn btn-primary'><i class='fa fa-calendar-plus-o'></i></button></a></td>
                                                <td>$row_paper[member_id]</td>
                                                <td>$row_paper[nama_konferensi]</td>
                                                <td>$row_paper[realname] </td>
                                                <td>$row_paper[judul] </td>   
                                                <td>$status</td>                                    
                                                <td>$status_tf</td>
                                                
                                            </tr>
                                        </tbody>";
                                };
                                ?>

                                <tfoot>
                                    <tr>
                                    <th>ACTION</th>
                                        <th>NO ANGGOTA</th>
                                        <th>KONFERENSI</th>
                                        <th>PENGARANG</th>
                                        <th>JUDUL</th>
                                        <th>STATUS VERIFIKASI</th>
                                        <th>STATUS TRANSFER</th>                                        
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </div>
        </div>
        <!-- /.box -->


        <!-- /.box -->

        <!-- Input addon -->


        </div>
        </div>

        </div>
        </div>
    <?php
}
?>