<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasar extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/pasar_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->pasar_model->select_all()->result();
			$this->template->display('admin/pasar_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function adddata() {
		$data['error']			= false;
		$data['listKelas'] 		= $this->pasar_model->select_kelas()->result();
		$data['listBentuk'] 	= $this->pasar_model->select_bentuk_bangunan()->result();
		$data['listKondisi'] 	= $this->pasar_model->select_kondisi_bangunan()->result();
		$data['listSurat'] 		= $this->pasar_model->select_surat_kepemilikan()->result();
		$data['listAlamat'] 	= $this->pasar_model->select_desa_kecamatan()->result();
		$this->template->display('admin/pasar_add_view', $data);
	}

	public function savedata() {
		$this->form_validation->set_rules('kode','<b>Kode Pasar</b>','trim|required|is_unique[sipp_pasar.pasar_kode]');
		$this->form_validation->set_rules('nama','<b>Nama Pasar</b>','trim|required|is_unique[sipp_pasar.pasar_nama]');		

		if ($this->form_validation->run() == FALSE) {
			$data['error']			= true;
			$data['listKelas'] 		= $this->pasar_model->select_kelas()->result();
			$data['listBentuk'] 	= $this->pasar_model->select_bentuk_bangunan()->result();
			$data['listKondisi'] 	= $this->pasar_model->select_kondisi_bangunan()->result();
			$data['listSurat'] 		= $this->pasar_model->select_surat_kepemilikan()->result();
			$data['listAlamat'] 	= $this->pasar_model->select_desa_kecamatan()->result();
			$this->template->display('admin/pasar_add_view', $data);
		} else {
			if (!empty($_FILES['userfile']['name'])) {
				$jam 	= time();
				$kode 	= seo_title($this->input->post('nama'));
					
				$config['file_name']    = 'Pasar_'.$kode.'_'.$jam.'.jpg';
				$config['upload_path'] = './pasar_image/';
				$config['allowed_types'] = 'jpg|png|gif|jpeg';		
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('userfile');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config['maintain_ratio'] = TRUE;
												
				$config['width'] = 500;
				$config['height'] = 350;
				$this->load->library('image_lib',$config);
				 
				$this->image_lib->resize();
			} elseif (empty($_FILES['userfile']['name'])){
				$config['file_name'] = '';
			}

			$this->pasar_model->insert_data();
			$this->session->set_flashdata('notification','Simpan Data Sukses.');
	 		redirect(site_url('admin/pasar'));
	 	}
	}
	
	public function editdata($pasar_id) {		
		$data['listKelas'] 		= $this->pasar_model->select_kelas()->result();
		$data['listBentuk'] 	= $this->pasar_model->select_bentuk_bangunan()->result();
		$data['listKondisi'] 	= $this->pasar_model->select_kondisi_bangunan()->result();
		$data['listSurat'] 		= $this->pasar_model->select_surat_kepemilikan()->result();
		$data['listAlamat'] 	= $this->pasar_model->select_desa_kecamatan()->result();
		$data['detail'] 		= $this->pasar_model->select_detail_by_id($pasar_id)->row();
		$this->template->display('admin/pasar_edit_view', $data);
	}

	public function updatedata() {
		if (!empty($_FILES['userfile']['name'])) {
			$jam 	= time();
			$kode 	= seo_title($this->input->post('nama'));
					
			$config['file_name']    = 'Pasar_'.$kode.'_'.$jam.'.jpg';
			$config['upload_path'] = './pasar_image/';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';		
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->do_upload('userfile');
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config['maintain_ratio'] = TRUE;
											
			$config['width'] = 500;
			$config['height'] = 350;
			$this->load->library('image_lib',$config);
				 
			$this->image_lib->resize();
		} elseif (empty($_FILES['userfile']['name'])){
			$config['file_name'] = '';
		}

		$this->pasar_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/pasar'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/pasar'));
		} else {
			$this->pasar_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/pasar'));
		}
	}

	public function printdata($pasar_id) {
		$data['listKelas'] 		= $this->pasar_model->select_kelas()->result();
		$data['listBentuk'] 	= $this->pasar_model->select_bentuk_bangunan()->result();
		$data['listKondisi'] 	= $this->pasar_model->select_kondisi_bangunan()->result();
		$data['listSurat'] 		= $this->pasar_model->select_surat_kepemilikan()->result();
		$data['detail'] 		= $this->pasar_model->select_detail_by_id($pasar_id)->row();
		$this->load->view('admin/pasar_print_view', $data);
	}
}
/* Location: ./application/controller/admin/Pasar.php */