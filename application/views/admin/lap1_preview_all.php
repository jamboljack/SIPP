<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>img/kudus.jpg">
<title>Print Data Pedagang</title>
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

    .page {
        width: 29.7cm;
        min-height: 21cm;
        padding: 0cm;
        margin: 0.1cm auto;
        border: 0.3px #D3D3D3 none;
        border-radius: 2px;
        background: white;
    }
</style>

<style type="text/css">
	body{
        font-family: "Times New Roman"; 
        font-size:15px
    }
	
    h1{
        font-size:15px
    }	
</style>

<style>
@media print{
	#comments_controls,
	#print-link{
		display:none;
	}
}
</style>
</head>

<body>
<a href="#Print">
<img src="<?php echo base_url(); ?>img/print_icon.gif" height="36" width="32" title="Print" id="print-link" onClick="window.print(); return false;" />
</a>
<div class="page">
<div align="center">LAPORAN PEDAGANG</div>
<div align="center">
<?php 
echo $detailpasar->pasar_nama;
?>
</div>
<div align="center">SEMUA TEMPAT</div>
<br>
<table align="center">
    <tr>
        <th width="3%">No</th>
        <th width="10%">NPWRD</th>
        <th width="20%">Nama Pedagang</th>
        <th>Alamat</th>
        <th width="25%">Pasar</th>
        <th width="10%">Status</th>
    </tr>
    <?php
    foreach($listTempat as $d) {
        $tempat_id  = $d->tempat_id;
        $cekdata    = $this->lap1_model->select_detail_by_tempat($tempat_id)->result(); 
        if (count($cekdata) > 0) {
    ?>
    <tr>
        <td colspan='6'><b>Tempat : <?php echo $d->tempat_nama; ?></b></td>
    </tr>
    <?php
        $daftardetail = $this->lap1_model->select_detail_by_tempat($tempat_id)->result(); 
    	$no = 1; 
    	foreach($daftardetail as $r) {
    ?>
    <tr>
        <td valign="top"><?php echo $no; ?></td>                                
        <td valign="top" align="center"><?php echo $r->dasar_npwrd; ?></td>
        <td valign="top"><?php echo ucwords(strtolower($r->penduduk_nama)); ?></td>
        <td valign="top"><?php echo ucwords(strtolower($r->penduduk_alamat.' Desa '.$r->desa_nama.' Kec. '.$r->kecamatan_nama)).'<br>'.ucwords(strtolower($r->kabupaten_nama.' Provinsi '.$r->provinsi_nama)); ?></td>
        <td valign="top"><?php echo $r->pasar_nama.' <b>('.$r->tempat_nama.')</b>'."<br>".'Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2'; ?><br>Jenis : <b><?php echo $r->jenis_nama; ?></b></td>
        <td align="center" valign="top"><?php echo $r->dasar_status; ?></td>   
    </tr>
    <?php 
        $no++;
        }
        }
    }
    ?>
  </table>
</div>

</body>
</html>