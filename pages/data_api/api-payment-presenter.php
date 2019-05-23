
					
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
    $sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 'p.paper_id';
    $order  = (isset($_GET['order'])) ? $_GET['order'] : 'DESC';
    
   $SQL_BASE="SELECT pre.realname,pre.member_id,
   pre.instansi,p.judul,
   tp.from_bank, ac.nama_bank AS to_bank,tp.jumlah_transfer,tp.v_transfer 
   FROM transaksi_presenter as tp
   LEFT JOIN paper as p ON tp.paper_id=p.paper_id
   LEFT JOIN presenter as pre ON p.id_presenter=pre.id_presenter
   LEFT JOIN account_bank as ac ON tp.kode_bank=ac.kode_bank";
    
    
//    $ret['rows'] = mysqli_fetch_array($result);
    
    if($search<>''){
			//get where
            $SQL_BASE.=' WHERE tp.v_transfer=1 AND ';
            $SQL_BASE.='p.judul like "%'.$search.'%" OR ';
            $SQL_BASE.='pre.member_id like "%'.$search.'%" OR ';
			$SQL_BASE.='pre.realname like "%'.$search.'%" ';
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
             //echo $SQL;
			if($ret['total'] > 0){
                while($result_data = mysqli_fetch_object($query)){
                    $ret['rows'][] = $result_data;
                }
            }
		}
    
    echo json_encode($ret);

?>