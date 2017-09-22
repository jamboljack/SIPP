<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Transaksi <small>Balik Nama</small>
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
                    <a href="<?php echo site_url('admin/baliknama'); ?>">Balik Nama</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Cari Pedagang</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i> Cari Pedagang
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/baliknama/caridatapedagang'); ?>" method="post"  name="form1">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <div class="form-body">
                                <h3 class="form-section">Data Pedagang</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">NIK atau Nama</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter NIK atau Nama Pedagang" name="nama" value="<?php echo set_value('nama'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="input-group-btn btn-right">    
                                            <button class="btn blue-madison" type="submit" name="cari">
                                                <i class="fa fa-search"></i> Cari
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="input-group-btn btn-right">
                                            <a href="<?php echo site_url('admin/baliknama'); ?>" class="btn yellow">
                                                <i class="fa fa-times"></i> Kembali
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        <?php 
        if ($tampil == 'ya') {
        ?>        
        <div class="row">
            <div class="col-md-12">                
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Pedagang - Keyword : <?php echo strtoupper(trim($this->input->post('nama'))); ?>
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">No. Surat</th>
                                <th width="10%">Tanggal</th>
                                <th width="8%">NPWRD</th>
                                <th>Nama Pedagang</th>
                                <th width="20%">Nama Pasar</th>
                                <th width="10%">Status</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($listPedagang as $r) {
                                $tgl_surat      = $r->dasar_tgl_surat;
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
                                <td><?php echo $r->penduduk_nama; ?></td>
                                <td><?php echo ucwords($r->pasar_nama).' <b>('.$r->tempat_nama.')</b>'."<br>".'Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2'; ?>
                                </td>
                                <td>
                                    <?php if ($r->dasar_status=='Baru') { ?>
                                        <span class="label label-info"><i class="fa fa-plus-circle"></i> <?php echo $r->dasar_status; ?></span>
                                    <?php } elseif ($r->dasar_status=='Perpanjangan') { ?>
                                        <span class="label label-warning"><i class="fa fa-copy (alias)"></i> <?php echo $r->dasar_status; ?></span>
                                    <?php } else { ?>
                                        <span class="label label-primary"><i class="fa fa-random"></i> <?php echo $r->dasar_status; ?></span>
                                    <?php } ?>
                                </td>                              
                                <td>                                    
                                    <a href="<?php echo site_url('admin/baliknama/pilihpenduduk/'.$r->dasar_id); ?>">
                                        <button class="btn btn-primary btn-xs" title="Edit Data">
                                            <i class="icon-shuffle"></i> Balik Nama
                                        </button>
                                    </a>                                    
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
    </div>            
</div>  