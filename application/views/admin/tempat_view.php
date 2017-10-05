<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>
<script>
    function hapusData(tempat_id) {
        var id = tempat_id;
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
            window.location.href="<?php echo site_url('admin/tempat/deletedata'); ?>"+"/"+id
        });
    }
</script>

<script type="text/javascript">
    $(function() {
        $(document).on("click",'.edit_button', function(e) {
            var id      = $(this).data('id');
            var name    = $(this).data('name');
            var kd_rek    = $(this).data('kd_rek');
            $(".tempat_id").val(id);
            $(".tempat_name").val(name);
            $(".tempat_kd_rek").val(kd_rek);
        })
    });
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

<!-- Add Modal Form -->
<div class="modal bs-modal-lg" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo site_url('admin/tempat/savedata'); ?>" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        
            <div class="modal-header">                      
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-plus-square"></i> Form Tambah Jenis Tempat</h4>
            </div>
            <div class="modal-body">                
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Jenis Tempat</label>
                    <div class="col-md-9 has-error">
                        <input type="text" class="form-control" placeholder="Enter Jenis Tempat" name="nama" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Kode Rekening</label>
                    <div class="col-md-3 has-error">
                        <input type="text" class="form-control" placeholder="Enter Kode Rekening" name="kd_rek" maxlength="2" autocomplete="off" required>
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
            <form action="<?php echo site_url('admin/tempat/updatedata'); ?>" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" class="form-control tempat_id" name="id">
                        
            <div class="modal-header">                      
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Form Edit Jenis Tempat</h4>
            </div>
            <div class="modal-body">                
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Jenis Tempat</label>
                    <div class="col-md-9 has-error">
                        <input type="text" class="form-control tempat_name" placeholder="Enter Jenis Tempat" name="nama" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group">                    
                    <label class="col-md-3 control-label">Kode Rekening</label>
                    <div class="col-md-3 has-error">
                        <input type="text" class="form-control tempat_kd_rek" placeholder="Enter Kode Rekening" name="kd_rek" maxlength="2" autocomplete="off" required>
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
            Master <small>Jenis Tempat</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">                    
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Master</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Jenis Tempat</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">
                <a data-toggle="modal" href="#add">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</button>
                </a>
                <br><br>
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Jenis Tempat
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover" id="tableData">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="5%">Kode</th>
                                <th>Jenis Tempat</th>
                                <th width="10%">Kode Rekening</th>
                                <th width="16%">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                        </tbody>

                        </table>
                    </div>
                </div>            
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript">
var table;
$(document).ready(function() {
    table = $('#tableData').DataTable({ 
        "processing": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            "type": "POST",
            "url": "<?php echo site_url('admin/tempat/data_list')?>"
        },
        "columnDefs": [ 
            { 
                "targets": [ 0, 2 ],
                "orderable": false,
            },
        ],
    });
});
</script>