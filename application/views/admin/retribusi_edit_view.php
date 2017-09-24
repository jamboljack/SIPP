<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>
<?php
if ($this->session->flashdata('notification')) { ?>
<script>
    swal({
        title: "Done",
        text: "<?php echo $this->session->flashdata('notification'); ?>",
        timer: 2000,
        showConfirmButton: false,
        type: 'success'
    });
</script>
<? } ?>

<script type="text/javascript">
function HitungKembalian(){
    var myForm1     = document.form1;
    var Total       = parseFloat(myForm1.totaltagih.value);
    var JumlahBayar = parseFloat(myForm1.jumlahbayar.value);
    console.log(Total, JumlahBayar);

    var Kembalian   = (JumlahBayar - Total);
    if (Kembalian > 0) {
        myForm1.kembalian.value = Kembalian;
    } else {
        myForm1.kembalian.value = 0;
    }
}
</script>

<?php
$bln        = $detail->skrd_bulan;
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

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            Transaksi Retribusi <small>Pembayaran Retribusi</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Transaksi Retribusi</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo site_url('admin/retribusi'); ?>">Pembayaran Retribusi</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Proses Pembayaran Retribusi</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Data Pedagang
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group-control">
                                                <input type="text" class="form-control" name="no_bukti" value="<?php echo $detail->skrd_no; ?>" readonly>
                                                <label for="form_control_1">No. Bukti</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group-control">
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $detail->dasar_npwrd.' / '.$bulan.' '.$detail->skrd_tahun; ?>" readonly>
                                                <label for="form_control_1">NPWRD / Periode</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group-control">
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $detail->pasar_nama; ?>" readonly>
                                                <label for="form_control_1">Pasar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group-control">
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $detail->penduduk_nik; ?>" readonly>
                                                <label for="form_control_1">N I K</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group-control">
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $detail->penduduk_nama; ?>" readonly>
                                                <label for="form_control_1">Nama Pedagang</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group-control">
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $detail->penduduk_alamat.' '.$detail->kabupaten_nama; ?>" readonly>
                                                <label for="form_control_1">Alamat</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Detail Surat Ketetapan Retribusi Daerah
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $tgl_trans  = $detail->skrd_tgl;

                        if (!empty($tgl_trans)) {
                            $mtgl           = explode("-",$tgl_trans);
                            $thn            = $mtgl[0];
                            $bln            = $mtgl[1];
                            $tgl            = $mtgl[2];
                            $tanggal_tr     = $tgl.'-'.$bln.'-'.$thn;
                        } else {
                            $tanggal_tr     = date('d-m-Y');
                        }
                        ?>
                        <div class="invoice">
                            <div class="row invoice-logo">
                                <div class="col-xs-6">
                                    <p>
                                    <b>TOTAL</b>
                                    <span class="muted">
                                    Status :
                                    <?php
                                    if ($detail->skrd_status == 1) {
                                        echo '<b>BELUM BAYAR</b>';
                                    } else {
                                        echo '<b>BAYAR</b>';
                                    }

                                    if ($detail->skrd_status == 2) {
                                        echo " / ".tgl_indo($detail->skrd_tgl_bayar)." / Kasir : ".$detail->user_username;
                                    }
                                    ?>
                                    </span>
                                    </p>
                                </div>
                                <div class="col-xs-6">
                                <p>
                                <b><?php $total = ($detail->skrd_total+$detail->skrd_bunga+$detail->skrd_kenaikan); echo number_format($total, 0, '.', ','); ?></b>
                                <span class="muted">No. Bukti : <b><?php echo $detail->skrd_no; ?> / <?php echo $tanggal_tr; ?></b></span>
                                </p>
                                </div>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>

                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Item Retribusi
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Kode Rekening</th>
                                <th>Uraian Retribusi</th>
                                <th width="10%">Luas</th>
                                <th width="10%">Tarif/Hari</th>
                                <th width="10%">Jml. Hari</th>
                                <th width="10%">Sub Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            foreach($daftarItem as $r) {
                                $item_id = $r->item_id;
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $r->item_kode; ?></td>
                                <td><?php echo $r->item_uraian; ?></td>
                                <td align="right"><?php echo $r->item_luas.' '.$r->item_satuan; ?></td>
                                <td align="right"><?php echo $r->item_tarif; ?></td>
                                <td align="right"><?php echo $r->item_hari; ?></td>
                                <td align="right"><?php echo number_format($r->item_subtotal, 0, '.', ','); ?></td>
                            </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <form role="form" action="<?php echo site_url('admin/retribusi/updatedata/'.$this->uri->segment(4)); ?>" method="post" name="form1">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="id" value="<?php echo $detail->skrd_id; ?>">
            <input type="hidden" id="totaltagih" value="<?php echo $total; ?>">

                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="well">
                        <div class="row static-info align-reverse">
                            <div class="col-md-7 name">Total :</div>
                            <div class="col-md-4 value">
                                <input type="text" class="form-control" name="total" value="<?php echo number_format($detail->skrd_total, 0, '.', ','); ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="row static-info align-reverse">
                            <div class="col-md-7 name">Bunga :</div>
                            <div class="col-md-4 value">
                                <input type="text" class="form-control" name="bunga" value="<?php echo number_format($detail->skrd_bunga, 0, '.', ','); ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="row static-info align-reverse">
                            <div class="col-md-7 name">Kenaikan :</div>
                            <div class="col-md-4 value">
                                <input type="text" class="form-control" name="kenaikan" value="<?php echo number_format($detail->skrd_kenaikan, 0, '.', ','); ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="row static-info align-reverse">
                            <div class="col-md-7 name"><b>Jumlah Bayar :</b></div>
                            <div class="col-md-4 value">
                                <input type="text" class="form-control" name="jumlahbayar" id="jumlahbayar" value="<?php echo $detail->skrd_bayar; ?>" onkeydown="HitungKembalian()" autocomplete="off">
                            </div>
                        </div>
                        <div class="row static-info align-reverse">
                            <div class="col-md-7 name"><b>Kembalian :</b></div>
                            <div class="col-md-4 value">
                                <input type="text" class="form-control" name="kembalian" id="kembalian" value="<?php echo $detail->skrd_kembali; ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Bayar</button>
                    <?php if ($detail->skrd_status == 1) { ?>
                    <a href="<?php echo site_url('admin/retribusi/printdata/'.$this->uri->segment(4)); ?>" class="btn blue"><i class="fa fa-print"></i> Print
                    </a>
                    <?php } ?>
                    <a href="<?php echo site_url('admin/retribusi'); ?>" class="btn yellow">
                        <i class="fa fa-times"></i> Batal
                    </a>
                </div>

            </form>
        </div>

        <div class="clearfix"></div>
    </div>
</div>