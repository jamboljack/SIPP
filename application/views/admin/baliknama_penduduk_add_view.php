<script type="text/javascript">
    $(document).ready(function () {
        $("#provinsi_id").select2({
        });
        $("#kabupaten_id").select2({
        });
        $("#kecamatan_id").select2({
        });
        $("#kelurahan_id").select2({
        });
    });
</script>

<script type="text/javascript">
    function tampilKabupaten() {
        kdprop = document.getElementById("provinsi_id").value;
        $.ajax({
            url:"<?php echo base_url();?>admin/pendasaran/pilih_kabupaten/"+kdprop+"",
            success: function(response) {
                $("#kabupaten_id").html(response);
            },
            dataType:"html"
        });
        return false;
    }
     
    function tampilKecamatan() {
        kdkab = document.getElementById("kabupaten_id").value;
        $.ajax({
            url:"<?php echo base_url();?>admin/pendasaran/pilih_kecamatan/"+kdkab+"",
            success: function(response) {
                $("#kecamatan_id").html(response);
            },
            dataType:"html"
        });
        return false;
    }

    function tampilKelurahan() {
        kdkec = document.getElementById("kecamatan_id").value;
        $.ajax({
            url:"<?php echo base_url();?>admin/pendasaran/pilih_kelurahan/"+kdkec+"",
            success: function(response) {
                $("#kelurahan_id").html(response);
            },
            dataType:"html"
        });
        return false;
    }
</script>

<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Transaksi Pendasaran <small>Balik Nama</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">                    
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>                
                <li>
                    <a href="#">Transaksi Pendasaran</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo site_url('admin/baliknama'); ?>">Balik Nama</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo site_url('admin/baliknama/pilihpenduduk/'.$this->uri->segment(4)); ?>">Pilih Penduduk</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Tambah Penduduk</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus-square"></i> Form Tambah Penduduk
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/baliknama/savedatapenduduk/'.$this->uri->segment(4)); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" class="provinsi_id" name="provinsi_id" value="<?php echo set_value('provinsi_id'); ?>">
                        <input type="hidden" class="kab_id" name="kab_id" value="<?php echo set_value('kab_id'); ?>">                        

                            <div class="form-body">
                                <?php if ($error == 'true') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <b>ERROR !!</b> <br>
                                    <?php echo validation_errors(); ?>
                                </div>
                                <?php } ?>
                                <h3 class="form-section">Data Detail</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">N I K</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter N I K" name="nik" value="<?php echo set_value('nik'); ?>" pattern="^[0-9]*" title="Harus Angka" autocomplete="off" maxlength="16" required autofocus>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">No. KK</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter No. KK" name="no_kk" value="<?php echo set_value('no_kk'); ?>" pattern="^[0-9]*" title="Harus Angka" autocomplete="off" maxlength="16" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Penduduk</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Penduduk" name="nama" value="<?php echo set_value('nama'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tempat Lahir</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Enter Tempat Lahir" name="tmpt_lahir" value="<?php echo set_value('tmpt_lahir'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tanggal Lahir</label>
                                    <div class="col-md-3">
                                        <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" name="tgl_lahir" value="<?php echo set_value('tgl_lahir'); ?>" placeholder="DD-MM-YYYY" autocomplete="off" required />
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Jenis Kelamin</label>
                                    <div class="md-radio-inline col-md-9">
                                        <div class="md-radio">
                                            <input type="radio" name="rdJk" class="md-radiobtn" id="Jk1" value="1" <?php echo set_checkbox('rdJk', 1); ?> required>
                                            <label for="Jk1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Laki-Laki
                                            </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" name="rdJk" class="md-radiobtn" id="Jk2" value="2" <?php echo set_checkbox('rdJk', 2); ?> required>
                                            <label for="Jk2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Provinsi</label>
                                    <div class="col-md-9">
                                        <?php
                                        $style_provinsi = 'class="select2_category form-control" id="provinsi_id"  onChange="tampilKabupaten()"';
                                            echo form_dropdown('lstProvinsi',$provinsi,'',$style_provinsi);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Kabupaten</label>
                                    <div class="col-md-9">
                                        <?php
                                        $style_kabupaten = 'class="select2_category form-control" id="kabupaten_id" onChange="tampilKecamatan()"';
                                        echo form_dropdown("lstKabupaten",array('Pilih Kabupaten'=>'- Pilih Kabupaten -'),'',$style_kabupaten);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Kecamatan</label>
                                    <div class="col-md-9">
                                        <?php
                                        $style_kecamatan = 'class="select2_category form-control" id="kecamatan_id" onChange="tampilKelurahan()"';
                                        echo form_dropdown("lstKecamatan",array('Pilih Kecamatan'=>'- Pilih Kecamatan -'),'',$style_kecamatan);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Desa</label>
                                    <div class="col-md-9">
                                        <?php
                                        $style_kelurahan = 'class="select2_category form-control" id="kelurahan_id"';
                                        echo form_dropdown("lstKelurahan",array('Pilih Desa '=>'- Pilih Desa -'),'',$style_kelurahan);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Alamat" name="alamat" value="<?php echo set_value('alamat'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                        <span class="help-block">SAMPLE : NAMA ALAMAT RT : 999 RW : 999</span>
                                    </div>
                                </div>
                                <h3 class="form-section">Foto</h3>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Upload Foto</label>
                                    <div class="col-md-9 has-success">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?php echo base_url(); ?>img/no_image.gif" alt="" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;">
                                            </div>
                                            <div>
                                                <span class="btn btn-blue btn-file">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> Browse</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                                    <input type="file" class="default" name="userfile" />
                                                </span>                                             
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            <span class="label label-danger">NOTE !</span>
                                            <span>Resolution : 500 x 750 pixel</span>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Simpan</button>
                                        <a href="<?php echo site_url('admin/baliknama/pilihpenduduk/'.$this->uri->segment(4)); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
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