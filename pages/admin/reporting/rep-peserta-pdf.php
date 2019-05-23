<?php

// Define relative path from this script to mPDF
$nama_dokumen = 'Daftar Pelaporan Peserta'; //Beri nama file PDF hasil.
define('_MPDF_PATH', '../../../mpdf60/');
include(_MPDF_PATH . "mpdf.php");
$mpdf = new mPDF('utf-8', 'A4-L'); // Create new mPDF Document

//Beginning Buffer to save PHP variables and HTML tags
ob_start();
include '../../../config/koneksi.php';
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daftar Pelaporan Peserta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>

    <head>
        <style>
            p.header {
                font-family: "verdana", Times, serif;
                font-size: 20px;
                /* font-weight:bold; */
                text-align: center;
            }

            p.headerjudul {
                font-family: Arial, Helvetica, sans-serif;
                text-align: center;
                font-size: 12px;
                font-weight: bold;
            }

            p.isi {
                font-family: Arial, Helvetica, sans-serif;
                text-align: justify;
                font-size: 12px;

            }
        </style>
    </head>


<body>
    <!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak masalah.-->
    <!--CONTOH Code START-->
    <table class="heading" style="width:100%;">

        <tr>
            <td>
                <center>
                    <p class='header'>Daftar Peserta</p>
                </center>
            </td>
        </tr>
        <tr>

        </tr>
    </table>
    <table class="heading" border="1" width="100%">
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th style="width: 10%;">No Anggota</th>
                <th style="width: 10%;">Nama</th>
                <th style="width: 10%;">Username</th>
                <th style="width: 10%;">Email</th>
                <th style="width: 10%;">Instansi</th>
                <th style="width: 10%;">No Handphone</th>
                <th style="width: 10%;">Tanggal Daftar</th>

            </tr>
        </thead>
        <?php

        $select = mysqli_query($konek, "SELECT * FROM peserta");

        $no = 1;

        while ($row_member = mysqli_fetch_array($select)) {


            echo "<tbody>
                                            <tr>
                                                <td><center>$no</center></td>
                                                <td>$row_member[member_id]</td>
                                                <td>$row_member[realname]</td>
                                                <td>$row_member[username]</td>
                                                <td>$row_member[email]</td>
                                                <td>$row_member[instansi]</td>
                                                <td>$row_member[no_hp]</td>                                               
                                               <td>$row_member[input_date]</td>                                              
                                            </tr>
                                        </tbody>";
            $no++;
        };
        ?>


    </table>

</body>

</html>
<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen . ".pdf", 'I');
exit;

?>