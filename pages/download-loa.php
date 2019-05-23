<?php
// Define relative path from this script to mPDF
$nama_dokumen = 'Letter_of_Accepted'; //Beri nama file PDF hasil.
define('_MPDF_PATH', '../mpdf60/');
include(_MPDF_PATH . "mpdf.php");
$mpdf = new mPDF('utf-8', 'A4'); // Create new mPDF Document

//Beginning Buffer to save PHP variables and HTML tags
ob_start();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Letter Of Invitation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>

    <head>
        <style>
            p.header {
                font-family: "Quicksand", sans-serif;
                font-size: 24px;
                /* font-weight:bold; */
                text-align: center;
            }

            p.headerjudul {
                font-family: "Quicksand", sans-serif;
                text-align: center;
                font-size: 16px;
                font-weight: bold;
            }

            p.isi {
                font-family: "Quicksand", sans-serif;
                text-align: justify;
                font-size: 14px;

            }
        </style>
    </head>


<body>
    <!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak masalah.-->
    <!--CONTOH Code START-->
    <?php
    include '../config/koneksi.php';
    $paper_id = $_GET['id'];
    $query = "SELECT p.paper_id,p.judul, p.abstrak, p.v_paper,p.id_presenter,pre.realname,pre.member_id, p.file_paper,tp.biaya_conf,tp.transfer_id,tp.v_transfer, 
    conf.nama_konferensi,conf.start_date,conf.end_date,conf.penyelenggara, mr.nama_ruang,jj.jam FROM paper as p 
    LEFT JOIN presenter as pre ON p.id_presenter=pre.id_presenter
    LEFT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
    LEFT JOIN conference as conf ON p.konferensi_id=conf.konferensi_id
    LEFT JOIN mst_ruang as mr ON conf.ruang_id=mr.ruang_id
    LEFT JOIN paper_jadwal as pj ON p.paper_id=pj.paper_id
    LEFT JOIN jadwal_jam as jj ON pj.jam_id=jj.jam_id
    WHERE p.paper_id='$paper_id'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    $tanggal_conf = date('d-m-Y', strtotime($row['start_date']));
    $end_conf = date('d-m-Y', strtotime($row['end_date']));


    if ($hitung == 0) {
        echo '<script>alert("ID Paper Tidak Di Temukan")
  location.replace("' . $base_url . '/index.php?p=dashboard-presenter")</script>';
    }
    ?>
    <table class="heading" style="width:100%;">
        <tr>
            <td>
                <center><img src="../img/logo_loi.png" width="70px" height="70px"></center>
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <p class='header'>Letter Of Invitation</p>
                </center>
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <p class='headerjudul'><?php echo $row['nama_konferensi'];  ?></p>
                </center>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table class="heading" style="width:100%;">
        <tr>
            <td>
                <p class='isi'>Dear <?php echo $row['realname'];  ?></p>
            </td>
        </tr>
        <?php
        //  $query_draf = "SELECT * from download where download_id='3'";
        //  $hasil_draf = mysqli_query($konek, $query_draf);
        //  $row_draf = mysqli_fetch_array($hasil_draf);

        ?>
        <br>
        <tr>

            <td style="text-align: justify;">
                <!-- <p class='isi'><?php echo $row_draf['draf'];  ?></p> -->
                <p class='isi'>The review processes for 1st International Conference on Economics, Business, Accounting and
                    Management (ICEBAM) 2018 organized by Faculty of Economy and Business has been completed. The
                    conference reviewed by international experts.</p>
                <br>
                <p class='isi'> Based on the recommendations of the reviewers and the Technical Program Committees, we are pleased
                    to inform you that your paper entitled Accounting students, perception and interest in auditor profession:
                    The role of learning experience and setting (file link: has been ACCEPTED for publication and oral
                    presentation. You are cordially invited to present the paper orally at ICEBAM 2018 to be held on 18,
                    December 2018, Sidoarjo, Indonesia.</p>
                <br>
                <p class='isi'> The ICEBAM 2018 is sponsored by Universitas Muhammadiyah Sidoarjo. Selected papers will be
                    published in Proceeding Indexed in Scopus/WoS. Other articles have option to get refund (Rp.
                    1.500.000,-), OR published in Proceeding Indexed by google scholar and Crossref, OR published in
                    Journal indexed in Sinta/Google Scholar. The announcement regarding papers qualified in Scopus
                    indexed proceeding, will delivered 1 (one) week after conference.</p>
                </p>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table style="width:100%;">
        <tr>
            <td style="width: 25%;">
                <p>Judul </p>
            </td>
            <td style="width: 1%;">
                <p style="width: 1px;">: </p>
            </td>
            <td style="width: 74%;">
                <p><?php echo $row['judul'];  ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 25%;">
                <p>No Anggota</p>
            </td>
            <td style="width: 1%;">
                <p style="width: 1px;">: </p>
            </td>
            <td style="width: 74%;">
                <p><?php echo $row['member_id'];  ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 25%;">
                <p>Pengarang</p>
            </td>
            <td style="width: 1%;">
                <p style="width: 1px;">: </p>
            </td>
            <td style="width: 74%;">
                <p><?php echo $row['realname'];  ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 25%;">
                <p>Ruang</p>
            </td>
            <td style="width: 1%;">
                <p style="width: 1px;">: </p>
            </td>
            <td style="width: 74%;">
                <p><?php echo $row['nama_ruang']; ?></p>
            </td>
        </tr>

        <tr>
            <td style="width: 25%;">
                <p>Tanggal</p>
            </td>
            <td style="width: 1%;">
                <p style="width: 1px;">: </p>
            </td>
            <td style="width: 74%;">
                <p><?php echo $tanggal_conf . ' s/d ' . $end_conf;  ?></p>
            </td>
        </tr>

        <tr>
            <td style="width: 25%;" colspan="3">
                <br>

            </td>

        </tr>

        <tr>

            <td style="text-align: justify;" colspan="3">
                <p class='isi'>Note :</p>
                <p class='isi'>Registration can only be confirmed when payment proof has been uploaded in <a href="https://goo.glforms/fDNToMtTZYDWy6p72">https://goo.glforms/fDNToMtTZYDWy6p72 </a>
                </p>
                <br>
                <p class='isi'>All participants should prepare visa, air tickets, room reservation and other matters by themselves before
                    the conference.</p>
                <br>
                <p class='isi'>Send your final papers (MS Word) to us at icebam@umsida.ac.id and payment (Before December 14,
                    2018)</p>
                <br>
                <p class='isi'> For the most updated information on the conference, please check the conference website at
                    icebam.umsida.ac.id</p>
                <br>
                <p class='isi'><b>Important dates:</b><br><br>
                    <ul>
                        <li> November 30th : Full Paper Submission deadline</li>
                        <li> December 7th : Last notification of full paper acceptance</li>
                        <li> December 14th : Registration Deadline</li>
                        <li> December 18th : The Conference</li>
                    </ul>
                </p>
                <br>
                </p>
                <p class='isi'> <b>Chat Group: </b><br><br>
                <a href="https://chat.whatsapp.com/KgkPt2YeWfnGyrdis1Xmmj"> https://chat.whatsapp.com/KgkPt2YeWfnGyrdis1Xmmj</a>
                </p>
                <br>
    </table>
    <br>

    <table align="right">
        <tr>
            <td>
                Warm regards,
            </td>
        </tr>
        <br>
        <br>
        <br>
        <br>
        <tr>
            <td>Conference Committee </td>
        </tr>
    </table>
</body>

</html> <?php
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
        ?>