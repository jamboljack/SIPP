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
                    <a href="#">Cari Penduduk Pemilik Baru</a>
                </li>
            </ul>                
        </div>  
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i> Cari Penduduk/Pemilik Baru
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/baliknama/caridatapenduduk/'.$this->uri->segment(4)); ?>" method="post" enctype="multipart/form-data" name="form1">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <div class="form-body">
                                <h3 class="form-section">Data Penduduk/Pemilik Baru</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">NIK atau Nama</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter NIK atau Nama Penduduk" name="nama" value="<?php echo set_value('nama'); ?>" autocomplete="off" required>
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
                                            <a href="<?php echo site_url('admin/baliknama/addpenduduk/'.$this->uri->segment(4)); ?>" class="btn red">
                                                <i class="fa fa-plus-square"></i> Tambah Penduduk
                                            </a>
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="input-group-btn btn-right">
                                            <a href="<?php echo site_url('admin/baliknama/pilihpasar'); ?>" class="btn yellow">
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
                            <i class="fa fa-list"></i> Daftar Penduduk - Keyword : <?php echo strtoupper(trim($this->input->post('nama'))); ?>
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">N I K</th>
                                <th width="20%">Nama Penduduk</th>
                                <th width="10%">Tgl. Lahir</th>
                                <th>Alamat</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($listPenduduk as $r) {
                                $tgl_lahir      = $r->penduduk_tgl_lahir;
                                $xtgl           = explode("-",$tgl_lahir);
                                $thn            = $xtgl[0];
                                $bln            = $xtgl[1];
                                $tgl            = $xtgl[2];
                                $tanggal_lhr    = $tgl.'-'.$bln.'-'.$thn;
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>                                
                                <td><?php echo $r->penduduk_nik; ?></td>                                
                                <td><?php echo $r->penduduk_nama; ?></td>
                                <td><?php echo $tanggal_lhr; ?></td>
                                <td><?php echo $r->penduduk_alamat.' RT. '.$r->penduduk_rt.'/'.$r->penduduk_rw.'<br> DESA '.$r->desa_nama.', KECAMATAN '.$r->kecamatan_nama.'<br>KAB. '.$r->kabupaten_nama.' PROV. '.$r->provinsi_nama; ?></td>
                                <td>                                    
                                    <a href="<?php echo site_url('admin/baliknama/adddata/'.$this->uri->segment(4).'/'.$r->penduduk_id); ?>">
                                        <button class="btn btn-primary btn-xs" title="Proses Selanjutnya">
                                            <i class="icon-pencil"></i> Proses
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