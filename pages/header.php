<?php
session_start();
include "../config/koneksi.php";
if (!isset($_SESSION['email'])) {

    header("Location: ../index.php");
}

if ($_SESSION['group_session'] == 'peserta') {
    $id_peserta   = $_SESSION['id_peserta'];
    $query      = "SELECT * FROM peserta WHERE id_peserta='$id_peserta'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    if ($hitung == 0) {
        echo '<script>alert("ID Anggota Tidak Di Temukan")
              location.replace("' . $base_url . '/index.php?p=dashboard-peserta")</script>';
    }

    if ($row['image'] == "") {
        $foto = '../files/peserta/no_photo.png';
    } else {
        $foto = '../files/peserta/' . $row['image'] . '';
    }
} else {
    $foto = '../files/admin.png';
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PubEazy</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- DATA TABLES -->
    <link href="../assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <!-- Select2 -->
    <link rel="stylesheet" href="../assets/bower_components/select2/dist/css/select2.min.css">


    <link href="../assets/editor/editor.css" type="text/css" rel="stylesheet" />


    <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- CSS DATATABLES JSON -->
    <link href="../assets/plugins/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">


    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet"> -->

    <!-- jQuery 3 -->
    <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Select2 -->
    <script src="../assets/bower_components/select2/dist/js/select2.full.min.js"></script>


    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../assets/editor/editor.js"></script>
    <script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Data Tables Ajax JSON -->
    <script src="../assets/plugins/bootstrap-table/dist/bootstrap-table.min.js" type="text/javascript"></script>
    <!-- CK Editor -->
    <script src="../assets/bower_components/ckeditor/ckeditor.js"></script>
</head>
<style>
    a.disabled {
        pointer-events: none;
        cursor: default;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo $base_url; ?>/index.php?p=dashboard" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>P</b>E</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Pub</b>Eazy</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo $foto; ?>" class="img-responsive img-circle" alt="User Image" style=" height: 45px; width: 45px; ">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $_SESSION['realname'] ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU</li>
                    <!-- START MODUL ADMIN -->
                    <?php

                    if ($_SESSION['group_session'] == 'admin') {


                        ?>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=list-konferensi">
                                <i class="fa fa-newspaper-o"></i> <span>Conference</span>

                            </a>

                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i> <span>Presenter</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=paper-review">
                                        <i class="fa fa-book"></i> <span>Paper Review</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=list-paper">
                                        <i class="fa fa-book"></i> <span>Daftar Paper</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=v-paper">
                                        <i class="fa fa-check-square-o"></i> <span>Verification Paper</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=list-transaksi-presenter">
                                        <i class="fa fa-bank"></i> <span>Verification Payment Proofs</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=list-v-akhir">
                                        <i class="fa fa-check-square"></i> <span>Verification Full Paper</span>
                                    </a>
                                </li>
                                <!-- <li>
                                                                                                    <a href="<?php echo $base_url; ?>/index.php?p=list-jadwal">
                                                                                                        <i class="fa fa-calendar-check-o"></i> <span>List Jadwal</span>
                                                                                                    </a>
                                                                                                </li> -->
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i> <span>Participants</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">

                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=list-transaksi-peserta">
                                        <i class="fa fa-users"></i> <span>Payment Proofs Participant</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cogs"></i> <span>Master File</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                            <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=mst-presenter">
                                        <i class="fa fa-inbox"></i> <span>Presenter</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=mst-peserta">
                                        <i class="fa fa-inbox"></i> <span>Participants</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=mst-subject">
                                        <i class="fa fa-inbox"></i> <span>Subject</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=mst-keyword">
                                        <i class="fa fa-key"></i> <span>Keyword</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=mst-jam">
                                        <i class="fa fa-clock-o"></i> <span>Time</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=mst-accountbank">
                                        <i class="fa fa-bank"></i> <span>Bank Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=mst-ruang">
                                        <i class="fa fa-building-o"></i> <span>Room</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=mst-paket">
                                        <i class="fa fa-list-alt"></i> <span>Package Conference</span>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user-secret"></i> <span>Reviewer</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=list-reviewer">
                                        <i class="fa fa-list"></i> <span>Reviewer</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i> <span>Reporting</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=rep-payment-presenter">
                                        <i class="fa fa-file-o"></i> <span>Payment Proofs Presenter</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=rep-payment-peserta">
                                        <i class="fa fa-file-o"></i> <span>Payment Proofs Participants</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=rep-loi">
                                        <i class="fa fa-file-o"></i> <span>Letter of Invitation (LOI)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=rep-loa">
                                        <i class="fa fa-file-o"></i> <span>Letter of Accepted (LOA)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=rep-abstrak">
                                        <i class="fa fa-file-o"></i> <span>Abstrak</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=rep-fullpaper">
                                        <i class="fa fa-file-o"></i> <span>Full Paper</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=rep-poster">
                                        <i class="fa fa-file-o"></i> <span>Poster</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=rep-ppt">
                                        <i class="fa fa-file-o"></i> <span>PPT</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=rep-presenter">
                                        <i class="fa fa-file-o"></i> <span>Presenter</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=rep-peserta">
                                        <i class="fa fa-file-o"></i> <span>Peserta</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- START SYSTEM SETTING -->
                        <li class="header">SYSTEM SETTING</li>

                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=system-setting">
                                <i class="fa fa-cog"></i> <span>System Setting</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=mst-admin">
                                <i class="fa fa-user"></i> <span>Administrator</span>
                            </a>
                        </li>
                        <!-- CLOSE SYSTEM SETTING -->


                        <li>
                            <a href="../config/logout.php">
                                <i class="fa fa-sign-out"></i> <span>Logout</span>
                            </a>
                        </li>


                    <?php
                } ?>
                    <!-- CLOSE MODUL ADMIN -->
                    <!-- START MODUL REVIEWER -->
                    <?php

                    if ($_SESSION['group_session'] == 'reviewer') {


                        ?>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=dashboard-reviewer">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i> <span>Review Paper</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=list-paper-reviewer">
                                        <i class="fa fa-book"></i> <span>Daftar Paper</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=edit-profile-reviewer">
                                <i class="fa fa-user"></i> <span>Change Your Profile</span>
                            </a>
                        </li>

                        <li>
                            <a href="../config/logout.php">
                                <i class="fa fa-sign-out"></i> <span>Logout</span>
                            </a>
                        </li>
                    <?php
                }
                ?>
                    <!-- CLOSE MODUL REVIEWER -->
                    <!-- START MODUL PRESENTER-->
                    <?php
                    if ($_SESSION['group_session'] == 'presenter') {
                        $id_presenter   = $_SESSION['id_presenter'];

                        $q_paper    = "SELECT * FROM paper WHERE v_paper='1' AND id_presenter='$id_presenter'";
                        $d_data     = mysqli_query($konek, $q_paper);
                        $data       = mysqli_fetch_array($d_data);
                        $row_paper  = mysqli_num_rows($d_data);

                        $q_payment      = "SELECT * FROM paper as p 
                        LEFT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id 
                        WHERE tp.v_transfer='1' AND p.paper_id='$data[paper_id]'";
                        $d_payment      = mysqli_query($konek, $q_payment);
                        $row_payment    = mysqli_num_rows($d_payment);

                        $q_akhir      = "SELECT * FROM paper as p WHERE v_akhir='1' AND paper_id='$data[paper_id]'";
                        $d_akhir     = mysqli_query($konek, $q_akhir);
                        $row_akhir   = mysqli_num_rows($d_akhir);

                        if ($row_paper == 0) {
                            $style_paper = "style='pointer-events: none; cursor: default; opacity: .35; box-shadow: none;'";
                        } else {
                            $style_paper = "";
                        }

                        if ($row_payment == 0) {
                            $style_payment = "style='pointer-events: none; cursor: default; opacity: .35; box-shadow: none;'";
                        } else {
                            $style_payment = "";
                        }
                        if ($row_akhir == 0) {
                            $style_akhir = "style='pointer-events: none; cursor: default; opacity: .35; box-shadow: none;'";
                        } else {
                            $style_akhir = "";
                        }
                        ?>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=dashboard-presenter">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=pre-list-paper">
                                <i class="fa fa-list"></i> <span>List Paper</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=add-paper">
                                <i class="fa fa-book"></i> <span>Upload Paper</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=bukti-transfer" <?php echo $style_paper; ?>>
                                <i class="fa fa-credit-card"></i> <span>Payment Proofs</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=add-jadwal" <?php echo $style_payment; ?>>
                                <i class="fa fa-calendar-plus-o"></i> <span>Add Schedule</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=add-ppt" <?php echo $style_akhir; ?>>
                                <i class="fa fa-file-powerpoint-o"></i> <span>Upload PPT</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=edit-presenter">
                                <i class="fa fa-user"></i> <span>Change Your Profile</span>
                            </a>
                        </li>

                        <li>
                            <a href="../config/logout.php">
                                <i class="fa fa-sign-out"></i> <span>Logout</span>
                            </a>
                        </li>

                    <?php

                }
                ?>
                    <!-- CLOSE MODUL PRESENTER-->
                    <!-- START MODUL PESERTA -->
                    <?php
                    if ($_SESSION['group_session'] == 'peserta') {


                        ?>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=dashboard-peserta">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-list-ul"></i> <span>Konferensi</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">

                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=konferensi">
                                        <i class="fa fa-check"></i> <span>Pilih Konferensi</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo $base_url; ?>/index.php?p=daftar-konferensi">
                                        <i class="fa fa-bars"></i> <span>Daftar Konferensi</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=list-transfer">
                                <i class="fa fa-credit-card"></i> <span>Bukti Transfer</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>/index.php?p=edit-peserta">
                                <i class="fa fa-user"></i> <span>Ubah Profil Pengguna</span>
                            </a>
                        </li>

                        <li>
                            <a href="../config/logout.php">
                                <i class="fa fa-sign-out"></i> <span>Logout</span>
                            </a>
                        </li>
                        <!-- CLOSE MODUL PESERTA -->
                    <?php

                }
                ?>


                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- START CONTENT TEMPALTE -->