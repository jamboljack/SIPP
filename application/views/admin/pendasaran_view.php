<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>
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
            window.location.href="<?php echo site_url('admin/dasar/deletedata'); ?>"+"/"+id
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
            Transaksi <small>Surat Pendasaran</small>
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
                    <a href="#">Surat Pendasaran</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo site_url('admin/pendasaran/pilihpenduduk'); ?>">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</button>
                </a>
                <br><br>
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Surat Pendasaran
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">No. Surat</th>
                                <th width="10%">Tanggal</th>
                                <th width="8%">NPWRD</th>
                                <th>Nama Pedagang</th>
                                <th width="20%">Nama Pasar</th>
                                <th width="10%">Status</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($daftarlist as $r) {
                                $dasar_id       = $r->dasar_id;

                                $tgl_surat      = $r->dasar_tgl_surat;
                                $xtgl           = explode("-",$tgl_surat);
                                $thn            = $xtgl[0];
                                $bln            = $xtgl[1];
                                $tgl            = $xtgl[2];
                                $tanggal_srt    = $tgl.'-'.$bln.'-'.$thn;
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>                                
                                <td><?php echo $r->dasar_no; ?></td>                                
                                <td><?php echo $tanggal_srt; ?></td>
                                <td><?php echo $r->dasar_npwrd; ?></td>
                                <td><?php echo $r->penduduk_nama; ?></td>
                                <td><?php echo ucwords($r->pasar_nama).' <b>('.$r->tempat_nama.')</b>'."<br>".'Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2'; ?>
                                </td>                                
                                <td>
                                    <?php if ($r->dasar_status=='Baru') { ?>
                                        <span class="label label-info"><i class="fa fa-plus-circle"></i> <?php echo $r->dasar_status; ?></span>
                                    <?php } elseif ($r->dasar_status=='Perpanjangan') { ?>
                                        <span class="label label-warning"><i class="fa fa-copy (alias)"></i> <?php echo $r->dasar_status; ?></span>
                                    <?php } else { ?>
                                        <span class="label label-primary"><i class="fa fa-random"></i> <?php echo $r->dasar_status; ?></span>
                                    <?php } ?>
                                    <br>
                                    <?php if ($r->dasar_st_print == 1) { ?>
                                        <span class="label label-default"><i class="fa fa-print"></i> <?php echo 'Di Cetak'; ?></span>
                                    <?php } else { ?>
                                        <span class="label label-danger"><i class="fa fa-print"></i> <?php echo 'Belum Cetak'; ?></span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($r->dasar_data == 0) { ?>
                                        <?php if ($r->dasar_st_print == 0) { ?>
                                        <a href="<?php echo site_url('admin/pendasaran/editdata/'.$r->dasar_id); ?>">
                                            <button class="btn btn-primary btn-xs" title="Edit Data">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </a>
                                        <?php } ?>
                                        <a href="<?php echo site_url('admin/pendasaran/printdata/'.$r->dasar_id); ?>">
                                            <button class="btn btn-default btn-xs" title="Cetak Surat Pendasaran">
                                                <i class="icon-printer"></i>
                                            </button>
                                        </a>
                                        <?php if ($r->dasar_st_print == 1) { ?>
                                        <a href="<?php echo site_url('admin/pendasaran/perpanjangan/'.$r->dasar_id); ?>">
                                            <button class="btn btn-danger btn-xs" title="Perpanjangan Surat">
                                                <i class="icon-docs"></i>
                                            </button>
                                        </a>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <span class="label label-danger"><i class="fa fa-remove (alias)"></i> Tidak Berlaku</span>
                                    <?php } ?>
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