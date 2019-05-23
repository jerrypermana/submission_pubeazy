<?php
include "../../config/koneksi.php";

if (isset($_GET['search'])) {
    $search    =    $_GET['search'];
    $query = mysqli_query($konek, "SELECT * FROM mst_subject where subject like '%$search%'");
} elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = mysqli_query($konek, "SELECT * FROM mst_subject as ms, paper_subject as ps where ms.subject_id=ps.subject_id and ps.paper_id='$id'");
} else {
    $query = mysqli_query($konek, "SELECT * FROM mst_subject order by subject asc");
}



$data = array();
while ($row = mysqli_fetch_array($query)) {
    $data['results'][] = array(

        "id" => $row['subject_id'],
        "text" => $row['subject']
    );
}
echo json_encode($data);
//$query=mysqli_query($konek,"SELECT * FROM mst_author");

 