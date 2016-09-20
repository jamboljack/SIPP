<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komponen extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/komponen_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->komponen_model->select_all()->result();
			$this->template->display('admin/komponen_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function adddata() {
		$data['error'] 	= 'false';
		$this->template->display('admin/komponen_add_view', $data);
	}

	public function savedata() {
		$this->form_validation->set_rules('uraian','<b>Uraian Komponen</b>','trim|required|is_unique[sipp_komponen.komponen_uraian]');		

		if ($this->form_validation->run() == FALSE) {
			$data['error'] 	= 'true';
			$this->template->display('admin/komponen_add_view', $data);
		} else {
			$this->komponen_model->insert_data();
			$this->session->set_flashdata('notification','Simpan Data Sukses.');
	 		redirect(site_url('admin/komponen'));
	 	}
	}
	
	public function editdata($komponen_id) {
		$data['detail'] 		= $this->komponen_model->select_detail_by_id($komponen_id)->row();
		$this->template->display('admin/komponen_edit_view', $data);
	}

	public function updatedata() {
		$this->komponen_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/komponen'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/komponen'));
		} else {
			$this->komponen_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/komponen'));
		}
	}

	public function rincian($komponen_id) {		
		$data['listTarif'] 		= $this->komponen_model->select_tarif($komponen_id)->result();
		$data['detail'] 		= $this->komponen_model->select_detail_by_id($komponen_id)->row();
		$data['listKelas'] 		= $this->komponen_model->select_kelas()->result();
		$data['listTempat'] 	= $this->komponen_model->select_tempat()->result();
		$this->template->display('admin/komponen_tarif_view', $data);
	}

	public function savedatatarif() {
		$this->komponen_model->insert_data_tarif();
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
	 	redirect(site_url('admin/komponen/rincian/'.$this->uri->segment(4)));
	}

	public function updatedatatarif() {
		$this->komponen_model->update_data_tarif();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/komponen/rincian/'.$this->uri->segment(4)));
	}

	public function deletedatatarif($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(5));
		
		if ($kode == null) {
			redirect(site_url('admin/komponen/rincian/'.$this->uri->segment(4)));
		} else {
			$this->komponen_model->delete_data_tarif($kode);
			$this->session->set_flashdata('notification','Hapus Data Tarif Sukses.');
			redirect(site_url('admin/komponen/rincian/'.$this->uri->segment(4)));
		}
	}	
}
/* Location: ./application/controller/admin/Komponen.php */