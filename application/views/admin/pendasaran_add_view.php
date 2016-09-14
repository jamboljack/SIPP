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
                    <a href="#">Tambah Surat Pendasaran</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus-square"></i> Form Tambah Surat Pendasaran
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/pendasaran/savedata/'.$this->uri->segment(4)); ?>" method="post" enctype="multipart/form-data" name="form1">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="pedagang_id" value="<?php echo $detailpedagang->pedagang_id; ?>">
                        <input type="hidden" name="pasar_inisial" id="pasar_inisial" value="<?php echo set_value('pasar_inisial'); ?>">
                        <input type="hidden" name="pasar_kode" id="pasar_kode" value="<?php echo set_value('pasar_kode'); ?>">
                        <input type="hidden" name="jenis_kode" id="jenis_kode" value="<?php echo set_value('jenis_kode'); ?>">

                            <div class="form-body">
                                <h3 class="form-section">Data Pedagang</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">N I K</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter N I K" name="nik" value="<?php echo $detailpedagang->pedagang_nik; ?>" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pedagang</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Pedagang" name="nama" value="<?php echo $detailpedagang->pedagang_nama; ?>" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <?php
                                    $tgl_lahir      = $detailpedagang->pedagang_tgl_lahir;
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
                                        <textarea class="form-control" name="alamat" rows="2" placeholder="Enter Description" required><?php echo $detailpedagang->pedagang_alamat.' RT.'.$detailpedagang->pedagang_rt.'/'.$detailpedagang->pedagang_rw.' KAB. '.$detailpedagang->kabupaten_nama.' PROV. '.$detailpedagang->provinsi_nama; ?></textarea>
                                    </div>
                                </div>
                                <h3 class="form-section">Data Surat Pendasaran</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tanggal Surat</label>
                                    <div class="col-md-3">
                                        <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" name="tgl_surat" value="<?php echo set_value('tgl_surat', date('d-m-Y')); ?>" placeholder="DD-MM-YYYY" autocomplete="off" required autofocus/>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Periode Berlaku</label>
                                    <div class="col-md-9">                                
                                        <div class="input-group input-large" data-date="<?php echo date('Y-m-d'); ?>" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control default-date-picker" name="tgl1" placeholder="DD-MM-YYYY" value="<?php echo set_value('tgl1', date('d-m-Y')); ?>" required>
                                            <div class="form-control-focus"></div>
                                            <span class="input-group-addon"><b>s/d</b></span>
                                            <input type="text" class="form-control default-date-picker" name="tgl2" placeholder="DD-MM-YYYY" value="<?php echo set_value('tgl2', date('d-m-Y')); ?>" required>
                                            <div class="form-control-focus"></div>
                                        </div>                                        
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
                                            ?>php
                                            <option value="<?php echo $j->jenis_id; ?>" <?php echo set_select('lstJenis', $j->jenis_id); ?> data-kode="<?php echo $j->jenis_kode; ?>"><?php echo $j->jenis_nama; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pasar</label>
                                    <div class="col-md-9">
                                        <select class="select2_category form-control" data-placeholder="- Pilih Nama Pasar -" name="lstPasar" id="lstPasar" onchange="myPasar()" required>
                                            <option value="">- Pilih Nama Pasar -</option>
                                            <?php
                                            foreach($listPasar as $p) {
                                            ?>php
                                            <option value="<?php echo $p->pasar_id; ?>" <?php echo set_select('lstPasar', $p->pasar_id); ?> data-inisial="<?php echo $p->pasar_inisial; ?>" data-kode="<?php echo $p->pasar_kode; ?>" data-alamat="<?php echo $p->pasar_alamat; ?>" data-kecamatan="<?php echo $p->kecamatan_nama; ?>" data-desa="<?php echo $p->desa_nama; ?>"><?php echo $p->pasar_nama; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Alamat Pasar" name="alamat" value="<?php echo set_value('alamat'); ?>" id="alamat" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Jenis Tempat</label>
                                    <div class="md-radio-inline col-md-9">
                                        <?php 
                                        $no = 1;
                                        foreach ($listTempat as $t) {
                                        ?>
                                        <div class="md-radio">
                                            <input type="radio" name="rdTempat" class="md-radiobtn" id="<?php echo 'radio'.$no; ?>" value="<?php echo $t->tempat_id; ?>" <?php echo set_checkbox('rdTempat', $t->tempat_id); ?> required>
                                            <label for="<?php echo 'radio'.$no; ?>">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> <?php echo $t->tempat_nama; ?>
                                            </label>
                                        </div>
                                        <?php 
                                        $no++; 
                                        } 
                                        ?>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Blok</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Blok Tempat" name="blok" value="<?php echo set_value('blok'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nomor</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Nomor Tempat" name="nomor" value="<?php echo set_value('nomor'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Panjang</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Panjang Tempat" name="panjang" id="panjang" value="<?php echo set_value('panjang', 0); ?>" onkeydown="HitungLuas()" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Lebar</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Lebar Tempat" name="lebar" id="lebar" value="<?php echo set_value('lebar', 0); ?>" onkeydown="HitungLuas()" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Luas Lokasi (m2)</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Luas Lokasi (m2)" name="luas" value="<?php echo set_value('luas', 0); ?>" id="luas" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Simpan</button>
                                        <a href="<?php echo site_url('admin/pendasaran/pilihpedagang'); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
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