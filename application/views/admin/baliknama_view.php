<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>
<script>
    function hapusData(baliknama_id) {
        var id = baliknama_id;
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
            window.location.href="<?php echo site_url('admin/baliknama/deletedata'); ?>"+"/"+id
        });
    }
</script>

<script>
    function ACCData(baliknama_id) {
        var id = baliknama_id;
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
            window.location.href="<?php echo site_url('admin/baliknama/savedataacc'); ?>"+"/"+id
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
            Transaksi Pendasaran <small>Balik Nama</small>
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
                    <a href="#">Balik Nama</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">
                <?php if ($this->session->userdata('level') <> 'Operator') { ?>
                <div class="form-body">
                    <div class="alert alert-block alert-warnung fade in">
                        <b>NOTE :</b><br>
                        - Setelah Anda Klik <b>ACC Data</b>, selanjutnya akan otomatis membuat <b>Surat Pendasaran Baru</b> untuk <b>Pedagang Baru</b>, mohon diinput dengan Lengkap. <br>
                        - Surat Pendasaran yang lama sudah <b>TIDAK BERLAKU</b> lagi.
                    </div>               
                </div>
                <?php } ?>
                <a href="<?php echo site_url('admin/baliknama/pilihpasar'); ?>">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</button>
                </a>
                <br><br>
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Balik Nama
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">No. Surat</th>
                                <th width="10%">Tanggal</th>
                                <th width="10%">No. Surat Dasar</th>
                                <th width="10%">Pedagang Lama</th>
                                <th width="10%">Pedagang Baru</th>                                
                                <th width="20%">Nama Pasar</th>                                
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($daftarlist as $r) {
                                $baliknama_id   = $r->baliknama_id;
                                $tgl_surat      = $r->baliknama_tgl;
                                $xtgl           = explode("-",$tgl_surat);
                                $thn            = $xtgl[0];
                                $bln            = $xtgl[1];
                                $tgl            = $xtgl[2];
                                $tanggal_srt    = $tgl.'-'.$bln.'-'.$thn;
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>                                
                                <td><?php echo $r->baliknama_no; ?></td>                                
                                <td><?php echo $tanggal_srt; ?></td>
                                <td><?php echo $r->dasar_no; ?></td>
                                <td><?php echo $r->dasar_npwrd.'<br>'.$r->nama; ?></td>
                                <td><?php echo $r->baliknama_npwrd.'<br>'.$r->penduduk_nama; ?></td>
                                <td><?php echo ucwords($r->pasar_nama).' <b>('.$r->tempat_nama.')</b>'."<br>".'Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2'; ?>
                                </td>                               
                                <td>
                                    <?php if ($r->baliknama_data == 0) { ?>
                                    <a href="<?php echo site_url('admin/baliknama/editdata/'.$r->baliknama_id.'/'.$r->dasar_id); ?>">
                                        <button class="btn btn-primary btn-xs" title="Edit Data">
                                            <i class="icon-pencil"></i>
                                        </button>
                                    </a>
                                    <a onclick="hapusData(<?php echo $baliknama_id; ?>)"><button class="btn btn-danger btn-xs" title="Hapus Data"><i class="icon-trash"></i></button>
                                    </a>
                                    <?php } else { ?>
                                    <span class="label label-success"><i class="fa fa-check-square"></i> ACC SPV</span>
                                    <?php } ?>

                                    <?php if ($this->session->userdata('level') <> 'Operator' && $r->baliknama_data == 0) { ?>
                                        <a onclick="ACCData(<?php echo $baliknama_id; ?>)"><button class="btn btn-success btn-xs" title="ACC"><i class="icon-check "></i> ACC Data</button>
                                        </a>
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