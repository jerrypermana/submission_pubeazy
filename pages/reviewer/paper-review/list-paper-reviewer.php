<?php
if ($_SESSION['group_session'] == 'reviewer') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> List Paper Reviewer
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"> <i class="fa fa-list"></i> List Paper</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Member ID</th>
                                                <th>Presenter</th>
                                                <th>Conference</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <?php
                                        $reviewer = $_SESSION['reviewer_id'];
                                        $query = "SELECT p.paper_id,p.id_presenter, presenter.member_id,presenter.realname, p.judul, p.v_paper, p.input_date, 
                                        p.last_update, conference.nama_konferensi,status.status 
                                        FROM paper as p 
                                        LEFT JOIN presenter ON p.id_presenter=presenter.id_presenter 
                                        LEFT JOIN conference ON p.konferensi_id=conference.konferensi_id 
                                        LEFT JOIN paper_reviewer as pr ON p.paper_id=pr.paper_id 
                                        LEFT JOIN reviewer as r ON pr.review_id=r.reviewer_id
                                        LEFT JOIN status ON p.v_paper=status.status_id
                                        WHERE pr.review_id='$reviewer' order by input_date DESC";
                                        $select = mysqli_query($konek, $query);
                                        //echo $query;

                                        while ($row_paper = mysqli_fetch_array($select)) {
                                         

                                            

                                            if ($row_paper["v_paper"]  == '1') {
                                                $status_ver = "<span class='label label-success'>$row_paper[status]</span>";
                                            } else if ($row_paper["v_paper"] == '2') {
                                                $status_ver = "<span class='label label-warning'>$row_paper[status]</span>";
                                            } else if ($row_paper["v_paper"]  == '3') {
    
                                                $status_ver = "<span class='label label-danger'>$row_paper[status]</span>";
                                            } else {
    
                                                $status_ver = "<span class='label label-warning'>not yet approved</span>";
                                            }
    

                                           


                                            echo "<tbody>
                                            <tr>
                                                <td align='center'><a href='$base_url/index.php?p=v-paper-reviewer&paperID=$row_paper[paper_id]'><button type='button' class='btn btn-primary'><i class='fa fa-upload'></i> Verify</button></a></td>
                                                <td>$row_paper[member_id]</td>
                                                <td>$row_paper[realname]</td>
                                                <td>$row_paper[nama_konferensi]</td>
                                                <td>$row_paper[judul]</td>
                                                <td>$status_ver</td>
                                            
                                            </tr>
                                        </tbody>";
                                        };
                                        ?>



                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>

        <script>
            $(function() {
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                })
            })
        </script>

    <?php
}
?>