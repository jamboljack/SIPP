<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/jenis_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->jenis_model->select_all()->result();
			$this->template->display('admin/jenis_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function savedata() {		
		$this->jenis_model->insert_data();
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
 		redirect(site_url('admin/jenis'));
	}
	
	public function updatedata() {		
		$this->jenis_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/jenis'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/jenis'));
		} else {
			$this->jenis_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/jenis'));
		}
	}	
}
/* Location: ./application/controller/admin/Jenis.php */