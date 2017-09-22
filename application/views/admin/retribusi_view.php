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
    function hapusData(skrd_id) {
        var id = skrd_id;
        swal({
            title: 'Anda Yakin ?',
            text: 'Data ini Akan Berubah BELUM BAYAR !',type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            closeOnConfirm: true
        }, function() {
            window.location.href="<?php echo site_url('admin/retribusi/deletedata'); ?>"+"/"+id
        });
    }
</script>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            Transaksi Retribusi <small>Pembayaran Retribusi</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Transaksi Retribusi</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Pembayaran Retribusi</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="fa fa-search"></i>
                            <span class="caption-subject bold uppercase"> Filter Data</span>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <form role="form" id="form-filter" class="form-horizontal">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Periode</label>
                                            <div class="col-md-6">
                                                <select class="form-control" name="lstBulan" id="lstBulan" required autofocus>
                                                    <option value="">- Pilih Bulan -</option>
                                                    <option value="1" <?php if (date('m') == 1) { echo 'selected'; } ?>>Januari</option>
                                                    <option value="2" <?php if (date('m')== 2) { echo 'selected'; } ?>>Februari</option>
                                                    <option value="3" <?php if (date('m')== 3) { echo 'selected'; } ?>>Maret</option>
                                                    <option value="4" <?php if (date('m')== 4) { echo 'selected'; } ?>>April</option>
                                                    <option value="5" <?php if (date('m')== 5) { echo 'selected'; } ?>>Mei</option>
                                                    <option value="6" <?php if (date('m')== 6) { echo 'selected'; } ?>>Juni</option>
                                                    <option value="7" <?php if (date('m')== 7) { echo 'selected'; } ?>>Juli</option>
                                                    <option value="8" <?php if (date('m')== 8) { echo 'selected'; } ?>>Agustus</option>
                                                    <option value="9" <?php if (date('m')== 9) { echo 'selected'; } ?>>September</option>
                                                    <option value="10" <?php if (date('m')== 10) { echo 'selected'; } ?>>Oktober</option>
                                                    <option value="11" <?php if (date('m')== 11) { echo 'selected'; } ?>>November</option>
                                                    <option value="12" <?php if (date('m')== 12) { echo 'selected'; } ?>>Desember</option>
                                                </select>
                                                <div class="form-control-focus"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" class="form-control" placeholder="Tahun" name="tahun" id="tahun" value="<?php echo date('Y'); ?>" autocomplete="off">
                                                <div class="form-control-focus"></div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Pasar</label>
                                            <div class="col-md-9">
                                                <select class="form-control" data-placeholder="- Pilih Nama Pasar -" name="lstPasar" id="lstPasar">
                                                    <option value="">- Pilih Nama Pasar -</option>
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
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Tempat</label>
                                            <div class="col-md-6">
                                                <select class="form-control" data-placeholder="- Pilih Jenis Tempat -" name="lstTempat" id="lstTempat">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" class="btn blue" id="btn-filter">Filter</button>
                                        <button type="button" class="btn default" id="btn-reset">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Data SKRD
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="tableData">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">No. Surat</th>
                                <th width="10%">Periode</th>
                                <th>NPWRD</th>
                                <th width="20%">Pasar</th>
                                <th width="10%">Total</th>
                                <th width="10%">Status</th>
                                <th width="13%">Aksi</th>
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
        "order": [],
        "ajax": {
            "url": "<?php echo site_url('admin/retribusi/data_list')?>",
            "type": "post",
            "data": function(data) {
                data.lstBulan = $('#lstBulan').val();
                data.tahun = $('#tahun').val();
                data.lstPasar = $('#lstPasar').val();
                data.lstTempat = $('#lstTempat').val();
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