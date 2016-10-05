<script type="text/javascript">
    $(document).ready(function () {        
        $("#lstPasar").select2({
        });
        $("#lstTempat").select2({
        });
        $("#lstBulan").select2({
        });
    });
</script>

<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Report <small>Pendasaran</small>
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
                    <a href="#">Pendasaran per Periode Habis</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-doc"></i> Laporan Pendasaran per Periode Habis
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/lap2/caridata'); ?>" method="post" enctype="multipart/form-data">
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
                                        <label class="control-label col-md-3">Periode</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="lstBulan" id="lstBulan" required>
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
                                            <input type="number" class="form-control" placeholder="Tahun" name="tahun" value="<?php echo set_value('tahun', date('Y')); ?>" autocomplete="off" required>
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
                                            <div class="col-md-3">
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
                <a href="<?php echo site_url('admin/lap2/preview/'.$Report['Pasar'].'/'.$Report['Tempat'].'/'.$Report['Bulan'].'/'.$Report['Tahun']); ?>" class="btn blue" target="_blank"><i class="fa fa-print"></i> Print Preview
                </a>
                <a href="<?php echo site_url('admin/lap2/exportpdf/'.$Report['Pasar'].'/'.$Report['Tempat'].'/'.$Report['Bulan'].'/'.$Report['Tahun']); ?>" class="btn red" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF
                </a>
                <br>
                <br>
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Hasil Pencarian Pendasaran per Periode Habis
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">No. Surat</th>
                                <th width="10%">Tgl. Habis</th>
                                <th width="10%">NPWRD</th>
                                <th>Nama Pedagang</th>
                                <th width="30%">Nama Pasar</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($daftarlist as $r) {
                                $tgl_surat      = $r->dasar_sampai;
                                $xtgl           = explode("-",$tgl_surat);
                                $thn            = $xtgl[0];
                                $bln            = $xtgl[1];
                                $tgl            = $xtgl[2];
                                $tanggal_srt    = $tgl.'-'.$bln.'-'.$thn;
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>                                
                                <td><?php echo $r->dasar_no; ?></td>                                
                                <td><?php echo $tanggal_srt; ?></td>
                                <td><?php echo $r->dasar_npwrd; ?></td>
                                <td><?php echo ucwords(strtolower($r->penduduk_nama)); ?></td>
                                <td><?php echo ucwords($r->pasar_nama).' <b>('.$r->tempat_nama.')</b>'."<br>".'Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2'; ?>
                                </td>
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