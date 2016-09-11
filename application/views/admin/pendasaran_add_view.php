<script type="text/javascript">
$(function() {
    $(document).on("click",'.pilih_pedagang', function(e) {        
        var pedagang_id     = $(this).data('id');
        var pedagang_nik     = $(this).data('nik');
        var pedagang_nama   = $(this).data('nama');        
        $(".pedagang_id").val(pedagang_id);
        $(".pedagang_nik").val(pedagang_nik);
        $(".pedagang_nama").val(pedagang_nama);
    })
});
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#lstPasar").select2({
        });
        $("#lstJenis").select2({
        });        
    });
</script>

<script language="JavaScript" type="text/JavaScript">
function myPasar() { 
    var x               = document.getElementById("lstPasar");         
    var pasar_kode      = x.options[(x.selectedIndex)].getAttribute('data-kode');
    var pasar_alamat    = x.options[(x.selectedIndex)].getAttribute('data-alamat');
    var kecamatan       = x.options[(x.selectedIndex)].getAttribute('data-kecamatan');
    var desa            = x.options[(x.selectedIndex)].getAttribute('data-desa');
    document.getElementById("pasar_kode").value = pasar_kode;
    document.getElementById("alamat").value = pasar_alamat+', DESA '+desa+', KEC. '+kecamatan;
}
</script>

<!-- List Pedagang -->
<div class="modal bs-modal-lg" id="caripedagang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-header">                      
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-search"></i> Cari Data Pedagang</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="8%">Pilih</th>
                                <th width="12%">N I K</th>
                                <th>Nama Pedagang</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                            
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($listPedagang as $p) {                            
                            ?>
                            <tr>
                                <td align="center">
                                    <button type="button" class="btn btn-success btn-xs pilih_pedagang" data-toggle="modal" data-id="<?php echo $p->pedagang_id; ?>" data-nik="<?php echo $p->pedagang_nik; ?>" data-nama="<?php echo $p->pedagang_nama; ?>" title="Pilih Alamat" data-dismiss="modal"><i class="icon-check"></i> Pilih
                                    </button>
                                </td>
                                <td><?php echo $p->pedagang_nik; ?></td>
                                <td><?php echo $p->pedagang_nama; ?></td>
                                <td><?php echo $p->pedagang_alamat; ?></td>
                            </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn yellow" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                </div>
            </form>
        </div>        
    </div>    
</div>

<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Surat Pendasaran
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
                    <a href="<?php echo site_url('admin/pendasaran'); ?>">Surat Pendasaran</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Tambah Surat Pendasaran</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus-square"></i> Form Tambah Surat Pendasaran
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/pendasaran/savedata'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" class="pedagang_id" name="pedagang_id" value="<?php echo set_value('pedagang_id'); ?>">
                        <input type="hidden" name="pasar_kode" id="pasar_kode" value="<?php echo set_value('pasar_kode'); ?>">

                            <div class="form-body">
                                <?php if ($error == 'true') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <b>ERROR !!</b> <br>
                                    <?php echo validation_errors(); ?>
                                </div>
                                <?php } ?>
                                <h3 class="form-section">Data Surat Pendasaran</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tanggal Surat</label>
                                    <div class="col-md-3">
                                        <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" name="tgl_surat" value="<?php echo set_value('tgl_surat', date('d-m-Y')); ?>" placeholder="DD-MM-YYYY" autocomplete="off" required />
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>                                
                                <h3 class="form-section">Data Pedagang</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">N I K</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control pedagang_nik" placeholder="Enter N I K" name="nik" value="<?php echo set_value('nik'); ?>" autocomplete="off" required autofocus>
                                        <div class="form-control-focus"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="input-group-btn btn-right">
                                            <a data-toggle="modal" href="#caripedagang" title="Klik untuk Cari Data">
                                                <button class="btn blue-madison" type="button">
                                                <i class="fa fa-search"></i>
                                                </button>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pedagang</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control pedagang_nama" placeholder="Enter Nama Pedagang" name="nama" value="<?php echo set_value('nama'); ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <h3 class="form-section">Data Pasar</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jenis Dagangan</label>
                                    <div class="col-md-9">
                                        <select class="select2_category form-control" data-placeholder="- Pilih Jenis Dagangan -" name="lstJenis" id="lstJenis" required>
                                            <option value="">- Pilih Jenis Dagangan -</option>
                                            <?php
                                            foreach($listJenis as $j) {
                                            ?>php
                                            <option value="<?php echo $j->jenis_id; ?>" <?php echo set_select('lstJenis', $j->jenis_id); ?>><?php echo $j->jenis_nama; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pasar</label>
                                    <div class="col-md-9">
                                        <select class="select2_category form-control" data-placeholder="- Pilih Nama Pasar -" name="lstPasar" id="lstPasar" onchange="myPasar()" required>
                                            <option value="">- Pilih Nama Pasar -</option>
                                            <?php
                                            foreach($listPasar as $p) {
                                            ?>php
                                            <option value="<?php echo $p->pasar_id; ?>" <?php echo set_select('lstPasar', $p->pasar_id); ?> data-kode="<?php echo $p->pasar_kode; ?>" data-alamat="<?php echo $p->pasar_alamat; ?>" data-kecamatan="<?php echo $p->kecamatan_nama; ?>" data-desa="<?php echo $p->desa_nama; ?>"><?php echo $p->pasar_nama; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Alamat Pasar" name="alamat" value="<?php echo set_value('alamat'); ?>" id="alamat" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Blok</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Blok Pasar" name="blok" value="<?php echo set_value('blok'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Ruko</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Ruko Pasar" name="ruko" value="<?php echo set_value('ruko'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Kios</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Kios Pasar" name="kios" value="<?php echo set_value('kios'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">LOS</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="LOS Pasar" name="los" value="<?php echo set_value('los'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Luas Lokasi (m2)</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Luas Lokasi (m2)" name="luas" value="<?php echo set_value('luas', 0); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Simpan</button>
                                        <a href="<?php echo site_url('admin/pedagang'); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>            
</div>  