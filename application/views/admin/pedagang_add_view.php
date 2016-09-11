<script type="text/javascript">
$(function() {
    $(document).on("click",'.pilih_alamat', function(e) {        
        var provinsi_id     = $(this).data('pid');
        var provinsi_nama   = $(this).data('pname');
        var kab_id          = $(this).data('kid');
        var kab_nama        = $(this).data('kname');        
        $(".provinsi_id").val(provinsi_id);
        $(".provinsi_nama").val(provinsi_nama);
        $(".kab_id").val(kab_id);
        $(".kabupaten_nama").val(kab_nama);
    })
});
</script>

<!-- List Provinsi, Kab, Kec, Desa -->
<div class="modal bs-modal-lg" id="carialamat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-header">                      
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-search"></i> Cari Data Alamat</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="8%">Pilih</th>                                
                                <th>Kabupaten</th>
                                <th>Provinsi</th>
                            </tr>
                        </thead>
                            
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($listAlamat as $a) {                            
                            ?>
                            <tr>
                                <td align="center">
                                    <button type="button" class="btn btn-success btn-xs pilih_alamat" data-toggle="modal" data-pid="<?php echo $a->provinsi_id; ?>" data-pname="<?php echo $a->provinsi_nama; ?>" data-kid="<?php echo $a->kabupaten_id; ?>" data-kname="<?php echo $a->kabupaten_nama; ?>" title="Pilih Alamat" data-dismiss="modal"><i class="icon-check"></i> Pilih
                                    </button>
                                </td>
                                <td><?php echo $a->kabupaten_nama; ?></td>
                                <td><?php echo $a->provinsi_nama; ?></td>
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
            Data Pedagang
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">                    
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>                
                <li>
                    <a href="#">Data</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                 <li>
                    <a href="<?php echo site_url('admin/pedagang'); ?>">Data Pedagang</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Tambah Data Pedagang</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus-square"></i> Form Tambah Pedagang
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/pedagang/savedata'); ?>" method="post" enctype="multipart/form-data">
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
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Enter N I K" name="nik" value="<?php echo set_value('nik'); ?>" pattern="^[0-9]*" title="Harus Angka" autocomplete="off" maxlength="16" required autofocus>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pedagang</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Pedagang" name="nama" value="<?php echo set_value('nama'); ?>" autocomplete="off" required>
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
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Alamat" name="alamat" value="<?php echo set_value('alamat'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Kabupaten</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control kabupaten_nama" placeholder="Enter Kabupaten" name="kabupaten" value="<?php echo set_value('kabupaten'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="input-group-btn btn-right">
                                            <a data-toggle="modal" href="#carialamat" title="Klik untuk Cari Data">
                                                <button class="btn blue-madison" type="button">
                                                <i class="fa fa-search"></i>
                                                </button>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Provinsi</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control provinsi_nama" placeholder="Enter Provinsi" name="provinsi" value="<?php echo set_value('provinsi'); ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
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
                                        <a href="<?php echo site_url('admin/pedagang'); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
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