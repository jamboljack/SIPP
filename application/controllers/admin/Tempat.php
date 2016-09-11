<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tempat extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/tempat_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->tempat_model->select_all()->result();
			$this->template->display('admin/tempat_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function savedata() {		
		$this->tempat_model->insert_data();
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
 		redirect(site_url('admin/tempat'));
	}
	
	public function updatedata() {		
		$this->tempat_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/tempat'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/tempat'));
		} else {
			$this->tempat_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/tempat'));
		}
	}	
}
/* Location: ./application/controller/admin/Tempat.php */