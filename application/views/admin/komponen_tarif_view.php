<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>
<script>
    function hapusData(tarif_id) {
        var id = tarif_id;
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
            window.location.href="<?php echo site_url('admin/komponen/deletedatatarif/'.$this->uri->segment(4)); ?>"+"/"+id
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

<script type="text/javascript">
    $(function() {
        $(document).on("click",'.edit_button', function(e) {
            var id      = $(this).data('id');
            var kelas   = $(this).data('kelas');
            var tempat  = $(this).data('tempat');
            var harga   = $(this).data('harga');
            var type    = $(this).data('type');
            $(".tarif_id").val(id);
            $(".kelas_id").val(kelas);
            $(".tempat_id").val(tempat);
            $(".harga").val(harga);
            $(".lstType").val(type);
        })
    });
</script>


<!-- Add Modal Form -->
<div class="modal bs-modal-lg" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo site_url('admin/komponen/savedatatarif/'.$this->uri->segment(4)); ?>" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        
            <div class="modal-header">                      
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-plus-square"></i> Form Tambah Tarif</h4>
            </div>
            <div class="modal-body">                
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Kelas Pasar</label>
                    <div class="col-md-9">
                        <select class="form-control" name="lstKelas" required>
                            <option value="">- Pilih Kelas Pasar -</option>
                            <?php 
                            foreach($listKelas as $k) {                                            
                            ?>
                            <option value="<?php echo $k->kelas_id; ?>"><?php echo $k->kelas_nama; ?></option>
                            <?php                                                
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Jenis Tempat</label>
                    <div class="col-md-9">
                        <select class="form-control" name="lstTempat" required>
                            <option value="">- Pilih Jenis Tempat -</option>
                            <?php 
                            foreach($listTempat as $t) {                                            
                            ?>
                            <option value="<?php echo $t->tempat_id; ?>"><?php echo $t->tempat_nama; ?></option>
                            <?php                                                
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Harga /m2 per Hari</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Enter Harga" name="harga" pattern="^[0-9]*" title="Harus ANGKA" value="<?php echo set_value('harga', 0); ?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Type Bayar</label>
                    <div class="col-md-3">
                        <select class="form-control" name="lstType" required>
                            <option value="">- Pilih Type Bayar -</option>
                            <option value="H">Per Hari</option>
                            <option value="M">Per m2/Hari</option>
                        </select>
                    </div>
                </div>
            </div>
                        
            <div class="modal-footer">
                <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Simpan</button>
                <button type="button" class="btn yellow" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
            </form>
        </div>        
    </div>    
</div>

<!-- Edit Modal Form -->
<div class="modal bs-modal-lg" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo site_url('admin/komponen/updatedatatarif/'.$this->uri->segment(4)); ?>" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" class="form-control tarif_id" name="id">
                        
            <div class="modal-header">                      
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Form Edit Tarif</h4>
            </div>
            <div class="modal-body">                
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Kelas Pasar</label>
                    <div class="col-md-9">
                        <select class="form-control kelas_id" name="lstKelas" required>
                            <option value="">- Pilih Kelas Pasar -</option>
                            <?php 
                            foreach($listKelas as $k) {                                            
                            ?>
                            <option value="<?php echo $k->kelas_id; ?>"><?php echo $k->kelas_nama; ?></option>
                            <?php                                                
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Jenis Tempat</label>
                    <div class="col-md-9">
                        <select class="form-control tempat_id" name="lstTempat" required>
                            <option value="">- Pilih Jenis Tempat -</option>
                            <?php 
                            foreach($listTempat as $t) {                                            
                            ?>
                            <option value="<?php echo $t->tempat_id; ?>"><?php echo $t->tempat_nama; ?></option>
                            <?php                                                
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Harga /m2 per Hari</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control harga" placeholder="Enter Harga" name="harga" pattern="^[0-9]*" title="Harus ANGKA" value="<?php echo set_value('harga', 0); ?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Type Bayar</label>
                    <div class="col-md-3">
                        <select class="form-control lstType" name="lstType" required>
                            <option value="">- Pilih Type Bayar -</option>
                            <option value="H">Per Hari</option>
                            <option value="M">Per m2/Hari</option>
                        </select>
                    </div>
                </div>
            </div>
                        
            <div class="modal-footer">
                <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Update</button>
                <button type="button" class="btn yellow" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
            </form>
        </div>        
    </div>    
</div>


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
                    <a href="#"><?php echo $detail->komponen_uraian; ?></a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Tambah Rincian Tarif <?php echo $detail->komponen_uraian; ?></a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">
                <a data-toggle="modal" href="#add">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah Tarif</button>
                </a>
                <a href="<?php echo site_url('admin/komponen'); ?>" class="btn yellow">
                    <i class="fa fa-times"></i> Kembali
                </a>
                <br><br>
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Rincian Tarif <?php echo $detail->komponen_uraian; ?>
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="5%">No</th>                                
                                <th>Kelas</th>
                                <th>Tempat</th>
                                <th>Tarif</th>
                                <th>Type Bayar</th>
                                <th width="16%">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($listTarif as $r) {
                                $tarif_id = $r->tarif_id;

                                if ($r->st_tarif == 'H') {
                                    $type = 'Per Hari';
                                } else {
                                    $type = 'Per m2/Hari';
                                }
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>                                
                                <td><?php echo $r->kelas_nama; ?></td> 
                                <td><?php echo $r->tempat_nama; ?></td>
                                <td><?php echo 'Rp. '.number_format($r->tarif_harga, 0, '.', ','); ?></td>
                                <td><?php echo $type; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs edit_button" data-toggle="modal" data-target="#edit" data-id="<?php echo $r->tarif_id; ?>" data-kelas="<?php echo $r->kelas_id; ?>" data-tempat="<?php echo $r->tempat_id; ?>" data-harga="<?php echo $r->tarif_harga; ?>" data-type="<?php echo $r->st_tarif; ?>" title="Edit Data"><i class="icon-pencil"></i> Edit
                                    </button>
                                    <a onclick="hapusData(<?php echo $tarif_id; ?>)"><button class="btn btn-danger btn-xs" title="Hapus Data"><i class="icon-trash"></i> Hapus</button>
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