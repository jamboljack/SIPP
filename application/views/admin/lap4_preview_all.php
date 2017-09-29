<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>img/kudus.jpg">
<title>Print Laporan Pembayaran Retribusi</title>
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
        width: 21cm;
        min-height: 29.7cm;
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
        font-size:12px
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
<div align="center">LAPORAN PEMBAYARAN RETRIBUSI</div>
<div align="center">
<?php 
echo $detailpasar->pasar_nama;
?>
</div>

<div align="center">PERIODE : <?php echo strtoupper(tgl_indo($this->uri->segment(6))).' s/d '.strtoupper(tgl_indo($this->uri->segment(7))); ?></div>
<div align="center">SEMUA TEMPAT</div>
<br>
<table align="center">
    <tr>
        <th width="4%">No</th>
        <th width="18%">No. Surat</th>                                
        <th width="20%">NPWRD</th>
        <th width="30%">Nama Pasar</th>
        <th width="12%">Tgl. Bayar</th>
        <th width="13%">Total</th>
    </tr>
    <?php
    foreach($listTempat as $d) {
        $tempat_id  = $d->tempat_id;
        $cekdata    = $this->lap4_model->select_detail_by_tempat($tempat_id)->result(); 
        if (count($cekdata) > 0) {
    ?>
    <tr>
        <td colspan='6'><b>Tempat : <?php echo $d->tempat_nama; ?></b></td>
    </tr>
    <?php
        $daftardetail = $this->lap4_model->select_detail_by_tempat($tempat_id)->result();     	
        $no     = 1; 
        $tot    = 0;
    	foreach($daftardetail as $r) {
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
        <td colspan="4" align="center"><b>SUB TOTAL : <?php echo $d->tempat_nama; ?></b></td>
        <td align="right" colspan="2"><?php echo '<b>Rp. '.number_format($tot, 0, '.', ',').'</b>'; ?></td>
    </tr>
    <?php
        }
    }
    ?>
    <tr>
        <td colspan="4" align="center"><b>TOTAL PEMBAYARAN :</b></td>
        <td align="right" colspan="2"><?php echo '<b>Rp. '.number_format($detail->totalbayar, 0, '.', ',').'</b>'; ?></td>
    </tr>
</table>
</div>

</body>
</html>