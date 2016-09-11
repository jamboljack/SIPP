<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepemilikan extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/kepemilikan_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->kepemilikan_model->select_all()->result();
			$this->template->display('admin/kepemilikan_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function savedata() {		
		$this->kepemilikan_model->insert_data();
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
 		redirect(site_url('admin/kepemilikan'));
	}
	
	public function updatedata() {		
		$this->kepemilikan_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/kepemilikan'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/kepemilikan'));
		} else {
			$this->kepemilikan_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/kepemilikan'));
		}
	}	
}
/* Location: ./application/controller/admin/Kepemilikan.php */