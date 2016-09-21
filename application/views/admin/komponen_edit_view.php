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
                    <a href="#">Edit Komponen Retribusi</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i> Form Edit Komponen Retribusi
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/komponen/updatedata'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" value="<?php echo $detail->komponen_id; ?>" name="id">

                            <div class="form-body">                              
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Kode Rekening</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter Kode Rekening" name="kode" value="<?php echo $detail->komponen_kode; ?>" pattern="^[0-9]*" title="Harus ANGKA" maxlength="9" autocomplete="off" autofocus>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Uraian Komponen</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Uraian Komponen" name="uraian" value="<?php echo $detail->komponen_uraian; ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Type Komponen</label>
                                    <div class="md-radio-inline col-md-9">
                                        <?php 
                                            if ($detail->komponen_type == 'M') { // Menu
                                                $checkM = 'checked';
                                                $checkS = '';
                                            } elseif ($detail->komponen_type == 'S') { // Sub Menu
                                                $checkM = '';
                                                $checkS = 'checked';
                                            } else {
                                                $checkM = '';
                                                $checkS = '';
                                            }
                                        ?>
                                        <div class="md-radio">
                                            <input type="radio" id="radio1" name="rdType" class="md-radiobtn" value="M" <?php echo $checkM; ?> required>
                                            <label for="radio1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> MENU
                                            </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="radio2" name="rdType" class="md-radiobtn" value="S" <?php echo $checkS; ?> required>
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
                                        <input type="text" class="form-control" name="tarif" value="<?php echo $detail->komponen_tarif; ?>" pattern="^[0-9]*" title="Harus ANGKA" maxlength="10" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Satuan</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="satuan" value="<?php echo $detail->komponen_satuan; ?>" maxlength="5" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Update</button>
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