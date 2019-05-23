<?php
if ($_SESSION['group_session'] == 'presenter') {
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-file-o"></i> List Paper
        </h1>

    </section>
    </br>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">


                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><i class="fa fa-file-o"></i> List Paper</h3>

                                <div class="box-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">


                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tr>
                                        <th style="width: 10%;">ACTION</th>
                                        <th style="width: 15%;">PENGARANG</th>
                                        <th style="width: 30%;">JUDUL</th>
                                        <th style="width: 15%;">KEYWORD</th>
                                        <th style="width: 10%;">STATUS</th>
                                    </tr>

                                    <?php

                                    $id_presenter =  $_SESSION['id_presenter'];
                                    $select = mysqli_query($konek, "SELECT paper.paper_id, paper.judul, presenter.realname, paper.v_paper,status.status
                                                                    FROM paper 
                                                                    LEFT JOIN presenter ON paper.id_presenter=presenter.id_presenter
                                                                    LEFT JOIN status ON paper.v_paper=status.status_id
                                                                    WHERE  paper.id_presenter='$id_presenter' ");



                                    while ($row_paper = mysqli_fetch_array($select)) {

                                        $select_keyword = mysqli_query($konek, "SELECT mk.keyword as keyword FROM paper LEFT JOIN paper_keyword as pk ON paper.paper_id=pk.paper_id
                                         LEFT JOIN mst_keyword as mk ON pk.keyword_id=mk.keyword_id WHERE id_presenter='$id_presenter'");
                                        while ($row_keyword = mysqli_fetch_array($select_keyword)) {

                                            $key = $row_keyword['keyword'];
                                        };


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
                                        <td><a href='$base_url/index.php?p=pre-edit-paper&id=$row_paper[paper_id]'><button type='button' class='btn btn-default'><i class='fa fa-edit'></i></button></a>
                                        &nbsp &nbsp <a href='$base_url/index.php?p=hapus&id=" . $row_paper['paper_id'] . "'onClick=\"return confirm('Apakah anda yakin akan menghapus data Paper $row_paper[judul] ?')\"><button type='button' class='btn btn-default'><i class='fa fa-trash'></i></button></a></td>
                                        
                                            <td>$row_paper[realname] </td>
                                            <td>$row_paper[judul] </td>                                                
                                            <td>$key</td>
                                            <td>$status_ver</td>
                                        
                                        </tr>
                                    </tbody>";
                                    };
                                    ?>

                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>







            </div>
        </div>
     
    <?php
}
?>