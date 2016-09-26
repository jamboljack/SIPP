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
<?php
// Tgl. Surat
$tgl_surat      = $detail->dasar_tgl_surat;
if (!empty($tgl_surat)) {
    $xtgl           = explode("-",$tgl_surat);
    $thn            = $xtgl[0];
    $bln            = $xtgl[1];
    $tgl            = $xtgl[2];
    $tanggal_srt    = $tgl.'-'.$bln.'-'.$thn;
} else {
    $tanggal_srt    = '';
}

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
            <td width="15%">NPWRD</td>
            <td width="5%">:</td>
            <td width="80%"><b><?php echo $detail->dasar_npwrd; ?></b></td>
        </tr>
        <tr>
            <td>N I K</td>
            <td>:</td>
            <td><b><?php echo $detail->penduduk_nik; ?></b></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?php echo $detail->penduduk_nama; ?></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>:</td>
            <td><?php echo age($detail->penduduk_tgl_lahir); ?> Tahun</td>
        </tr>
        <tr>
            <td valign="top">Alamat</td>
            <td valign="top">:</td>
            <td><?php echo ucwords(strtolower($detail->penduduk_alamat)).' RT. '.$detail->penduduk_rt.'/'.$detail->penduduk_rw.' Desa '.ucwords(strtolower($detail->desa_nama)).' Kecamatan '.ucwords(strtolower($detail->kecamatan_nama)).'<br>'.ucwords(strtolower($detail->kabupaten_nama)).' - '.ucwords(strtolower($detail->provinsi_nama)); ?>
            </td>
        </tr>
    </table>
    </li>
    <li>
    Untuk menggunakan/menempati tempat pendasaran Los/Kios : <?php echo $detail->tempat_nama; ?> <?php echo $detail->pasar_nama; ?>, Lokasi Los/Kios : Blok/Kring <?php echo $detail->dasar_blok; ?>, Nomor <?php echo $detail->dasar_nomor; ?>, Ukuran <?php echo $detail->dasar_panjang.'x'.$detail->dasar_lebar; ?> m, Jenis barang dagangan : <?php echo $detail->jenis_nama; ?>
    </li>
    <li>Dengan persyaratan :<br>
    <ol type="a">
      	<li>Mentaati semua ketentuan yang diatur dalam Peraturan Daerah Kabupaten Kudus Nomor 14 Tahun 2012 dan ketentuan peraturan perundang-undangan lainnya yang berlaku.</li>
      	<li>Mentaati petunjuk dari Dinas Perdagangan dan Pengelolaan Pasar.</li>
      	<li>Surat Izin ini berlaku mulai tanggal <b><?php echo $tanggal_dari; ?></b> sampai dengan tanggal <b><?php echo $tanggal_sampai; ?></b> dan dapat diperbaharui.</li>
      	<li>Izin sewaktu-waktu dapat dicabut apabila pemegang izin melakukan pelanggaran terhadap ketentuan peraturan perundang-undangan yang berlaku.</li>        
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
            <td>&nbsp;</td>
            <td>Pada Tanggal</td>
            <td>: <?php echo date('d-m-Y'); ?></td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
            <td width="15%" align="center" valign="top">
                <?php if (!empty($detail->penduduk_foto)) { ?>
                    <img src="<?php echo base_url(); ?>penduduk_image/<?php echo $detail->penduduk_foto; ?>" width="100%">
                <?php } ?>
            </td>
            <td width="40%" align="center" valign="top">Pemegang Izin<br>
            <br>
            <br>
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
            KABUPATEN KUDUS
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