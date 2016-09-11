<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendasaran extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/pendasaran_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->pendasaran_model->select_all()->result();
			$this->template->display('admin/pendasaran_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function adddata() {
		$data['error']			= false;		
		$data['listPasar'] 		= $this->pendasaran_model->select_pasar()->result();
		$data['listPedagang'] 	= $this->pendasaran_model->select_pedagang()->result();
		$data['listJenis'] 		= $this->pendasaran_model->select_jenis()->result();
		$this->template->display('admin/pendasaran_add_view', $data);
	}

	public function savedata() {		
		$this->pendasaran_model->insert_data();
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
	 	redirect(site_url('admin/pendasaran'));
	}
	
	public function editdata($pendasaran_id) {		
		$data['listAlamat'] 	= $this->pendasaran_model->select_prov_kab()->result();
		$data['detail'] 		= $this->pendasaran_model->select_detail_by_id($pendasaran_id)->row();
		$this->template->display('admin/pendasaran_edit_view', $data);
	}

	public function updatedata() {		
		$this->pendasaran_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/pendasaran'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/pendasaran'));
		} else {
			$this->pendasaran_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/pendasaran'));
		}
	}	
}
/* Location: ./application/controller/admin/Pendasaran.php */