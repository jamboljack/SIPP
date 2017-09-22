<?php
include_once '../config/koneksidb.php';

session_start();
$id 		= $_GET['id'];
mysql_select_db($database, $konekdb);

$sql 		= "SELECT k.skrd_no, k.skrd_tgl, k.skrd_total, k.skrd_tgl_tempo, 
				d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, p.penduduk_nik, p.penduduk_nama,
 				s.pasar_nama, s.pasar_alamat, j.jenis_nama, t.tempat_nama 
				FROM sipp_skrd k 
				JOIN sipp_dasar d ON k.dasar_id=d.dasar_id 
				JOIN sipp_penduduk p ON d.penduduk_id = p.penduduk_id
				JOIN sipp_pasar s ON d.pasar_id = s.pasar_id
				JOIN sipp_jenis j ON d.jenis_id = j.jenis_id
				JOIN sipp_tempat t ON d.tempat_id = t.tempat_id
				WHERE p.penduduk_nik = '".$id."'";

$result 	= mysql_query($sql, $konekdb) or die(mysql_error());
$data 		= mysql_fetch_array($result);	
$total 		= mysql_num_rows($result);
//while ($row = mysql_fetch_array($result)) {
//    print_r($row);
//}
//mysql_free_result($result);

//while($rows = mysql_fetch_assoc($result)){
	//$data[] = $rows;
//}

//echo "<pre>";
//print_r($data);

$tojson['data'] = array(
		'skrd_no' 			=> $data['skrd_no'],
		'skrd_tgl' 			=> $data['skrd_no'],
		'skrd_total' 		=> $data['skrd_total'],
		'skrd_tgl_tempo' 	=> $data['skrd_tgl_tempo'],
		'dasar_npwrd' 		=> $data['dasar_npwrd'],
		'dasar_blok' 		=> $data['dasar_blok'],
		'dasar_nomor' 		=> $data['dasar_nomor'],
		'penduduk_nik' 		=> $data['penduduk_nik'],
		'penduduk_nama' 	=> $data['penduduk_nama'],
		'pasar_nama' 		=> $data['pasar_nama'],
		'pasar_alamat' 		=> $data['pasar_alamat'],
		'jenis_nama' 		=> $data['jenis_nama'],
		'tempat_nama' 		=> $data['tempat_nama']
);

$tojson['developer'] = array(
		'programmer' 	=> 'Jama Rochmad Muttaqin',
		'tester' 		=> 'Misbahul Ihsan'
);

header('content-Type: application/json');
echo json_encode($tojson);





?>