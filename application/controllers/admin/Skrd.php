<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skrd extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/skrd_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['listPasar'] 	= $this->skrd_model->select_pasar()->result();
			$data['listTempat'] = $this->skrd_model->select_tempat()->result();
			$data['daftarlist'] = $this->skrd_model->select_all()->result();
			$this->template->display('admin/skrd_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function adddata() {
		$data['error'] 		= 'false';
		$data['listPasar'] 	= $this->skrd_model->select_pasar()->result();
		$data['listTempat'] = $this->skrd_model->select_tempat()->result();
		$this->template->display('admin/skrd_add_view', $data);
	}

	public function savedata() {		
		$pasar_id	= $this->input->post('lstPasar');
		// Cari Data Pedagang by Pasar		
		$pedagang 	= $this->skrd_model->select_pedagang($pasar_id)->result();
		foreach ($pedagang as $p) {
			$dasar_id 	= $p->dasar_id;
			$cek_skrd 	= $this->skrd_model->select_skrd($dasar_id)->row(); // Cari Data SKRD by Periode
			if (count($cek_skrd) == 0) { // Belum Ada
				// Insert Data
				$this->skrd_model->insert_data($dasar_id);
			}
		}
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
	 	redirect(site_url('admin/skrd'));
	}
	
	public function editdata($skrd_id) {
		$data['detail'] 		= $this->skrd_model->select_detail_by_id($skrd_id)->row();
		$this->template->display('admin/skrd_edit_view', $data);
	}

	public function updatedata() {
		$this->skrd_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/skrd'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/skrd'));
		} else {
			$this->skrd_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/skrd'));
		}
	}

	public function rincian($skrd_id) {		
		$data['listTarif'] 		= $this->skrd_model->select_tarif($skrd_id)->result();
		$data['detail'] 		= $this->skrd_model->select_detail_by_id($skrd_id)->row();
		$data['listKelas'] 		= $this->skrd_model->select_kelas()->result();
		$data['listTempat'] 	= $this->skrd_model->select_tempat()->result();
		$this->template->display('admin/skrd_tarif_view', $data);
	}

	public function savedatatarif() {
		$this->skrd_model->insert_data_tarif();
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
	 	redirect(site_url('admin/skrd/rincian/'.$this->uri->segment(4)));
	}

	public function updatedatatarif() {
		$this->skrd_model->update_data_tarif();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/skrd/rincian/'.$this->uri->segment(4)));
	}

	public function deletedatatarif($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(5));
		
		if ($kode == null) {
			redirect(site_url('admin/skrd/rincian/'.$this->uri->segment(4)));
		} else {
			$this->skrd_model->delete_data_tarif($kode);
			$this->session->set_flashdata('notification','Hapus Data Tarif Sukses.');
			redirect(site_url('admin/skrd/rincian/'.$this->uri->segment(4)));
		}
	}	
}
/* Location: ./application/controller/admin/Skrd.php */