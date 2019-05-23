
					
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
    $sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 'tp.tgl_transfer';
    $order  = (isset($_GET['order'])) ? $_GET['order'] : 'asc';
    
   $SQL_BASE="SELECT p.judul,pre.realname,pre.member_id,tp.transfer_id,tp.biaya_conf,tp.tgl_transfer,v_transfer FROM paper as p 
   RIGHT JOIN presenter as pre ON p.id_presenter=pre.id_presenter
   RIGHT JOIN transaksi_presenter as tp ON p.paper_id=tp.paper_id";
    
    
//    $ret['rows'] = mysqli_fetch_array($result);
    
    if($search<>''){
			//get where
            $SQL_BASE.=' WHERE p.v_paper=1 AND ';
            $SQL_BASE.='pre.member_id like "%'.$search.'%" OR ';
			$SQL_BASE.='p.judul like "%'.$search.'%" OR ';
			$SQL_BASE.='pre.realname like "%'.$search.'%" OR ';
            $SQL_BASE.='tp.tgl_transfer like "%'.$search.'%" OR ';
            $SQL_BASE.='tp.transfer_id like "%'.$search.'%" OR ';
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
            //echo $SQL;
			if($ret['total'] > 0){
                while($result_data = mysqli_fetch_object($query)){
                    $ret['rows'][] = $result_data;
                }
            }
		}
    
    echo json_encode($ret);

?>