<script type="text/javascript">
    $(document).ready(function () {
        $("#lstPasar").select2({
        });
        $("#lstJenis").select2({
        });        
    });
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
                    <a href="#">Print Surat Pendasaran</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-print"></i> Print Surat Pendasaran
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/pendasaran/updatedata/'.$this->uri->segment(4)); ?>" method="post" enctype="multipart/form-data" name="form1">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">                        
                        
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="<?php echo site_url('admin/pendasaran/preview/'.$this->uri->segment(4).'/'.$detail->dasar_npwrd); ?>" class="btn blue" target="_blank"><i class="fa fa-search"></i> Preview
                                        </a>
                                        <?php
                                            $dasar_id   = trim($this->uri->segment(4));
                                            $npwrd      = trim($detail->dasar_npwrd);
                                            $cetak_surat= "print/Cetak_Surat_Dasar.php?id=".$dasar_id."&npwrd=".$npwrd;
                                        ?>
                                        <a href="<?php echo base_url().$cetak_surat; ?>" class="btn red" target="_blank"><i class="fa fa-print"></i> Print
                                        </a>
                                        <a href="<?php echo site_url('admin/pendasaran/exportpdf/'.$this->uri->segment(4).'/'.$detail->dasar_npwrd); ?>" class="btn green" target="_blank"><i class="fa fa-file-pdf-o"></i> Save PDF
                                        </a>                                        
                                        <a href="<?php echo site_url('admin/pendasaran'); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
                                        </a>
                                    </div>
                                </div>
                            </div>

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
                                        <input type="text" class="form-control" name="tgl_surat" value="<?php echo $tanggal_srt; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Periode Berlaku</label>
                                    <div class="col-md-3">                                
                                        <input type="text" class="form-control" name="tgl_berlaku" value="<?php echo $tanggal_dari.' s/d '.$tanggal_sampai; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div> 
                                </div>                                
                                <!--
                                <h3 class="form-section">Data Pedagang</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">N I K</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control pedagang_nik" placeholder="Enter N I K" name="nik" value="<?php echo $detail->pedagang_nik; ?>" autocomplete="off" disabled>
                                        <div class="form-control-focus"></div>
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
                                        <input type="text" class="form-control" placeholder="Enter Jenis Dagangan" name="jenis" value="<?php echo $detail->jenis_nama; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pasar</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Pasar" name="nama_pasar" value="<?php echo $detail->pasar_nama; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Alamat Pasar" name="alamat" value="<?php echo $detail->pasar_alamat.', DESA '.$detail->desa_nama.', KECAMATAN '.$detail->kecamatan_nama; ?>" id="alamat" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jenis Tempat</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Enter Jenis Tempat" name="tempat_nama" value="<?php echo $detail->tempat_nama; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Blok</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Blok Tempat" name="blok" value="<?php echo $detail->dasar_blok; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nomor</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Nomor Tempat" name="nomor" value="<?php echo $detail->dasar_nomor; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Panjang</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Panjang Tempat" name="panjang" id="panjang" value="<?php echo $detail->dasar_panjang; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Lebar</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Lebar Tempat" name="lebar" id="lebar" value="<?php echo $detail->dasar_lebar; ?>" autocomplete="off" readonly>
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
                                -->
                            </div>                            
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>            
</div>  