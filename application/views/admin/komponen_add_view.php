<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Setting <small>Komponen Retribusi</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">                    
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>                
                <li>
                    <a href="#">Setting</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                 <li>
                    <a href="<?php echo site_url('admin/komponen'); ?>">Komponen Retribusi</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Tambah Komponen Retribusi</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus-square"></i> Form Tambah Komponen Retribusi
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/komponen/savedata'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <div class="form-body">
                                <?php if ($error == 'true') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <b>ERROR !!</b> <br>
                                    <?php echo validation_errors(); ?>
                                </div>
                                <?php } ?>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Kode Rekening</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter Kode Rekening" name="kode" value="<?php echo set_value('kode'); ?>" pattern="^[0-9]*" title="Harus ANGKA" maxlength="9" autocomplete="off" autofocus>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Uraian Komponen</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Uraian Komponen" name="uraian" value="<?php echo set_value('uraian'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Type Komponen</label>
                                    <div class="md-radio-inline col-md-9">
                                        <div class="md-radio">
                                            <input type="radio" id="radio1" name="rdType" class="md-radiobtn" value="M" <?php echo set_checkbox('rdType', 'M'); ?> required>
                                            <label for="radio1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> MENU
                                            </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="radio2" name="rdType" class="md-radiobtn" value="S" <?php echo set_checkbox('rdType', 'S'); ?> required>
                                            <label for="radio2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> SUB MENU
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tarif per Hari</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="tarif" value="<?php echo set_value('tarif', 0); ?>" pattern="^[0-9]*" title="Harus ANGKA" maxlength="10" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Simpan</button>
                                        <a href="<?php echo site_url('admin/komponen'); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
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