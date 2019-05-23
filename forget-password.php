</br>
</br>
<main id="main">

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
        <div class="container">
            <div class="section-header">
                <h2>Forgotten account</h2>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <section id="contact" class="section-bg wow fadeInUp">

                        <div class="container">

                            <div class="form">



                                <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">


                                    <div class="col-md-12">




                                        <div class="form-row">
                                            <div class="col-md-2">
                                                <label></label>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <h3> Find Your Account</h3>

                                            </div>

                                            <div class="col-md-2">
                                                <label></label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-2">

                                            </div>
                                            <div class="form-group col-md-8">
                                                <label>Please enter your email address to search for your account.</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required />

                                            </div>

                                            <div class="col-md-2">
                                                <label></label>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="col-md-2">
                                                <label></label>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <h3>Capctha</h3>

                                            </div>

                                            <div class="col-md-2">
                                                <label></label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-3">
                                                <label></label>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <img id="captchaimg" src="captcha_code_file.php?rand=<?php echo rand(); ?>" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Captcha" />
                                            </div>

                                            <div class="col-md-3">
                                                <label></label>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name='submit'> Simpan</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <?php


                            //INSERT TO DATABASE REGISTER
                            if (isset($_POST['submit'])) {
                                if (empty($_SESSION['captcha']) || strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0) {
                                    //Note: the captcha code is compared case insensitively.
                                    //if you want case sensitive match, update the check above to
                                    // strcmp()
                                    echo '<script>alert("Capctha yang anda masukkan salah")
                                    location.replace("url.php?p=forget-password")</script>';
                                    // echo $_POST['captcha'];
                                } elseif (empty($errors)) {

                                    $email      = $_POST['email'];



                                    $query_presenter = mysqli_query($konek, "SELECT * FROM presenter WHERE email='$email'");
                                    $tu = mysqli_fetch_array($query_presenter);
                                    $t = mysqli_num_rows($query_presenter);

                                    $query_peserta = mysqli_query($konek, "SELECT * FROM peserta WHERE email='$email'");
                                    $peserta = mysqli_fetch_array($query_peserta);
                                    $row_peserta = mysqli_num_rows($query_peserta);

                                    $query_reviewer = mysqli_query($konek, "SELECT * FROM reviewer WHERE email='$email'");
                                    $reviewer = mysqli_fetch_array($query_reviewer);
                                    $row_reviewer = mysqli_num_rows($query_reviewer);

                                    if ($t == 1) {

                                        $chars = "0123456789";
                                        $pass = substr(str_shuffle($chars), 0, 6);
                                        $password = md5($pass);

                                        $q_update   = "UPDATE presenter SET password='$password' WHERE id_presenter='$tu[id_presenter]'";
                                        $update_pre   = mysqli_query($konek, $q_update);
                                        // echo $q_update;
                                        // echo $pass;

                                        $mst_email     = mysqli_query($konek, "SELECT * FROM mst_email WHERE email_id =1 ");
                                        $data_email    = mysqli_fetch_assoc($mst_email);

                                        include "phpmailer/classes/class.phpmailer.php";
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
                                        $mail->Subject = "Perubahan Password PubEazy Conference"; //subyek email
                                        $mail->AddAddress($email, $realname);  //tujuan email
                                        $mail->MsgHTML("<center>
                                        <b><h1>Terimakasih telah melakukan Perubahan Password Melalui Email</h1><b>
                                        <br/> 
                                        <br/> 
                                        <table rules='all' style='border-color: #666;' cellpadding='10'>
                                        <tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $tu['realname'] . "</td></tr>
                                        <tr><td><strong>Member ID:</strong> </td><td>" . $tu['member_id'] . "</td></tr>
                                        <tr><td><strong>Email:</strong> </td><td>" . $tu['email'] . "</td></tr>
                                        
                                        <tr>
                                        <td>Password Sementara : </td>
                                        <td>" . $pass . "</td>
                                        </tr>	
                                        <tr><td colspan='2'><b><h1>PubEazy Conference<h1><b></td></tr>
                                        </table>
                                        </center>");
                                        $mail->Send();

                                        if ($update_pre) {
                                            echo '<script>alert("Your Password has been updated Check your Email")
                                        location.replace("url.php?p=login")</script>';
                                        } else {
                                            echo '<script>alert("Your Password has been Failed Update")
                                            location.replace("url.php?p=forget-password")</script>';
                                        }
                                    } elseif ($row_peserta == 1) {
                                        $chars = "0123456789";
                                        $pass = substr(str_shuffle($chars), 0, 6);
                                        $password = md5($pass);

                                        $q_update_peserta   = "UPDATE peserta SET password='$password' WHERE id_peserta='$peserta[id_peserta]'";
                                        $update_peserta   = mysqli_query($konek, $q_update_peserta);
                                        // echo $q_update;
                                        // echo $pass;

                                        $mst_email     = mysqli_query($konek, "SELECT * FROM mst_email WHERE email_id =1 ");
                                        $data_email    = mysqli_fetch_assoc($mst_email);

                                        include "phpmailer/classes/class.phpmailer.php";
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
                                        $mail->Subject = "Perubahan Password PubEazy Conference"; //subyek email
                                        $mail->AddAddress($email, $realname);  //tujuan email
                                        $mail->MsgHTML("<center>
                                        <b><h1>Terimakasih telah melakukan Perubahan Password Melalui Email</h1><b>
                                        <br/> 
                                        <br/> 
                                        <table rules='all' style='border-color: #666;' cellpadding='10'>
                                        <tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $peserta['realname'] . "</td></tr>
                                        <tr><td><strong>Member ID:</strong> </td><td>" . $peserta['member_id'] . "</td></tr>
                                        <tr><td><strong>Email:</strong> </td><td>" . $peserta['email'] . "</td></tr>
                                        
                                        <tr>
                                        <td>Password Sementara : </td>
                                        <td>" . $pass . "</td>
                                        </tr>	
                                        <tr><td colspan='2'><b><h1>PubEazy Conference<h1><b></td></tr>
                                        </table>
                                        </center>");
                                        $mail->Send();

                                        if ($update_peserta) {
                                            echo '<script>alert("Your Password has been updated Check your Email")
                                        location.replace("url.php?p=login")</script>';
                                        } else {
                                            echo '<script>alert("Your Password has been Failed Update")
                                            location.replace("url.php?p=forget-password")</script>';
                                        }
                                    } elseif ($row_reviewer == 1) {
                                        $chars = "0123456789";
                                        $pass = substr(str_shuffle($chars), 0, 6);
                                        $password = md5($pass);

                                        $q_update_peserta   = "UPDATE reviewer SET password='$password' WHERE reviewer_id='$reviewer[reviewer_id]'";
                                        $update_peserta   = mysqli_query($konek, $q_update_peserta);
                                        // echo $q_update;
                                        // echo $pass;

                                        $mst_email     = mysqli_query($konek, "SELECT * FROM mst_email WHERE email_id =1 ");
                                        $data_email    = mysqli_fetch_assoc($mst_email);

                                        include "phpmailer/classes/class.phpmailer.php";
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
                                        $mail->Subject = "Perubahan Password PubEazy Conference"; //subyek email
                                        $mail->AddAddress($email, $realname);  //tujuan email
                                        $mail->MsgHTML("<center>
                                        <b><h1>Terimakasih telah melakukan Perubahan Password Melalui Email</h1><b>
                                        <br/> 
                                        <br/> 
                                        <table rules='all' style='border-color: #666;' cellpadding='10'>
                                        <tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $reviewer['realname'] . "</td></tr>
                                        <tr><td><strong>Email:</strong> </td><td>" . $reviewer['email'] . "</td></tr>
                                        
                                        <tr>
                                        <td>Password Sementara : </td>
                                        <td>" . $pass . "</td>
                                        </tr>	
                                        <tr><td colspan='2'><b><h1>PubEazy Conference<h1><b></td></tr>
                                        </table>
                                        </center>");
                                        $mail->Send();

                                        if ($update_peserta) {
                                            echo '<script>alert("Your Password has been updated Check your Email")
                                        location.replace("url.php?p=login-reviewer")</script>';
                                        } else {
                                            echo '<script>alert("Your Password has been Failed Update")
                                            location.replace("url.php?p=forget-password")</script>';
                                        }
                                    } else {
                                        //echo '<script>alert("tidak ditemukanr")</script>';

                                        echo '<script>alert("Your search did not return any results. Please try again with other information.")
				                        location.replace("url.php?p=forget-password")</script>';
                                    }
                                }
                            }

                            ?>

                        </div>
                    </section><!-- #contact -->
                </div>

            </div>
        </div>

    </section>

</main>