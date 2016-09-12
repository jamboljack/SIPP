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
		$data['listTempat']		= $this->pendasaran_model->select_tempat()->result();
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
	
	public function editdata($dasar_id) {		
		$data['listTempat']		= $this->pendasaran_model->select_tempat()->result();
		$data['listPasar'] 		= $this->pendasaran_model->select_pasar()->result();
		$data['listPedagang'] 	= $this->pendasaran_model->select_pedagang()->result();
		$data['listJenis'] 		= $this->pendasaran_model->select_jenis()->result();
		$data['detail'] 		= $this->pendasaran_model->select_detail_by_id($dasar_id)->row();
		$this->template->display('admin/pendasaran_edit_view', $data);
	}

	public function updatedata() {
		if ($this->input->post('status_print') == 1) {
			$this->session->set_flashdata('notification','Surat Pendasaran sudah di Print, Tidak bisa di Edit.');
			redirect(site_url('admin/pendasaran/editdata/'.$this->uri->segment(4)));
		} else {
			$this->pendasaran_model->update_data();
			$this->session->set_flashdata('notification','Update Data Sukses.');
			redirect(site_url('admin/pendasaran'));
		}
	}
	
	public function printdata($dasar_id) {		
		$data['detail'] = $this->pendasaran_model->select_detail_preview($dasar_id)->row();
		$cek 			= $this->pendasaran_model->select_detail_preview($dasar_id)->row();		
		if ($cek->dasar_st_print == 0) {
			$this->pendasaran_model->update_data_print();
		}		
		$this->template->display('admin/pendasaran_preview_view', $data);
	}

	public function preview($dasar_id) {		
		$data['detail'] 		= $this->pendasaran_model->select_detail_preview($dasar_id)->row();
		$data['petugas'] 		= $this->pendasaran_model->select_petugas()->row();
		$this->load->view('admin/pendasaran_preview_print', $data);
	}

	public function exportpdf($dasar_id) {
		$data['detail'] 		= $this->pendasaran_model->select_detail_preview($dasar_id)->row();
		$data['petugas'] 		= $this->pendasaran_model->select_petugas()->row();	

		$time 			= time();
		$npwrd 			= $this->uri->segment(5);
		$filename 		= 'Surat_Pendasaran_'.$npwrd.'_'.$time;
		$pdfFilePath 	= FCPATH."download/$filename.pdf";
			
		if (file_exists($pdfFilePath) == FALSE){
			ini_set('memory_limit','50M');
			$html = $this->load->view('admin/pendasaran_preview_pdf', $data, true);
			$this->load->library('pdf');
			$param = '"en-GB-x","A4","","",10,10,10,10,6,3,"L"'; // Landscape		
			$pdf = $this->pdf->load($param);
			$pdf->SetHeader(''); 
			$pdf->SetFooter('');
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		redirect("download/$filename.pdf");			
	}

	public function perpanjangan($dasar_id) {		
		$data['listTempat']		= $this->pendasaran_model->select_tempat()->result();
		$data['listPasar'] 		= $this->pendasaran_model->select_pasar()->result();
		$data['listPedagang'] 	= $this->pendasaran_model->select_pedagang()->result();
		$data['listJenis'] 		= $this->pendasaran_model->select_jenis()->result();
		$data['detail'] 		= $this->pendasaran_model->select_detail_by_id($dasar_id)->row();
		$this->template->display('admin/pendasaran_perpanjangan_view', $data);
	}

	public function savedataperpanjangan() {		
		$this->pendasaran_model->insert_data_perpanjangan();
		$this->session->set_flashdata('notification','Simpan Data Perpanjangan Sukses.');
	 	redirect(site_url('admin/pendasaran'));
	}
}
/* Location: ./application/controller/admin/Pendasaran.php */