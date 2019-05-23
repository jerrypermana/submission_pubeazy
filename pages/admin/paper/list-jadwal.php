<?php
if ($_SESSION['group_session'] == 'admin' || $_SESSION['group_session'] == 'reviewer') {
    ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Daftar Paper
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

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">NO</th>
                                    <th style="width: 10%;">JADWAL</th>
                                    <th style="width: 10%;">PENGARANG</th>
                                    <th style="width: 30%;">JUDUL</th>
                                    <th style="width: 10%;">STATUS VERIFIKASI</th>
                                    <th style="width: 10%;">ACTION</th>
                                </tr>
                            </thead>
                            <?php

                            $username =  $_SESSION['username'];
                            $select = mysqli_query($konek, "SELECT p.paper_id,p.judul, p.abstrak, p.v_paper,pre.realname, 
                            tp.biaya_conf,tp.transfer_id,tp.v_transfer, pj.start_day,pj.end_day,pj.start_time,pj.end_time,
                            pj.v_jadwal, mst_ruang.nama_ruang
                            FROM paper as p 
                            inner JOIN presenter as pre ON p.username=pre.username 
                            inner JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
                            inner JOIN paper_jadwal as pj ON p.paper_id=pj.paper_id
                            inner JOIN mst_ruang ON pj.ruang_id=mst_ruang.ruang_id");

                            $no = 1;

                           
                            while ($row_paper = mysqli_fetch_array($select)) {
                                $epoch      = $row_paper["start_day"] ;
                                $dt         = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                                $start_day  = $dt->format('d-m-Y');
                                $start_time = sprintf("%02d:%02d", $row_paper["start_time"] / 60 / 60, ($row_paper["start_time"] % (60 * 60) / 60));
                                $end_time   = sprintf("%02d:%02d", $row_paper["end_time"] / 60 / 60, ($row_paper["end_time"] % (60 * 60) / 60));

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
                                                <td>$no</td>
                                                <td><b>$row_paper[nama_ruang]</b><br><b>$start_day</b><br> $start_time s/d $end_time</td>
                                                <td>$row_paper[realname] </td>
                                                <td>$row_paper[judul] </td>                                                
                                               
                                                 <td>$status</td>
                                                <td align='center'><a href='$base_url/index.php?p=v-jadwal&id=$row_paper[paper_id]'><button type='button' class='btn btn-default'><i class='fa fa-calendar-plus-o'></i></button></a>
                                              </td>
                                            </tr>
                                        </tbody>";

                                $no++;
                            
                            };
                            ?>

                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>JADWAL</th>
                                    <th>PENGARANG</th>
                                    <th>JUDUL</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
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