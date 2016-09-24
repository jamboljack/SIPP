<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>img/kudus.jpg">
<title>Print Surat Pendataan Pasar</title>
<style type="text/css">
	table {    
    	width: 100%;
	}

    tr, td {
        padding: 5px;
    }	

    .head1 {
        font-size: 18px;
        font-weight: normal;
        padding: 0px 0px 0px 0px;
        line-height: 5px;
    }

    .head2 {
        font-size: 22px;
        font-weight: bold;
        line-height: 5px;
    }

    .head3 {
        font-size: 15px;
        font-weight: normal;
        line-height: 5px;
    }

    .head4 {
        font-size: 15px;
        font-weight: normal;
        line-height: 5px;
    }

    .surat {
        font-size: 18px;
        font-weight: bold;
        line-height: 2px;
        text-align: center;
        text-decoration: underline;
    }

    .nomor {
        font-size: 15px;        
        line-height: 2px;
        text-align: center;
    }

    .aturan ol {
        padding: 10px;
    }

    li {
        padding: 5px;
    }	

	body{
        font-family: "Times New Roman"; 
        font-size:15px;
    }

	h1{
        font-size:15px
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

    .aturan {
        margin-left: 0;
        padding-right: 0;
        list-style-type: 1;
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
    <table width="100%" align="center" cellpadding="2" cellspacing="2">
        <tr>
            <td width="20%" align="center"><img src="<?php echo base_url(); ?>img/logokds.jpg" height="80%"></td>
            <td width="80%" align="center">
                <p class="head1">PEMERINTAH KABUPATEN KUDUS</p>
                <p class="head2">DINAS PERDAGANGAN DAN PENGELOLAAN PASAR</p>
                <p class="head3">Komplek Perkantoran Jl. Mejobo Nomor 45 Telp (0291) 4251050 - 437434</p>
                <p class="head4">KUDUS 59319</p>
            </td>            
        </tr>
    </table>
    <hr size="5px" color="#000000">
    <br>
    <p class="surat">DATA PASAR</p>
    <table align="center" width="100%">
        <tr>
            <td width="17%">Nama Pasar</td>
            <td colspan="5">: <?php echo $detail->pasar_nama; ?></td>
            <td width="15%">Tahun Berdiri</td>
            <td width="12%">: <?php echo $detail->pasar_thn_berdiri; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td colspan="7">: <?php echo $detail->pasar_alamat; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td width="8%">&nbsp;&nbsp;Desa</td>
            <td colspan="3">: <?php echo $detail->desa_nama; ?></td>
            <td width="12%">Kecamatan</td>
            <td colspan="2">: <?php echo $detail->kecamatan_nama; ?></td>
        </tr>
        <tr>
            <td>Koordinat</td>
            <td colspan="4">:&nbsp;Longitude : <?php echo $detail->pasar_long; ?></td>
            <td colspan="3">Latitude : <?php echo $detail->pasar_lat; ?></td>
        </tr>
        <tr>
            <td>Luas Tanah</td>
            <td colspan="2">: <?php echo number_format($detail->pasar_luas_tnh, 0, '.', ','); ?> m2</td>
            <td width="17%">Luas Bangunan</td>
            <td colspan="2">: <?php echo number_format($detail->pasar_luas_bangun, 0, '.', ','); ?> m2</td>
            <td>Jml. Lantai</td>
            <td>: <?php echo $detail->pasar_jml_lantai; ?></td>
        </tr>
        <tr>
            <td>Jml. LOS</td>
            <td colspan="2">: <?php echo number_format($detail->pasar_jml_los, 0, '.', ','); ?> unit</td>
            <td>Jml. Kios</td>
            <td colspan="2">: <?php echo number_format($detail->pasar_jml_kios, 0, '.', ','); ?> unit</td>
            <td>Jml. Dasaran</td>
            <td>: <?php echo $detail->pasar_jml_dasaran; ?></td>
        </tr>
        <tr>
            <td colspan="3">Operasional Pasar</td>
            <td colspan="5">:
            <?php 
			if ($detail->pasar_operasional == 'H') { // Harian
            	$checkH = 'checked';
                $checkM = '';
			} elseif ($detail->pasar_operasional == 'M') { // Mingguan
	            $checkH = '';
            	$checkM = 'checked';
            }
            ?> 
            <input type="radio" name="rOperasioanl" value="H" <?php echo $checkH; ?> disabled> Harian
            <input type="radio" name="rOperasioanl" value="M" <?php echo $checkM; ?> disabled> Mingguan</td>
        </tr>
        <tr>
            <td colspan="3">Bentuk Bangunan Pasar</td>
            <td colspan="5">:
            <?php 
            foreach ($listBentuk as $b) {
                if ($detail->bentuk_id == $b->bentuk_id) {
            ?>
            <input type="radio" name="rBentuk" value="<?php echo $b->bentuk_id; ?>" checked disabled> <?php echo ucwords(strtolower($b->bentuk_nama)); ?>          
            <?php } else { ?>
            <input type="radio" name="rBentuk" value="<?php echo $b->bentuk_id; ?>" disabled> <?php echo ucwords(strtolower($b->bentuk_nama)); ?>
            <?php 
		  	   }
            }
			?>
            </td>
        </tr>
        <tr>
            <td colspan="3">Kondisi Bangunan Pasar</td>
            <td colspan="5">:
            <?php 
            foreach ($listKondisi as $k) {
                if ($detail->kondisi_id == $k->kondisi_id) {
            ?>
            <input type="radio" name="rKondisi" value="<?php echo $k->kondisi_id; ?>" checked disabled> <?php echo ucwords(strtolower($k->kondisi_nama)); ?>          
            <?php } else { ?>
            <input type="radio" name="rKondisi" value="<?php echo $k->kondisi_id; ?>" disabled> <?php echo ucwords(strtolower($k->kondisi_nama)); ?>
            <?php 
		  	   }
            }
			?>
            </td>
        </tr>
        <tr>
            <td colspan="3">Surat Kepemilikan Lahan</td>
            <td colspan="5">:
            <?php 
            foreach ($listSurat as $s) {
                if ($detail->kepemilikan_id == $s->kepemilikan_id) {
            ?>
            <input type="radio" name="rLahan" value="<?php echo $s->kepemilikan_id; ?>" checked disabled> <?php echo ucwords(strtolower($s->kepemilikan_nama)); ?>          
            <?php } else { ?>
            <input type="radio" name="rLahan" value="<?php echo $s->kepemilikan_id; ?>" disabled> <?php echo ucwords(strtolower($s->kepemilikan_nama)); ?>
            <?php 
		  	   }
            }
			?>
            </td>
        </tr>
        <tr>
            <td>Omzet Pasar</td>
            <td colspan="7">:</td>
        </tr>
        <tr>
            <td>Harian</td>
            <td colspan="3">: <?php echo number_format($detail->pasar_omzet_hari, 0, '.', ','); ?></td>
            <td colspan="2">Mingguan</td>
            <td colspan="2">: <?php echo number_format($detail->pasar_omzet_minggu, 0, '.', ','); ?></td>
        </tr>
        <tr>
            <td>Bulanan</td>
            <td colspan="3">: <?php echo number_format($detail->pasar_omzet_bulan, 0, '.', ','); ?></td>
            <td colspan="2">Tahunan</td>
            <td colspan="2">: <?php echo number_format($detail->pasar_omzet_tahun, 0, '.', ','); ?></td>
        </tr>
        <!--<tr>
            <td>Jumlah Pedagang</td>
            <td colspan="7">:</td>
        </tr>
        <tr>
            <td> LOS</td>
            <td colspan="2">: Pedagang</td>
            <td>Kios</td>
            <td colspan="2">: Pedagang</td>
            <td>Dasaran</td>
            <td>: Pedagang</td>
        </tr>
        -->
        <tr>
            <td>Fasilitas Umum</td>
            <td colspan="7">:</td>
        </tr>
        <tr>
            <td>Areal Parkir</td>
            <td colspan="3">: <?php if ($detail->pasar_parkir==1) { echo 'Ada'; } ?></td>
            <td colspan="2">MCK</td>
            <td colspan="2">: <?php if ($detail->pasar_mck==1) { echo 'Ada'; } ?></td>
        </tr>
        <tr>
            <td>TPS</td>
            <td colspan="3">: <?php if ($detail->pasar_tps==1) { echo 'Ada'; } ?></td>
            <td colspan="2">Tempat Ibadah</td>
            <td colspan="2">: <?php if ($detail->pasar_mushola==1) { echo 'Ada'; } ?></td>
        </tr>
        <tr>
            <td>Pengelolaan Pasar</td>
            <td colspan="7">: <?php echo $detail->pasar_pengelola; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">Kudus, <?php echo tgl_indo(date('Y-m-d')); ?></td>
        </tr>
        <tr>
            <td colspan="4" align="center">Menyetujui</td>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" align="center">Koordinator <?php echo ucwords(strtolower($detail->pasar_nama)); ?></td>
            <td colspan="4" align="center">Petugas</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" align="center"><u><?php echo $detail->pasar_koordinator; ?></u><br>NIP. <?php echo $detail->pasar_nip; ?></td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
        </tr>
    </table>
</div>

</body>
</html>