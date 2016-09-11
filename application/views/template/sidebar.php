<?php
$uri = $this->uri->segment(2);

if ($uri == 'home') {
    $dashboard      = 'active';
    $master         = '';
    $span_master_1  = '';
    $span_master_2  = '';
    $kelas          = '';
    $bentuk         = '';
    $kondisi        = '';
    $kepemilikan    = '';
    $jenis          = '';
    $data           = '';
    $span_data_1    = '';
    $span_data_2    = '';
    $pasar          = '';
    $pedagang       = '';
    $trans          = '';
    $span_trans_1   = '';
    $span_trans_2   = '';
    $pendasaran     = '';
    $retribusi      = '';    
    $users          = '';
} elseif ($uri == 'kelas') {
    $dashboard      = '';
    $master         = 'active open';
    $span_master_1  = '<span class="selected"></span>';
    $span_master_2  = 'open';
    $kelas          = 'active';
    $bentuk         = '';
    $kondisi        = '';
    $kepemilikan    = '';    
    $jenis          = '';
    $data           = '';
    $span_data_1    = '';
    $span_data_2    = '';
    $pasar          = '';
    $pedagang       = '';
    $trans          = '';
    $span_trans_1   = '';
    $span_trans_2   = '';
    $pendasaran     = '';
    $retribusi      = '';    
    $users          = '';
} elseif ($uri == 'bentuk') {
    $dashboard      = '';
    $master         = 'active open';
    $span_master_1  = '<span class="selected"></span>';
    $span_master_2  = 'open';
    $kelas          = '';
    $bentuk         = 'active';
    $kondisi        = '';
    $kepemilikan    = '';
    $jenis          = '';
    $data           = '';
    $span_data_1    = '';
    $span_data_2    = '';
    $pasar          = '';
    $pedagang       = '';
    $trans          = '';
    $span_trans_1   = '';
    $span_trans_2   = '';
    $pendasaran     = '';
    $retribusi      = '';    
    $users          = '';
} elseif ($uri == 'kondisi') {
    $dashboard      = '';
    $master         = 'active open';
    $span_master_1  = '<span class="selected"></span>';
    $span_master_2  = 'open';
    $kelas          = '';
    $bentuk         = '';
    $kondisi        = 'active';
    $kepemilikan    = '';
    $jenis          = '';
    $data           = '';
    $span_data_1    = '';
    $span_data_2    = '';
    $pasar          = '';
    $pedagang       = '';
    $trans          = '';
    $span_trans_1   = '';
    $span_trans_2   = '';
    $pendasaran     = '';
    $retribusi      = '';    
    $users          = '';
} elseif ($uri == 'kepemilikan') {
    $dashboard      = '';
    $master         = 'active open';
    $span_master_1  = '<span class="selected"></span>';
    $span_master_2  = 'open';
    $kelas          = '';
    $bentuk         = '';
    $kondisi        = '';
    $kepemilikan    = 'active';
    $jenis          = '';
    $data           = '';
    $span_data_1    = '';
    $span_data_2    = '';
    $pasar          = '';
    $pedagang       = '';
    $trans          = '';
    $span_trans_1   = '';
    $span_trans_2   = '';
    $pendasaran     = '';
    $retribusi      = '';    
    $users          = '';
} elseif ($uri == 'jenis') {
    $dashboard      = '';
    $master         = 'active open';
    $span_master_1  = '<span class="selected"></span>';
    $span_master_2  = 'open';
    $kelas          = '';
    $bentuk         = '';
    $kondisi        = '';
    $kepemilikan    = '';
    $jenis          = 'active';
    $data           = '';
    $span_data_1    = '';
    $span_data_2    = '';
    $pasar          = '';
    $pedagang       = '';
    $trans          = '';
    $span_trans_1   = '';
    $span_trans_2   = '';
    $pendasaran     = '';
    $retribusi      = '';    
    $users          = '';
} elseif ($uri == 'pasar') {
    $dashboard      = '';
    $master         = '';
    $span_master_1  = '';
    $span_master_2  = '';
    $kelas          = '';
    $bentuk         = '';
    $kondisi        = '';
    $kepemilikan    = '';
    $jenis          = '';
    $data           = 'active open';
    $span_data_1    = '<span class="selected"></span>';
    $span_data_2    = 'open';
    $pasar          = 'active';
    $pedagang       = '';
    $trans          = '';
    $span_trans_1   = '';
    $span_trans_2   = '';
    $pendasaran     = '';
    $retribusi      = '';    
    $users          = '';
} elseif ($uri == 'pedagang') {
    $dashboard      = '';
    $master         = '';
    $span_master_1  = '';
    $span_master_2  = '';
    $kelas          = '';
    $bentuk         = '';
    $kondisi        = '';
    $kepemilikan    = '';
    $jenis          = '';
    $data           = 'active open';
    $span_data_1    = '<span class="selected"></span>';
    $span_data_2    = 'open';
    $pasar          = '';
    $pedagang       = 'active';
    $trans          = '';
    $span_trans_1   = '';
    $span_trans_2   = '';
    $pendasaran     = '';
    $retribusi      = '';    
    $users          = '';
} elseif ($uri == 'pendasaran') {
    $dashboard      = '';
    $master         = '';
    $span_master_1  = '';
    $span_master_2  = '';
    $kelas          = '';
    $bentuk         = '';
    $kondisi        = '';
    $kepemilikan    = '';
    $jenis          = '';
    $data           = '';
    $span_data_1    = '';
    $span_data_2    = '';
    $pasar          = '';
    $pedagang       = '';
    $trans          = 'active open';
    $span_trans_1   = '<span class="selected"></span>';
    $span_trans_2   = 'open';
    $pendasaran     = 'active';
    $retribusi      = '';    
    $users          = '';
} elseif ($uri == 'retribusi') {
    $dashboard      = '';
    $master         = '';
    $span_master_1  = '';
    $span_master_2  = '';
    $kelas          = '';
    $bentuk         = '';
    $kondisi        = '';
    $kepemilikan    = '';
    $jenis          = '';
    $data           = '';
    $span_data_1    = '';
    $span_data_2    = '';
    $pasar          = '';
    $pedagang       = '';    
    $trans          = 'active open';
    $span_trans_1   = '<span class="selected"></span>';
    $span_trans_2   = 'open';
    $pendasaran     = '';
    $retribusi      = 'active';    
    $users          = '';
} elseif ($uri == 'users') {
    $dashboard      = '';
    $master         = '';
    $span_master_1  = '';
    $span_master_2  = '';
    $kelas          = '';
    $bentuk         = '';
    $kondisi        = '';
    $kepemilikan    = '';
    $jenis          = '';
    $data           = '';
    $span_data_1    = '';
    $span_data_2    = '';
    $pasar          = '';
    $pedagang       = '';    
    $trans          = '';
    $span_trans_1   = '';
    $span_trans_2   = '';
    $pendasaran     = '';
    $retribusi      = '';    
    $users          = 'active';
} else {
    $dashboard      = 'active';
    $master         = '';
    $span_master_1  = '';
    $span_master_2  = '';
    $kelas          = '';
    $bentuk         = '';
    $kondisi        = '';
    $kepemilikan    = '';
    $jenis          = '';
    $data           = '';
    $span_data_1    = '';
    $span_data_2    = '';
    $pasar          = '';
    $pedagang       = '';
    $trans          = '';
    $span_trans_1   = '';
    $span_trans_2   = '';
    $pendasaran     = '';
    $retribusi      = '';    
    $users          = ''; 
}

?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">         
        <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">            
            <li class="sidebar-toggler-wrapper">            
               <div class="sidebar-toggler">
               </div>               
            </li>
            <li class="sidebar-search-wrapper">                    
                <form class="sidebar-search">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                        </span>
                    </div>
                </form>                
            </li>
            <li class="tooltips <?php echo $dashboard; ?>" data-container="body" data-placement="right" data-html="true" data-original-title="Dashboard">
                <a href="<?php echo site_url('admin/home'); ?>">
                    <i class="fa fa-home"></i>
                    <span class="title">
                    Dashboard
                    </span>
                </a>
            </li>
            <li class="<?php echo $master; ?>">
                <a href="javascript:;">
                    <i class="fa fa-list"></i>
                    <span class="title">Master</span>
                    <?php echo $span_master_1; ; ?>
                    <span class="arrow <?php echo $span_master_2; ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php echo $kelas; ?>">
                        <a href="<?php echo site_url('admin/kelas'); ?>">
                            <i class="fa fa-check-square-o"></i>
                            Kelas Pasar
                        </a>
                    </li>
                    <li class="<?php echo $bentuk; ?>">
                        <a href="<?php echo site_url('admin/bentuk'); ?>">
                            <i class="fa fa-check-square-o"></i>
                            Bentuk Bangunan
                        </a>
                    </li>
                    <li class="<?php echo $kondisi; ?>">
                        <a href="<?php echo site_url('admin/kondisi'); ?>">
                            <i class="fa fa-check-square-o"></i>
                            Kondisi Bangunan
                        </a>
                    </li>
                    <li class="<?php echo $kepemilikan; ?>">
                        <a href="<?php echo site_url('admin/kepemilikan'); ?>">
                            <i class="fa fa-check-square-o"></i>
                            Surat Kepemilikan
                        </a>
                    </li>
                    <li class="<?php echo $jenis; ?>">
                        <a href="<?php echo site_url('admin/jenis'); ?>">
                            <i class="fa fa-check-square-o"></i>
                            Jenis Dagangan
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo $data; ?>">
                <a href="javascript:;">
                    <i class="fa fa-tasks"></i>
                    <span class="title">Data</span>
                    <?php echo $span_data_1; ; ?>
                    <span class="arrow <?php echo $span_data_2; ; ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php echo $pasar; ?>">
                        <a href="<?php echo site_url('admin/pasar'); ?>">
                            <i class="fa fa-check-square-o"></i>
                            Data Pasar
                        </a>
                    </li>
                    <li class="<?php echo $pedagang; ?>">
                        <a href="<?php echo site_url('admin/pedagang'); ?>">
                            <i class="fa fa-check-square-o"></i>
                            Data Pedagang
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo $trans; ?>">
                <a href="javascript:;">
                    <i class="fa fa-exchange"></i>
                    <span class="title">Transaksi</span>
                    <?php echo $span_trans_1; ; ?>
                    <span class="arrow <?php echo $span_trans_2; ; ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php echo $pendasaran; ?>">
                        <a href="<?php echo site_url('admin/pendasaran'); ?>">
                            <i class="fa fa-check-square-o"></i>
                            Surat Pendasaran
                        </a>
                    </li>
                    <li class="<?php echo $retribusi; ?>">
                        <a href="<?php echo site_url('admin/retribusi'); ?>">
                            <i class="fa fa-check-square-o"></i>
                            Pembayaran Retribusi
                        </a>
                    </li>
                </ul>
            </li>
            <li class="tooltips <?php echo $users; ?>" data-container="body" data-placement="right" data-html="true" data-original-title="Users">
                <a href="<?php echo site_url('admin/users'); ?>">
                    <i class="fa fa-users"></i>
                    <span class="title">
                    Users
                    </span>
                </a>
            </li>            
        </ul>        
    </div>
</div>