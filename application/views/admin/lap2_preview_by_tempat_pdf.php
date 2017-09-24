<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	table {
    	border: 1px solid #ccccb3;    	
    	width: 100%;
	}
	
    th {
    	height: 30px;
	}
	
    th {
    	height: 20px;
    	background-color: #eff3f8;
    	color: black;
	}
	
    th, td {
	    padding: 5px;
	    border-bottom: 1px solid #ddd;	
	}
    h4 {
        text-decoration: underline;
        line-height: 0.5px;   
    }
</style>

<style type="text/css">
	body{
        font-family: "Times New Roman"; 
        font-size:12px
    }
	
    h1{
        font-size:15px
    }	
</style>
</head>

<?php 
$bln        = $this->uri->segment(6);
switch ($bln) {
case 1:
    $bulan = "Januari";
    break;
case 2:
    $bulan = "Februari";
    break;
case 3:
    $bulan = "Maret";
    break;
case 4:
    $bulan = "April";
    break;
case 5:
    $bulan = "Mei";
    break;
case 6:
    $bulan = "Juni";
    break;
case 7:
    $bulan = "Juli";
    break;
case 8:
    $bulan = "Agustus";
    break;
case 9:
    $bulan = "September";
    break;
case 10:
    $bulan = "Oktober";
    break;
case 11:
    $bulan = "November";
    break;
case 12:
    $bulan = "Desember";
    break;
}
?>

<body>
<div class="page">
<div align="center">LAPORAN PENDASARAN PER PERIODE HABIS</div>
<div align="center">
<?php 
echo $detailpasar->pasar_nama;
?>
</div>
<div align="center">TEMPAT : <?php echo $detailtempat->tempat_nama; ?></div>
<div align="center">PERIODE : <?php echo $bulan.' '.$this->uri->segment(7)?></div>
<br>
<table align="center">
    <tr>
        <th width="5%">No</th>
        <th width="17%">No. Surat</th>
        <th width="12%">Tgl. Habis</th>
        <th width="15%">NPWRD</th>
        <th>Nama Pedagang</th>
        <th width="27%">Nama Pasar</th>
    </tr>
    <?php
    	$no = 1; 
    	foreach($daftarlist as $r) {
            $tgl_surat      = $r->dasar_sampai;
            $xtgl           = explode("-",$tgl_surat);
            $thn            = $xtgl[0];
            $bln            = $xtgl[1];
            $tgl            = $xtgl[2];
            $tanggal_srt    = $tgl.'-'.$bln.'-'.$thn;
    ?>
    <tr>
        <td align="center" valign="top"><?php echo $no; ?></td>                                
        <td valign="top"><?php echo $r->dasar_no; ?></td>
        <td align="center" valign="top"><?php echo $tanggal_srt; ?></td>
        <td align="center" valign="top"><?php echo $r->dasar_npwrd; ?></td>
        <td valign="top"><?php echo strtoupper($r->penduduk_nama); ?></td>
        <td valign="top"><?php echo ucwords($r->pasar_nama).' <b>('.$r->tempat_nama.')</b>'."<br>".'Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2'; ?></td>
    </tr>
    <?php 
        $no++;
    }
    ?>
  </table>
</div>

</body>
</html>