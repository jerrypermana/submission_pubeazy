
					
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
    $sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 'p.input_date';
    $order  = (isset($_GET['order'])) ? $_GET['order'] : 'DESC';
    
   $SQL_BASE="SELECT p.paper_id, presenter.realname,presenter.member_id, p.judul, p.v_paper,p.v_akhir, p.input_date, p.last_update, p.v_paper,
   conference.nama_konferensi FROM paper as p 
   LEFT JOIN presenter ON p.id_presenter=presenter.id_presenter
   LEFT JOIN conference ON p.konferensi_id=conference.konferensi_id
   LEFT JOIN paper_jadwal as pj ON p.paper_id=pj.paper_id";
    
    
//    $ret['rows'] = mysqli_fetch_array($result);
    
    if($search<>''){
			//get where
            $SQL_BASE.=' WHERE p.v_paper=1 AND';
            $SQL_BASE.='presenter.member_id like "%'.$search.'%" OR ';
            $SQL_BASE.='conference.nama_konferensi like "%'.$search.'%" OR ';
			$SQL_BASE.='presenter.realname like "%'.$search.'%" OR ';
			$SQL_BASE.='p.judul like "%'.$search.'%" OR ';
			$SQL_BASE.='p.input_date like "%'.$search.'%" OR ';
			$SQL_BASE.='p.last_update like "%'.$search.'%" ';
			$result = mysqli_query($konek, $SQL_BASE);
			$ret['total'] = mysqli_num_rows($result);
					
			//get where with limit
			$SQL=($sort) ? $SQL_BASE.' ORDER BY '.$sort.' '.$order : $SQL_BASE;
			$SQL.=' LIMIT '.$offset.','.$limit;
            $query=mysqli_query($konek, $SQL);
            // echo $SQL;	
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