<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>img/kudus.jpg">
<title>Print Surat Ketetapan Retribusi Daerah</title>
<style type="text/css">
	table {
    	border-collapse: collapse;
	}
	
	tr, td {
        padding: 2px;
    }
	
	body{
        font-family: "Calibri"; 
        font-size: 14px;
    }
	
	h1{
        font-size: 15px
    }
	.page {
		width: 21cm;
		min-height: 59.4cm;
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
<div class="page">
SURAT KETETAPAN RETRIBUSI DAERAH
<table width="100%" border="1" align="center">
    <tr>
        <th colspan="6" align="center">
            <p>PEMERINTAH KABUPATEN KUDUS<br>
            TANDA BUKTI PEMBAYARAN<br>
            Nomor Bukti : <?php echo $detail->skrd_no; ?>
            </p>
        </th>            
    </tr>
    <tr>
        <td colspan="6" align="center">
            <table width="100%" align="center">
                <tr>
                    <td width="19">a.</td>
                    <td colspan="4">Bendahara Penerimaan / Bendahara Penerimaan Pembantu</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">Telah menerima uang sebesar</td>
                    <td colspan="2">
                    : Rp. <?php $total = ($detail->skrd_total+$detail->skrd_bunga+$detail->skrd_kenaikan);  
                    echo number_format($total, 0, '.', ','); ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">Terbilang</td>
                    <td colspan="2">: <?php echo ucwords(strtolower(terbilang($total))); ?> Rupiah</td>
                </tr>
                <tr>
                    <td>b.</td>
                    <td width="154">Dari Nama</td>
                    <td width="223">: <?php echo $detail->penduduk_nama; ?></td>
                    <td width="144" align="center">NPWRD</td>
                    <td width="222">: <?php echo $detail->dasar_npwrd; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat</td>
                    <td colspan="3">
                    : <?php echo ucwords(strtolower($detail->penduduk_alamat.' '.$detail->kabupaten_nama)); ?>
                    </td>
                </tr>
                <tr>
                    <td>c.</td>
                    <td>Sebagai Pembayaran</td>
                    <td>: Retribusi <?php echo $detail->pasar_nama; ?></td>
                    <td align="center">Bulan</td>
                    <td>: <?php echo $bulan.' '.$detail->skrd_tahun; ?></td>
                </tr>
                <tr>
                    <td colspan="5">
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
                                $no = 1; 
                                foreach($daftarItem as $i) { 
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
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>d.</td>
                    <td>Tanggal diterima uang</td>
                    <td colspan="3">:</td>
                </tr>
                <tr>
                    <td colspan="3" align="center">Mengetahui</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">Bendahara Penerimaan/Bendahara Pembantu</td>
                    <td colspan="2" align="center">Pembayar/Penyetor</td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><p></p>
                    <p><b><u><?php echo $petugas->pasar_koordinator; ?></u></b><br>NIP : <?php echo $petugas->pasar_nip; ?>
                    </p></td>
                    <td colspan="2" align="center"><p></p>
                    <p><b><?php echo $detail->penduduk_nama; ?></b></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Lembar Asli</td>
                    <td colspan="3">: Untuk Pembayar/Penyetor/Pihak Ketiga</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Salinan 1</td>
                    <td colspan="3">: Untuk Bendahara Penerimaan, Bendahara Pembantu</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Salinan 2</td>
                    <td colspan="3">: Arsip</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
SURAT KETETAPAN RETRIBUSI DAERAH
<table width="100%" border="1" align="center">
    <tr>
        <th colspan="6" align="center">
            <p>
            PEMERINTAH KABUPATEN KUDUS<br>
            TANDA BUKTI PEMBAYARAN<br>
            Nomor Bukti : <?php echo $detail->skrd_no; ?></p>
        </th>            
    </tr>
    <tr>
        <td colspan="6" align="center">
          	<table width="100%" align="center">
                <tr>
                	<td width="19">a.</td>
                	<td colspan="4">Bendahara Penerimaan / Bendahara Penerimaan Pembantu</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">Telah menerima uang sebesar</td>
                    <td colspan="2">: Rp. <?php $total = ($detail->skrd_total+$detail->skrd_bunga+$detail->skrd_kenaikan);
                    echo number_format($total, 0, '.', ','); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">Terbilang</td>
                    <td colspan="2">: <?php echo ucwords(strtolower(terbilang($total))); ?> Rupiah</td>
                </tr>
                <tr>
                    <td>b.</td>
                    <td width="154">Dari Nama</td>
                    <td width="223">: <?php echo $detail->penduduk_nama; ?></td>
                    <td width="144" align="center">NPWRD</td>
                    <td width="222">: <?php echo $detail->dasar_npwrd; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat</td>
                    <td colspan="3">: <?php echo ucwords(strtolower($detail->penduduk_alamat.' '.$detail->penduduk_rt.'/'.$detail->penduduk_rw.' '.$detail->kabupaten_nama)); ?></td>
                </tr>
                <tr>
                    <td>c.</td>
                    <td>Sebagai Pembayaran</td>
                    <td>: Retribusi <?php echo $detail->pasar_nama; ?></td>
                    <td align="center">Bulan</td>
                    <td>: <?php echo $bulan.' '.$detail->skrd_tahun; ?></td>
                </tr>
                <tr>
                    <td colspan="5">
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
                                $no = 1; 
                                foreach($daftarItem as $i) { 
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
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>d.</td>
                    <td>Tanggal diterima uang</td>
                    <td colspan="3">:</td>
                </tr>
                <tr>
                    <td colspan="3" align="center">Mengetahui</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" align="center">Bendahara Penerimaan/Bendahara Pembantu</td>
                    <td colspan="2" align="center">Pembayar/Penyetor</td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><p>&nbsp;</p>
                    <p><b><u><?php echo $petugas->pasar_koordinator; ?></u></b><br>NIP : <?php echo $petugas->pasar_nip; ?>
                    </p></td>
                    <td colspan="2" align="center"><p>&nbsp;</p>
                    <p><b><?php echo $detail->penduduk_nama; ?></b></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Lembar Asli</td>
                    <td colspan="3">: Untuk Pembayar/Penyetor/Pihak Ketiga</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Salinan 1</td>
                    <td colspan="3">: Untuk Bendahara Penerimaan, Bendahara Pembantu</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Salinan 2</td>
                    <td colspan="3">: Arsip</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

SURAT KETETAPAN RETRIBUSI DAERAH
<table width="100%" border="1" align="center">
        <tr>
            <th width="25%" colspan="4" align="center">
              <p>PEMERINTAH<br>
                KABUPATEN KUDUS
              </p>
            </th>
            <th width="50%" align="center">SURAT KETETAPAN RETRIBUSI DAERAH<br>
              (SKRD)              <br></th>
            <th width="25%" align="center"> NOMOR BUKTI<br><?php echo $detail->skrd_no; ?></th>            
        </tr>
        <tr>
          <td colspan="6" align="center">
          	<table width="100%" align="center">
            <tr>
              <td width="196" align="right">&nbsp;</td>
              <td width="94">Masa</td>
              <td width="386" colspan="3">: <?php echo $bulan; ?></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td>Tahun</td>
              <td colspan="3">: <?php echo $detail->skrd_tahun; ?></td>
            </tr>
            <tr>
              <td colspan="2" align="right">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">Nama</td>
              <td colspan="3">: <?php echo $detail->penduduk_nama; ?></td>
              </tr>
            <tr>
              <td colspan="2">Alamat</td>
              <td colspan="3">: <?php echo ucwords(strtolower($detail->penduduk_alamat.' '.$detail->penduduk_rt.'/'.$detail->penduduk_rw.' '.$detail->kabupaten_nama)); ?></td>
              </tr>
            <tr>
              <td colspan="2">Nomor Pokok Wajib Retribusi Daerah (NPWRD)</td>
              <td colspan="3">: <?php echo $detail->dasar_npwrd; ?></td>
              </tr>
            <tr>
              <td colspan="2">Tanggal Jatuh Tempo</td>
              <td colspan="3">: <?php echo tgl_indo($detail->skrd_tgl_tempo); ?></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="5">
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
                  <td>Dengan Huruf</td>
                  <td colspan="4">:  <?php echo ucwords(strtolower(terbilang($total))); ?> Rupiah</td>
              </tr>
              <tr>
                <td colspan="5" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3">PERHATIAN :</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5">1. Harap Penyetoran dilakukan pada Pembantu Bendahara Penerima di Kantor Pasar</td>
              </tr>
              <tr>
                <td colspan="5">2. Apabila SKR ini tidak atau kurang dibayar lewat waktu paling lama 30 hari setelah SKR diterima atau (tanggal jatuh tempo) </td>
              </tr>
              <tr>
                <td colspan="5">dikenakan sanksi administrasi berupa bunga sebesar 2% per bulan</td>
              </tr>
            </table>
          </td>
       </tr>
       <tr>
       	<td colspan="6" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
       	  <tr>
       	    <td width="50%">&nbsp;</td>
       	    <td align="center">KUDUS, <?php echo tgl_indo(date('Y-m-d')); ?></td>
   	      </tr>
       	  <tr>
       	    <td>&nbsp;</td>
       	    <td align="center"><?php echo $kadin->petugas_title_kadin; ?></td>
   	      </tr>
       	  <tr>
       	    <td>&nbsp;</td>
       	    <td>&nbsp;</td>
   	      </tr>
       	  <tr>
       	    <td>&nbsp;</td>
       	    <td>&nbsp;</td>
   	      </tr>
       	  <tr>
       	    <td>&nbsp;</td>
       	    <td>&nbsp;</td>
   	      </tr>
       	  <tr>
       	    <td>&nbsp;</td>
       	    <td>&nbsp;</td>
   	      </tr>
       	  <tr>
       	    <td>&nbsp;</td>
       	    <td>&nbsp;</td>
   	      </tr>
       	  <tr>
       	    <td>&nbsp;</td>
       	    <td align="center"><b><u><?php echo $kadin->petugas_nama_kadin; ?></u></b></td>
   	      </tr>
       	  <tr>
       	    <td>&nbsp;</td>
       	    <td align="center"><?php echo $kadin->petugas_jab_kadin; ?></td>
   	      </tr>
       	  <tr>
       	    <td>&nbsp;</td>
       	    <td align="center">NIP. <?php echo $kadin->petugas_nik_kadin; ?></td>
   	      </tr>
     	  </table>
    </tr>
    <tr>
    	<td colspan="6">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

        </td>
    </tr>
    </table>

</div>

</body>
</html>