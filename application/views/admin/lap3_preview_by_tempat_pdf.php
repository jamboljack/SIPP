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
        font-size:11px
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
<div align="center">LAPORAN RETRIBUSI PEDAGANG</div>
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
        <th width="23%">No. Surat</th>                                
        <th width="20%">NPWRD</th>
        <th width="25%">Nama Pasar</th>
        <th width="10%">Tgl. Bayar</th>
        <th width="13%">Total</th>
    </tr>
    <?php
    	$no = 1;
        $tot = 0;
    	foreach($daftarlist as $r) {
            $ttl    = ($r->skrd_total+$r->skrd_bunga+$r->skrd_kenaikan);
            $total  = '<b>Rp. '.number_format($ttl, 0, '.', ',').'</b>';

            $tot    = ($tot + $ttl);

            $tgl_bayar  = $r->skrd_tgl_bayar;
            if (!empty($tgl_bayar)) {
                $xtgl           = explode("-",$tgl_bayar);
                $thn            = $xtgl[0];
                $bln            = $xtgl[1];
                $tgl            = $xtgl[2];
                $tanggal_byr    = $tgl.'-'.$bln.'-'.$thn;    
            } else {
                $tanggal_byr    = 'BELUM BAYAR';
            }
    ?>
    <tr>
        <td align="center" valign="top"><?php echo $no; ?></td>                                
        <td valign="top"><?php echo $r->skrd_no; ?></td>                                
        <td valign="top"><?php echo $r->dasar_npwrd.'<br>'.$r->penduduk_nama; ?></td>
        <td valign="top"><?php echo ucwords($r->pasar_nama).' <b>('.$r->tempat_nama.')</b>'."<br>".'Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2'; ?></td>        
        <td align="center" valign="top"><?php echo $tanggal_byr; ?></td>
        <td align="right" valign="top"><?php echo $total; ?></td>
    </tr>
    <?php 
        $no++;
    }
    ?>
    <tr>
        <td colspan="4" align="center"><b>SUB TOTAL : <?php echo $detailtempat->tempat_nama; ?></b></td>
        <td align="right" colspan="2"><?php echo '<b>Rp. '.number_format($tot, 0, '.', ',').'</b>'; ?></td>
    </tr>
  </table>
</div>

</body>
</html>