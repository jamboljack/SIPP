<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>img/kudus.jpg">
<title>Print Kwitansi Pembayaran SKRD</title>
<style type="text/css">
	table {
    	border-collapse: collapse;
	}

	tr, td {
        padding: 1px;
    }

	body{
        font-family: "Calibri";
        font-size: 14px;
    }

    .page {
		left:5px;
        right:5px;
        height:5.51in ; /*Ukuran Panjang Kertas */
        width: 8.50in; /*Ukuran Lebar Kertas */
        margin: 0.1cm auto;
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
<?php
$bln        = $detail->skrd_bulan;
switch ($bln) {
    case 1:
        $bulan = "JANUARI";
        break;
    case 2:
        $bulan = "FEBRUARI";
        break;
    case 3:
        $bulan = "MARET";
        break;
    case 4:
        $bulan = "APRIL";
        break;
    case 5:
        $bulan = "MEI";
        break;
    case 6:
        $bulan = "JUNI";
        break;
    case 7:
        $bulan = "JULI";
        break;
    case 8:
        $bulan = "AGUSTUS";
        break;
    case 9:
        $bulan = "SEPTEMBER";
        break;
    case 10:
        $bulan = "OKTOBER";
        break;
    case 11:
        $bulan = "NOVEMBER";
        break;
    case 12:
        $bulan = "DESEMBER";
        break;
}
?>
<body>
<a href="#Print">
<img src="<?php echo base_url(); ?>img/print_icon.gif" height="25" width="23" title="Print" id="print-link" onClick="window.print(); return false;" />
</a>
<a href="<?php echo site_url('admin/retribusi'); ?>" id="print-link"> Kembali ke Retribusi</a>
<div class="page">
<table width="100%" border="1" align="center">
    <tr>
        <td colspan="6" align="center">
            <b> TANDA BUKTI PEMBAYARAN<br>
            Nomor Bukti : <?php echo $detail->skrd_no; ?></b>
        </td>
    </tr>
    <tr>
        <td colspan="6" align="center">
            <table width="100%" align="center">
                <tr>
                    <td width="19">a.</td>
                    <td colspan="5">Bendahara Penerimaan / Bendahara Penerimaan Pembantu</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Telah menerima uang sebesar</td>
                    <td colspan="4"><b>
                    : Rp. <?php $total = ($detail->skrd_total+$detail->skrd_bunga+$detail->skrd_kenaikan);
                    echo number_format($total, 0, '.', ','); ?> <b>(<?php echo ucwords(strtolower(terbilang($total))); ?> Rupiah )</b></b>                    </td>
                </tr>
                <tr>
                    <td>b.</td>
                    <td width="236">Dari Nama</td>
                    <td colspan="2">: <?php echo $detail->penduduk_nama; ?></td>
                    <td width="72">NPWRD</td>
                    <td width="221">: <?php echo $detail->dasar_npwrd; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat</td>
                    <td colspan="4">
                    : <?php echo ucwords(strtolower($detail->penduduk_alamat.' '.$detail->kabupaten_nama)); ?>
                    </td>
                </tr>
                <tr>
                    <td>c.</td>
                    <td>Sebagai Pembayaran</td>
                    <td colspan="2">: Retribusi <?php echo ucwords(strtolower($detail->pasar_nama)); ?></td>
                    <td>Bulan</td>
                    <td>: <?php echo $bulan.' '.$detail->skrd_tahun; ?></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <table width="95%" border="1" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                                <td width="5%" align="center">No</td>
                                <td width="18%" align="center">Kode Rekening</td>
                                <td width="37%" align="center">Uraian Retribusi</td>
                                <td width="9%" align="right">Luas</td>
                                <td width="9%" align="right">Tarif /hari</td>
                                <td width="8%" align="right">Jml. Hari</td>
                                <td width="15%" align="right">Jumlah (Rp)</td>
                            </tr>
                            <?php
                                $subtotal = 0;
                                $no = 1;
                                foreach($daftarItem as $i) {
                                    $subtotal = ($subtotal + $i->item_subtotal);
                            ?>
                            <tr>
                                <td align="center"><?php echo $no; ?></td>
                                <td><?php echo $i->item_kode; ?></td>
                                <td><?php echo $i->item_uraian; ?></td>
                                <td align="right"><?php echo $i->item_luas.' '.$i->item_satuan; ?></td>
                                <td align="right"><?php echo $i->item_tarif; ?></td>
                                <td align="right"><?php echo $i->item_hari; ?></td>
                                <td align="right"><?php echo number_format($i->item_subtotal, 0, '.', ','); ?></td>
                            </tr>
                            <?php
                                $no++;
        				    }
        				    ?>
                            <tr>
                            <td colspan="2" rowspan="4" align="center">&nbsp;</td>
                            <td colspan="4">Jumlah Ketetapan Pokok Retribusi</td>
                            <td align="right"><?php echo number_format($subtotal, 0, '.', ','); ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Sanksi</td>
                            <td colspan="3">a. Bunga</td>
                            <td align="right"><?php echo number_format($detail->skrd_bunga, 0, '.', ','); ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="3">b. Kenaikan</td>
                            <td align="right"><?php echo number_format($detail->skrd_kenaikan, 0, '.', ','); ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">Jumlah Keseluruhan</td><?php $total = ($detail->skrd_bunga+$detail->skrd_kenaikan+$detail->skrd_total); ?>
                            <td align="right"><?php echo number_format($total, 0, '.', ','); ?></td>
                        </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>d.</td>
                    <td>Tanggal diterima uang</td>
                    <td colspan="4">: <b><?php echo tgl_indo($detail->skrd_tgl_bayar); ?></b></td>
                </tr>
                </table>
                <table align="center" width="100%">
                <tr>
                    <td colspan="3" align="center">Bendahara Penerimaan/Bendahara Pembantu</td>
                    <td width="54%" colspan="3" align="center">Pembayar/Penyetor</td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><p><b><u><br>
                    <?php echo $petugas->pasar_koordinator; ?></u></b><br>NIP : <?php echo $petugas->pasar_nip; ?>
                    </p></td>
                    <td colspan="3" align="center"><p></p>
                    <p><b><?php echo $detail->penduduk_nama; ?></b></p></td>
                </tr>
                <tr>
                    <td width="2%"></td>
                    <td width="13%">Lembar Asli</td>
                    <td colspan="4">: Untuk Pembayar/Penyetor/Pihak Ketiga</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Salinan 1</td>
                    <td colspan="4">: Untuk Bendahara Penerimaan, Bendahara Pembantu</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Salinan 2</td>
                    <td colspan="4">: Arsip</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>

</body>
</html>