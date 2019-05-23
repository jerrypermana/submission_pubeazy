
					
<?php
include_once "../../config/koneksi.php";

     $ret = array(
        'total'=>0,
        'rows'=>array()
    );
    header('Content-Type: application/json');

    $limit  = isset($_GET['limit']) ? $_GET['limit'] : 10;
    $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
    $search = (isset($_GET['search'])) ? $_GET['search'] : '';
    $sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 'tp.input_date';
    $order  = (isset($_GET['order'])) ? $_GET['order'] : 'asc';
    
   $SQL_BASE="SELECT tp.transfer_id,p.id_peserta,p.member_id,p.realname,conf.nama_konferensi,conf.penyelenggara,pk.nama_paket,tp.v_transfer,tp.input_date
   FROM transaksi_peserta as tp
   LEFT JOIN peserta as p ON tp.id_peserta=p.id_peserta
   LEFT JOIN conference as conf ON tp.konferensi_id=conf.konferensi_id
   LEFT JOIN paket_konferensi as pk ON tp.paket_id=pk.paket_id";
    
    
//    $ret['rows'] = mysqli_fetch_array($result);
    
    if($search<>''){
			//get where
            $SQL_BASE.=' WHERE ';
            $SQL_BASE.='p.realname like "%'.$search.'%" OR ';
			$SQL_BASE.='conf.nama_konferensi like "%'.$search.'%" OR ';
			$SQL_BASE.='conf.penyelenggara like "%'.$search.'%" OR ';
            $SQL_BASE.='pk.nama_paket like "%'.$search.'%" OR ';
            $SQL_BASE.='p.member_id like "%'.$search.'%" OR ';
			$SQL_BASE.='tp.v_transfer like "%'.$search.'%" ';
			$result = mysqli_query($konek, $SQL_BASE);
			$ret['total'] = mysqli_num_rows($result);
					
			//get where with limit
			$SQL=($sort) ? $SQL_BASE.' ORDER BY '.$sort.' '.$order : $SQL_BASE;
			$SQL.=' LIMIT '.$offset.','.$limit;
            $query=mysqli_query($konek, $SQL);
            //echo $SQL;	
			if($ret['total'] > 0){
                while($result_data = mysqli_fetch_object($query)){
                    $ret['rows'][] = $result_data;
                }
            }
		}else{
           
			//get all
			$result=mysqli_query($konek, $SQL_BASE);
			$ret['total'] = mysqli_num_rows($result);
			//get limit
			$SQL=($sort) ? $SQL_BASE.' ORDER BY '.$sort.' '.$order : $SQL_BASE;
			$SQL.=' LIMIT '.$offset.','.$limit;
            $query=mysqli_query($konek, $SQL);
            // echo $SQL;
			if($ret['total'] > 0){
                while($result_data = mysqli_fetch_object($query)){
                    $ret['rows'][] = $result_data;
                }
            }
		}
    
    echo json_encode($ret);

?>