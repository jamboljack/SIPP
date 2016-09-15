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
                        <input type="hidden" class="penduduk_id" name="penduduk_id" value="<?php echo $detail->penduduk_id; ?>">
                        <input type="hidden" name="pasar_inisial" id="pasar_inisial" value="<?php echo $detail->pasar_inisial; ?>">
                        <input type="hidden" name="pasar_kode" id="pasar_kode" value="<?php echo $detail->pasar_kode; ?>">
                        <input type="hidden" name="jenis_kode" id="jenis_kode" value="<?php echo $detail->jenis_kode; ?>">
                        <input type="hidden" name="status_print" value="<?php echo $detail->dasar_st_print; ?>">

                            <div class="form-body">
                                <h3 class="form-section">Data Pedagang</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">N I K</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter N I K" name="nik" value="<?php echo $detail->penduduk_nik; ?>" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pedagang</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Pedagang" name="nama" value="<?php echo $detail->penduduk_nama; ?>" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <?php
                                    $tgl_lahir      = $detail->penduduk_tgl_lahir;
                                    $xtgl           = explode("-",$tgl_lahir);
                                    $thn            = $xtgl[0];
                                    $bln            = $xtgl[1];
                                    $tgl            = $xtgl[2];
                                    $tanggal_lhr    = $tgl.'-'.$bln.'-'.$thn;
                                ?>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tanggal Lahir</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="tgl_lahir" value="<?php echo $tanggal_lhr; ?>" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="alamat" rows="2" readonly><?php echo $detail->penduduk_alamat.' RT.'.$detail->penduduk_rt.'/'.$detail->penduduk_rw.' DESA '.$detail->desa_nama.' KEC. '.$detail->kecamatan_nama.' KAB. '.$detail->kabupaten_nama.' PROV. '.$detail->provinsi_nama; ?></textarea>
                                    </div>
                                </div>
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
                                    $tanggal_srt    = date('d-m-Y');
                                }

                                $tgl_dari           = $detail->dasar_dari;
                                if (!empty($tgl_dari)) {
                                    $xtgld          = explode("-",$tgl_dari);
                                    $thnd           = $xtgld[0];
                                    $blnd           = $xtgld[1];
                                    $tgld           = $xtgld[2];
                                    $tanggal_dari   = $tgld.'-'.$blnd.'-'.$thnd;
                                } else {
                                    $tanggal_dari   = date('d-m-Y');
                                }

                                $tgl_sampai         = $detail->dasar_sampai;
                                if (!empty($tgl_sampai)) {
                                    $xtgls          = explode("-",$tgl_sampai);
                                    $thns           = $xtgls[0];
                                    $blns           = $xtgls[1];
                                    $tgls           = $xtgls[2];
                                    $tanggal_sampai = $tgls.'-'.$blns.'-'.$thns;
                                } else {
                                    $tanggal_sampai = date('d-m-Y');
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
                                <h3 class="form-section">Data Pasar</h3>
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
                                        <input type="text" class="form-control" placeholder="Alamat Pasar" name="alamat" value="<?php echo $detail->pasar_alamat.', DESA '.$detail->desa_pasar.', KECAMATAN '.$detail->kecamatan_pasar; ?>" id="alamat" autocomplete="off" readonly>
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
                                        <input type="text" class="form-control" placeholder="Luas Lokasi (m2)" name="luas" value="<?php echo $detail->dasar_luas; ?>" id="luas" autocomplete="off" readonly>
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