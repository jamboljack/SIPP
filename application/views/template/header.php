<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
    <div class="page-header-inner">        
        <div class="page-logo">
            <a href="<?php echo site_url('admin/home'); ?>">
                <img src="<?php echo base_url(); ?>img/logo-admin.png" alt="logo" class="logo-default"/>
            </a>
            <div class="menu-toggler sidebar-toggler hide"></div>
        </div>

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="icon-bell"></i>
                    <?php
                    $ListDasarBaru  = $this->home_model->select_pendasaran_baru()->result(); 
                    $Jml_Dasar = count($ListDasarBaru);
                    ?>
                    <span class="badge badge-default">
                    <?php echo $Jml_Dasar; ?> </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">                            
                            <h3><span class="bold"><?php echo $Jml_Dasar; ?> Pending</span> Pendasaran</h3>
                            <a href="<?php echo site_url('admin/pendasaran');?>">Tampil Semua</a>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                <?php foreach($ListDasarBaru as $x) { ?>
                                <li>
                                    <a href="#">
                                    <span class="time">
                                        <?php 
                                            $tgl_surat      = $x->dasar_tgl_surat;
                                            $xtgl           = explode("-",$tgl_surat);
                                            $thn            = $xtgl[0];
                                            $bln            = $xtgl[1];
                                            $tgl            = $xtgl[2];
                                            $tanggal_surat  = $tgl.'-'.$bln.'-'.$thn; 
                                            echo $tanggal_surat;
                                        ?>
                                    </span>
                                    <span class="details">
                                    <?php echo $x->dasar_no; ?></span>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="fa fa-random"></i>
                    <?php
                    $ListBalikNama  = $this->home_model->select_baliknama()->result(); 
                    $Jml_Balik      = count($ListBalikNama);
                    ?>
                    <span class="badge badge-warning">
                    <?php echo $Jml_Balik; ?> </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3><span class="bold"><?php echo $Jml_Balik; ?> Pending</span> Balik Nama</h3>
                            <a href="<?php echo site_url('admin/baliknama');?>">Tampil Semua</a>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                <?php foreach($ListBalikNama as $n) { ?>
                                <li>
                                    <a href="#">
                                    <span class="time">
                                        <?php 
                                            $tgl_surat      = $n->baliknama_tgl;
                                            $xtgl           = explode("-",$tgl_surat);
                                            $thn            = $xtgl[0];
                                            $bln            = $xtgl[1];
                                            $tgl            = $xtgl[2];
                                            $tanggal_surat  = $tgl.'-'.$bln.'-'.$thn; 
                                            echo $tanggal_surat;
                                        ?>
                                    </span>
                                    <span class="details">
                                    <?php echo $n->baliknama_no; ?></span>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-user">                    
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <?php
                        if ($this->session->userdata('avatar') <> '') {
                            $image = "icon/".$this->session->userdata('avatar');
                        } else {
                            $image = "img/avatar.png";
                        }                        
                        ?>
                        <img alt="" class="img-circle" src="<?php echo base_url().$image; ?>"/>
                        <span class="username username-hide-on-mobile"><?php echo $this->session->userdata('nama'); ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?php echo site_url('admin/account'); ?>">
                                <i class="icon-user"></i> My Account
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('login/logout'); ?>">
                                <i class="icon-key"></i> Log Out 
                            </a>
                        </li>
                    </ul>
                </li>                
            </ul>
        </div>      
    </div>   
</div>