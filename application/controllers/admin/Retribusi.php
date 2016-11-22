<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retribusi extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/retribusi_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['listPasar'] 	= $this->retribusi_model->select_pasar()->result();
			$data['listTempat'] = $this->retribusi_model->select_tempat()->result();
			$data['daftarlist'] = $this->retribusi_model->select_all()->result();
			$this->template->display('admin/retribusi_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}

	public function caridataskrd() {
		$data['listPasar'] 	= $this->retribusi_model->select_pasar()->result();
		$data['listTempat'] = $this->retribusi_model->select_tempat()->result();
		$data['daftarlist'] = $this->retribusi_model->select_by_criteria()->result();
		$this->template->display('admin/retribusi_view', $data);
	}

	public function editdata($skrd_id) {
		$data['detail'] 		= $this->retribusi_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] 	= $this->retribusi_model->select_list_item($skrd_id)->result();
		$this->template->display('admin/retribusi_edit_view', $data);
	}

	public function updatedataitem() {
		$this->retribusi_model->update_data_item();
		$this->session->set_flashdata('notification','Update Data Item Sukses.');
		redirect(site_url('admin/retribusi/editdata/'.$this->uri->segment(4)));
	}

	public function updatedata() {
		$this->retribusi_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/retribusi/printdata/'.$this->uri->segment(4)));
	}

	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));

		if ($kode == null) {
			redirect(site_url('admin/retribusi'));
		} else {
			$this->retribusi_model->delete_data($kode);
			$this->session->set_flashdata('notification','Penggantian Status Sukses.');
			redirect(site_url('admin/retribusi'));
		}
	}

	public function printdata($skrd_id) {
		$data['detail'] 	= $this->retribusi_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] = $this->retribusi_model->select_list_item($skrd_id)->result();
		$data['petugas'] 	= $this->retribusi_model->select_petugas($skrd_id)->row();
		$data['kadin'] 		= $this->retribusi_model->select_kadin()->row();
		$this->load->view('admin/kwitansi_bayar_retribusi_view', $data);
	}

	public function printdatapdf($skrd_id) {
		$data['detail'] 	= $this->retribusi_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] = $this->retribusi_model->select_list_item($skrd_id)->result();
		$data['petugas'] 	= $this->retribusi_model->select_petugas($skrd_id)->row();
		$data['kadin'] 		= $this->retribusi_model->select_kadin()->row();

		$time 			= time();
		$filename 		= 'Surat_Tagihan_'.$time;
		$pdfFilePath 	= FCPATH."download/$filename.pdf";

		if (file_exists($pdfFilePath) == FALSE){
			ini_set('memory_limit','50M');
			$html = $this->load->view('admin/surat_tagihan_retribusi_pdf', $data, true);
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
}
/* Location: ./application/controller/admin/Retribusi.php */