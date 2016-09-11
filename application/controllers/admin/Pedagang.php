<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedagang extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/pedagang_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->pedagang_model->select_all()->result();
			$this->template->display('admin/pedagang_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function adddata() {
		$data['error']			= false;
		$data['listAlamat'] 	= $this->pedagang_model->select_prov_kab()->result();
		$this->template->display('admin/pedagang_add_view', $data);
	}

	public function savedata() {
		$this->form_validation->set_rules('nik','<b>N I K</b>','trim|required|min_length[16]|max_length[16]|is_unique[sipp_pedagang.pedagang_nik]');
		
		if ($this->form_validation->run() == FALSE) {
			$data['error']			= true;
			$data['listAlamat'] 	= $this->pedagang_model->select_prov_kab()->result();
			$this->template->display('admin/pedagang_add_view', $data);
		} else {
			if (!empty($_FILES['userfile']['name'])) {
				$jam 	= time();
				$kode 	= seo_title($this->input->post('nama'));
					
				$config['file_name']    = 'Pedagang_'.$kode.'_'.$jam.'.jpg';
				$config['upload_path'] = './pedagang_image/';
				$config['allowed_types'] = 'jpg|png|gif|jpeg';		
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('userfile');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config['maintain_ratio'] = TRUE;
												
				$config['width'] = 500;
				$config['height'] = 750;
				$this->load->library('image_lib',$config);
				 
				$this->image_lib->resize();
			} elseif (empty($_FILES['userfile']['name'])){
				$config['file_name'] = '';
			}

			$this->pedagang_model->insert_data();
			$this->session->set_flashdata('notification','Simpan Data Sukses.');
	 		redirect(site_url('admin/pedagang'));
	 	}
	}
	
	public function editdata($pedagang_id) {		
		$data['listAlamat'] 	= $this->pedagang_model->select_prov_kab()->result();
		$data['detail'] 		= $this->pedagang_model->select_detail_by_id($pedagang_id)->row();
		$this->template->display('admin/pedagang_edit_view', $data);
	}

	public function updatedata() {
		if (!empty($_FILES['userfile']['name'])) {
			$jam 	= time();
			$kode 	= seo_title($this->input->post('nama'));
					
			$config['file_name']    = 'Pedagang_'.$kode.'_'.$jam.'.jpg';
			$config['upload_path'] = './pedagang_image/';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';		
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->do_upload('userfile');
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config['maintain_ratio'] = TRUE;
											
			$config['width'] = 500;
			$config['height'] = 750;
			$this->load->library('image_lib',$config);
				 
			$this->image_lib->resize();
		} elseif (empty($_FILES['userfile']['name'])){
			$config['file_name'] = '';
		}

		$this->pedagang_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/pedagang'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/pedagang'));
		} else {
			$this->pedagang_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/pedagang'));
		}
	}	
}
/* Location: ./application/controller/admin/Pedagang.php */