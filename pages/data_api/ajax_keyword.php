<?php
include "../../config/koneksi.php";

if (isset($_GET['search'])) {
    $search    =    $_GET['search'];
    $query = mysqli_query($konek, "SELECT * FROM mst_keyword where keyword like '%$search%'");
} elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = mysqli_query($konek, "SELECT * FROM mst_keyword as mk, paper_keyword as pk where mk.keyword_id=pk.keyword_id and pk.paper_id='$id'");
} else {
    $query = mysqli_query($konek, "SELECT * FROM mst_keyword order by keyword asc");
}



$data = array();
while ($row = mysqli_fetch_array($query)) {
    $data['results'][] = array(

        "id" => $row['keyword_id'],
        "text" => $row['keyword']
    );
}
echo json_encode($data);
//$query=mysqli_query($konek,"SELECT * FROM mst_author");

 