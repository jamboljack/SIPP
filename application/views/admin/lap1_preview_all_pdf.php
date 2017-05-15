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

<body>
<div>
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
        <th width="5%">No</th>
        <th width="17%">NPWRD</th>
        <th width="20%">Nama Pedagang</th>
        <th>Alamat</th>
        <th width="25%">Pasar</th>
    </tr>
    <?php
    foreach($listTempat as $d) {
        $tempat_id  = $d->tempat_id;
        $cekdata    = $this->lap1_model->select_detail_by_tempat($tempat_id)->result(); 

        if (count($cekdata) > 0) {
    ?>
    <tr>
        <td colspan='5'><b>Tempat : <?php echo $d->tempat_nama; ?></b></td>
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