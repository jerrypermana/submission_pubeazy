<?php
include "config/koneksi.php";
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PubEazy | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="index2.html"><b>Pub</b>Eazy</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">LOGIN REVIEWER</p>

            <form method="POST" name='simpan' onSubmit='return validasi()' id="test">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="email" id='email' placeholder="email" />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" id='password' placeholder="Password" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <img id="captchaimg" src="captcha_code_file.php?rand=<?php echo rand(); ?>" /><br>
                    <input type="text" class="form-control" name="captcha" id="captcha" />
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">

                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-flat">Masuk</button>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="form-group has-feedback">
                <a href="url.php?p=forget-password"><label>Forget Password ?</label></a>
                </div>
            </form>
            <!-- TUTUP JS CEK AUTHETIKASI PASSWORD -->
            <script type='text/javascript'>
                function validasi() {




                    if (simpan.email.value == "") {
                        alert("email harus di isi");
                        simpan.email.focus();
                        return false;
                    }
                    if (simpan.password.value == "") {
                        alert("Password harus di isi");
                        simpan.password.focus();
                        return false;
                    }


                    return true;
                }
            </script>
            <!-- TUTUP JS CEK AUTHETIKASI PASSWORD -->
            <!-- PHP LOGIN PASSWORD -->
            <?php
            if (isset($_POST['submit'])) {
                if (empty($_SESSION['captcha']) || strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0) {
                    //Note: the captcha code is compared case insensitively.
                    //if you want case sensitive match, update the check above to
                    // strcmp()
                    echo '<script>alert("Capctha yang anda masukkan salah")
                    location.replace("url.php?p=login")</script>';
                } elseif (empty($errors)) {

                    $email      = $_POST['email'];
                    $password   = md5($_POST['password']);


                    $query_presenter = mysqli_query($konek, "SELECT * FROM reviewer WHERE email='$email' AND password='$password'");
                    $tu = mysqli_fetch_array($query_presenter);
                    $t = mysqli_num_rows($query_presenter);

     

                    if ($t == 1) {



                        $_SESSION['email'] = $tu['email'];
                        $_SESSION['reviewer_id'] = $tu['reviewer_id'];
                        $_SESSION['realname'] = $tu['realname'];
                        $_SESSION['password'] = $tu['password'];
                        $_SESSION['group_session'] = $tu['group_session'];

                        echo '<script>location.replace("pages/index.php?p=dashboard-reviewer")</script>';
                    } else {

                        echo '<script>alert("Login Gagal, Silahkan Masukkan Password dan email dengan benar")
				location.replace("url.php?p=login-reviewer")</script>';
                    }
                }
            }




            ?>
            <!-- TUTUP PHP LOGIN PASSWORD -->

            <div class="social-auth-links text-center">

            </div>
            <!-- /.social-auth-links -->


        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="assets/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>

</html>