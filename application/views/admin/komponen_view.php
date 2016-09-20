<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>
<script>
    function hapusData(komponen_id) {
        var id = komponen_id;
        swal({
            title: 'Anda Yakin ?',
            text: 'Data ini Akan di Hapus !',type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            closeOnConfirm: true
        }, function() {
            window.location.href="<?php echo site_url('admin/komponen/deletedata'); ?>"+"/"+id
        });
    }
</script>

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
                    <a href="#">Komponen Retribusi</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo site_url('admin/komponen/adddata'); ?>">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</button>
                </a>
                <br><br>
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Komponen Retribusi
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Kode Rekening</th>
                                <th>Uraian</th>
                                <th width="10%">Type</th>
                                <th width="15%">Tarif</th>                                
                                <th width="10%">Rincian</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($daftarlist as $r) {
                                $komponen_id = $r->komponen_id;
                                
                                if ($r->komponen_type == 'M') {
                                    $type = 'Menu';
                                } else {
                                    $type = 'Sub Menu';
                                }
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>                                
                                <td><?php echo $r->komponen_kode; ?></td>
                                <td><?php echo $r->komponen_uraian; ?></td>
                                <td><?php echo $type; ?></td>
                                <td><?php echo number_format($r->komponen_tarif, 0, '.', ','); ?></td>
                                <td>
                                    <?php if ($r->komponen_type == 'S') { ?>
                                    <a href="<?php echo site_url('admin/komponen/rincian/'.$r->komponen_id); ?>">
                                        <button class="btn btn-primary btn-xs" title="Rincian Tarif">
                                            <i class="icon-list"></i> Rincian
                                        </button>
                                    </a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('admin/komponen/editdata/'.$r->komponen_id); ?>">
                                        <button class="btn btn-primary btn-xs" title="Edit Data">
                                            <i class="icon-pencil"></i>
                                        </button>
                                    </a>
                                    <a onclick="hapusData(<?php echo $komponen_id; ?>)">
                                        <button class="btn btn-danger btn-xs" title="Hapus Data">
                                            <i class="icon-trash"></i>
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