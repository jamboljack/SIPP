<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>
<?php
if ($this->session->flashdata('notification')) { ?>
<script>
    swal({
        title: "Info",
        text: "<?php echo $this->session->flashdata('notification'); ?>",
        timer: 2000,
        showConfirmButton: false,
        type: 'warning'
    });
</script>
<? } ?>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            Transaksi Pendasaran <small>Export Excel</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo site_url('admin/pendasaran'); ?>">Transaksi Pendasaran</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Export Excel</a>
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
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/pendasaran/exportexcel'); ?>" method="post">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Pasar</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="lstPasar" required>
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
                                                <select class="form-control" name="lstTempat" required>
                                                    <option value="all">- SEMUA -</option>
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
                                                <input type="text" class="form-control" placeholder="BLOK" name="blok">
                                                <div class="form-control-focus"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Status</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="lstStatus" required>
                                                    <option value="all">- SEMUA -</option>
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
                                                <select class="form-control" name="lstStatusCetak" required>
                                                    <option value="all">- SEMUA -</option>
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
                                                <select class="form-control" name="lstStatusACC" required>
                                                    <option value="all">- SEMUA -</option>
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
                                                <select class="form-control" name="lstStatusSurat" required>
                                                    <option value="all">- SEMUA -</option>
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
                                        <button type="submit" class="btn blue"><i class="fa fa-file-excel-o"></i> Export</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>