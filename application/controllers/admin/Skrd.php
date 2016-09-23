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
	
	public function caridataskrd() {
		$data['listPasar'] 	= $this->skrd_model->select_pasar()->result();
		$data['listTempat'] = $this->skrd_model->select_tempat()->result();
		$data['daftarlist'] = $this->skrd_model->select_by_criteria()->result();
		$this->template->display('admin/skrd_view', $data);
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
		$data['daftarItem'] 	= $this->skrd_model->select_list_item($skrd_id)->result();
		$this->template->display('admin/skrd_edit_view', $data);
	}

	public function updatedataitem() {
		$this->skrd_model->update_data_item();
		$this->session->set_flashdata('notification','Update Data Item Sukses.');
		redirect(site_url('admin/skrd/editdata/'.$this->uri->segment(4)));
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

	public function printdata($skrd_id) {		
		$data['detail'] 	= $this->skrd_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] = $this->skrd_model->select_list_item($skrd_id)->result();
		$data['petugas'] 	= $this->skrd_model->select_petugas($skrd_id)->row();
		$data['kadin'] 		= $this->skrd_model->select_kadin()->row();
		$cek 				= $this->skrd_model->select_detail_by_id($skrd_id)->row();
		
		if ($cek->skrd_st_print == 0) {
			$this->skrd_model->update_data_print();
		}		
		$this->load->view('admin/surat_tagihan_skrd_view', $data);
	}

	public function printdatapdf($skrd_id) {
		$data['detail'] 	= $this->skrd_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] = $this->skrd_model->select_list_item($skrd_id)->result();
		$data['petugas'] 	= $this->skrd_model->select_petugas($skrd_id)->row();
		$data['kadin'] 		= $this->skrd_model->select_kadin()->row();

		$time 			= time();		
		$filename 		= 'Surat_Tagihan_'.$time;
		$pdfFilePath 	= FCPATH."download/$filename.pdf";
			
		if (file_exists($pdfFilePath) == FALSE){
			ini_set('memory_limit','50M');
			$html = $this->load->view('admin/surat_tagihan_skrd_pdf', $data, true);
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
/* Location: ./application/controller/admin/Skrd.php */