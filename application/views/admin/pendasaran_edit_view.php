<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>

<?php 
if ($this->session->flashdata('notification')) { ?>
<script>
    swal({
        title: "Warning",
        text: "<?php echo $this->session->flashdata('notification'); ?>",
        timer: 2000,
        showConfirmButton: false,
        type: 'warning'
    });
</script>
<? } ?>

<script type="text/javascript">
$(function() {
    $(document).on("click",'.pilih_pedagang', function(e) {        
        var pedagang_id     = $(this).data('id');
        var pedagang_nik     = $(this).data('nik');
        var pedagang_nama   = $(this).data('nama');        
        $(".pedagang_id").val(pedagang_id);
        $(".pedagang_nik").val(pedagang_nik);
        $(".pedagang_nama").val(pedagang_nama);
    })
});
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#lstPasar").select2({
        });
        $("#lstJenis").select2({
        });        
    });
</script>

<script language="JavaScript" type="text/JavaScript">
function myPasar() { 
    var x               = document.getElementById("lstPasar");         
    var pasar_inisial   = x.options[(x.selectedIndex)].getAttribute('data-inisial');
    var pasar_kode      = x.options[(x.selectedIndex)].getAttribute('data-kode');
    var pasar_alamat    = x.options[(x.selectedIndex)].getAttribute('data-alamat');
    var kecamatan       = x.options[(x.selectedIndex)].getAttribute('data-kecamatan');
    var desa            = x.options[(x.selectedIndex)].getAttribute('data-desa');
    document.getElementById("pasar_kode").value = pasar_kode;
    document.getElementById("pasar_inisial").value = pasar_inisial;
    document.getElementById("alamat").value = pasar_alamat+', DESA '+desa+', KECAMATAN '+kecamatan;    
}
</script>

<script language="JavaScript" type="text/JavaScript">
function myJenis() { 
    var j               = document.getElementById("lstJenis");
    var jenis_kode      = j.options[(j.selectedIndex)].getAttribute('data-kode');    
    document.getElementById("jenis_kode").value = jenis_kode;    
}
</script>

<script type="text/javascript">
function HitungLuas(){
    var myForm1     = document.form1;
    var Panjang     = parseInt(myForm1.panjang.value);    
    var Lebar       = parseInt(myForm1.lebar.value);
    
    var Luas    = (Panjang*Lebar);    
    if (Luas > 0) {
        myForm1.luas.value = Luas; 
    } else {
        myForm1.luas.value = 0;
    }       
}
</script>

<!-- List Pedagang -->
<div class="modal bs-modal-lg" id="caripedagang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-header">                      
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-search"></i> Cari Data Pedagang</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="8%">Pilih</th>
                                <th width="12%">N I K</th>
                                <th>Nama Pedagang</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                            
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($listPedagang as $p) {                            
                            ?>
                            <tr>
                                <td align="center">
                                    <button type="button" class="btn btn-success btn-xs pilih_pedagang" data-toggle="modal" data-id="<?php echo $p->pedagang_id; ?>" data-nik="<?php echo $p->pedagang_nik; ?>" data-nama="<?php echo $p->pedagang_nama; ?>" title="Pilih Alamat" data-dismiss="modal"><i class="icon-check"></i> Pilih
                                    </button>
                                </td>
                                <td><?php echo $p->pedagang_nik; ?></td>
                                <td><?php echo $p->pedagang_nama; ?></td>
                                <td><?php echo $p->pedagang_alamat; ?></td>
                            </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn yellow" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                </div>
            </form>
        </div>        
    </div>    
</div>

<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Transaksi <small>Surat Pendasaran</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">                    
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>                
                <li>
                    <a href="#">Transaksi</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                 <li>
                    <a href="<?php echo site_url('admin/pendasaran'); ?>">Surat Pendasaran</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Edit Surat Pendasaran</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i> Form Edit Surat Pendasaran
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/pendasaran/updatedata/'.$this->uri->segment(4)); ?>" method="post" enctype="multipart/form-data" name="form1">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="id" value="<?php echo $detail->dasar_id; ?>">
                        <input type="hidden" class="pedagang_id" name="pedagang_id" value="<?php echo $detail->pedagang_id; ?>">
                        <input type="hidden" name="pasar_inisial" id="pasar_inisial" value="<?php echo $detail->pasar_inisial; ?>">
                        <input type="hidden" name="pasar_kode" id="pasar_kode" value="<?php echo $detail->pasar_kode; ?>">
                        <input type="hidden" name="jenis_kode" id="jenis_kode" value="<?php echo $detail->jenis_kode; ?>">
                        <input type="hidden" name="status_print" value="<?php echo $detail->dasar_st_print; ?>">

                            <div class="form-body">
                                <h3 class="form-section">Data Surat Pendasaran</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">No Surat</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Enter No Surat" name="no" value="<?php echo $detail->dasar_no; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">NPWRD</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Enter NPWRD" name="npwrd" value="<?php echo $detail->dasar_npwrd; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
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
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tanggal Surat</label>
                                    <div class="col-md-3">
                                        <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" name="tgl_surat" value="<?php echo $tanggal_srt; ?>" placeholder="DD-MM-YYYY" autocomplete="off" disabled />
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Periode Berlaku</label>
                                    <div class="col-md-9">                                
                                        <div class="input-group input-large" data-date="<?php echo date('Y-m-d'); ?>" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control default-date-picker" name="tgl1" placeholder="DD-MM-YYYY" value="<?php echo $tanggal_dari; ?>" required autofocus>
                                            <div class="form-control-focus"></div>
                                            <span class="input-group-addon"><b>s/d</b></span>
                                            <input type="text" class="form-control default-date-picker" name="tgl2" placeholder="DD-MM-YYYY" value="<?php echo $tanggal_sampai; ?>" required>
                                            <div class="form-control-focus"></div>
                                        </div>                                        
                                    </div> 
                                </div>
                                <h3 class="form-section">Data Pedagang</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">N I K</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control pedagang_nik" placeholder="Enter N I K" name="nik" value="<?php echo $detail->pedagang_nik; ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="input-group-btn btn-right">
                                            <a data-toggle="modal" href="#caripedagang" title="Klik untuk Cari Data">
                                                <button class="btn blue-madison" type="button">
                                                <i class="fa fa-search"></i>
                                                </button>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pedagang</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control pedagang_nama" placeholder="Enter Nama Pedagang" name="nama" value="<?php echo $detail->pedagang_nama; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <h3 class="form-section">Data Pasar</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jenis Dagangan</label>
                                    <div class="col-md-9">
                                        <select class="select2_category form-control" data-placeholder="- Pilih Jenis Dagangan -" name="lstJenis" id="lstJenis" onchange="myJenis()" required>
                                            <option value="">- Pilih Jenis Dagangan -</option>
                                            <?php
                                            foreach($listJenis as $j) {
                                                if ($detail->jenis_id == $j->jenis_id) {
                                            ?>php
                                            <option value="<?php echo $j->jenis_id; ?>" data-kode="<?php echo $j->jenis_kode; ?>" selected><?php echo $j->jenis_nama; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $j->jenis_id; ?>" data-kode="<?php echo $j->jenis_kode; ?>"><?php echo $j->jenis_nama; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pasar</label>
                                    <div class="col-md-9">
                                        <select class="select2_category form-control" data-placeholder="- Pilih Nama Pasar -" name="lstPasar" id="lstPasar" onchange="myPasar()" disabled>
                                            <option value="">- Pilih Nama Pasar -</option>
                                            <?php
                                            foreach($listPasar as $p) {
                                                if ($detail->pasar_id == $p->pasar_id) {
                                            ?>php
                                            <option value="<?php echo $p->pasar_id; ?>" data-inisial="<?php echo $p->pasar_inisial; ?>" data-kode="<?php echo $p->pasar_kode; ?>" data-alamat="<?php echo $p->pasar_alamat; ?>" data-kecamatan="<?php echo $p->kecamatan_nama; ?>" data-desa="<?php echo $p->desa_nama; ?>" selected><?php echo $p->pasar_nama; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $p->pasar_id; ?>" data-inisial="<?php echo $p->pasar_inisial; ?>" data-kode="<?php echo $p->pasar_kode; ?>" data-alamat="<?php echo $p->pasar_alamat; ?>" data-kecamatan="<?php echo $p->kecamatan_nama; ?>" data-desa="<?php echo $p->desa_nama; ?>"><?php echo $p->pasar_nama; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Alamat Pasar" name="alamat" value="<?php echo $detail->pasar_alamat.', DESA '.$detail->desa_nama.', KECAMATAN '.$detail->kecamatan_nama; ?>" id="alamat" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Jenis Tempat</label>
                                    <div class="md-radio-inline col-md-9">
                                        <?php 
                                        $no = 1;
                                        foreach ($listTempat as $t) {
                                            if ($detail->tempat_id == $t->tempat_id) {
                                        ?>
                                        <div class="md-radio">
                                            <input type="radio" name="rdTempat" class="md-radiobtn" id="<?php echo 'radio'.$no; ?>" value="<?php echo $t->tempat_id; ?>" checked required>
                                            <label for="<?php echo 'radio'.$no; ?>">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> <?php echo $t->tempat_nama; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="md-radio">
                                            <input type="radio" name="rdTempat" class="md-radiobtn" id="<?php echo 'radio'.$no; ?>" value="<?php echo $t->tempat_id; ?>" required>
                                            <label for="<?php echo 'radio'.$no; ?>">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> <?php echo $t->tempat_nama; ?>
                                            </label>
                                        </div>
                                        <?php 
                                            }
                                        $no++; 
                                        } 
                                        ?>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Blok</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Blok Tempat" name="blok" value="<?php echo $detail->dasar_blok; ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nomor</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Nomor Tempat" name="nomor" value="<?php echo $detail->dasar_nomor; ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Panjang</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Panjang Tempat" name="panjang" id="panjang" value="<?php echo $detail->dasar_panjang; ?>" onkeydown="HitungLuas()" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Lebar</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Lebar Tempat" name="lebar" id="lebar" value="<?php echo $detail->dasar_lebar ?>" onkeydown="HitungLuas()" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Luas Lokasi (m2)</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Luas Lokasi (m2)" name="luas" value="<?php echo $detail->dasar_luas; ?>" id="luas" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Update</button>
                                        <a href="<?php echo site_url('admin/pendasaran'); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>            
</div>  