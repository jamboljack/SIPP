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
    $(document).on("click",'.pilih_penduduk', function(e) {
        var penduduk_id         = $(this).data('id');
        var penduduk_nik        = $(this).data('nik');
        var penduduk_nama       = $(this).data('nama');
        var tgl_lahir           = $(this).data('tgl');
        var penduduk_tgl_lahir  = tgl_lahir.split("-").reverse().join("-");
        var alamat              = $(this).data('alamat');
        var rt                  = $(this).data('rt');
        var rw                  = $(this).data('rw');
        var provinsi            = $(this).data('provinsi');
        var kabupaten           = $(this).data('kabupaten');
        var kecamatan           = $(this).data('kecamatan');
        var desa                = $(this).data('desa');
        $(".penduduk_id").val(penduduk_id);
        $(".penduduk_nik").val(penduduk_nik);
        $(".penduduk_nama").val(penduduk_nama);
        $(".penduduk_tgl_lahir").val(penduduk_tgl_lahir);
        $(".penduduk_alamat").val(alamat+' RT. '+rt+'/'+rw+' DESA '+desa+' KEC. '+kecamatan+' KAB. '+kabupaten+' PROVINSI '+provinsi);
    })
});
</script>

<!-- List Penduduk -->
<div class="modal bs-modal-lg" id="caripenduduk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-header">                      
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-search"></i> Cari Data Penduduk</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="5%">Pilih</th>
                                <th width="12%">N I K</th>
                                <th width="15%">Nama Penduduk</th>
                                <th width="10%">Tgl. Lahir</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                            
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($listPenduduk as $p) {
                                $tgl_lhr      = $p->penduduk_tgl_lahir;
                                $xtgl           = explode("-",$tgl_lhr);
                                $thn            = $xtgl[0];
                                $bln            = $xtgl[1];
                                $tgl            = $xtgl[2];
                                $tanggal_lhr    = $tgl.'-'.$bln.'-'.$thn;                            
                            ?>
                            <tr>
                                <td align="center">
                                    <button type="button" class="btn btn-success btn-xs pilih_penduduk" data-toggle="modal" data-id="<?php echo $p->penduduk_id; ?>" data-nik="<?php echo $p->penduduk_nik; ?>" data-nama="<?php echo $p->penduduk_nama; ?>" data-tgl="<?php echo $p->penduduk_tgl_lahir; ?>" data-alamat="<?php echo $p->penduduk_alamat; ?>" data-rt="<?php echo $p->penduduk_rt; ?>" data-rw="<?php echo $p->penduduk_rw; ?>" data-provinsi="<?php echo $p->provinsi_nama; ?>" data-kabupaten="<?php echo $p->kabupaten_nama; ?>" data-kecamatan="<?php echo $p->kecamatan_nama; ?>" data-desa="<?php echo $p->desa_nama; ?>" title="Pilih Data" data-dismiss="modal"><i class="icon-check"></i>
                                    </button>
                                </td>
                                <td><?php echo $p->penduduk_nik; ?></td>
                                <td><?php echo $p->penduduk_nama; ?></td>
                                <td><?php echo $tanggal_lhr; ?></td>
                                <td><?php echo $p->penduduk_alamat.' RT. '.$p->penduduk_rt.'/'.$p->penduduk_rw.' DESA '.$p->desa_nama.' KEC. '.$p->kecamatan_nama.'<br> KAB. '.$p->kabupaten_nama.' PROVINSI '.$p->provinsi_nama; ?></td>
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
                    <a href="#">Edit Balik Nama</a>
                </li>
            </ul>                
        </div>              
                        
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i> Form Edit Balik Nama
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" action="<?php echo site_url('admin/baliknama/updatedata/'.$this->uri->segment(4)); ?>" method="post" enctype="multipart/form-data" name="form1">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="baliknama_id" value="<?php echo $detailbalik->baliknama_id; ?>">
                        <input type="hidden" name="id" value="<?php echo $detail->dasar_id; ?>">
                        <input type="hidden" name="dasar_no" value="<?php echo $detail->dasar_no; ?>">
                        <input type="hidden" name="dasar_npwrd" value="<?php echo $detail->dasar_npwrd; ?>">
                        <input type="hidden" name="penduduk_id_lama" value="<?php echo $detail->penduduk_id; ?>">
                        <input type="hidden" class="penduduk_id" name="penduduk_id" value="<?php echo $detailbalik->penduduk_id; ?>">
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
                                        <input type="text" class="form-control" placeholder="Enter N I K" name="nik" value="<?php echo $detail->penduduk_nik; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Nama Pedagang</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Nama Pedagang" name="nama" value="<?php echo $detail->penduduk_nama; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <?php
                                    $tgl_lahir      = $detail->penduduk_tgl_lahir;
                                    $xtgl           = explode("-",$tgl_lahir);
                                    $thn            = $xtgl[0];
                                    $bln            = $xtgl[1];
                                    $tgl            = $xtgl[2];
                                    $tanggal_lhr    = $tgl.'-'.$bln.'-'.$thn;
                                ?>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tanggal Lahir</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="tgl_lahir" value="<?php echo $tanggal_lhr; ?>" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="alamat" rows="1" readonly><?php echo $detail->penduduk_alamat.' RT.'.$detail->penduduk_rt.'/'.$detail->penduduk_rw.' DESA '.$detail->desa_lama.' KEC. '.$detail->kecamatan_lama.' KAB. '.$detail->kabupaten_nama.' PROV. '.$detail->provinsi_nama; ?></textarea>
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
                                    <label class="col-md-3 control-label" for="form_control_1">No. Surat Balik Nama</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nama" value="<?php echo $detailbalik->baliknama_no; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
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
                                        <input type="text" class="form-control penduduk_nik" placeholder="Enter N I K" name="nik_baru" value="<?php echo $detailbalik->penduduk_nik; ?>" autocomplete="off" required>
                                        <div class="form-control-focus"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="input-group-btn btn-right">
                                            <a data-toggle="modal" href="#caripenduduk" title="Klik untuk Cari Data">
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
                                        <input type="text" class="form-control penduduk_nama" placeholder="Nama Pedagang" name="nama_baru" value="<?php echo $detailbalik->penduduk_nama; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <?php
                                    $tgl_lahir1     = $detailbalik->penduduk_tgl_lahir;
                                    $xtgl1          = explode("-",$tgl_lahir1);
                                    $thn1           = $xtgl1[0];
                                    $bln1           = $xtgl1[1];
                                    $tgl1           = $xtgl1[2];
                                    $tanggal_lhr1   = $tgl1.'-'.$bln1.'-'.$thn1;
                                ?>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Tanggal Lahir</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control penduduk_tgl_lahir" placeholder="DD-MM-YYYY" name="tgl_lahir_baru" value="<?php echo $tanggal_lhr1; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control penduduk_alamat" placeholder="Alamat" name="alamat_baru" value="<?php echo $detailbalik->penduduk_alamat.' RT.'.$detailbalik->penduduk_rt.'/'.$detailbalik->penduduk_rw.' DESA '.$detailbalik->desa_nama.' KEC. '.$detailbalik->kecamatan_nama.' KAB. '.$detailbalik->kabupaten_nama.' PROV. '.$detailbalik->provinsi_nama; ?>" autocomplete="off" readonly>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Update</button>
                                        <a href="<?php echo site_url('admin/baliknama'); ?>" class="btn yellow"><i class="fa fa-times"></i> Batal
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