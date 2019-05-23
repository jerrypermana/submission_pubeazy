<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-bank"></i> Account Bank
        </h1>

    </section>
    </br>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-primary" data-target="#ModalAddBank" data-toggle="modal"> <i class="fa fa-plus"></i> Tambah Account Bank</button>
                </div>
                <div class="col-md-3">

                    <a href="<?php echo $base_url; ?>/index.php?p=mst-accountbank" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> Daftar Accout Bank
                    </a>
                </div>
                <div class="col-md-6">
                </div>

                <br>
                <br>


                <div class="col-md-12">

                    <!-- form start -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-bank"></i> List Account Bank</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%; text-align: center;">NAMA BANK</th>
                                            <th style="width: 20%; text-align: center;">NO REKENING</th>
                                            <th style="width: 20%; text-align: center;">ATAS NAMA</th>
                                            <th style="width: 20%; text-align: center;">ACTION</th>
                                        </tr>
                                    </thead>
                                    <?php


                                    $select = mysqli_query($konek, "SELECT * FROM account_bank");




                                    while ($row_bank = mysqli_fetch_array($select)) {




                                        echo "<tbody>
                                            <tr>
                                                <td >$row_bank[nama_bank]</td>
                                                <td >$row_bank[rekening]</td>
                                                <td >$row_bank[atas_nama]</td>
                                                <td align='center'><a href='$base_url/index.php?p=mst-edit-accountbank&bankID=$row_bank[kode_bank]'><button type='button' class='btn btn-default'><i class='fa fa-edit'></i> Edit</button></a>
                                                &nbsp
                                               <a href='$base_url/index.php?p=mst-hapus&bankID=$row_bank[kode_bank]'onClick=\"return confirm('Apakah anda yakin akan menghapus data Jam $row_bank[nama_bank] ?')\"><button type='button' class='btn btn-danger'><i class='fa fa-trash'> Hapus</i></button></a>
                                                </td>
                                            </tr>
                                        </tbody>";
                                    };
                                    ?>

                                  
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Popup untuk Add SUbject-->
        <div id="ModalAddBank" name='myform' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Tambahkan Account Bank</h4>
                    </div>

                    <div class="modal-body">
                        <form id="add_bank" method="POST">

                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Account Bank</label>
                                <input type="text" name="nama_bank" class="form-control" placeholder="Masukkan Nama Bank..." required />
                                <br>
                                <input type="text" name="rekening" class="form-control" placeholder="Masukkan Rekening Bank..." required />
                                <br>
                                <input type="text" name="atas_nama" class="form-control" placeholder="Masukkan Atas Nama..." required />

                            </div>



                            <div class="modal-footer">
                                <button class="btn btn-success" id="btn" type="submit">
                                    Confirm
                                </button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="$('#add_bank')[0].reset();">
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


                $('#add_bank').submit(function(e) {
                    data = $('#add_bank').serialize();
                    $.ajax({
                        type: "POST",
                        url: "data_api/save-bank.php",
                        data: data,
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                alert(result.msg);
                                $('#ModalAddbank').modal('hide');
                                $('#add_bank')[0].reset();
                            }
                        }
                    });
                    e.preventDefault();
                });
            })
        </script>

    <?php
}
?>