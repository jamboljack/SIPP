<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>
<?php 
if ($this->session->flashdata('notification')) { ?>
<script>
    swal({
        title: "Done",
        text: "<?php echo $this->session->flashdata('notification'); ?>",
        timer: 2000,
        showConfirmButton: false,
        type: 'success'
    });
</script>
<? } ?>

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
                    <a href="#">Data Penduduk</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Data Penduduk
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">N I K</th>
                                <th width="15%">No. KK</th>
                                <th>Nama Penduduk</th>                                
                                <th width="35%">Alamat</th>                                
                                <th width="8%">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($daftarlist as $r) {
                                $penduduk_id = $r->penduduk_id;
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>                                
                                <td><?php echo $r->penduduk_nik; ?></td>
                                <td><?php echo $r->penduduk_no_kk; ?></td>
                                <td><?php echo $r->penduduk_nama; ?></td>                                
                                <td><?php echo $r->penduduk_alamat.' RT.'.$r->penduduk_rt.'/'.$r->penduduk_rw; ?><br>
                                    <?php echo 'DESA '.$r->desa_nama.', KEC. '.$r->kecamatan_nama; ?><br>
                                    <?php echo 'KAB. '.$r->kabupaten_nama.', PROV. '.$r->provinsi_nama; ?>
                                </td>                                
                                <td>
                                    <a href="<?php echo site_url('admin/penduduk/detail/'.$r->penduduk_id); ?>">
                                        <button class="btn btn-primary btn-xs" title="Detail Data">
                                            <i class="icon-pencil"></i> Detail
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

        <div class="clearfix"></div>
    </div>
</div>