<?php
include "../../config/koneksi.php";
if(isset($_GET['start_date'])){
    $start =  $_GET['start_date'];
    
    $query = "SELECT jj.jam_id,jj.jam FROM jadwal_jam as jj where jam_id
        NOT IN (
        SELECT jj.jam_id FROM jadwal_jam as jj
        RIGHT JOIN paper_jadwal as pj ON jj.jam_id=pj.jam_id
        RIGHT JOIN paper as p ON pj.paper_id=p.paper_id
        RIGHT JOIN conference as conf ON p.konferensi_id=conf.konferensi_id
        WHERE conf.show_dashboard='1' AND pj.date='$start')";
        
    $result = mysqli_query($konek, $query);
    $respon = array();
    while ($hasil = mysqli_fetch_array($result))
    {
        $respon[] = $hasil;
    }

    
}


//echo $query;
echo json_encode($respon);
?>