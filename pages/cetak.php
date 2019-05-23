<?php
include_once '../config/koneksi.php';

require_once '../plugins/phpexcel/Classes/PHPExcel/Shared/PDF/config/lang/eng.php';
require_once '../plugins/phpexcel/Classes/PHPExcel/Shared/PDF/tcpdf.php';

class MYPDF extends TCPDF {
	//Page Header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'conference.png';
		$this->Image($image_file, 15, 10, 15, '', 'PNG', '', 'T', false, 200, '', false, false, 0, false, false, false);
		$this->SetY(15);
		$this->SetFont('quicksandmedium', 'B', 22);
		$this->Cell(0, 15, 'PubEazy Conference', 0, false, 'C', 0, 1, 1, false, 'M', 'M');
	}

	// Page footer
	public function Footer() {
		$this->SetY(-15);
		$this->SetFont('quicksandmedium', 'B', 10);
		$this->Cell(0, 10, 'PubEazy Conference, Jakarta Selatan Jakarta, Indonesia (021) 228-2123', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

$pdf = new MYPDF ("L", "mm", "A5", true, 'UTF-8', false);

// // Fetch DB
$transfer_id   = $_GET['transfer_id'];
$query      	= "SELECT
	tp.transfer_id,
	p.id_peserta,
	p.member_id,
	p.realname,
	p.image,
	conf.nama_konferensi,
	conf.penyelenggara,
	pk.nama_paket,
	pk.biaya,
	tp.v_transfer,
	mr.nama_ruang,
	conf.start_date,
	tp.transfer_id,
	tp.nama_transfer,
	tp.jumlah_transfer,
	tp.kode_bank,
	tp.tgl_transfer,
	tp.v_transfer,
	ab.nama_bank,
	ab.atas_nama,
	ab.rekening
FROM transaksi_peserta as tp
LEFT JOIN peserta as p ON tp.id_peserta=p.id_peserta
LEFT JOIN conference as conf ON tp.konferensi_id=conf.konferensi_id
LEFT JOIN paket_konferensi as pk ON tp.paket_id=pk.paket_id
LEFT JOIN mst_ruang as mr ON conf.ruang_id=mr.ruang_id
LEFT JOIN account_bank as ab ON tp.kode_bank=ab.kode_bank
WHERE md5(tp.transfer_id)='$transfer_id'";
$hasil = mysqli_query($konek, $query);
$data = mysqli_fetch_array($hasil);
$tanggal_conf = date('d-m-Y', strtotime($data['start_date']));
$tanggal_tf = date('d-m-Y', strtotime($data['tgl_transfer']));

if ($data['image'] == ""){
	$foto = '../files/peserta/no_photo.png';
} else {
	$foto = '../files/peserta/'.$data['image'].'';
}

// Set Document Information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("Pubeazy");
$pdf->SetTitle("Cetak Tiket Konferensi");
$pdf->SetSubject("Cetak Tiket Konferensi");
$pdf->SetKeywords('Pubeazy');

// Preferences
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);
$pdf->SetMargins(15, 10, 15);
$pdf->SetAutoPageBreak(TRUE, 5);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);

$pdf->AddPage();
$pdf->SetFont('quicksandmedium', 'B', 10);
$pdf->SetY(35);

// Barcode Style
$style = array(
	'position' => '',
	'align' => 'C',
	'stretch' => false,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => true,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'quicksandmedium',
	'fontsize' => 8,
	'stretchtext' => 4
);

if (md5($data['transfer_id']) == $transfer_id){
	$body = '
	<table cellpadding="1" cellspacing="1" border="0" style="text-align:center;">
		<tr style="text-align:left;">
			<td width="28%">
				<img src="'.$foto.'" border="0" height="200" width="160" align="top" />
			</td>
			<td width="72%">
				<table cellpadding="1" cellspacing="6">
					<tr>
						<td width="30%">No. Anggota</td>
						<td width="70%">: '.$data['member_id'].'</td>
					</tr>
					<tr>
						<td width="30%">Nama Lengkap</td>
						<td width="70%">: '.$data['realname'].'</td>
					</tr>
					<tr>
						<td width="30%">Konferensi</td>
						<td width="70%">: '.$data['nama_konferensi'].'</td>
					</tr>
					<tr>
						<td width="30%">Penyelanggara</td>
						<td width="70%">: '.$data['penyelenggara'].'</td>
					</tr>
					<tr>
						<td width="30%">Ruang Konferensi</td>
						<td width="70%">: '.$data['nama_ruang'].'</td>
					</tr>
					<tr>
						<td width="30%">Tanggal Konferensi</td>
						<td width="70%">: '.$tanggal_conf.'</td>
					</tr>
					<tr>
						<td width="30%">No. Transaksi</td>
						<td width="70%">: '.$data['transfer_id'].'</td>
					</tr>
					<tr>
						<td width="30%">Paket Konferensi</td>
						<td width="70%">: '.$data['nama_paket'].'</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';
} else {
	$body = '<h1>Data Tidak Ditemukan.</h1>';
}
$pdf->writeHTML($body, true, false, true, false, '');

// BARCODE : CODE 128 A
$pdf->write1DBarcode(''.$data['member_id'].'', 'C128A', '', '', '', 15, 0.28, $style, 'N');

// output
$pdf->Output(''.$data['member_id'].'.pdf');
?>
