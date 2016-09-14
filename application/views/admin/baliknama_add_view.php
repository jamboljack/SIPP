<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>
<?php 
if ($this->session->flashdata('notification')) { ?>
<script>
    swal({
        title: "Warning",
        text: "<?php echo $this->session->flashdata('notification'); ?>",
        timer: 2000,
        showConfirmButton: false,
        type: 'warning'
    });
</script>
<? } ?>

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
            Transaksi <small>Balik Nama</small>
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
                    <a href="<?php echo site_url('admin/baliknama'); ?>">Balik Nama</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Tambah Balik Nama</a>
                </li>
            </ul>                
        </div>              
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus-square"></i> Form Tambah Balik Nama
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/baliknama/savedata/'.$this->uri->segment(4)); ?>" method="post" enctype="multipart/form-data" name="form1">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="id" value="<?php echo $detail->dasar_id; ?>">
                        <input type="hidden" name="dasar_no" value="<?php echo $detail->dasar_no; ?>">
                        <input type="hidden" name="dasar_npwrd" value="<?php echo $detail->dasar_npwrd; ?>">
                        <input type="hidden" name="pedagang_id_lama" value="<?php echo $detail->pedagang_id; ?>">
                        <input type="hidden" class="pedagang_id" name="pedagang_id" value="<?php echo set_value('pedagang_id'); ?>">
                        <input type="hidden" name="pasar_id" value="<?php echo $detail->pasar_id; ?>">
                        <input type="hidden" name="pasar_inisial" value="<?php echo $detail->pasar_inisial; ?>">
                        <input type="hidden" name="pasar_kode" value="<?php echo $detail->pasar_kode; ?>">
                        <input type="hidden" name="jenis_id" value="<?php echo $detail->jenis_id; ?>">
                        <input type="hidden" name="jenis_kode" value="<?php echo $detail->jenis_kode; ?>">
                        <input type="hidden" name="tempat_id" value="<?php echo $detail->tempat_id; ?>">
                        <input type="hidden" name="blok" value="<?php echo $detail->dasar_blok; ?>">
                        <input type="hidden" name="nomor" value="<?php echo $detail->dasar_nomor; ?>">
                        <input type="hidden" name="panjang" value="<?php echo $detail->dasar_panjang; ?>">
                        <input type="hidden" name="lebar" value="<?php echo $detail->dasar_lebar; ?>">
                        <input type="hidden" name="luas" value="<?php echo $detail->dasar_luas; ?>">

                            <?php
                                // Tgl. Surat
                                $tgl_surat      = $detail->dasar_tgl_surat;
                                if (!empty($tgl_surat)) {
                                    $xtgl           = explode("-",$tgl_surat);
                                    $thn            = $xtgl[0];
                                    $bln            = $xtgl[1];
                                    $tgl            = $xtgl[2];
                                    $tanggal_srt    = $tgl.'-'.$bln.'-'.$thn;
                                } else {
                                    $tanggal_srt    = '';
                                }

                                $tgl_dari           = $detail->dasar_dari;
                                if (!empty($tgl_dari)) {
                                    $xtgld          = explode("-",$tgl_dari);
                                    $thnd           = $xtgld[0];
                                    $blnd           = $xtgld[1];
                                    $tgld           = $xtgld[2];
                                    $tanggal_dari   = $tgld.'-'.$blnd.'-'.$thnd;
                                } else {
                                    $tanggal_dari   = '';
                                }

                                $tgl_sampai         = $detail->dasar_sampai;
                                if (!empty($tgl_sampai)) {
                                    $xtgls          = explode("-",$tgl_sampai);
                                    $thns           = $xtgls[0];
                                    $blns           = $xtgls[1];
                                    $tgls           = $xtgls[2];
                                    $tanggal_sampai = $tgls.'-'.$blns.'-'.$thns;
                                } else {
                                    $tanggal_sampai = '';
                                }
                            ?>

                            <div class="form-body">
                                <h3 class="form-section">Data Surat Pendasaran</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">No Surat</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Enter No Surat" name="no" value="<?php echo $detail->dasar_no; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">NPWRD</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Enter NPWRD" name="npwrd" value="<?php echo $detail->dasar_npwrd; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tanggal Surat</label>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" name="tgl_surat" value="<?php echo $tanggal_srt; ?>" placeholder="DD-MM-YYYY" autocomplete="off" readonly />
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Periode Berlaku</label>
                                    <div class="col-md-3">                                
                                        <input type="text" class="form-control" name="tgl_berlaku" value="<?php echo $tanggal_dari.' s/d '.$tanggal_sampai; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div> 
                                </div>
                                <h3 class="form-section">Data Pasar</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pasar</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Pasar" name="namapasar" value="<?php echo $detail->pasar_nama.' - '.$detail->pasar_alamat.', DESA '.$detail->desa_nama.', KECAMATAN '.$detail->kecamatan_nama; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jenis Tempat</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Enter Jenis Tempat" name="namapasar" value="<?php echo $detail->tempat_nama.' Blok '.$detail->dasar_blok.', Nomor '.$detail->dasar_nomor.', Luas '.$detail->dasar_luas.' m2'; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>                                
                                <h3 class="form-section">Data Pedagang Lama</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">N I K</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Enter N I K" name="nik" value="<?php echo $detail->pedagang_nik; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pedagang</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Pedagang" name="nama" value="<?php echo $detail->pedagang_nama; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Jenis Dagang</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Jenis Dagang" name="nama" value="<?php echo $detail->jenis_nama; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <h3 class="form-section">Data Balik Nama</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tanggal Balik Nama</label>
                                    <div class="col-md-3">
                                        <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" name="tgl_surat" value="<?php echo set_value('tgl_surat', date('d-m-Y')); ?>" placeholder="DD-MM-YYYY" autocomplete="off" required autofocus/>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div> 
                                <h3 class="form-section">Data Pedagang Baru</h3>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">N I K</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control pedagang_nik" placeholder="Enter N I K" name="nik" value="<?php echo set_value('nik'); ?>" autocomplete="off" required>
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

                                <div class="form-group">
                                    <div class="mt-checkbox-list col-sm-12">                                        
                                        <label class="mt-checkbox mt-checkbox-outline"><b>NOTE :</b><br>
                                        - Setelah Anda Klik <b>Simpan</b>, selanjutnya akan otomatis membuat <b>Surat Pendasaran Baru</b> untuk <b>Pedagang Baru</b>, mohon diinput dengan Lengkap. <br>
                                        - Surat Pendasaran yang lama sudah <b>TIDAK BERLAKU</b> lagi.
                                        </label>                          
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Simpan</button>
                                        <a href="<?php echo site_url('admin/baliknama/pilihpasar'); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
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