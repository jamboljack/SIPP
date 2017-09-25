<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>img/kudus.jpg">
<title>Print Surat Pendasaran</title>
<style type="text/css">
	table {    
    	width: 100%;
	}

    tr, td {
        padding: 2px;
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
        font-size: 20px;
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
<?php

$tgl_dari           = $detail->dasar_dari;
if (!empty($tgl_dari)) {
    $xtgld          = explode("-",$tgl_dari);
    $thnd           = $xtgld[0];
    $blnd           = $xtgld[1];
    $tgld           = $xtgld[2];
    $tanggal_dari   = $tgld.'-'.$blnd.'-'.$thnd;
} else {
    $tanggal_dari   = '';
}

$tgl_sampai         = $detail->dasar_sampai;
if (!empty($tgl_sampai)) {
    $xtgls          = explode("-",$tgl_sampai);
    $thns           = $xtgls[0];
    $blns           = $xtgls[1];
    $tgls           = $xtgls[2];
    $tanggal_sampai = $tgls.'-'.$blns.'-'.$thns;
} else {
    $tanggal_sampai = '';
}
?>
<div class="page">
    <table width="100%" align="center" cellpadding="2" cellspacing="2">
        <tr>
            <td width="20%" align="center"></td>
            <td width="80%" align="center">
                <br><br><br><br><br><br>
            </td>            
        </tr>
    </table>
    <br>
    <p class="surat">SURAT PENDASARAN</p>
    <p class="nomor">Nomor : <?php echo $detail->dasar_no; ?></p>
    <br><br>
    <ol class="aturan">
    <li>Dasar :<br>
    Peraturan Daerah Kabupaten Kudus Nomor 14 Tahun 2012 tentang Retribusi Pelayanan Pasar.
    </li>
    <li>Diberikan Kepada :<br>    
    <table width="100%">
        <tr>
            <td>N I K</td>
            <td>:</td>
            <td><b><?php echo $detail->penduduk_nik; ?></b></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><b><?php echo $detail->penduduk_nama; ?></b></td>
        </tr>
        <tr>
            <td>Tempat, Tgl. Lahir</td>
            <td>:</td>
            <td><?php echo ucwords(strtolower($detail->penduduk_tmpt_lhr)).', '.tgl_indo($detail->penduduk_tgl_lahir); ?></td>
        </tr>
        <tr>
            <td valign="top">Alamat</td>
            <td valign="top">:</td>
            <td><?php echo ucwords(strtolower($detail->penduduk_alamat)).' Desa '.ucwords(strtolower($detail->desa_nama)).' Kecamatan '.ucwords(strtolower($detail->kecamatan_nama)).'<br>'.ucwords(strtolower($detail->kabupaten_nama)).' - '.ucwords(strtolower($detail->provinsi_nama)); ?>
            </td>
        </tr>
    </table>
    </li>
    <li>
    Untuk menggunakan/menempati tempat pendasaran <b><?php echo ucwords(strtolower($detail->tempat_nama)).' '.ucwords(strtolower($detail->pasar_nama)); ?></b>, Blok/Kring <b><?php echo $detail->dasar_blok; ?></b>, Nomor <b><?php echo $detail->dasar_nomor; ?></b>, Ukuran <b><?php echo $detail->dasar_panjang.' x '.$detail->dasar_lebar; ?> m</b>, dengan jenis barang dagangan : <b><?php echo $detail->jenis_nama; ?></b>.
    </li>
    <li>Dengan persyaratan :<br>
    <ol type="a">
      	<li>Mentaati semua ketentuan yang diatur dalam Peraturan Daerah Kabupaten Kudus Nomor 14 Tahun 2012 dan ketentuan peraturan perundang-undangan lainnya yang berlaku.</li>
      	<li>Mentaati petunjuk dari Dinas Perdagangan Kabupaten Kudus.</li>
      	<li>Surat Pendasaran ini berlaku mulai tanggal <b><?php echo tgl_indo($detail->dasar_dari); ?></b> sampai dengan tanggal <b><?php echo tgl_indo($detail->dasar_sampai); ?></b> dan dapat diperbaharui.</li>
      	<li>Pendasaran sewaktu-waktu dapat dicabut apabila pemegang izin melakukan pelanggaran terhadap ketentuan peraturan perundang-undangan yang berlaku.</li>        
   	</ol>
    </li>
    </ol>
    <br>    
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
            <td width="60%">&nbsp;</td>
            <td width="15%">Dikeluarkan di</td>
            <td width="35%">: Kudus</td>
        </tr>
        <tr>
            <!--<span id="datetime"></span>-->
            <td>&nbsp;</td>
            <td>Pada Tanggal</td>
            <td>: <?php echo tgl_indo(date('Y-m-d')); ?></td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
            <td width="15%" align="center" valign="top">
                <?php if (!empty($detail->penduduk_foto)) { ?>
                    <img src="<?php echo base_url(); ?>penduduk_image/<?php echo $detail->penduduk_foto; ?>" width="100%">
                <?php } ?>
            </td>
            <td width="40%" align="center" valign="top">PEDAGANG<br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <b><u><?php echo $detail->penduduk_nama; ?></u></b>
            </td>
            <td width="45%" align="center" valign="top">
            <?php echo $petugas->petugas_title_kadin; ?><br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <b><u><?php echo $petugas->petugas_nama_kadin; ?></u></b><br>
            <?php echo $petugas->petugas_jab_kadin; ?><br>
            NIP. <?php echo $petugas->petugas_nik_kadin; ?>
            </td>
        </tr>
    </table>
</div>

</body>
</html>

<!-- Menampilkan Tanggal Client Side -->
<!--<script src="<?php // echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">
var dt = new Date();
document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
</script>-->