<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/sweetalert2.css">
<script src="<?php echo base_url(); ?>js/sweetalert2.min.js"></script>

<?php 
if ($this->session->flashdata('notification')) { ?>
	<script>
    	swal({
        	title: "Done",
            text: "<?php echo $this->session->flashdata('notification'); ?>",
            timer: 2500,
            showConfirmButton: false,
            type: 'success'
       	});
    </script>
<? } ?>

<div class="page-content-wrapper">
	<div class="page-content">		
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		My Account <small>User Account</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
						<a href="<?php echo site_url('admin/home'); ?>">Dashboard</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">My Account</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row margin-top-20">
			<div class="col-md-12">
				<!-- BEGIN PROFILE SIDEBAR -->
				<div class="profile-sidebar">
					<!-- PORTLET MAIN -->
					<div class="portlet light profile-sidebar-portlet">
						<!-- SIDEBAR USERPIC -->
						<div class="profile-userpic">
							<?php if (!empty($detail->user_avatar)) { ?>
							<img src="<?php echo base_url(); ?>icon/<?php echo $detail->user_avatar; ?>" class="img-responsive" alt="">
							<?php } else { ?>
								<img src="<?php echo base_url(); ?>img/no_photo.png" class="img-responsive" alt="">
							<?php } ?>
						</div>
						<!-- END SIDEBAR USERPIC -->
						<!-- SIDEBAR USER TITLE -->
						<div class="profile-usertitle">
							<div class="profile-usertitle-name">
								<?php echo $this->session->userdata('nama'); ?>
							</div>
							<div class="profile-usertitle-job">
								<?php echo $this->session->userdata('level'); ?>
							</div>
						</div>
						<!-- END SIDEBAR USER TITLE -->
						<!-- SIDEBAR MENU -->
						<div class="profile-usermenu">
							<ul class="nav">
								<li class="active">
									<a href="extra_profile_account.html">
									<i class="icon-settings"></i>
									Account Settings
									</a>
								</li>
							</ul>
						</div>
						<!-- END MENU -->
					</div>
					<!-- END PORTLET MAIN -->
				</div>
				<!-- END BEGIN PROFILE SIDEBAR -->
				<!-- BEGIN PROFILE CONTENT -->
				<div class="profile-content">
					<div class="row">
						<div class="col-md-12">
							<div class="portlet light">
								<div class="portlet-title tabbable-line">
									<div class="caption caption-md">
										<i class="icon-globe theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
									</div>
									<ul class="nav nav-tabs">
										<li class="active">
											<a href="#tab_1_1" data-toggle="tab">Personal Info</a>
										</li>
										<li>
											<a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
										</li>
										<li>
											<a href="#tab_1_3" data-toggle="tab">Change Password</a>
										</li>
									</ul>
								</div>
								<div class="portlet-body">
									<div class="tab-content">
										<!-- TAB 1 -->
										<div class="tab-pane active" id="tab_1_1">
											<form role="form" action="<?php echo site_url('admin/account/updatedata'); ?>" method="post">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<div class="form-group">
                                                    <label class="control-label">Nama Lengkap</label>
                                                    <input type="text" name="nama" class="form-control" placeholder="Enter Nama Lengkap" value="<?php echo $detail->user_name; ?>" autocomplete="off" required autofocus>
                                                </div>
                                                <div class="form-group">
                                                	<label class="control-label">Alamat</label>
                                                	<input type="text" name="alamat" class="form-control" placeholder="Enter Alamat" value="<?php echo $detail->user_address; ?>" autocomplete="off" required >
                                                </div>
                                                <div class="form-group">
                                                	<label class="control-label">No. Telpon</label>
                                                	<input type="text" name="telp" class="form-control" placeholder="Enter No. Telpon" value="<?php echo $detail->user_phone; ?>" autocomplete="off" required >
                                                </div>
					                            <div class="form-group">
					                            	<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update</button>
					                            </div>
                                            </form>
										</div>
										<!-- TAB 1 -->
										<!-- TAB 2 -->
										<div class="tab-pane" id="tab_1_2">
											<p>Change your Avatar Picture</p>
											<form action="<?php echo site_url('admin/account/updateavatar'); ?>" role="form" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                
                                                <div class="form-group">
                                                	<div class="fileupload fileupload-new" data-provides="fileupload">
                                                	<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                		<img src="<?php echo base_url(); ?>img/noimage.png" alt="" />
                                                	</div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;">
                                                    </div>
                                                    <div>
                                                    <span class="btn btn-blue btn-file">
                                                    	<span class="fileupload-new"><i class="icon-paper-clip"></i> Browse</span>
                                                        <span class="fileupload-exists"><i class="icon-undo"></i> Ganti</span>
                                                            <input type="file" class="default" name="userfile" />
                                                        </span>                                             
                                                    </div>
                                                   	</div>                                                  
                                                </div>
                                                <div class="form-group">
                                                	<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Change Avatar</button>
                                                </div>
                                            </form>
										</div>
										<!-- TAB 2 -->
										<!-- CHANGE PASSWORD TAB -->
										<div class="tab-pane" id="tab_1_3">
											<form action="<?php echo site_url('admin/account/updatepassword'); ?>" method="post">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<div class="form-group">
													<label class="control-label">New Password</label>
													<input type="password" class="form-control" name="password" required />
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Change Password</button>
												</div>
											</form>
										</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PROFILE CONTENT -->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->