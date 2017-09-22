<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tempat extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/tempat_model');
	}

	public function index() {
		if($this->session->userdata('logged_in_sipp')) {
			$this->template->display('admin/tempat_view');
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function data_list() {
        $List = $this->tempat_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row = array();
            $tempat_id = $r->tempat_id;

            $row[] = $no;
            $row[] = $r->tempat_nama;
            $row[] = '<button type="button" class="btn btn-primary btn-xs edit_button" data-toggle="modal" data-target="#edit" data-id="'.$r->tempat_id.'" data-name="'.$r->tempat_nama.'" title="Edit Data"><i class="icon-pencil"></i> Edit</button>
            		<a onclick="hapusData('.$tempat_id.')"><button class="btn btn-danger btn-xs" title="Hapus Data"><i class="icon-trash"></i> Hapus</button></a>';
            
            $data[] = $row;
        }
 
        $output = array(
                        "draw" 				=> $_POST['draw'],
                        "recordsTotal" 		=> $this->tempat_model->count_all(),
                        "recordsFiltered" 	=> $this->tempat_model->count_filtered(),
                        "data" 				=> $data,
                );
        
        echo json_encode($output);
    }

	public function savedata() {		
		$this->tempat_model->insert_data();
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
 		redirect(site_url('admin/tempat'));
	}
	
	public function updatedata() {		
		$this->tempat_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/tempat'));
	}
	
	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/tempat'));
		} else {
			$this->tempat_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/tempat'));
		}
	}	
}
/* Location: ./application/controller/admin/Tempat.php */