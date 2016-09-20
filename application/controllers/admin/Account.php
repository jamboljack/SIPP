<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/account_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['detail'] = $this->account_model->select_detail()->row();
			$this->template->display('admin/account_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function updatedata() {
		$this->account_model->update_data();
		$this->session->set_flashdata('notification','Update Personal Info Success.');
 		redirect(site_url('admin/account'));
	}

	public function updateavatar() {
		if (!empty($_FILES['userfile']['name'])) {
			$jam 	= time();
			$kode 	= strtolower($this->session->userdata('username'));
					
			$config['file_name']    = 'Avatar_'.$kode.'_'.$jam.'.jpg';
			$config['upload_path'] = './icon/';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';		
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->do_upload('userfile');
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config['maintain_ratio'] = TRUE;
											
			$config['width'] = 200;
			$config['height'] = 200;
			$this->load->library('image_lib',$config);
			 
			$this->image_lib->resize();
		} elseif (empty($_FILES['userfile']['name'])){
			$config['file_name'] = '';
		}		
		
		$this->account_model->update_data_avatar();
		$this->session->set_flashdata('notification','Update Avatar Success.');
 		redirect(site_url('admin/account'));
	}

	public function updatepassword() {	
		$this->account_model->update_data_password();
		$this->session->set_flashdata('notification','Update Password Success.');
 		redirect(site_url('admin/account'));
	}
}
/* Location: ./application/controller/admin/Account.php */