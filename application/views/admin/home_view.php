<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">
            Dashboard <small>Statistics <?php echo date('Y'); ?></small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">                    
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
                </li>
            </ul>                
        </div>            
                        
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-building"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <?php 
                            $Jml_Pasar = count($TotalPasar);
                            echo number_format($Jml_Pasar);
                        ?>
                        </div>
                        <div class="desc">
                        Pasar
                        </div>
                    </div>
                    <a class="more" href="<?php echo site_url('admin/pasar'); ?>">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <?php 
                            $Jml_Data = count($TotalPedagang);
                            echo number_format($Jml_Data);
                        ?>
                        </div>
                        <div class="desc">
                        Pedagang
                        </div>
                    </div>
                    <a class="more" href="<?php echo site_url('admin/pendasaran'); ?>">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green-haze">
                    <div class="visual">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <?php 
                            $Tagihan = ($tagihan->subtotal+$tagihan->bunga+$tagihan->kenaikan);
                            echo number_format($Tagihan);
                        ?>
                        </div>
                        <div class="desc">
                        Tagihan <?php echo date('Y'); ?>
                        </div>
                    </div>
                    <a class="more" href="<?php echo site_url('admin/skrd'); ?>">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-line-chart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <?php 
                            $Bayar = ($bayar->subtotal+$bayar->bunga+$bayar->kenaikan);
                            echo number_format($Bayar);
                        ?>
                        </div>
                        <div class="desc">
                        Pembayaran <?php echo date('Y'); ?>
                        </div>
                    </div>
                    <a class="more" href="<?php echo site_url('admin/retribusi'); ?>">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>         
            
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-blue-steel hide"></i>
                            <span class="caption-subject font-blue-steel bold uppercase">Pendasaran Tempo Bulan ini</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                            <ul class="feeds">
                                <?php foreach($ListDasar as $r) { ?>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-warning">
                                                    <i class="fa fa-info"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    <a href='<?php echo site_url('admin/pendasaran/editdata/'.$r->dasar_id); ?>' title='Klik untuk Detail'><?php echo $r->dasar_no; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            <?php 
                                            $tgl_tempo      = $r->dasar_sampai;
                                            $xtgl           = explode("-",$tgl_tempo);
                                            $thn            = $xtgl[0];
                                            $bln            = $xtgl[1];
                                            $tgl            = $xtgl[2];
                                            $tanggal_tempo  = $tgl.'-'.$bln.'-'.$thn; 
                                            echo $tanggal_tempo;
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="scroller-footer">
                            <div class="btn-arrow-link pull-right">
                                <a href="<?php echo site_url('admin/skrd'); ?>">Lihat Semua</a>
                                <i class="icon-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-blue-steel hide"></i>
                            <span class="caption-subject font-blue-steel bold uppercase">Pembayaran Tempo Bulan ini</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                            <ul class="feeds">
                                <?php foreach($ListSKRD as $s) { ?>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-danger">
                                                    <i class="fa fa-check-square-o"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    <a href='<?php echo site_url('admin/retribusi/editdata/'.$s->skrd_id); ?>' title='Klik untuk Detail'><?php echo $s->skrd_no; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            <?php 
                                            $ttl    = ($s->skrd_total+$s->skrd_bunga+$s->skrd_kenaikan);
                                            echo number_format($ttl, 0, '.', ','); 
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="scroller-footer">
                            <div class="btn-arrow-link pull-right">
                                <a href="<?php echo site_url('admin/retribusi'); ?>">Lihat Semua</a>
                                <i class="icon-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>