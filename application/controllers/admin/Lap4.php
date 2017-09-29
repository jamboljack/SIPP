<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap4 extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/lap4_model');	
	}
	
	public function index(){
		if($this->session->userdata('logged_in_sipp')) {
			$data['tampil']		= 'tidak';
			$data['listPasar'] 	= $this->lap4_model->select_pasar()->result();
			$data['listTempat'] = $this->lap4_model->select_tempat()->result();
			$this->template->display('admin/lap4_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function caridata() {
		$tgl1 		= date("Y-m-d", strtotime($this->input->post('tgl1', 'true')));
		$tgl2 		= date("Y-m-d", strtotime($this->input->post('tgl2', 'true')));
		$pasar_id	= trim($this->input->post('lstPasar', 'true'));
		$tempat_id 	= trim($this->input->post('lstTempat', 'true'));

		$data = array(
			'Pasar' 	=> $pasar_id,
			'Tempat' 	=> $tempat_id,
			'Tgl1' 		=> $tgl1,
			'Tgl2' 		=> $tgl2
		);
		
		$data['Report'] 	= $data;
		$data['tampil']		= 'ya';
		$data['listPasar'] 	= $this->lap4_model->select_pasar()->result();
		$data['listTempat'] = $this->lap4_model->select_tempat()->result();
		$data['daftarlist'] = $this->lap4_model->select_by_criteria()->result();		
		$this->template->display('admin/lap4_view', $data);
	}	
	
	public function preview() {  
		$pasar_id 	= $this->uri->segment(4);
		$tempat_id 	= $this->uri->segment(5);
		$tgl1 		= $this->uri->segment(6);
		$tgl2 		= $this->uri->segment(7);

		$data['detailpasar'] 	= $this->lap4_model->select_pasar_by_id($pasar_id)->row();
		if ($tempat_id == 'all') {
			$data['listTempat'] = $this->lap4_model->select_tempat()->result();
			$data['detail'] 	= $this->lap4_model->select_total_bayar($pasar_id, $tempat_id, $tgl1, $tgl2)->row();
			$this->load->view('admin/lap4_preview_all', $data);
		} else {
			$data['detailtempat'] 	= $this->lap4_model->select_tempat_by_id($tempat_id)->row();
			$data['daftarlist'] 	= $this->lap4_model->select_by_id()->result();
			$data['detail'] 		= $this->lap4_model->select_total_bayar($pasar_id, $tempat_id, $tgl1, $tgl2)->row();
			$this->load->view('admin/lap4_preview_by_tempat', $data);
		}
	}
	
	public function previewdetail() {  
		$pasar_id 	= $this->uri->segment(4);
		$tempat_id 	= $this->uri->segment(5);
		$tgl1 		= $this->uri->segment(6);
		$tgl2 		= $this->uri->segment(7);

		$data['detailpasar'] 	= $this->lap4_model->select_pasar_by_id($pasar_id)->row();
		if ($tempat_id == 'all') {
			$data['listTempat'] = $this->lap4_model->select_tempat()->result();
			$data['detail'] 	= $this->lap4_model->select_total_bayar($pasar_id, $tempat_id, $tgl1, $tgl2)->row();
			$this->load->view('admin/lap4_previewdetail_all', $data);
		} else {
			$data['detailtempat'] 	= $this->lap4_model->select_tempat_by_id($tempat_id)->row();
			$data['daftarlist'] 	= $this->lap4_model->select_by_id()->result();
			$data['detail'] 		= $this->lap4_model->select_total_bayar($pasar_id, $tempat_id, $tgl1, $tgl2)->row();
			$this->load->view('admin/lap4_previewdetail_by_tempat', $data);
		}
	}

	public function previewrekap() { // Rekap per Item Komponen
		$pasar_id 	= $this->uri->segment(4);
		$tempat_id 	= $this->uri->segment(5);

		$data['listKomponen'] 	= $this->lap4_model->select_komponen()->result();
		$data['detailpasar'] 	= $this->lap4_model->select_pasar_by_id($pasar_id)->row();

		if ($tempat_id == 'all') {
			$data['listTempat'] = $this->lap4_model->select_tempat()->result();
			$this->load->view('admin/lap4_previewrekap', $data);
		} else {
			$data['detailtempat'] 	= $this->lap4_model->select_tempat_by_id($tempat_id)->row();
			$this->load->view('admin/lap4_previewrekap_detail', $data);
		}
	}
}
/* Location: ./application/controllers/admin/Lap4.php */