<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bentuk extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/bentuk_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->bentuk_model->select_all()->result();
			$this->template->display('admin/bentuk_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function savedata() {		
		$this->bentuk_model->insert_data();
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
 		redirect(site_url('admin/bentuk'));
	}
	
	public function updatedata() {		
		$this->bentuk_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/bentuk'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/bentuk'));
		} else {
			$this->bentuk_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/bentuk'));
		}
	}
}
/* Location: ./application/controller/admin/Bentuk.php */