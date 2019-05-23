<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-cog"></i> System Settings
        </h1>

    </section>
    </br>
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



                                <div class="box box-solid">

                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="box-group" id="accordion">
                                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                            <div class="panel box box-primary">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                            <i class="fa fa-envelope"></i> Setting Email
                                                        </a>
                                                    </h4>
                                                </div>
                                                <form role="form" action="" method="POST" name='simpan' onSubmit='return validasi()' enctype="multipart/form-data">
                                                    <div id="collapseOne" class="panel-collapse collapse in">
                                                        <?php


                                                        $q_email        = "SELECT * FROM mst_email";
                                                        $hasil_email    = mysqli_query($konek, $q_email);
                                                        $d_email        = mysqli_fetch_array($hasil_email);

                                                        ?>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">SMTP Host</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="SMTP_Host" id='SMTP_Host' class="form-control" value='<?php echo $d_email['SMTP_Host']; ?>'>
                                                                <input type="hidden" name="email_id" id='email_id' class="form-control" value='<?php echo $d_email['email_id']; ?>'>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">SMTP User</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="SMTP_User" id='SMTP_User' class="form-control" value='<?php echo $d_email['SMTP_User'];  ?>'>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">SMTP Pass</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="SMTP_Pass" id='SMTP_Pass' class="form-control" value='<?php echo $d_email['SMTP_Pass']; ?>'>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">SMTP Port</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="SMTP_Port" id='SMTP_Port' class="form-control" value='<?php echo $d_email['SMTP_Port']; ?>'>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <label class="col-sm-2 control-label">Mail Protocol</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="Mail_Protocol" id='Mail_Protocol' class="form-control" value='<?php echo $d_email['Mail_Protocol']; ?>'>
                                                            </div>
                                                        </div>
                                                        <div class="box-footer">
                                                            <button type="submit" name="u_email" class="btn btn-info">Update</button>
                                                            <button type="cancel" class="btn btn-default  pull-right">Cancel</button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>



                                            
                                            
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <?php
                            if (isset($_POST['u_email'])) {
                                $email_id       = $_POST['email_id'];
                                $SMTP_Host      = $_POST['SMTP_Host'];
                                $SMTP_User      = $_POST['SMTP_User'];
                                $SMTP_Pass      = $_POST['SMTP_Pass'];
                                $SMTP_Port      = $_POST['SMTP_Port'];
                                $Mail_Protocol  = $_POST['Mail_Protocol'];

                                $q_mail     = "UPDATE mst_email set SMTP_Host='$SMTP_Host', 
                                    SMTP_User='$SMTP_User',
                                    SMTP_Pass='$SMTP_Pass',
                                    SMTP_Port='$SMTP_Port',
                                    Mail_Protocol='$Mail_Protocol'
                                    WHERE email_id='$email_id'";

                                $upd_mail     = mysqli_query($konek, $q_mail);

                                if ($upd_mail) {
                                    echo '<script>alert("System Settings Email is Update")
                                location.replace("' . $base_url . '/index.php?p=system-setting")</script>';
                                } else {
                                    echo '<script>alert("System Settings Email Failed Update")</script>';
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


    <?php
}
?>