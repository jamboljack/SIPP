<script type="text/javascript">
$(function() {
    $(document).on("click",'.pilih_alamat', function(e) {        
        var provinsi_id     = $(this).data('pid');
        var provinsi_nama   = $(this).data('pname');
        var kab_id          = $(this).data('kid');
        var kab_nama        = $(this).data('kname');
        var kec_id          = $(this).data('cid');
        var kec_nama        = $(this).data('cname');
        var desa_id         = $(this).data('did');
        var desa_nama       = $(this).data('dname');
        $(".provinsi_id").val(provinsi_id);
        $(".provinsi_nama").val(provinsi_nama);
        $(".kab_id").val(kab_id);
        $(".kab_nama").val(kab_nama);
        $(".kec_id").val(kec_id);
        $(".kec_nama").val(kec_nama);
        $(".desa_id").val(desa_id);
        $(".desa_nama").val(desa_nama);
    })
});
</script>

<!-- List Provinsi, Kab, Kec, Desa -->
<div class="modal bs-modal-lg" id="carialamat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-header">                      
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-search"></i> Cari Data Alamat</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="8%">Pilih</th>
                                <th>Desa</th>
                                <th>Kecamatan</th>
                                <th>Kabupaten</th>
                                <th>Provinsi</th>
                            </tr>
                        </thead>
                            
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($listAlamat as $a) {                            
                            ?>
                            <tr>
                                <td align="center">
                                    <button type="button" class="btn btn-success btn-xs pilih_alamat" data-toggle="modal" data-pid="<?php echo $a->provinsi_id; ?>" data-pname="<?php echo $a->provinsi_nama; ?>" data-kid="<?php echo $a->kabupaten_id; ?>" data-kname="<?php echo $a->kabupaten_nama; ?>" data-cid="<?php echo $a->kecamatan_id; ?>" data-cname="<?php echo $a->kecamatan_nama; ?>" data-did="<?php echo $a->desa_id; ?>" data-dname="<?php echo $a->desa_nama; ?>" title="Pilih Alamat" data-dismiss="modal"><i class="icon-check"></i> Pilih
                                    </button>
                                </td>
                                <td><?php echo $a->desa_nama; ?></td>
                                <td><?php echo $a->kecamatan_nama; ?></td>
                                <td><?php echo $a->kabupaten_nama; ?></td>
                                <td><?php echo $a->provinsi_nama; ?></td>
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
            Data <small>Data Pasar</small>
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
                    <a href="<?php echo site_url('admin/pasar'); ?>">Data Pasar</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Tambah Data Pasar</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus-square"></i> Form Tambah Pasar
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/pasar/savedata'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" class="provinsi_id" name="provinsi_id" value="<?php echo set_value('provinsi_id'); ?>">
                        <input type="hidden" class="kab_id" name="kab_id" value="<?php echo set_value('kab_id'); ?>">
                        <input type="hidden" class="kec_id" name="kec_id" value="<?php echo set_value('kec_id'); ?>">
                        <input type="hidden" class="desa_id" name="desa_id" value="<?php echo set_value('desa_id'); ?>">                        

                            <div class="form-body">
                                <?php if ($error == 'true') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <b>ERROR !!</b> <br>
                                    <?php echo validation_errors(); ?>
                                </div>
                                <?php } ?>
                                <h3 class="form-section">Data Detail</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Kode Pasar</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter Kode Pasar" name="kode" value="<?php echo set_value('kode'); ?>" autocomplete="off" required autofocus>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pasar</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Pasar" name="nama" value="<?php echo set_value('nama'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tahun Berdiri</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter Tahun Berdiri" name="tahun" value="<?php echo set_value('tahun'); ?>" pattern="^[0-9]*" title="Isi hanya Angka" autocomplete="off" maxlength="4" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Alamat" name="alamat" value="<?php echo set_value('alamat'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Kecamatan</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control kec_nama" placeholder="Enter Kecamatan" name="kecamatan" value="<?php echo set_value('kecamatan'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="input-group-btn btn-right">
                                            <a data-toggle="modal" href="#carialamat" title="Klik untuk Cari Data">
                                                <button class="btn blue-madison" type="button">
                                                <i class="fa fa-search"></i>
                                                </button>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Desa</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control desa_nama" placeholder="Enter Desa" name="desa" value="<?php echo set_value('desa'); ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <h3 class="form-section">Koordinat</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Latitude</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter Latitude" name="latitude" value="<?php echo set_value('latitude'); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Longitude</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter Longitude" name="longitude" value="<?php echo set_value('longitude'); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <h3 class="form-section">Keterangan</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Luas Tanah (m2)</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Enter Luas Tanah (m2)" name="luas_tanah" value="<?php echo set_value('luas_tanah', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Luas Bangunan (m2)</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Enter Luas Bangunan (m2)" name="luas_bangunan" value="<?php echo set_value('luas_bangunan', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jumlah Lantai</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Enter Jumlah Lantai" name="jml_lantai" value="<?php echo set_value('jml_lantai', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jumlah Blok</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Enter Jumlah Blok" name="jml_blok" value="<?php echo set_value('jml_blok', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jumlah Ruko</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Enter Jumlah Ruko" name="jml_ruko" value="<?php echo set_value('jml_ruko', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jumlah Kios</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Enter Jumlah Kios" name="jml_kios" value="<?php echo set_value('jml_kios', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jumlah LOS</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Enter Jumlah LOS" name="jml_los" value="<?php echo set_value('jml_los', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jumlah Dasaran</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Enter Jumlah Dasaran" name="jml_dasaran" value="<?php echo set_value('jml_dasaran', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <h3 class="form-section">Pendukung</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Kelas Pasar</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="lstKelas" required>
                                            <option value="">- Pilih Kelas Pasar -</option>
                                            <?php 
                                            foreach($listKelas as $k) {                                            
                                            ?>
                                            <option value="<?php echo $k->kelas_id; ?>" <?php echo set_select('lstKelas', $k->kelas_id); ?>><?php echo $k->kelas_nama; ?></option>
                                            <?php                                                
                                            }
                                            ?>
                                        </select>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Operasional</label>
                                    <div class="md-radio-inline col-md-9">
                                        <div class="md-radio">
                                            <input type="radio" id="radio1" name="rdOperasional" class="md-radiobtn" value="H" <?php echo set_checkbox('rdOperasional', 'H'); ?> required>
                                            <label for="radio1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> HARIAN
                                            </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="radio2" name="rdOperasional" class="md-radiobtn" value="M" <?php echo set_checkbox('rdOperasional', 'M'); ?>>
                                            <label for="radio2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> MINGGUAN
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Bentuk Bangunan Pasar</label>
                                    <div class="md-radio-inline col-md-9">
                                        <?php 
                                        $no = 3;
                                        foreach ($listBentuk as $b) {
                                        ?>
                                        <div class="md-radio">
                                            <input type="radio" name="rdBentuk" class="md-radiobtn" id="<?php echo 'radio'.$no; ?>" value="<?php echo $b->bentuk_id; ?>" <?php echo set_checkbox('rdBentuk', $b->bentuk_id); ?> required>
                                            <label for="<?php echo 'radio'.$no; ?>">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> <?php echo $b->bentuk_nama; ?>
                                            </label>
                                        </div>
                                        <?php 
                                        $no++; 
                                        } 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Kondisi Bangunan Pasar</label>
                                    <div class="md-radio-inline col-md-9">
                                        <?php 
                                        $no = 6;
                                        foreach ($listKondisi as $k) {
                                        ?>
                                        <div class="md-radio">
                                            <input type="radio" name="rdKondisi" class="md-radiobtn" id="<?php echo 'radio'.$no; ?>" value="<?php echo $k->kondisi_id; ?>" <?php echo set_checkbox('rdKondisi', $k->kondisi_id); ?> required>
                                            <label for="<?php echo 'radio'.$no; ?>">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> <?php echo $k->kondisi_nama; ?>
                                            </label>
                                        </div>
                                        <?php 
                                        $no++; 
                                        } 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Surat Kepemilikan Lahan</label>
                                    <div class="md-radio-inline col-md-9">
                                        <?php 
                                        $no = 9;
                                        foreach ($listSurat as $s) {
                                        ?>
                                        <div class="md-radio">
                                            <input type="radio" name="rdLahan" class="md-radiobtn" id="<?php echo 'radio'.$no; ?>" value="<?php echo $s->kepemilikan_id; ?>" <?php echo set_checkbox('rdLahan', $s->kepemilikan_id); ?> required>
                                            <label for="<?php echo 'radio'.$no; ?>">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> <?php echo $s->kepemilikan_nama; ?>
                                            </label>
                                        </div>
                                        <?php 
                                        $no++; 
                                        } 
                                        ?>
                                    </div>
                                </div>
                                <h3 class="form-section">Omzet Pasar</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Harian</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Enter Harian" name="omzet_harian" value="<?php echo set_value('omzet_harian', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Mingguan</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Enter Mingguan" name="omzet_mingguan" value="<?php echo set_value('omzet_mingguan', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Bulanan</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Enter Bulanan" name="omzet_bulanan" value="<?php echo set_value('omzet_bulanan', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tahunan</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Enter Tahunan" name="omzet_tahunan" value="<?php echo set_value('omzet_tahunan', 0); ?>" autocomplete="off">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <h3 class="form-section">Fasilitas Umum</h3>
                                <div class="form-group form-md-checkboxes">
                                    <label class="col-md-3 control-label" for="form_control_1">Areal Parkir</label>
                                    <div class="md-checkbox-inline col-md-9">
                                        <div class="md-checkbox">
                                            <input type="checkbox" id="chkParkir" class="md-check" name="chkParkir" value="1" <?php echo set_checkbox('chkParkir', 1); ?>>
                                            <label for="chkParkir">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Ada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes">
                                    <label class="col-md-3 control-label" for="form_control_1">MCK</label>
                                    <div class="md-checkbox-inline col-md-9">
                                        <div class="md-checkbox">
                                            <input type="checkbox" id="chkMCK" class="md-check" name="chkMCK" value="1" <?php echo set_checkbox('chkMCK', 1); ?>>
                                            <label for="chkMCK">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Ada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes">
                                    <label class="col-md-3 control-label" for="form_control_1">TPS</label>
                                    <div class="md-checkbox-inline col-md-9">
                                        <div class="md-checkbox">
                                            <input type="checkbox" id="chkTPS" class="md-check" name="chkTPS" value="1" <?php echo set_checkbox('chkTPS', 1); ?>>
                                            <label for="chkTPS">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Ada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes">
                                    <label class="col-md-3 control-label" for="form_control_1">Tempat Ibadah</label>
                                    <div class="md-checkbox-inline col-md-9">
                                        <div class="md-checkbox">
                                            <input type="checkbox" id="chkIbadah" class="md-check" name="chkIbadah" value="1" <?php echo set_checkbox('chkIbadah', 1); ?>>
                                            <label for="chkIbadah">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Ada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes"">
                                    <label class="col-md-3 control-label" for="form_control_1">Pengelolaan Pasar</label>
                                    <div class="md-radio-inline col-md-9">
                                        <div class="md-radio">
                                            <input type="radio" id="radio12" name="rdKelola" class="md-radiobtn" value="Baik" <?php echo set_checkbox('rdKelola', 'Baik'); ?>>
                                            <label for="radio12">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Baik
                                            </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="radio13" name="rdKelola" class="md-radiobtn" value="Baru" <?php echo set_checkbox('rdKelola', 'Baru'); ?>>
                                            <label for="radio13">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Baru
                                            </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="radio14" name="rdKelola" class="md-radiobtn" value="Cukup" <?php echo set_checkbox('rdKelola', 'Cukup'); ?>>
                                            <label for="radio14">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Cukup
                                            </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="radio15" name="rdKelola" class="md-radiobtn" value="Kurang" <?php echo set_checkbox('rdKelola', 'Kurang'); ?>>
                                            <label for="radio15">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Kurang
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="form-section">Penanggung Jawab</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">NIP</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter NIP" name="nip" value="<?php echo set_value('nip'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Koordinator Pasar</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Koordinator Pasar" name="nama_koordinator" value="<?php echo set_value('nama_koordinator'); ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <h3 class="form-section">Foto Pasar</h3>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Gambar Pasar</label>
                                    <div class="col-md-9 has-success">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?php echo base_url(); ?>img/no_image.gif" alt="" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;">
                                            </div>
                                            <div>
                                                <span class="btn btn-blue btn-file">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> Browse</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                                    <input type="file" class="default" name="userfile" />
                                                </span>                                             
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            <span class="label label-danger">NOTE !</span>
                                            <span>Resolution : 500 x 350 pixel</span>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Simpan</button>
                                        <a href="<?php echo site_url('admin/pasar'); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
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