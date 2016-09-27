<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap1 extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/lap1_model');	
	}
	
	public function index(){
		if($this->session->userdata('logged_in_sipp')) {
			$data['tampil']		= 'tidak';
			$data['listPasar'] 	= $this->lap1_model->select_pasar()->result();
			$data['listTempat'] = $this->lap1_model->select_tempat()->result();
			$this->template->display('admin/lap1_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function caridata() {
		$pasar_id	= trim($this->input->post('lstPasar'));
		$tempat_id 	= trim($this->input->post('lstTempat'));

		$data = array(
			'Pasar' 	=> $pasar_id,
			'Tempat' 	=> $tempat_id
		);

		$data['Report'] 	= $data;
		$data['tampil']		= 'ya';
		$data['listPasar'] 	= $this->lap1_model->select_pasar()->result();
		$data['listTempat'] = $this->lap1_model->select_tempat()->result();
		$data['daftarlist'] = $this->lap1_model->select_by_criteria()->result();		
		$this->template->display('admin/lap1_view', $data);
	}	
	
	public function preview($pasar_id = '', $tempat_id = '') {  
		$pasar_id 	= $this->uri->segment(4);
		$tempat_id 	= $this->uri->segment(5);

		$data['detailpasar'] 	= $this->lap1_model->select_pasar_by_id($pasar_id)->row();
		if ($tempat_id == 'all') {
			$data['listTempat'] = $this->lap1_model->select_tempat()->result();
			$this->load->view('admin/lap1_preview_all', $data);
		} else {
			$data['detailtempat'] 	= $this->lap1_model->select_tempat_by_id($tempat_id)->row();
			$data['daftarlist'] 	= $this->lap1_model->select_by_id()->result();			
			$this->load->view('admin/lap1_preview_by_tempat', $data);
		}
	}
	
	
	public function exportpdf($pasar_id = '', $tempat_id = '') {
		$pasar_id 	= $this->uri->segment(4);
		$tempat_id 	= $this->uri->segment(5);
		$data['detailpasar'] 	= $this->lap1_model->select_pasar_by_id($pasar_id)->row();

		$time = time();
		$filename = 'Report_Pelanggan_'.$pasar_id.'_'.$tempat_id.'_'.$time;
		$pdfFilePath = FCPATH."download/$filename.pdf";
			
		if (file_exists($pdfFilePath) == FALSE){
			ini_set('memory_limit','50M');

			if ($tempat_id == 'all') {
				$data['listTempat'] = $this->lap1_model->select_tempat()->result();
				$html = $this->load->view('admin/lap1_preview_all_pdf', $data, true);
			} else {
				$data['detailtempat'] 	= $this->lap1_model->select_tempat_by_id($tempat_id)->row();
				$data['daftarlist'] 	= $this->lap1_model->select_by_id()->result();
				$html = $this->load->view('admin/lap1_preview_by_tempat_pdf', $data, true);
			}

			$this->load->library('pdf');
			$param = '"en-GB-x","A4-L","","",10,10,10,10,6,3'; // Landscape
			$pdf = $this->pdf->load($param);
			$pdf->SetHeader(''); 
			$pdf->SetFooter('');
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		redirect("download/$filename.pdf");			
	}
	
}
/* Location: ./application/controllers/admin/Lap1.php */