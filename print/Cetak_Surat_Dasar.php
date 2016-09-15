<?
include_once '../config/koneksidb.php';
include_once '../config/fungsi.php';

session_start();
$id 		= $_REQUEST['id'];
$npwrd 		= base64_decode(trim($_REQUEST['npwrd']));
mysql_select_db($database, $konekdb);

$sqla 		= "SELECT d.*, p.*, e.provinsi_nama, k.kabupaten_nama, c.kecamatan_nama, a.desa_nama,
 				s.pasar_nama, s.pasar_alamat, j.jenis_nama, t.tempat_nama 
				FROM sipp_dasar d 
				JOIN sipp_penduduk p ON d.penduduk_id = p.penduduk_id
				JOIN sipp_provinsi e ON p.provinsi_id = e.provinsi_id
				JOIN sipp_kabupaten k ON p.kabupaten_id = k.kabupaten_id
				JOIN sipp_kecamatan c ON p.kecamatan_id = c.kecamatan_id
				JOIN sipp_desa a ON p.desa_id = a.desa_id
				JOIN sipp_pasar s ON d.pasar_id = s.pasar_id
				JOIN sipp_jenis j ON d.jenis_id = j.jenis_id
				JOIN sipp_tempat t ON d.tempat_id = t.tempat_id
				WHERE d.dasar_id = '".$id."'";

$rsa 		= mysql_query($sqla, $konekdb) or die(mysql_error());	
$rowrsa 	= mysql_fetch_assoc($rsa);

$xno_surat	= strtoupper(trim($rowrsa['dasar_no']));
$xnpwrd		= strtoupper(trim($rowrsa['dasar_npwrd']));
$xnik		= strtoupper(trim($rowrsa['penduduk_nik']));
$xnama		= strtoupper(trim($rowrsa['penduduk_nama']));
$xumur		= age($rowrsa['penduduk_tgl_lahir']);
$xalamat	= ucwords(strtolower(trim($rowrsa['penduduk_alamat']).' RT. '.$rowrsa['penduduk_rt'].'/'.$rowrsa['penduduk_rw'].' Desa '.trim($rowrsa['desa_nama']).' Kecamatan '.trim($rowrsa['kecamatan_nama'])));
$xarea		= ucwords(strtolower(trim($rowrsa['kabupaten_nama']).' - '.trim($rowrsa['provinsi_nama'])));
$xfoto 		= trim($rowrsa['penduduk_foto']); // Foto
$xtempat	= strtoupper(trim($rowrsa['tempat_nama']));
$xpasar		= strtoupper(trim($rowrsa['pasar_nama']));
$xblok		= strtoupper(trim($rowrsa['dasar_blok']));
$xnomor		= strtoupper(trim($rowrsa['dasar_nomor']));
$xukuran	= $rowrsa['dasar_panjang'].'x'.$rowrsa['dasar_lebar'];
$xjenis		= strtoupper(trim($rowrsa['jenis_nama']));
$tgl1 		= trim($rowrsa['dasar_dari']);
if (($tgl1 == "") || ($tgl1 == "0000-00-00")) {
	$xtgl1 	="";
} else {
	$xtgl 	= explode("-",$tgl1);
	$xtgl1 	= $xtgl[2]."-".$xtgl[1]."-".$xtgl[0];	
}

$tgl2 		= trim($rowrsa['dasar_sampai']);
if (($tgl2 == "") || ($tgl2 == "0000-00-00")) {
	$xtgl2 	="";
} else {
	$xtgl 	= explode("-",$tgl2);
	$xtgl2 	= $xtgl[2]."-".$xtgl[1]."-".$xtgl[0];	
}

$xtanggalcetak = date('d-m-Y');

// Data Petugas
$sqlb 		= "SELECT * FROM sipp_petugas WHERE petugas_id = 1";
$rsb 		= mysql_query($sqlb, $konekdb) or die(mysql_error());
$rowrsb 	= mysql_fetch_assoc($rsb);
$xnik_kadin	= trim($rowrsb['petugas_nik_kadin']);
$xnama_kadin= trim($rowrsb['petugas_nama_kadin']);
$xjabatan	= trim($rowrsb['petugas_jab_kadin']);
$xtitle		= trim($rowrsb['petugas_title_kadin']);

$document = file_get_contents("../template_surat/Template_Surat_Dasar.rtf");
$document = preg_replace('[xno_surat]',$xno_surat,$document);	
$document = preg_replace('[xnpwrd]',$xnpwrd,$document);
$document = preg_replace('[xnik]',$xnik,$document);
$document = preg_replace('[xnama]',$xnama,$document);
$document = preg_replace('[xumr]',$xumur,$document);
$document = preg_replace('[xalamat]',$xalamat,$document);
$document = preg_replace('[xarea]',$xarea,$document);
$document = preg_replace('[xtempat]',$xtempat,$document);
$document = preg_replace('[xpasar]',$xpasar,$document);
$document = preg_replace('[xblok]',$xblok,$document);
$document = preg_replace('[xnomor]',$xnomor,$document);
$document = preg_replace('[xukuran]',$xukuran,$document);
$document = preg_replace('[xjenisdagang]',$xjenis,$document);
$document = preg_replace('[xtanggal1]',$xtgl1,$document);
$document = preg_replace('[xtanggal2]',$xtgl2,$document);
$document = preg_replace('[xtanggalcetak]',$xtanggalcetak,$document);
$document = preg_replace('[xttl]',$xtitle,$document);
$document = preg_replace('[xnmpetugas]',$xnama_kadin,$document);
$document = preg_replace('[xjabatan]',$xjabatan,$document);
$document = preg_replace('[xnip]',$xnik_kadin,$document);
$document = preg_replace('[xnama]',$xnama,$document);

$time 		= time();
$mnpwrd		= $_REQUEST['npwrd'];
$file 		= "Surat_Pendasaran_".$mnpwrd.'_'.$time.".rtf";
header("Content-type: application/msword");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-disposition: inline; filename=".$file);
header("Content-length: " . strlen($document));
echo $document;
?>