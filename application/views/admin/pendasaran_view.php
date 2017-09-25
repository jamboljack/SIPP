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

<script>
    function hapusData(dasar_id) {
        var id = dasar_id;
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
            window.location.href="<?php echo site_url('admin/pendasaran/deletedata'); ?>"+"/"+id
        });
    }
</script>

<script>
    function ACCData(dasar_id) {
        var id = dasar_id;
        swal({
            title: 'ACC Data ?',
            text: 'ACC Data Surat Ini !',type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            closeOnConfirm: true
        }, function() {
            window.location.href="<?php echo site_url('admin/pendasaran/accdata'); ?>"+"/"+id
        });
    }
</script>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            Transaksi Pendasaran <small>Surat Pendasaran</small>
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
                    <a href="#">Surat Pendasaran</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i> Filter Data
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" id="form-filter" class="form-horizontal">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Pasar</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="lstPasar" id="lstPasar">
                                                    <?php
                                                    foreach($listPasar as $p) {
                                                    ?>php
                                                    <option value="<?php echo $p->pasar_id; ?>"><?php echo $p->pasar_nama; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <div class="form-control-focus"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Tempat</label>
                                            <div class="col-md-6">
                                                <select class="form-control" name="lstTempat" id="lstTempat">
                                                    <option value="">- SEMUA -</option>
                                                    <?php
                                                    foreach($listTempat as $t) {
                                                    ?>php
                                                    <option value="<?php echo $t->tempat_id; ?>"><?php echo ucwords(strtolower($t->tempat_nama)); ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <div class="form-control-focus"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" placeholder="BLOK" name="blok" id="blok">
                                                <div class="form-control-focus"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Status</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="lstStatus" id="lstStatus">
                                                    <option value="">- SEMUA -</option>
                                                    <option value="Baru">Baru</option>
                                                    <option value="Perpanjangan">Perpanjangan</option>
                                                    <option value="Balik Nama">Balik Nama</option>
                                                </select>
                                                <div class="form-control-focus"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Cetak ?</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="lstStatusCetak" id="lstStatusCetak">
                                                    <option value="">- SEMUA -</option>
                                                    <option value="1">Belum Cetak</option>
                                                    <option value="2">Sudah Cetak</option>
                                                </select>
                                                <div class="form-control-focus"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">ACC ?</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="lstStatusACC" id="lstStatusACC">
                                                    <option value="">- SEMUA -</option>
                                                    <option value="1">Belum ACC</option>
                                                    <option value="2">Sudah ACC</option>
                                                </select>
                                                <div class="form-control-focus"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Berlaku ?</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="lstStatusSurat" id="lstStatusSurat">
                                                    <option value="">- SEMUA -</option>
                                                    <option value="1">Masih Berlaku</option>
                                                    <option value="2">Tidak Berlaku</option>
                                                </select>
                                                <div class="form-control-focus"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12" align="center">
                                        <button type="button" class="btn blue" id="btn-filter"><i class="fa fa-search"></i> Filter</button>
                                        <button type="button" class="btn default" id="btn-reset"><i class="fa fa-refresh"></i> Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a href="<?php echo site_url('admin/pendasaran/pilihpenduduk'); ?>">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</button>
        </a>
        <?php if ($this->session->userdata('level') == 'Admin') { ?>
        <a href="<?php echo site_url('admin/pendasaran/accdata_all'); ?>">
            <button type="submit" class="btn btn-warning" title="ACC Semua Data">
                <i class="fa fa-check"></i> ACC Semua
            </button>
        </a>
        <a href="<?php echo site_url('admin/pendasaran/excel'); ?>">
            <button type="submit" class="btn btn-danger"><i class="fa fa-file-excel-o"></i> Excel</button>
        </a>
        <?php } ?>
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Surat Pendasaran
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="tableData">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">No. Surat</th>
                                <th width="10%">Tgl. Habis</th>
                                <th width="8%">NPWRD</th>
                                <th>Nama Pedagang</th>
                                <th width="20%">Nama Pasar</th>
                                <th width="10%">Status</th>
                                <th width="10%">Aksi</th>
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
        "processing": true,
        "serverSide": true,
        "order": [2, 'asc'],
        "lengthMenu": [
                [20, 50, 75, 100, -1],
                [20, 50, 75, 100, "All"] // change per page values here
        ],
        "pageLength": 20,
        "ajax": {
            "type": "POST",
            "url": "<?php echo site_url('admin/pendasaran/data_list')?>",
            "data": function(data) {
                data.lstPasar = $('#lstPasar').val();
                data.lstTempat = $('#lstTempat').val();
                data.blok = $('#blok').val();
                data.lstStatus = $('#lstStatus').val();
                data.lstStatusCetak = $('#lstStatusCetak').val();
                data.lstStatusACC = $('#lstStatusACC').val();
                data.lstStatusSurat = $('#lstStatusSurat').val();
            }
        },
        "columnDefs": [ 
            { 
                "targets": [ 0, 7],
                "orderable": false,
            },
        ],
    });
    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table
    });
});
</script>