<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kondisi extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/kondisi_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->kondisi_model->select_all()->result();
			$this->template->display('admin/kondisi_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function savedata() {		
		$this->kondisi_model->insert_data();
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
 		redirect(site_url('admin/kondisi'));
	}
	
	public function updatedata() {		
		$this->kondisi_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/kondisi'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/kondisi'));
		} else {
			$this->kondisi_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/kondisi'));
		}
	}	
}
/* Location: ./application/controller/admin/Kondisi.php */