<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-list-alt"></i> Package Conference
        </h1>

    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-primary" data-target="#ModalAddPaket" data-toggle="modal"> <i class="fa fa-plus"></i> Add Package</button>
                </div>
                <div class="col-md-3">

                    <a href="<?php echo $base_url; ?>/index.php?p=mst-paket" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List Package
                    </a>
                </div>
                <div class="col-md-6">
                </div>

                <br>
                <br>


                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-user-secret"></i> List Package Conference</h3>

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


                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table id="example2" class="table table-bordered table-striped dataTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%; text-align: center;">Name Package</th>
                                                    <th style="width: 20%; text-align: center;">Cost Package</th>
                                                    <th style="width: 20%; text-align: center;">Actions</th>
                                                </tr>
                                            </thead>
                                            <?php


                                            $select = mysqli_query($konek, "SELECT * FROM paket_konferensi");
                                            while ($row_paket = mysqli_fetch_array($select)) {
                                                echo "<tbody>
                                                        <tr>
                                                            <td >$row_paket[nama_paket]</td>
                                                            <td >$row_paket[biaya]</td>
                                                            <td align='center'><a href='$base_url/index.php?p=mst-edit-paket&paketID=$row_paket[paket_id]'><button type='button' class='btn btn-default'><i class='fa fa-edit'></i> Edit</button></a>
                                                        &nbsp
                                                        <a href='$base_url/index.php?p=mst-hapus&paketID=$row_paket[paket_id]'onClick=\"return confirm('Apakah anda yakin akan menghapus data Package $row_paket[nama_paket] ?')\"><button type='button' class='btn btn-danger'><i class='fa fa-trash'> Hapus</i></button></a>

                                            </tr>
                                            </tbody>";
                                            };
                                            ?>


                                        </table>
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

        <!-- /.box -->


        <!-- /.box -->

        <!-- Input addon -->



        <!-- Modal Popup untuk Add SUbject-->
        <div id="ModalAddPaket" name='myform' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Add Package</h4>
                    </div>

                    <div class="modal-body">
                        <form id="add_paket" method="POST">

                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Name Package</label>
                                <input type="text" name="nama_paket" class="form-control" placeholder="Insert Name package..." required />

                            </div>
                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Cost Package</label>
                                <input type="text" name="biaya" id='biaya' class="form-control" placeholder="Insert Cost Package..." required />

                            </div>



                            <div class="modal-footer">
                                <button class="btn btn-success" id="btn" type="submit">
                                    Confirm
                                </button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="$('#add_paket')[0].reset();">
                                    Cancel
                                </button>
                            </div>

                        </form>



                    </div>


                </div>
            </div>
        </div>

        <!-- TUTUP MODAL SUBJECT -->
        <script>
            $(document).ready(function() {

                $(function() {
                    $('#example2').DataTable({
                        'paging': true,
                        'lengthChange': true,
                        'searching': true,
                        'ordering': true,
                        'info': true,
                        'autoWidth': true
                    })
                })

                $('#add_paket').submit(function(e) {
                    data = $('#add_paket').serialize();
                    $.ajax({
                        type: "POST",
                        url: "data_api/save-paket.php",
                        data: data,
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                alert(result.msg);
                                $('#ModalAddPaket').modal('hide');
                                $('#add_Paket')[0].reset();
                            }
                        }
                    });
                    e.preventDefault();
                });

                var biaya = document.getElementById("biaya");
                biaya.addEventListener("keyup", function(e) {
                    // tambahkan 'Rp.' pada saat form di ketik
                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                    biaya.value = formatRupiah(this.value);
                });

                /* Fungsi formatRupiah */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, "").toString(),
                        split = number_string.split(","),
                        sisa = split[0].length % 3,
                        biaya = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    if (ribuan) {
                        separator = sisa ? "." : "";
                        biaya += separator + ribuan.join(".");
                    }

                    biaya = split[1] != undefined ? biaya + "," + split[1] : biaya;
                    return prefix == undefined ? biaya : biaya ? "Rp. " + biaya : "";
                }
            })
        </script>

    <?php
}
?>