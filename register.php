<br>
<br>
<main id="main">

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
        <div class="container">
            <div class="section-header">
                <h2>REGISTRATION </h2>
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
                                                <h3> Basic Information</h3>

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
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Full Name (without academic title)" />


                                            </div>
                                            <!--  -->
                                            <div class="col-md-2">
                                                <label></label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-2">
                                                <label></label>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <select class="form-control" name='participant' id="participant">
                                                    <option value=''>--- PARTICIPATION ---</option>
                                                    <option value='1'>Presenter</option>
                                                    <option value='2'>Non-Presenter</option>

                                                </select>
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
                                                <input type="text" name="address" class="form-control" id="address" placeholder="Full Address" />


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
                                                <input type="text" name="institution" class="form-control" id="institution" placeholder="Institution" />


                                            </div>

                                            <div class="col-md-2">
                                                <label></label>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-2">
                                                <label></label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="text" name="hp" class="form-control" id="hp" placeholder="Phone Number" />

                                            </div>
                                            <div class="form-group col-md-4">
                                                <select class="form-control" name='gender'>
                                                    <option value=''>--- Gender ---</option>
                                                    <option value='1'>Male</option>
                                                    <option value='2'>Female</option>

                                                </select>
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
                                                <h3> Login Information</h3>

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
                                            <div class="form-group col-md-4">
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" />


                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="password" name="repassword" class="form-control" id="repassword" placeholder="Confirmation Password" />


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
                                <script type='text/javascript'>
                                    function validasi() {
                                        // var emailExp = "/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i";

                                        // if (!emailExp(simpan.email.value)) == false) {
                                        //     alert("Email is not valid");
                                        //     simpan.email.focus();
                                        //     return false;
                                        // }


                                        if (simpan.name.value == "") {
                                            alert("The Full Name field is required");
                                            simpan.name.focus();
                                            return false;
                                        }
                                        if (isNaN(parseInt(simpan.name.value)) == false) {
                                            alert("The Full Name field is required");
                                            simpan.name.focus();
                                            return false;
                                        }
                                        if (simpan.participant.value == "") {
                                            alert("The Participant field is required");
                                            simpan.participant.focus();
                                            return false;
                                        }
                                        if (simpan.address.value == "") {
                                            alert("The Address field is required");
                                            simpan.address.focus();
                                            return false;
                                        }
                                        if (simpan.institution.value == "") {
                                            alert("The Institution field is required");
                                            simpan.institution.focus();
                                            return false;
                                        }

                                        if (simpan.hp.value == "") {
                                            alert("The Phone Number field is required");
                                            simpan.hp.focus();
                                            return false;
                                        }

                                        if (simpan.gender.value == "") {
                                            alert("The Gender field is required");
                                            simpan.gender.focus();
                                            return false;
                                        }


                                        if (simpan.password.value == "") {
                                            alert("The Password field is required");
                                            simpan.password.focus();
                                            return false;
                                        }

                                        var baru = simpan.password.value;
                                        var lagi = simpan.repassword.value;

                                        if (baru != lagi) {
                                            alert('Password baru tidak cocok,\nCek ulang password baru Anda!');
                                            return false;
                                        }


                                        return true;
                                    }
                                </script>
                            </div>
                            <?php


                            //INSERT TO DATABASE REGISTER
                            if (isset($_POST['submit'])) {
                                if (empty($_SESSION['captcha']) || strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0) {
                                    //Note: the captcha code is compared case insensitively.
                                    //if you want case sensitive match, update the check above to
                                    // strcmp()
                                    echo '<script>alert("Capctha yang anda masukkan salah")
                                    location.replace("url.php?p=register")</script>';
                                    // echo $_POST['captcha'];
                                } elseif (empty($errors)) {
                                    $nama             = ucwords($_POST['name']);
                                    $participant      = $_POST['participant'];
                                    $address          = $_POST['address'] == '' ? '-' : ucwords($_POST['address']);
                                    $afiliasi         = $_POST['institution'] == '' ? '-' : ucwords($_POST['institution']);
                                    $hp               = $_POST['hp'] == '' ? '-' : $_POST['hp'];
                                    $gender           = $_POST['gender'] == '' ? '-' : $_POST['gender'];

                                    $email            = $_POST['email'];
                                    $password         = md5($_POST['password']);

                                    $tglinput         = date("Y/m/d");
                                    $tglubah          = date("Y/m/d");

                                    $group_pre        = 'presenter';
                                    $group_pes        = 'peserta';

                                    if ($participant == 1) {

                                        $select_presenter = mysqli_query($konek, "SELECT * FROM presenter order by id_presenter desc");
                                        $presenter_select = mysqli_fetch_array($select_presenter);
                                        $numpresenter = mysqli_fetch_row(($select_presenter));

                                        $item    = $presenter_select['member_id'];

                                        if ($numpresenter > 0) {
                                            $one = 1;
                                            $split = substr($item, 6, 9);
                                            $part = $one . $split;
                                            $sum = $part;
                                            $join = $part + 1;
                                        } else {
                                            $join = 10001;
                                        }
                                        $change = strval($join);
                                        $groub = substr($change, 1, 5);
                                        $member_id = 'RJI-1-' . $groub;
                                        $join++;

                                        $query  = "INSERT INTO presenter (member_id, realname, email, gender,address,afiliasi, no_hp,password, group_Session , input_date, last_update)
                                        VALUES('$member_id', '$nama', '$email','$gender','$address','$afiliasi ','$hp', '$password','$group_pre','$tglinput', '$tglubah')";

                                        $insert_register = mysqli_query($konek, $query);
                                        // echo $query;
                                        if ($insert_register) {
                                            echo '<script>alert("Registrasi Berhasil")
                                                        	location.replace("' . $base_url . '/url.php?p=login")</script>';
                                        } else {

                                            echo '<script>alert("Registrasi Gagal")
                                                            location.replace("' . $base_url . '/url.php?p=register")</script>';
                                        }
                                    } else {

                                        $select_peserta = mysqli_query($konek, "SELECT * FROM peserta order by id_peserta desc");
                                        $peserta_select = mysqli_fetch_array($select_peserta);
                                        $numpeserta = mysqli_fetch_row(($select_peserta));

                                        $item    = $peserta_select['member_id'];

                                        if ($numpeserta > 0) {
                                            $one = 1;
                                            $split = substr($item, 6, 9);
                                            $part = $one . $split;
                                            $sum = $part;
                                            $join = $part + 1;
                                        } else {
                                            $join = 10001;
                                        }
                                        $change = strval($join);
                                        $groub = substr($change, 1, 5);
                                        $member_id = 'RJI-2-' . $groub;
                                        $join++;


                                        $query  = "INSERT INTO peserta (member_id, realname, email, gender,address,instansi, no_hp,password, group_Session , input_date, last_update)
                                    VALUES('$member_id', '$nama', '$email','$gender','$address','$institution ','$hp', '$password','$group_pes','$tglinput', '$tglubah')";

                                        // echo $query;
                                        $insert_registrasi    = mysqli_query($konek, $query);

                                        if ($insert_registrasi) {

                                            // $email      = $_POST['email'];;
                                            // $realname   = $data_peserta['realname'];
                                            $query = mysqli_query($konek, "SELECT * FROM conference WHERE show_dashboard='1' ");
                                            $row = mysqli_fetch_array($query);

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
                                            $mail->Subject = "Confirmation of Seminar Registration"; //subyek email
                                            $mail->AddAddress($email, $nama);  //tujuan email
                                            $mail->MsgHTML('<center><table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:60%">
                                            <tbody>
                                                <tr><td style="padding:5px">
                                                <span>
                                                Dear,' . $nama . '</span></td></tr>
                                                <tr><td><br></td></tr>
                                                <tr>
                                                <td style="padding:5px"><span style="line-height:25px">
                                                You have successfully registered to '. $row['nama_konferensi'] .'. Next please click the link below to Login the participant status</span></td></tr>
                                                <tr><td><br></td></tr>
                                                <tr><td>
                                                <a href="'.$base_url.'/url.php?p=login">Login To Website Conference</a></td>
                                                </tr>                                                
                                                <tr><td><br></td></tr>
                                                <tr><td>Best Regards,</span></td></tr>
                                                <tr><td><br></td></tr>
                                                <tr><td>PubEazy Organizing Committee</span></td></tr>
                                            </tbody>
                                        </table></center>');
                                            $mail->Send();


                                            echo '<script>alert("Registrasi Berhasil")
                                                        	location.replace("' . $base_url . '/url.php?p=login")</script>';
                                        } else {

                                            echo '<script>alert("Registrasi Gagal")
                                                            location.replace("' . $base_url . '/url.php?p=register")</script>';
                                        }
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