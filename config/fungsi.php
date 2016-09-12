<?php
include_once 'koneksidb.php';
mysql_select_db($database, $konekdb);

function age($dob) {
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    } else {
        return 0;
    }
}

function agenda($ijin)
{
	global $konekdb;
	$agenda="";
	$sqla="select curdate() as tgl";
	$rsa = mysql_query($sqla, $konekdb) or die(mysql_error());	
	$rowrsa = mysql_fetch_assoc($rsa);
		$tg = trim($rowrsa['tgl']);
		$xtg = explode("-",$tg);
		$thn = $xtg[0];
		$bln = $xtg[1];
		$tgl = $xtg[2];
	
	$sqlb="select max(no_agenda) as nog from c39_no_agenda where tahun = '".$thn."'";
	$rsb = mysql_query($sqlb, $konekdb) or die(mysql_error());	
	$rowrsb = mysql_fetch_assoc($rsb);
	$totrsb = mysql_num_rows($rsb);
	if ($totrsb==0){
		//no_agenda
		$nog = substr($thn,2,2)."000001";
		$upda = "update c39_no_agenda set "; 
		$upda = $upda."no_agenda='".$nog."',";
		$upda = $upda."tahun='".$thn."'";
		$upda = $upda." where id=1";
		$hsla = mysql_query($upda, $konekdb) or die(mysql_error());
	
		//insert no_agenda_log
		$insa = "insert into c39_no_agenda_log(no_agenda, jenis_ijin) VALUES (";
		$insa = $insa."'".$nog."',";
		$insa = $insa."'".$ijin."')";
		$hsla = mysql_query($insa, $konekdb) or die(mysql_error());
		
	} else {		
		$xnog = $rowrsb['nog'];
		$ynog = $xnog + 1;
		$angka = "00000".$ynog;
		$pjg = strlen($angka);
		if ($pjg>6) {
			$nog = substr($thn,2,2).substr($angka,-6,6);
		} else {
			$nog = substr($thn,2,2).$angka;
		}
		//update no agenda
		$upda = "update c39_no_agenda set "; 
		$upda = $upda."no_agenda='".$nog."',";
		$upda = $upda."tahun='".$thn."'";
		$upda = $upda." where id=1";
		$hsla = mysql_query($upda, $konekdb) or die(mysql_error());				

		//insert no_agenda_log
		$insa = "insert into c39_no_agenda_log(no_agenda, jenis_ijin) VALUES (";
		$insa = $insa."'".$nog."',";
		$insa = $insa."'".$ijin."')";
		$hsla = mysql_query($insa, $konekdb) or die(mysql_error());

	}
	return $agenda;	
}
function rupiah($angka)
{
	$rupiah="";
	$rp=strlen($angka);
	while ($rp>3)
	{
		$rupiah = ".". substr($angka,-3). $rupiah;
		$s=strlen($angka) - 3;
		$angka=substr($angka,0,$s);
		$rp=strlen($angka);
	}
	$rupiah = "Rp. " . $angka . $rupiah . "";
	return $rupiah;
}

function ribuan($angka)
{
	$ribuan="";
	$rb=strlen($angka);
	while ($rb>3)
	{
		$ribuan = ".". substr($angka,-3). $ribuan;
		$s=strlen($angka) - 3;
		$angka=substr($angka,0,$s);
		$rb=strlen($angka);
	}
	$ribuan = $angka . $ribuan . "";
	return $ribuan;
}

function real_ip ()
{
  if ($_ENV["HTTP_CLIENT_IP"]) $ip = $_ENV["HTTP_CLIENT_IP"];
  elseif ($_ENV["HTTP_X_FORWARDED_FOR"]) $ip = $_ENV["HTTP_X_FORWARDED_FOR"];
  elseif ($_ENV["HTTP_X_FORWARDED"]) $ip = $_ENV["HTTP_X_FORWARDED"];
  elseif ($_ENV["HTTP_FORWARDED_FOR"]) $ip = $_ENV["HTTP_FORWARDED_FOR"];
  elseif ($_ENV["HTTP_FORWARDED"]) $ip = $_ENV["HTTP_FORWARDED"];
  elseif ($_SERVER['REMOTE_ADDR']) $ip = $_SERVER['REMOTE_ADDR'];
  return $ip;
}
//untuk anti-sql

function nosql($str) {
   // $str = trim(mysql_real_escape_string(htmlentities(addslashes(htmlspecialchars($str)))));
	$str = preg_replace("%", "persen", $str);
	$str = preg_replace("1=1", "1smdgan1", $str);
	$str = preg_replace("-", "string", $str);
	$str = preg_replace("_", "stripbwh", $str);
	$str = preg_replace("/", "gmring", $str);
	$str = preg_replace("!", "pentung", $str);
	$str = preg_replace("'", "psiji", $str);
	$str = preg_replace("select", "NOSQL", $str);
	$str = preg_replace("delete", "NOSQL", $str);
	$str = preg_replace("update", "NOSQL", $str);
	$str = preg_replace("alter", "NOSQL", $str);
	$str = preg_replace("insert", "NOSQL", $str);
	$str = preg_replace("grant", "NOSQL", $str);
	$str = preg_replace("&", "~", $str);
	$str = preg_replace("@", " at ", $str);
	return $str;
  }
  
 function balikin($str) {
	$str = preg_replace("persen", "%", $str);
	$str = preg_replace("1smdgan1", "1=1", $str);
	$str = preg_replace("string", "-", $str);
	$str = preg_replace("stripbwh", "_", $str);
	$str = preg_replace("gmring", "/", $str);
	$str = preg_replace("pentung", "!", $str);
	$str = preg_replace("&amp;", "&", $str);
	$str = preg_replace("psiji", "'", $str);
	$str = preg_replace("~", "&", $str);
	$str = preg_replace(" at ", "@", $str);
	return $str;
  }
  
function hari($hari)
{
switch ($hari){
    case "Sunday" : $hari="Minggu";
        Break;
    case "Monday" : $hari="Senin";
        Break;
    case "Tuesday" : $hari="Selasa";
        Break;
    case "Wednesday" : $hari="Rabu";
        Break;
    case "Thursday" : $hari="Kamis";
        Break;
    case "Friday" : $hari="Jum'at";
        Break;
    case "Saturday" : $hari="Sabtu";
        Break;
	}
return $hari;
}

function bulan($bulan)
{
switch ($bulan){
    case "01" : $bulan="Januari";
        Break;
    case "02" : $bulan="Februari";
        Break;
    case "03" : $bulan="Maret";
        Break;
    case "04" : $bulan="April";
        Break;
    case "05" : $bulan="Mei";
        Break;
    case "06" : $bulan="Juni";
        Break;
    case "07" : $bulan="Juli";
        Break;
    case "08" : $bulan="Agustus";
        Break;
    case "09" : $bulan="September";
        Break;
    case "10" : $bulan="Oktober";
        Break;
    case "11" : $bulan="Nopember";
        Break;
    case "12" : $bulan="Desember";
        Break;
	 }
return $bulan;
}

function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}

?>