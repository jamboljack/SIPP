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

<script language="JavaScript" type="text/JavaScript">
function myPasar() { 
    var x         = document.getElementById("lstPasar");
    var kode      = x.options[(x.selectedIndex)].getAttribute('data-kode');
    var kelas     = x.options[(x.selectedIndex)].getAttribute('data-kelas');
    document.getElementById("kode_pasar").value = kode;
    document.getElementById("kelas_id").value = kelas;
}
</script>

<script language="JavaScript" type="text/JavaScript">
function myTempat() { 
    var t         = document.getElementById("lstTempat");
    var kode      = t.options[(t.selectedIndex)].getAttribute('data-kode');
    document.getElementById("kode_tempat").value = kode;
}
</script>

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
                    <a href="#">Buat SKRD</a>
                </li>
            </ul>
        </div>            
                        
        <div class="row">
            <div class="col-md-12">                
                <div class="portlet-body form">
                    <form role="form" class="form-horizontal" name="formInput" action="<?php echo site_url('admin/skrd/savedata'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="kode_tempat" id="kode_tempat" value="<?php echo set_value('kode_tempat'); ?>">
                    <input type="hidden" name="kode_pasar" id="kode_pasar" value="<?php echo set_value('kode_pasar'); ?>">
                    <input type="hidden" name="kelas_id" id="kelas_id" value="<?php echo set_value('kelas_id'); ?>">

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Periode</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="lstBulan" id="lstBulan" onchange="myDay()" required autofocus>
                                                <option value="">- Pilih Bulan -</option>
                                                <option value="1" <?php echo set_select('lstBulan', 1); ?>>Januari</option>
                                                <option value="2" <?php echo set_select('lstBulan', 2); ?>>Februari</option>
                                                <option value="3" <?php echo set_select('lstBulan', 3); ?>>Maret</option>
                                                <option value="4" <?php echo set_select('lstBulan', 4); ?>>April</option>
                                                <option value="5" <?php echo set_select('lstBulan', 5); ?>>Mei</option>
                                                <option value="6" <?php echo set_select('lstBulan', 6); ?>>Juni</option>
                                                <option value="7" <?php echo set_select('lstBulan', 7); ?>>Juli</option>
                                                <option value="8" <?php echo set_select('lstBulan', 8); ?>>Agustus</option>
                                                <option value="9" <?php echo set_select('lstBulan', 9); ?>>September</option>
                                                <option value="10" <?php echo set_select('lstBulan', 10); ?>>Oktober</option>
                                                <option value="11" <?php echo set_select('lstBulan', 11); ?>>November</option>
                                                <option value="12" <?php echo set_select('lstBulan', 12); ?>>Desember</option>
                                            </select>
                                            <div class="form-control-focus"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder="Tahun" name="tahun" id="tahun" onkeyup="myDay()" value="<?php echo date('Y'); ?>" autocomplete="off">
                                            <div class="form-control-focus"></div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Jumlah Hari</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="jumlahhari" id="jumlahhari" value="<?php echo set_value('jumlahhari'); ?>" pattern="^[0-9]*" title="Harus Angka" autocomplete="off" maxlength="2" required>
                                            <div class="form-control-focus"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Pasar</label>
                                        <div class="col-md-9">
                                            <select class="form-control" data-placeholder="- Pilih Nama Pasar -" name="lstPasar" id="lstPasar" onchange="myPasar()" required>
                                                <option value="">- Pilih Nama Pasar -</option>
                                                <?php
                                                foreach($listPasar as $p) {
                                                ?>php
                                                <option value="<?php echo $p->pasar_id; ?>" <?php echo set_select('lstPasar', $p->pasar_id); ?> data-kode="<?php echo $p->pasar_kode; ?>" data-kelas="<?php echo $p->kelas_id; ?>"><?php echo $p->pasar_nama; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="form-control-focus"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Tempat</label>
                                        <div class="col-md-6">
                                            <select class="form-control" data-placeholder="- Pilih Jenis Tempat -" name="lstTempat" id="lstTempat" onchange="myTempat()" required>
                                                <option value="">- Pilih Jenis Tempat -</option>
                                                <?php
                                                foreach($listTempat as $t) {
                                                ?>php
                                                <option value="<?php echo $t->tempat_id; ?>" <?php echo set_select('lstTempat', $t->tempat_id); ?> data-kode="<?php echo $t->tempat_kode; ?>"><?php echo ucwords(strtolower($t->tempat_nama)); ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="form-control-focus"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn blue-madison" type="submit">
                                        <i class="fa fa-floppy-o"></i> Create
                                    </button>
                                    <a href="<?php echo site_url('admin/skrd'); ?>" class="btn yellow">
                                        <i class="fa fa-times"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<script>
var hitunghari=function(bulan,taun){
    return new Date(taun, bulan, 0).getDate();
}

function myDay() {
    var myForm      = document.formInput;
    var mm_o        = document.getElementById("lstBulan").options;
    var mm_s        = document.getElementById("lstBulan").selectedIndex;
    var yy_o        = parseInt(myForm.tahun.value);
    var j_hari      = hitunghari(mm_s, yy_o);
    document.getElementById("jumlahhari").value = j_hari;
}
</script> 