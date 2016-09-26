<script type="text/javascript">
    $(document).ready(function () {        
        $("#lstPasar").select2({
        });
    });
</script>

<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Report <small>Pedagang per Pasar</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">                    
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Report</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Pedagang per Pasar</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-md-12">                
                <div class="portlet-body form">
                    <form role="form" class="form-horizontal" action="<?php echo site_url('admin/lap1/caridata'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Pasar</label>
                                        <div class="col-md-9">
                                            <select class="select2_category form-control" data-placeholder="- Pilih Nama Pasar -" name="lstPasar" id="lstPasar" required>
                                                <option value="">- Pilih Nama Pasar -</option>
                                                <?php
                                                foreach($listPasar as $p) {
                                                ?>php
                                                <option value="<?php echo $p->pasar_id; ?>" <?php echo set_select('lstPasar', $p->pasar_id); ?>><?php echo $p->pasar_nama; ?></option>
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
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Tempat</label>
                                        <div class="col-md-5">
                                            <select class="select2_category form-control" data-placeholder="- Pilih Jenis Tempat -" name="lstTempat" id="lstTempat" required>
                                                <option value="all">Semua</option>
                                                <?php
                                                foreach($listTempat as $t) {
                                                ?>php
                                                <option value="<?php echo $t->tempat_id; ?>" <?php echo set_select('lstTempat', $t->tempat_id); ?>><?php echo ucwords(strtolower($t->tempat_nama)); ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="form-control-focus"></div>
                                        </div>
                                        <div class="col-md-2">
                                            <span class="input-group-btn btn-right">    
                                                <button class="btn blue-madison" type="submit">
                                                    <i class="fa fa-search"></i> Cari
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <?php if ($tampil == 'ya') { ?>
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo site_url('admin/skrd/adddata'); ?>">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Buat SKRD</button>
                </a>
                <br><br>
                <div class="portlet box red-intense">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Daftar Data SKRD
                        </div>
                        <div class="tools"></div>
                    </div>

                    <div class="portlet-body">                        
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">No. Surat</th>
                                <th width="10%">Periode</th>
                                <th>NPWRD</th>
                                <th width="20%">Pasar</th>
                                <th width="9%">Total</th>
                                <th width="10%">Status</th>
                                <th width="14%">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($daftarlist as $r) {
                                $skrd_id    = $r->skrd_id;

                                $bln        = $r->skrd_bulan;
                                switch ($bln) {
                                    case 1:
                                        $bulan = "Januari";
                                        break;
                                    case 2:
                                        $bulan = "Februari";
                                        break;
                                    case 3:
                                        $bulan = "Maret";
                                        break;
                                    case 4:
                                        $bulan = "April";
                                        break;
                                    case 5:
                                        $bulan = "Mei";
                                        break;
                                    case 6:
                                        $bulan = "Juni";
                                        break;
                                    case 7:
                                        $bulan = "Juli";
                                        break;
                                    case 8:
                                        $bulan = "Agustus";
                                        break;
                                    case 9:
                                        $bulan = "September";
                                        break;
                                    case 10:
                                        $bulan = "Oktober";
                                        break;
                                    case 11:
                                        $bulan = "November";
                                        break;
                                    case 12:
                                        $bulan = "Desember";
                                        break;
                                }

                                $ttl    = ($r->skrd_total+$r->skrd_bunga+$r->skrd_kenaikan);
                                $total  = '<b>Rp. '.number_format($ttl, 0, '.', ',').'</b>';

                                if ($r->skrd_status == 0) {
                                    $status = '<span class="label label-danger">BELUM BAYAR</span>';
                                } else {
                                    $status = '<span class="label label-success">BAYAR</span>';
                                }
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>                                
                                <td><?php echo $r->skrd_no; ?></td>
                                <td><?php echo $bulan.'<br>'.$r->skrd_tahun; ?></td>
                                <td><?php echo $r->dasar_npwrd.'<br>'.$r->penduduk_nama; ?></td>
                                <td><?php echo $r->pasar_nama.' <b>('.$r->tempat_nama.')</b>'."<br>".'Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2'; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $status; ?></td>
                                <td>
                                    <?php if ($r->skrd_status==0) { ?>
                                    <a href="<?php echo site_url('admin/skrd/editdata/'.$r->skrd_id); ?>">
                                        <button class="btn btn-primary btn-xs" title="Edit Data">
                                            <i class="icon-pencil"></i>
                                        </button>
                                    </a>
                                    <a href="<?php echo site_url('admin/skrd/printdata/'.$r->skrd_id); ?>" target="_blank">
                                        <button class="btn btn-default btn-xs" title="Cetak Surat Tagihan">
                                            <i class="icon-printer"></i>
                                        </button>
                                    </a>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('level')<>'Operator' && $r->skrd_status==0) { ?>
                                    <a onclick="hapusData(<?php echo $skrd_id; ?>)">
                                        <button class="btn btn-danger btn-xs" title="Hapus Data">
                                            <i class="icon-trash"></i>
                                        </button>
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
        <?php } ?>

        <div class="clearfix"></div>
    </div>
</div>