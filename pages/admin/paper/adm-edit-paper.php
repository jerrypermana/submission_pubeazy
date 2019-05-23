<?php
if ($_SESSION['group_session'] == 'admin' || $_SESSION['group_session'] == 'reviewer') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3 class="box-title">Verifikasi Paper</h3>

    </section>
    </br>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php

                                $paper_id = $_GET['idpaper'];
                                $query = "SELECT paper.judul,paper.input_date,paper.v_paper,paper.abstrak,paper.file_paper,paper.paper_id,pre.realname,
                                pre.afiliasi,pre.member_id,conf.nama_konferensi,conf.konferensi_id,conf.penyelenggara ,status.status,tp.biaya_conf,paper.komentar
                                FROM paper 
                                LEFT JOIN transaksi_presenter as tp ON paper.paper_id=tp.paper_id
                                LEFT JOIN conference as conf ON paper.konferensi_id=conf.konferensi_id
                                LEFT JOIN presenter as pre ON paper.id_presenter=pre.id_presenter
                                LEFT JOIN status ON paper.v_paper=status.status_id
                                WHERE paper.paper_id='$paper_id'";
                                $hasil = mysqli_query($konek, $query);
                                $row = mysqli_fetch_array($hasil);
                                $hitung = mysqli_num_rows($hasil);

                                if ($row["v_paper"]  == '1') {
                                    $status = "<span class='label label-success'>$row[status]</span>";
                                } else if ($row["v_paper"] == '2') {
                                    $status = "<span class='label label-warning'>$row[status]</span>";
                                } else if ($row["v_paper"]  == '3') {

                                    $status = "<span class='label label-danger'>$row[status]</span>";
                                } else {

                                    $status = "<span class='label label-warning'>$row[status]</span>";
                                }
                                // $select_keyword = mysqli_query($konek, "SELECT mk.keyword_id, mk.keyword as keyword FROM paper LEFT JOIN paper_keyword as pk ON paper.paper_id=pk.paper_id
                                //           LEFT JOIN mst_keyword as mk ON pk.keyword_id=mk.keyword_id WHERE paper.paper_id='$paper_id'");

                                // $dataArray = [];
                                // while ($rowKey = mysqli_fetch_assoc($select_keyword)) {
                                //     array_push($dataArray, $rowKey);
                                // }

                                $select_keyword = mysqli_query($konek, "SELECT mk.keyword_id, mk.keyword as keyword FROM paper LEFT JOIN paper_keyword as pk ON paper.paper_id=pk.paper_id
                                          LEFT JOIN mst_keyword as mk ON pk.keyword_id=mk.keyword_id WHERE paper.paper_id='$paper_id'");

                                // $dataArray = [];
                                while ($rowKey = mysqli_fetch_assoc($select_keyword)) {
                                    $resultKey[] = $rowKey['keyword'];
                                }


                                $select_subject = mysqli_query($konek, "SELECT ms.subject_id, ms.subject as subject FROM paper 
                            LEFT JOIN paper_subject as ps ON paper.paper_id=ps.paper_id
                            LEFT JOIN mst_subject as ms ON ps.subject_id=ms.subject_id WHERE paper.paper_id='$paper_id'");

                                $dataArraySub = [];
                                while ($rowSub = mysqli_fetch_assoc($select_subject)) {
                                    array_push($dataArraySub, $rowSub);
                                }




                                if ($hitung == 0) {
                                    echo '<script>alert("Username Tidak Di Temukan")
									location.replace("' . $base_url . '/index.php?p=dashboard")</script>';
                                }


                                ?>
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <h4 style="text-align: center;"><?php echo $row["judul"] ?></h4>
                                        <h5 style="text-align: center;"><i>Author <?php echo $row["realname"] ?> </i> </h5>
                                        <h5 style="text-align: center;"><i><?php echo $row["afiliasi"] ?> </i> </h5>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="box-group" id="accordion">
                                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                            <div class="panel box box-primary">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                            Abstrak
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse in">
                                                    <div class="box-body">
                                                        <p style="text-align: justify;"><?php echo $row["abstrak"] ?><p>
                                                    </div>
                                                </div>
                                            </div>

                                            <form role="form" action="" method="POST" name='simpan' onSubmit='return validasi()' enctype="multipart/form-data">

                                                <div class="panel box box-danger">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                                Detail Information
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo" class="panel-collapse collapse in">
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Member</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["member_id"] ?></label>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Conference</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["nama_konferensi"] ?></label>
                                                            <input type="hidden" name="conf_id" id='conf_id' class="form-control" value='<?php echo $row["konferensi_id"]; ?>'>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">organizer</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["penyelenggara"] ?></label>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Keyword</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo implode(", ", $resultKey); ?></label>
                                                        </div>
                                                        <div class="box-body ">
                                                            <label class="col-sm-2 control-label">Created</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $row["input_date"] ?></label>
                                                        </div>

                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Status</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-9 control-label"><?php echo $status; ?></label>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">File</label>
                                                            <label class="col-sm-1 control-label">:</label>
                                                            <label class="col-sm-2 control-label">
                                                                <a href="../repository/<?php echo $row['file_paper']; ?>"><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fa fa-file-o"></i> Paper</button></a>
                                                            </label>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel box box-success">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                                Verifikasi
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree" class="panel-collapse collapse in">
                                                        <div class="box-body">
                                                            <div class="box-body">
                                                                <label class="col-sm-2 control-label">Subject</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control select1" name='subject[]'>
                                                                        <?php
                                                                        if (isset($dataArraySub[0])) {

                                                                            echo "<option value='" . $dataArraySub[0]['subject_id'] . "'>" . $dataArraySub[0]['subject'] . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="box-body">
                                                                <label class="col-sm-2 control-label"></label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control select1" name='subject[]'>
                                                                        <?php
                                                                        if (isset($dataArraySub[1])) {

                                                                            echo "<option value='" . $dataArraySub[1]['subject_id'] . "'>" . $dataArraySub[1]['subject'] . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="box-body">
                                                                <label class="col-sm-2 control-label"></label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control select1" name='subject[]'>
                                                                        <?php
                                                                        if (isset($dataArraySub[2])) {

                                                                            echo "<option value='" . $dataArraySub[2]['subject_id'] . "'>" . $dataArraySub[2]['subject'] . "</option>";
                                                                            // echo $dataArray[0]['keyword'];
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="box-body">
                                                                <label class="col-sm-2 control-label"></label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control select1" name='subject[]'>
                                                                        <?php
                                                                        if (isset($dataArraySub[3])) {

                                                                            echo "<option value='" . $dataArraySub[3]['subject_id'] . "'>" . $dataArraySub[3]['subject'] . "</option>";
                                                                            // echo $dataArray[0]['keyword'];
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="box-body">
                                                                <label class="col-sm-2 control-label"></label>
                                                                <div class="col-sm-6">
                                                                    <button type="button" class="btn btn-primary" data-target="#ModalAddSub" data-toggle="modal">Tambah Subject</button>
                                                                </div>
                                                            </div>

                                                            <div class="box-body">
                                                                <label class="col-sm-2 control-label">Verification</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control" name='v_paper'>
                                                                        <?php 
                                                                        if($row['v_paper'] != NULL){

                                                                            echo "<option value='$row[v_paper]'>$row[status]</option>";
                                                                        }else{

                                                                            echo "<option value=''>---- Status ----</option>";
                                                                        }
                                                                        
                                                                        
                                                                        
                                                                        ?>
                                                                        <option value=''>---- Status ----</option>
                                                                        
                                                                        <?php
                                                                        $select_status = mysqli_query($konek, "SELECT * FROM status");

                                                                        while ($row_stat = mysqli_fetch_array($select_status)) {

                                                                            echo "<option value='$row_stat[status_id]'>$row_stat[status]</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="box-body">
                                                                <label class="col-sm-2 control-label">Payment</label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="biaya" id='biaya' class="form-control" placeholder="Rp." value='<?php echo $row['biaya_conf']; ?>'>
                                                                    <input type="hidden" name="paper_id" id='paper_id' class="form-control" value='<?php echo $paper_id; ?>'>
                                                                </div>
                                                            </div>

                                                            <div class="box-body">
                                                                <label class="col-sm-2 control-label">Comment</label>
                                                                <div class="col-sm-8">
                                                                    <textarea class="form-control" name="komentar" id='komentar' rows="5" style="width: 90%"><?php echo $row['komentar']; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="box-footer">
                                                                <button type="cancel" class="btn btn-default">Cancel</button>
                                                                <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <?php
                            if (isset($_POST['submit'])) {

                                $paper_id   = $_POST['paper_id'];
                                $conf_id    = $_POST['conf_id'];
                                $komentar   = ucwords($_POST['komentar']);
                                $v_paper    = $_POST['v_paper'];
                                $tgl        = date('Y-m-d');
                                $biaya      = $_POST['biaya'];




                                $query_pape_update  = "UPDATE paper set 
                                        komentar='$komentar',
                                        v_paper='$v_paper',
                                        last_update='$tgl'
                                        where paper_id='$paper_id'";





                                // Insert Update paper
                                $insert_paper = mysqli_query($konek, $query_pape_update);


                                // Insert Transaksi Presenter
                                $query_transaksi  = "INSERT INTO transaksi_presenter (paper_id, biaya_conf, input_date, last_update)
                                    VALUES('$paper_id', '$biaya', '$tgl', '$tgl')";
                                $insert_transaksi  = mysqli_query($konek, $query_transaksi);

                                $delete_sub = mysqli_query($konek, "DELETE FROM paper_subject WHERE paper_id='$paper_id'");

                                $subject            = $_POST['subject'];
                                $jumlah_diisi_sub   = count($subject);
                                for ($x = 0; $x < $jumlah_diisi_sub; $x++) {

                                    $query_subject  = "INSERT INTO paper_subject values('$paper_id','$subject[$x]')";
                                    $update_subject = mysqli_query($konek, $query_subject);
                                }


                                if ($v_paper == 1) {


                                    //START SEND EMAIL VERIFIKASI
                                    $select_user = "SELECT p.paper_id, p.judul, p.id_presenter,pr.realname, pr.email, tp.biaya_conf,p.v_paper,tp.transfer_id,
                                        status.status ,conf.nama_konferensi,conf.penyelenggara 
                                        FROM paper as p 
                                        LEFT JOIN presenter as pr ON p.id_presenter=pr.id_presenter
                                        LEFT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
                                        LEFT JOIN status ON p.v_paper=status.status_id                                        
                                        LEFT JOIN conference as conf ON p.konferensi_id=conf.konferensi_id
                                        WHERE p.paper_id='$paper_id'";
                                    $hasil_user = mysqli_query($konek, $select_user);
                                    $row_user = mysqli_fetch_array($hasil_user);

                                    $email      = $row_user['email'];
                                    $realname   = $row_user['realname'];


                                    $mst_email     = mysqli_query($konek, "SELECT * FROM mst_email WHERE email_id =1 ");
                                    $data_email    = mysqli_fetch_assoc($mst_email);

                                    $mst_payment     = mysqli_query($konek, "SELECT * FROM account_bank");
                                   

                                        $send_mail ="<table width='100%' border='0' cellspacing='0' cellpadding='0' style='min-width:100%'>
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
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' style='border-collapse:collapse;'>
                                                    <tr>
                                                        <td height='25'> </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='center' style='color:#09c064;font-family:Verdana, Arial, sans-serif;font-size:22px;line-height:26px;overflow-y:hidden'>Your Appointment has been Confirmed!</td>
                                                    </tr>
                                                    <tr>
                                                        <td height='35'> </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='center'><img src='https://www.mytime.com/assets/email_assets/pending_and_confirmation/a-c.png' width='364' alt='' style='display:block;width:100%;max-width:364px;max-height:58px'></td>
                                                    </tr>
                                                    <tr>
                                                        <td height='20'> </td>
                                                    </tr>
                                        
                                        
                                        
                                                    <tr>
                                                        <td height='10'> </td>
                                                    </tr>
                                                </table>
                                        
                                            </td>
                                        </tr>
                                        </table>
                                        <table align='center' style='border-color: #666;' cellpadding='10' width='50%'>
                                        <tr>
                                        
                                            <td style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:14px;line-height:20px' colspan='3'>
                                                <p>Hi <span></span><span>$row_user[realname]</span><span></span>,</p>
                                                <p>Appointment confirmed Conference <span></span><span>$row_user[nama_konferensi]</span><span></span> on <span></span><span>" . date("l") . "," . date("F j") . ", " . date("Y") . " at " . date("h:i:sa") . "</span><span></span>. Please find the details below:</p>
                                            </td>
                                        
                                        </tr>
                                        
                                        <tr>
                                            <td width='35%'><strong>Judul</strong></td>
                                            <td width='1%'><strong>:</strong></td>
                                            <td width='65%'>$row_user[judul]</td>
                                        </tr>
                                        <tr>
                                            <td width='35%'><strong>Pengarang</strong></td>
                                            <td width='1%'><strong>:</strong></td>
                                            <td width='65%'>$row_user[realname]</td>
                                        </tr>
                                        <tr>
                                            <td width='35%'><strong>Status</strong></td>
                                            <td width='1%'><strong>:</strong></td>
                                            <td width='65%'>$row_user[status]</td>
                                        </tr>
                                        <tr>
                                            <td width='35%'><strong>Biaya Conference</strong></td>
                                            <td width='1%'><strong>:</strong></td>
                                            <td width='65%'>$row_user[biaya_conf]</td>
                                        </tr>
                                        <tr>
                                            <td width='35%'><strong>No Transaksi</strong></td>
                                            <td width='1%'><strong>:</strong></td>
                                            <td width='65%'>$row_user[transfer_id]</td>
                                        </tr>
                                        <tr>
                                            <td style='border-bottom: 2px solid black' height='5' colspan='3'> </td>
                                        </tr>
                                        <tr>
                                        
                                            <td colspan='3' align='center'><strong>
                                                    <p style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:14px;line-height:24px'>Metode Pembayaran </p></strong></td>
                                        
                                        </tr>
                                        <tr>
                                            <td style='border-bottom: 2px solid black' height='5' colspan='3'> </td>
                                        </tr>";
                                        
                                        while ($data_payment = mysqli_fetch_array($mst_payment)) {
                                        $send_mail .="   
                                                <tr style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:14px;line-height:24px'>
                                                    <td align='center' colspan='3'>$data_payment[nama_bank]<br>No Rek : $data_payment[rekening]<br> a/n $data_payment[atas_nama]</td>           
                                                </tr>";
                                                
                                        
                                        };
                                        $send_mail .="<tr>
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
                                    $mail->SetFrom("$data_email[SMTP_User]", "PubEazy Conference"); //set email pengirim
                                    $mail->Subject = "Pemberitahuan Verifikasi Paper"; //subyek email
                                    $mail->AddAddress($email, $realname);  //tujuan email
                                    $mail->MsgHTML($send_mail);
                                    $mail->Send();
                                } else {

                                    //START SEND EMAIL VERIFIKASI
                                    $select_user = "SELECT p.paper_id, p.judul, p.id_presenter, pr.realname, pr.email, tp.biaya_conf,p.v_paper,tp.transfer_id,p.komentar,
                                    status.status,conf.nama_konferensi,conf.penyelenggara 
                                FROM paper as p 
                                LEFT JOIN presenter as pr ON p.id_presenter=pr.id_presenter
                                LEFT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id
                                LEFT JOIN status ON p.v_paper=status.status_id                                                                       
                                LEFT JOIN conference as conf ON p.konferensi_id=conf.konferensi_id
                                WHERE p.paper_id='$paper_id'";
                                    $hasil_user = mysqli_query($konek, $select_user);
                                    $row_user = mysqli_fetch_array($hasil_user);

                                    $email      = $row_user['email'];
                                    $realname   = $row_user['realname'];

                                    $mst_email     = mysqli_query($konek, "SELECT * FROM mst_email WHERE email_id =1 ");
                                    $data_email    = mysqli_fetch_assoc($mst_email);

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
                                    $mail->SetFrom("$data_email[SMTP_User]", "PubEazy Conference"); //set email pengirim
                                    $mail->Subject = "Pemberitahuan Verifikasi Paper"; //subyek email
                                    $mail->AddAddress($email, $realname);  //tujuan email
                                    $mail->MsgHTML("<table width='100%' border='0' cellspacing='0' cellpadding='0' style='min-width:100%'>
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
                                        <table width='100%' border='0' cellspacing='0' cellpadding='0' style='border-collapse:collapse;'>
                                            <tr>
                                                <td height='25'> </td>
                                            </tr>
                                            <tr>
                                                <td align='center' style='color:#09c064;font-family:Verdana, Arial, sans-serif;font-size:22px;line-height:26px;overflow-y:hidden'>Your Appointment has been Confirmed!</td>
                                            </tr>
                                            <tr>
                                                <td height='35'> </td>
                                            </tr>
                                            <tr>
                                                <td align='center'><img src='https://www.mytime.com/assets/email_assets/pending_and_confirmation/a-c.png' width='364' alt='' style='display:block;width:100%;max-width:364px;max-height:58px'></td>
                                            </tr>
                                            <tr>
                                                <td height='20'> </td>
                                            </tr>
                            
                            
                            
                                            <tr>
                                                <td height='10'> </td>
                                            </tr>
                                        </table>
                            
                                    </td>
                                </tr>
                            </table>
                            <table align='center' style='border-color: #666;' cellpadding='10' width='50%'>
                                <tr>
                            
                                    <td style='color:#4f4f4f;font-family:Verdana, Arial, sans-serif;font-size:14px;line-height:20px' colspan='3'>
                                        <p>Hi <span></span><span>$row_user[realname]</span><span></span>,</p>
                                        <p>Appointment confirmed Conference <span></span><span>$row_user[nama_konferensi]</span><span></span> on <span></span><span>" . date("l") . "," . date("F j") . ", " . date("Y") . " at " . date("h:i:sa") . "</span><span></span>. Please find the details below:</p>
                                        </td>
                            
                                </tr>
                            
                                <tr>
                                    <td width='35%'><strong>Judul</strong></td>
                                    <td width='1%'><strong>:</strong></td>
                                    <td width='65%'>$row_user[judul]</td>
                                </tr>
                                <tr>
                                    <td width='35%'><strong>Pengarang</strong></td>
                                    <td width='1%'><strong>:</strong></td>
                                    <td width='65%'>$row_user[realname]</td>
                                </tr>
                                <tr>
                                    <td width='35%'><strong>Status</strong></td>
                                    <td width='1%'><strong>:</strong></td>
                                    <td width='65%'>$row_user[status]</td>
                                </tr>
                                
                                <tr>
                                    <td width='35%'><strong>Komentar</strong></td>
                                    <td width='1%'><strong>:</strong></td>
                                    <td width='65%'>$row_user[komentar]</td>
                                </tr>
                                
                            </table> ");
                                    $mail->Send();
                                }




                                //TUTUP SEND EMAIL

                                // echo $query_pape_update.'<br>';
                                // echo $query_loa;


                                if ($insert_paper and $update_subject and $insert_transaksi) {
                                    echo '<script>alert("Paper Berhasil di Edit")</script>';
                                } else {
                                    echo '<script>alert("Paper Gagal di Edit")</script>';
                                }
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box -->


            <!-- /.box -->

            <!-- Input addon -->


        </div>
        </div>
        <!-- Modal -->
        <!-- Modal Popup untuk Add Keyword-->
        <div id="ModalAdd" name='myform' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Tambahkan Keyword</h4>
                    </div>

                    <div class="modal-body">
                        <form id="add_keyword" method="POST">

                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Keyword</label>
                                <input type="text" name="keyword" class="form-control" placeholder="Masukkan Nama Keyword ..." required />
                                <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>" />
                            </div>



                            <div class="modal-footer">
                                <button class="btn btn-success" id="btn" type="submit">
                                    Confirm
                                </button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="$('#add_keyword')[0].reset();">
                                    Cancel
                                </button>
                            </div>

                        </form>



                    </div>


                </div>
            </div>
        </div>
        <!-- TUTUP Modal -->
        <!-- Modal Popup untuk Add SUbject-->
        <div id="ModalAddSub" name='myform' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Tambahkan Subject</h4>
                    </div>

                    <div class="modal-body">
                        <form id="add_subject" method="POST">

                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="Modal Name">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Masukkan Nama Subject..." required />

                            </div>



                            <div class="modal-footer">
                                <button class="btn btn-success" id="btn" type="submit">
                                    Confirm
                                </button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="$('#add_keyword')[0].reset();">
                                    Cancel
                                </button>
                            </div>

                        </form>



                    </div>


                </div>
            </div>
        </div>
        <!-- TUTUP MODAL SUBJECT -->
        </div>
        </div>

        <script>
            $(document).ready(function() {


                $('.select2').select2({
                    minimumInputLength: 2,
                    allowClear: true,
                    placeholder: 'Search Keywords ...',
                    ajax: {
                        url: 'data_api/ajax_keyword.php',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,

                            }
                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        }

                    }

                });


                $('.select1').select2({
                    minimumInputLength: 2,
                    allowClear: true,
                    placeholder: 'Search Keywords ...',
                    ajax: {
                        url: 'data_api/ajax_subject.php',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,

                            }
                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        }

                    }

                });

                $('#add_keyword').submit(function(e) {
                    data = $('#add_keyword').serialize();
                    $.ajax({
                        type: "POST",
                        url: "data_api/save-keyword.php",
                        data: data,
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                alert(result.msg);
                                $('#ModalAdd').modal('hide');
                                $('#add_author')[0].reset();
                            }
                        }
                    });
                    e.preventDefault();
                });

                $('#add_subject').submit(function(e) {
                    data = $('#add_subject').serialize();
                    $.ajax({
                        type: "POST",
                        url: "data_api/save-subject.php",
                        data: data,
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                alert(result.msg);
                                $('#ModalAddSub').modal('hide');
                                $('#add_author')[0].reset();
                            }
                        }
                    });
                    e.preventDefault();
                });

                $('.conf').select2()


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