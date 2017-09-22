<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Data <small>Data Penduduk</small>
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
                    <a href="<?php echo site_url('admin/penduduk'); ?>">Data Penduduk</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Edit Data Penduduk</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i> Form Edit Penduduk
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/penduduk/updatedata'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" value="<?php echo $detail->penduduk_id; ?>" name="id">
                        <input type="hidden" class="provinsi_id" name="provinsi_id" value="<?php echo $detail->provinsi_id; ?>">
                        <input type="hidden" class="kab_id" name="kab_id" value="<?php echo $detail->kabupaten_id; ?>">

                            <div class="form-body">
                                <h3 class="form-section">Data Detail</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">N I K</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter N I K" name="nik" value="<?php echo $detail->penduduk_nik; ?>" pattern="^[0-9]*" title="Harus Angka" autocomplete="off" maxlength="16" required autofocus>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">No. KK</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter No. KK" name="no_kk" value="<?php echo $detail->penduduk_no_kk; ?>" pattern="^[0-9]*" title="Harus Angka" autocomplete="off" maxlength="16" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Penduduk</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Penduduk (30 Karakter)" name="nama" value="<?php echo $detail->penduduk_nama; ?>" maxlength="30" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
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
                                        <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" name="tgl_lahir" value="<?php echo $tanggal_lhr; ?>" placeholder="DD-MM-YYYY" autocomplete="off" required />
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Jenis Kelamin</label>
                                    <div class="md-radio-inline col-md-9">
                                        <div class="md-radio">
                                            <?php 
                                            if ($detail->penduduk_jk == 'Laki-Laki') {
                                                $checkL = 'checked';
                                                $checkP = '';
                                            } elseif ($detail->penduduk_jk == 'Perempuan') {
                                                $checkL = '';
                                                $checkP = 'checked';
                                            } else {
                                                $checkL = '';
                                                $checkP = '';
                                            }
                                            ?>
                                            <input type="radio" name="rdJk" class="md-radiobtn" id="Jk1" value="Laki-Laki" <?php echo $checkL; ?> required>
                                            <label for="Jk1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Laki-Laki
                                            </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" name="rdJk" class="md-radiobtn" id="Jk2" value="Perempuan" <?php echo $checkP; ?>>
                                            <label for="Jk2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Area</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="alamat" value="<?php echo 'DESA '.$detail->desa_nama.', KEC.'.$detail->kecamatan_nama.', KAB. '.$detail->kabupaten_nama.' PROV. '.$detail->provinsi_nama; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Alamat" name="alamat" value="<?php echo $detail->penduduk_alamat; ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Rt</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter Rt" name="rt" value="<?php echo $detail->penduduk_rt; ?>" pattern="^[0-9]*" title="Harus Angka" maxlength="3" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Rw</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter Rw" name="rw" value="<?php echo $detail->penduduk_rw; ?>" pattern="^[0-9]*" title="Harus Angka" maxlength="3"  autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <h3 class="form-section">Foto</h3>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Foto</label>
                                    <div class="col-md-9">
                                        <?php if (!empty($detail->penduduk_foto)) { ?>
                                        <img src="<?php echo base_url(); ?>penduduk_image/<?php echo $detail->penduduk_foto; ?>" width="20%">
                                        <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>img/no_image.gif" alt="" />
                                        <?php }?>
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Upload Foto</label>
                                    <div class="col-md-9">
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
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Update</button>
                                        <a href="<?php echo site_url('admin/penduduk'); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
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