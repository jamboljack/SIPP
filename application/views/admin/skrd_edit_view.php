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

<script type="text/javascript">
    $(function() {
        $(document).on("click",'.edit_item', function(e) {
            var id          = $(this).data('id');
            var skrd_id     = $(this).data('skrd');
            var kode        = $(this).data('kode');
            var nama        = $(this).data('nama');
            var luas        = $(this).data('luas');
            var satuan      = $(this).data('satuan');
            var hari        = $(this).data('hari');
            var harga       = $(this).data('harga');
            var subtotal    = $(this).data('subtotal');
            $(".item_id").val(id);
            $(".item_skrd").val(skrd_id);
            $(".item_kode").val(kode);
            $(".item_nama").val(nama);
            $(".item_luas").val(luas);
            $(".item_satuan").val(satuan);
            $(".item_hari").val(hari);
            $(".item_harga").val(harga);
            $(".item_subtotal").val(subtotal);
        })
    });
</script>

<script type="text/javascript">
function HitungSubTotalItem(){
    var myForm2     = document.form2;
    var Luas        = parseFloat(myForm2.item_luas.value);
    var Harga       = parseFloat(myForm2.item_harga.value);
    var Hari        = parseFloat(myForm2.item_hari.value);

    var SubTotal    = (Luas*Harga*Hari);
    if (SubTotal > 0) {
        myForm2.item_subtotal.value = SubTotal; 
    } else {
        myForm2.item_subtotal.value = 0;
    }       
}
</script>

<!-- Edit Item Form -->
<div class="modal bs-modal-lg" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo site_url('admin/skrd/updatedataitem/'.$this->uri->segment(4)); ?>" class="form-horizontal" method="post" enctype="multipart/form-data" name="form2">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" class="form-control item_id" name="id">
            <input type="hidden" class="form-control item_skrd" name="skrd_id">
                        
            <div class="modal-header">                      
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Form Edit Item Retribusi</h4>
            </div>
            <div class="modal-body">              
                <div class="form-group form-md-line-input">
                    <label class="col-md-3 control-label">Kode Rekening</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control item_kode" name="kode" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-3 control-label">Uraian Retribusi</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control item_nama" name="nama" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-3 control-label">Luas</label>
                    <div class="col-md-2">
                        <input type="number" class="form-control item_luas" name="luas" id="item_luas" onkeydown="HitungSubTotalItem()" autocomplete="off" required>
                        <div class="form-control-focus"></div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-3 control-label">Satuan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control item_satuan" name="satuan" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-3 control-label">Tarif/Hari</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control item_harga" name="harga" id="item_harga" onkeydown="HitungSubTotalItem()" autocomplete="off" required>
                        <div class="form-control-focus"></div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-3 control-label">Jumlah Hari</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control item_hari" name="hari" id="item_hari" onkeydown="HitungSubTotalItem()" autocomplete="off" required>
                        <div class="form-control-focus"></div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-3 control-label">Sub Total</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control item_subtotal" name="subtotal" id="item_subtotal" autocomplete="off" readonly>
                    </div>
                </div>
            </div>
                        
            <div class="modal-footer">
                <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Update</button>
                <button type="button" class="btn yellow" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
            </form>
        </div>        
    </div>    
</div>

<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Transaksi Retribusi <small>SKRD</small>
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
                    <a href="<?php echo site_url('admin/skrd'); ?>">SKRD</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Edit Item SKRD</a>
                </li>
            </ul>               
        </div>            
                        
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Data Detail
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
                                    if ($detail->skrd_status == 0) {
                                        echo '<b>BELUM BAYAR</b>';
                                    } else {
                                        echo '<b>BAYAR</b>';
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
                                <th width="5%">Aksi</th>
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
                                <td align="center">
                                    <button type="button" class="btn btn-primary btn-xs edit_item" data-toggle="modal" data-target="#edit" data-id="<?php echo $r->item_id; ?>" data-skrd="<?php echo $r->skrd_id; ?>" data-kode="<?php echo $r->item_kode; ?>" data-nama="<?php echo $r->item_uraian; ?>" data-luas="<?php echo $r->item_luas; ?>" data-harga="<?php echo $r->item_tarif; ?>" data-satuan="<?php echo $r->item_satuan; ?>" data-hari="<?php echo $r->item_hari; ?>" data-subtotal="<?php echo $r->item_subtotal; ?>" title="Edit Data"><i class="icon-pencil"></i> Edit
                                    </button>
                                </td>
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
            <form role="form" action="<?php echo site_url('admin/skrd/updatedata'); ?>" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="id" value="<?php echo $detail->skrd_id; ?>">

                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="well">
                        <div class="row static-info align-reverse">
                            <div class="col-md-7 name">Total :</div>
                            <div class="col-md-4 value">
                                <input type="text" class="form-control" name="tahun" value="<?php echo number_format($detail->skrd_total, 0, '.', ','); ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="row static-info align-reverse">
                            <div class="col-md-7 name">Bunga :</div>
                            <div class="col-md-4 value">
                                <input type="text" class="form-control" name="bunga" value="<?php echo $detail->skrd_bunga; ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="row static-info align-reverse">
                            <div class="col-md-7 name">Kenaikan :</div>
                            <div class="col-md-4 value">
                                <input type="text" class="form-control" name="kenaikan" value="<?php echo $detail->skrd_kenaikan; ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Update</button>
                    <a href="<?php echo site_url('admin/skrd'); ?>" class="btn yellow">
                        <i class="fa fa-times"></i> Batal
                    </a>
                </div>
                
            </form>
        </div>            

        <div class="clearfix"></div>
    </div>
</div>