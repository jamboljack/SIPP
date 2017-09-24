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
			$this->template->display('admin/pasar_view');
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function data_list() {
        $List = $this->pasar_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row = array();
            $pasar_id = $r->pasar_id;

            if ($r->pasar_jenis == 'T') {
            	$jenis = '(Pasar Tradisional)';
            } else {
           		$jenis = '(Pasar Hewan)';
           	}

            $row[] = $no;
            $row[] = $r->pasar_inisial.'-'.$r->pasar_kode;
            $row[] = $r->pasar_nama.'<br>'.$jenis;
            $row[] = $r->pasar_thn_berdiri;
            $row[] = $r->pasar_alamat.'<br>DESA. '.$r->desa_nama.', KEC. '.$r->kecamatan_nama;
            $row[] = $r->pasar_nip.'<br>'.$r->pasar_koordinator;

            $linkedit  = site_url('admin/pasar/editdata/'.$r->pasar_id);
            $linkprint = site_url('admin/pasar/printdata/'.$r->pasar_id);

            $row[] = '<a href="'.$linkedit.'">
            			<button class="btn btn-primary btn-xs" title="Edit Data">
                       	<i class="icon-pencil"></i>
                       	</button>
                      </a>
                      <a onclick="hapusData('.$pasar_id.')">
                      	<button class="btn btn-danger btn-xs" title="Hapus Data">
                        <i class="icon-trash"></i>
                        </button>
                      </a>
                      <a href="'.$linkprint.'" target="_blank">
                      	<button class="btn btn-warning btn-xs" title="Print">
                        <i class="icon-printer"></i>
                        </button>
                      </a>';
            
            $data[] = $row;
        }
 
        $output = array(
                        "draw" 				=> $_POST['draw'],
                        "recordsTotal" 		=> $this->pasar_model->count_all(),
                        "recordsFiltered" 	=> $this->pasar_model->count_filtered(),
                        "data" 				=> $data,
                );
        
        echo json_encode($output);
    }

	public function adddata() {
		$data['error']			= false;
		$data['listKelas'] 		= $this->pasar_model->select_kelas()->result();
		$data['listBentuk'] 	= $this->pasar_model->select_bentuk_bangunan()->result();
		$data['listKondisi'] 	= $this->pasar_model->select_kondisi_bangunan()->result();
		$data['listSurat'] 		= $this->pasar_model->select_surat_kepemilikan()->result();
		$this->template->display('admin/pasar_add_view', $data);
	}

	// Ajax Kecamatan
	public function data_kecamatan_list() {
        $List = $this->pasar_model->get_kecamatan_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row = array();

            $row[] = '<button type="button" class="btn btn-success btn-xs pilih_alamat" data-toggle="modal" data-pid="'.$r->provinsi_id.'" data-pname="'.$r->provinsi_nama.'" data-kid="'.$r->kabupaten_id.'" data-kname="'.$r->kabupaten_nama.'" data-cid="'.$r->kecamatan_id.'" data-cname="'.$r->kecamatan_nama.'" data-did="'.$r->desa_id.'" data-dname="'.$r->desa_nama.'" title="Pilih Alamat" data-dismiss="modal"><i class="icon-check"></i> Pilih</button>';

            $row[] = $r->desa_nama;
            $row[] = $r->kecamatan_nama;
            $row[] = $r->kabupaten_nama;
            $row[] = $r->provinsi_nama;
            
            $data[] = $row;
        }
 
        $output = array(
                        "draw" 				=> $_POST['draw'],
                        "recordsTotal" 		=> $this->pasar_model->count_all_kecamatan(),
                        "recordsFiltered" 	=> $this->pasar_model->count_filtered_kecamatan(),
                        "data" 				=> $data,
                );
        
        echo json_encode($output);
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