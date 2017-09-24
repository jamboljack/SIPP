<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penduduk extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/penduduk_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->penduduk_model->select_all()->result();
			$this->template->display('admin/penduduk_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}
	
	public function detail($penduduk_id) {		
		$data['detail'] 		= $this->penduduk_model->select_detail_by_id($penduduk_id)->row();
		$this->template->display('admin/penduduk_edit_view', $data);
	}

	public function updatedata() {
		if (!empty($_FILES['userfile']['name'])) {
			$jam 	= time();
			$kode 	= seo_title($this->input->post('nama', 'true'));
					
			$config['file_name']    = 'Penduduk_'.$kode.'_'.$jam.'.jpg';
			$config['upload_path'] = './penduduk_image/';
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

		$this->penduduk_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/penduduk'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/penduduk'));
		} else {
			$this->penduduk_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/penduduk'));
		}
	}	
}
/* Location: ./application/controller/admin/Penduduk.php */