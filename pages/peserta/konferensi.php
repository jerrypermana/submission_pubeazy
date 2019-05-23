<?php
if ($_SESSION['group_session'] == 'peserta') {

    if (isset($_POST['submit'])) {

        $id_peserta          = $_SESSION['id_peserta'];
        $cek_peserta         = mysqli_query($konek, "SELECT * FROM peserta WHERE id_peserta = '$id_peserta'");
        $data_peserta        = mysqli_fetch_assoc($cek_peserta);

        $id_konferensi       = mysqli_real_escape_string($konek, $_POST['id_konferensi']);
        $paket_konferensi    = mysqli_real_escape_string($konek, $_POST['paket_konferensi']);

        $input_date          = date('Y-m-d');

        if (empty($id_konferensi)) {
            echo '<script>alert("Mohon pilih nama konferensi")</script>';
        } else if (empty($paket_konferensi)) {
            echo '<script>alert("Mohon pilih paket konferensi")</script>';
        } else {

            $insert_data   = mysqli_query($konek, "INSERT INTO transaksi_peserta (id_peserta, konferensi_id, paket_id, input_date) VALUES ('$id_peserta', '$id_konferensi', '$paket_konferensi', '$input_date')");

            if ($insert_data == TRUE) {

                $email      = $data_peserta['email'];
                $realname   = $data_peserta['realname'];

                $mst_email     = mysqli_query($konek, "SELECT * FROM mst_email WHERE email_id =1 ");
                $data_email    = mysqli_fetch_assoc($mst_email);

                $transaksi_peserta = mysqli_query(
                    $konek,
                    "SELECT
                         tp.transfer_id,
                         p.id_peserta,
                         conf.nama_konferensi,
                         conf.penyelenggara,
                         pk.nama_paket,
                         tp.v_transfer,
                         pk.biaya
                    FROM transaksi_peserta as tp
                    LEFT JOIN peserta as p ON tp.id_peserta = p.id_peserta
                    LEFT JOIN conference as conf ON tp.konferensi_id = conf.konferensi_id
                    LEFT JOIN paket_konferensi as pk ON tp.paket_id=pk.paket_id
                    WHERE tp.id_peserta='$id_peserta' ORDER BY transfer_id DESC LIMIT 1"
                );
                $data_transaksi = mysqli_fetch_array($transaksi_peserta);

                $mst_payment     = mysqli_query($konek, "SELECT * FROM account_bank");


                $send_mail = "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='min-width:100%'>
<tr>
<td style='font-size:0;text-align:center'>
    <table class='t-width' width='100%' border='0' cellspacing='0' cellpadding='0' style='max-width:170px;display:inline-block;vertical-align:middle'>
        <tr>
           <td height='10' style='font-size:1px;line-height:1px'> </td>
        </tr>
        <tr>
           <td align='center' style='width:170px; height:112px'>
           <img src='https://pubeazy.kresnanusantara.co.id/img/logo_loi.png' width='100' height='100'>
           </td>
        </tr>
        <tr>
           <td height='10' style='font-size:1px;line-height:1px'> </td>
        </tr>
    </table>
    <!--[if mso]></td><td width='360'><![endif]-->
    <table class='t-width' width='100%' border='0' cellspacing='0' cellpadding='0' style='display:inline-block; vertical-align:middle; max-width:360px;'>
        <tr>
           <td class='t-none' width='20'> </td>
           <td>
                <table width='100%' border='0' cellspacing='0' cellpadding='0' style='min-width:100%'>
                   <tr>
                        <td height='0' style='font-size:1px;line-height:1px'> </td>
                   </tr>
                   <tr>
                        <td align='left' class='t-center-txt' style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:20px;line-height:24px'>PubEazy Conference</td>
                   </tr>
                   <tr>
                        <td height='15' style='font-size:1px;line-height:1px'> </td>
                   </tr>
                   <tr>
                        <td align='left' class='t-center-txt' style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:14px;line-height:18px'>Jakarta Selatan</td>
                   </tr>
                   <tr>
                        <td align='left' class='t-center-txt' style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:14px;line-height:18px'>Jakarta, Indonesia</td>
                   </tr>
                   <tr>
                        <td align='left' class='t-center-txt' style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:14px;line-height:18px'>(021) 228-2123</td>
                   </tr>
                   <tr>
                        <td height='10' style='font-size:1px;line-height:1px'> </td>
                   </tr>
                </table>
           </td>
           <td class='t-none' width='20'> </td>
        </tr>
    </table>
    

</td>
</tr>
</table>
<table align='center' style='border-color: #666;' cellpadding='10' width='50%'>
<tr>

<td style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:14px;line-height:20px' colspan='3'>
    <p>Hi <span></span><span>$data_peserta[realname]</span><span></span>,</p>
    <p>Appointment confirmed Conference <span></span><span>$data_transaksi[nama_konferensi]</span><span></span> on <span></span><span>" . date("l") . "," . date("F j") . ", " . date("Y") . " at " . date("h:i:sa") . "</span><span></span>. Please find the details below:</p>
</td>

</tr>

<tr>
<td width='35%'><strong>Conference Name</strong></td>
<td width='1%'><strong>:</strong></td>
<td width='65%'>$data_transaksi[nama_konferensi]</td>
</tr>
<tr>
<td width='35%'><strong>Conference Package</strong></td>
<td width='1%'><strong>:</strong></td>
<td width='65%'>$data_transaksi[nama_paket]</td>
</tr>
<tr>
<td width='35%'><strong>Biaya Conference</strong></td>
<td width='1%'><strong>:</strong></td>
<td width='65%'>Rp $data_transaksi[biaya]</td>
</tr>
<tr>
<td width='35%'><strong>No Transaksi</strong></td>
<td width='1%'><strong>:</strong></td>
<td width='65%'>$data_transaksi[transfer_id]</td>
</tr>
<tr>
<td style='border-bottom: 2px solid black' height='5' colspan='3'> </td>
</tr>
<tr>

<td colspan='3' align='center'><strong>
        <p style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:14px;line-height:24px'>Metode Pembayaran </p><strong></td>

</tr>";

                while ($data_payment = mysqli_fetch_array($mst_payment)) {
                    $send_mail .= "   
        <tr style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:14px;line-height:24px'>
            <td align='center' colspan='3'>$data_payment[nama_bank]<br>No Rek : $data_payment[rekening]<br> a/n $data_payment[atas_nama]</td>           
        </tr>";
                };
                $send_mail .= "<tr>
    <td style='border-bottom: 2px solid black' height='5' colspan='3'> </td>
</tr></table>";


                include "../phpmailer/classes/class.phpmailer.php";
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->SMTPSecure = 'ssl';
                $mail->Host = $data_email['SMTP_Host']; //host masing2 provider email
                $mail->SMTPDebug = 2;
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->Username = $data_email['SMTP_User']; //user email
                $mail->Password = $data_email['SMTP_Pass']; //password email
                $mail->SetFrom("pubeazy.conf@gmail.com", "PubEazy Conference"); //set email pengirim
                $mail->Subject = "Pemberitahuan Pendaftaran Conference"; //subyek email
                $mail->AddAddress($email, $realname);  //tujuan email
                $mail->MsgHTML("$send_mail");
                $mail->Send();

                echo '<script>alert("Success")
                location.replace("' . $base_url . '/index.php?p=dashboard-peserta")</script>';
            } else {
                echo '<script>alert("Failed")
                location.replace("' . $base_url . '/index.php?p=dashboard-peserta")</script>';
            }
        }
    }

    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Konferensi
        </h1>

    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pilih Konferensi</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" method="POST" name='simpan' onSubmit='return validasi()' enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nama Konferensi</label>
                                <select class="form-control conf" name='id_konferensi'>

                                    <option value="" disabled selected>Pilih salah satu...</option>

                                    <?php
                                    $select_conf = mysqli_query($konek, "SELECT * FROM conference
                                     LEFT JOIN mst_ruang as mr ON conference.ruang_id=mr.ruang_id");

                                    while ($row = mysqli_fetch_array($select_conf)) {

                                        echo "<option value='$row[konferensi_id]'>$row[nama_konferensi]</option>";
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Paket Konferensi</label>
                                <select class="form-control" name='paket_konferensi'>
                                    <option value="" disabled selected>Pilih salah satu...</option>

                                    <?php
                                    $paket_conf = mysqli_query($konek, "SELECT * FROM paket_konferensi");

                                    while ($row = mysqli_fetch_array($paket_conf)) {

                                        echo "<option value='$row[paket_id]'>$row[nama_paket] (Rp $row[biaya])</option>";
                                    }
                                    ?>

                                </select>
                            </div>


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->

            </div>
        </div>

    <?php
}
?>