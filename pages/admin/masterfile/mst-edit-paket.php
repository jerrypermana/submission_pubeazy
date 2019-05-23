<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit jadwal Jam
        </h1>

    </section>
    <br>
    <?php

    $paket_id = $_GET['paketID'];
    $query = "SELECT * FROM paket_konferensi WHERE paket_id='$paket_id '";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    if ($hitung == 0) {
        echo '<script>alert("Package Conference Its Not Found")
        location.replace("' . $base_url . '/index.php?p=mst-paket")</script>';
    }
    ?>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- form start -->
                                <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">


                                    <table class="table table-condensed">
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Name Package*<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><input type="text" name="nama_paket" id='nama_paket' class="form-control" style="width: 90%" value='<?php echo $row['nama_paket']; ?>'>
                                                <input type="hidden" name="paket_id" class="form-control" style="width: 90%" value='<?php echo $row['paket_id']; ?>'></th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%; text-align: right;"><label>Cost Package*<label></th>
                                            <th style="width: 2%">:</th>
                                            <th style="width: 78%"><input type="text" name="biaya" id='biaya' class="form-control" style="width: 50%" value='<?php echo $row['biaya']; ?>'>

                                        </tr>

                                        <tr>
                                            <th style="width: 20%"></th>
                                            <th style="width: 2%"></th>
                                            <th style="width: 78%"> </br></br></br></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3">
                                                <center>
                                                    <button type="submit" name='update' class="btn btn-block btn-primary btn-sm">Update</button>
                                                    <button type="reset" onclick="goBack()" class="btn btn-block btn-warning btn-sm">Cancel</button>
                                                </center>
                                            </th>
                                        </tr>

                                    </table>
                                </form>

                                <?php
                                if (isset($_POST['update'])) {
                                    $paket_id       = $_POST['paket_id'];
                                    $paket          = $_POST['nama_paket'];
                                    $biaya          = $_POST['biaya'];





                                    $q_update  = "UPDATE paket_konferensi set nama_paket='$paket',biaya='$biaya' where paket_id='$paket_id'";

                                    //echo $q_update;
                                    $update_paket = mysqli_query($konek, $q_update);

                                    if ($update_paket) {
                                        echo '<script>alert("Package Conference Berhasil di-edit")
                                    location.replace("' . $base_url . '/index.php?p=mst-paket")</script>';
                                    } else {
                                        echo '<script>alert("Package Conference Gagal di-edit")
                                    location.replace("' . $base_url . '/index.php?p=mst-paket")</script>';
                                    }
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
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
                <!-- /.box -->


                <!-- /.box -->

                <!-- Input addon -->


            </div>
        </div>


    <?php
}
?>