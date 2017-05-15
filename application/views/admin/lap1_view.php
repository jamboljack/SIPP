<script type="text/javascript">
    $(document).ready(function () {        
        $("#lstPasar").select2({});
        $("#lstJenis").select2({});
        $("#lstTempat").select2({});
    });
</script>

<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Report <small>Pedagang per Pasar</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">                    
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Report</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Pedagang per Pasar</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-doc"></i> Laporan Pedagang per Pasar
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/lap1/caridata'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Pasar</label>
                                            <div class="col-md-9">
                                                <select class="select2_category form-control" data-placeholder="- Pilih Nama Pasar -" name="lstPasar" id="lstPasar" required autofocus>
                                                    <option value="">- Pilih Nama Pasar -</option>
                                                    <?php
                                                    foreach($listPasar as $p) {
                                                    ?>php
                                                    <option value="<?php echo $p->pasar_id; ?>" <?php echo set_select('lstPasar', $p->pasar_id); ?>><?php echo $p->pasar_nama; ?></option>
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
                                            <label class="control-label col-md-3">Jenis Dagangan</label>
                                            <div class="col-md-9">
                                                <select class="select2_category form-control" data-placeholder="- Pilih Jenis Dagangan -" name="lstJenis" id="lstJenis" required>
                                                    <option value="">- Pilih Jenis Dagangan -</option>
                                                    <?php
                                                    foreach($listJenis as $j) {
                                                    ?>php
                                                    <option value="<?php echo $j->jenis_id; ?>" <?php echo set_select('lstJenis', $j->jenis_id); ?>><?php echo $j->jenis_nama; ?></option>
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
                                                <select class="select2_category form-control" data-placeholder="- Pilih Jenis Tempat -" name="lstTempat" id="lstTempat" required>
                                                    <option value="all">Semua</option>
                                                    <?php
                                                    foreach($listTempat as $t) {
                                                    ?>php
                                                    <option value="<?php echo $t->tempat_id; ?>" <?php echo set_select('lstTempat', $t->tempat_id); ?>><?php echo ucwords(strtolower($t->tempat_nama)); ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <div class="form-control-focus"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <span class="input-group-btn btn-right">    
                                                    <button class="btn blue-madison" type="submit">
                                                        <i class="fa fa-search"></i> Cari
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <?php if ($tampil == 'ya') { ?>
        <div class="row">
            <div class="col-md-12">
                <?php 
                    if ($Report['Tempat'] == 'all') {  // Semua Tempat
                ?>
                    <a href="<?php echo site_url('admin/lap1/preview/'.$Report['Pasar'].'/'.$Report['Jenis'].'/all'); ?>" class="btn blue" target="_blank"><i class="fa fa-print"></i> Print Preview
                    </a>
                    <a href="<?php echo site_url('admin/lap1/exportpdf/'.$Report['Pasar'].'/'.$Report['Jenis'].'/all'); ?>" class="btn red" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF
                    </a>
                <?php } else { ?>
                    <a href="<?php echo site_url('admin/lap1/preview/'.$Report['Pasar'].'/'.$Report['Jenis'].'/'.$Report['Tempat']); ?>" class="btn blue" target="_blank"><i class="fa fa-print"></i> Print Preview
                    </a>
                    <a href="<?php echo site_url('admin/lap1/exportpdf/'.$Report['Pasar'].'/'.$Report['Jenis'].'/'.$Report['Tempat']); ?>" class="btn red" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF
                    </a>
                <?php }?>
                <br><br>
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Hasil Pencarian Pedagang per Pasar
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">NPWRD</th>
                                <th width="15%">Nama Pedagang</th>
                                <th>Alamat</th>
                                <th width="30%">Pasar</th>
                                <th width="15%">Status</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($daftarlist as $r) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>                                
                                <td><?php echo $r->dasar_npwrd; ?></td>
                                <td><?php echo ucwords(strtolower($r->penduduk_nama)); ?></td>
                                <td><?php echo ucwords(strtolower($r->penduduk_alamat.' Desa '.$r->desa_nama.' Kec. '.$r->kecamatan_nama)).'<br>'.ucwords(strtolower($r->kabupaten_nama.' Provinsi '.$r->provinsi_nama)); ?></td>
                                <td><?php echo $r->pasar_nama.' <b>('.$r->tempat_nama.')</b>'."<br>".'Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2'; ?><br>Jenis : <?php echo $r->jenis_nama; ?></td>
                                <td><?php echo $r->dasar_status; ?></td>
                            </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>

                        </table>
                    </div>
                </div>            
            </div>
        </div>
        <?php } ?>

        <div class="clearfix"></div>
    </div>
</div>