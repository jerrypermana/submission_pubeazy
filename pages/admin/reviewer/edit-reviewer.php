<?php
if ($_SESSION['group_session'] == 'admin') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-secret"></i> Edit Reviewer
        </h1>

    </section>
    <br>
    <?php

    $reviewerID  = $_GET['reviewerID'];
    $query      = "SELECT * FROM reviewer WHERE reviewer_id='$reviewerID'";
    $hasil = mysqli_query($konek, $query);
    $row = mysqli_fetch_array($hasil);
    $hitung = mysqli_num_rows($hasil);

    if($row['status_active'] == 1){
        $status="Active";
    }else{
        $status="In Active";
    }

    if ($hitung == 0) {
        echo '<script>alert("Reviewer Tidak Di Temukan")
         location.replace("' . $base_url . '../index.php?id=dashboard")</script>';
    }
    ?>


    <!-- Main content -->
    <section class="content">
        <div class="row">


            <!-- left column -->
            <div class="col-md-12">
                <div class="col-md-2" align="right">
                    <a href="<?php echo $base_url; ?>/index.php?p=list-reviewer" class="btn btn-block btn-primary btn-sm">
                        <i class="fa fa-list"></i> List Speakers
                    </a>
                </div>
                <div class="col-md-2" align="right">
                    <a href="<?php echo $base_url; ?>/index.php?p=add-reviewer" class="btn btn-block btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Add Reviewer
                    </a>
                </div>
                <div class="col-md-8">
                </div>

                <br>
                <br>
                <!-- general form elements -->
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <i class="fa fa-user-plus"></i>
                        <h3 class="box-title">Edit reviewer</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" method="POST" name='simpan' class='form-horizontal form-bordered' onSubmit='return validasi()' enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Full Name*</label>

                                <div class="col-sm-5">
                                    <input type="text" name="realname" id='realname' class="form-control" value='<?php echo $row['realname']; ?>' required>
                                    <input type="hidden" name="reviewer_id" id='reviewer_id' class="form-control" value='<?php echo $row['reviewer_id']; ?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Email Address*</label>

                                <div class="col-sm-5">
                                    <input type="text" name="email" id='email' class="form-control" value='<?php echo $row['email']; ?>' required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Password*</label>

                                <div class="col-sm-5">
                                    <input type="password" name="password" id='password' class="form-control" value='<?php echo $row['password']; ?>' required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Status*</label>

                                <div class="col-sm-5">
                                    <select name="status" required>
                                        <option value='<?php echo $row['status_active']; ?>'><?php echo $status; ?></option>
                                        <option value='-'>---- Select Status----</option>
                                        <option value='1'>Active</option>
                                        <option value='0'>In Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label"></label>

                                <div class="col-sm-5">
                                    <button type="submit" name="update" class="btn btn-info"><i class="fa fa-save"></i> update</button>
                                    <button type="cancel" class="btn btn-warning"><i class="fa fa-remove"></i> Cancel</button>
                                </div>
                            </div>

                        </div>



                </div>

                <!-- /.box-footer -->
                </form>
            </div>

</div>

        <?php
        if (isset($_POST['update'])) {
            $reviewer_id        =$_POST['reviewer_id'];
            $realname           = $_POST['realname'];
            $email              = $_POST['email'];
            $password           = md5($_POST['password']);
            $status             = $_POST['status'];
           // $input_date         = date('Y-m-d');
            $last_update        = date('Y-m-d');


            $query_reviewer  = "UPDATE reviewer SET realname='$realname',
            email='$email',
            password='$password',
            status_active='$status', 
            last_update='$last_update' 
            WHERE reviewer_id='$reviewer_id'";

            //echo $query_reviewer;
            $update_reviewer = mysqli_query($konek, $query_reviewer);

            if ($update_reviewer) {
                echo '<script>alert("Reviewer Berhasil di Perbaharui")</script>';
            } else {
                echo '<script>alert("Reviewer Gagal di Perbaharui")</script>';
            }
        }

        ?>

    <?php
}
?>