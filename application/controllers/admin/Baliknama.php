<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baliknama extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/baliknama_model');
		$this->load->model('admin/chain_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['daftarlist'] = $this->baliknama_model->select_all()->result();
			$this->template->display('admin/baliknama_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function pilihpedagang() {
		$data['tampil']		= 'tidak';
		$this->template->display('admin/pedagang_pilih_view', $data);
	}

	public function pilihpasar() {
		$data['tampil']		= 'tidak';
		$data['listPasar'] 	= $this->baliknama_model->select_pasar()->result();
		$this->template->display('admin/baliknama_pilih_view', $data);
	}

	public function caridatapedagang() {
		$data['tampil']			= 'ya';
		$nama 					= strtoupper(trim($this->input->post('nama')));
		$data['listPedagang'] 	= $this->baliknama_model->select_pedagang_cari($nama)->result();
		$this->template->display('admin/pedagang_pilih_view', $data);
	}

	public function caridatapasar() {
		$data['tampil']		= 'ya';
		$pasar_id 			= $this->input->post('lstPasar');
		$data['listPasar'] 	= $this->baliknama_model->select_pasar()->result();
		$data['listSurat']	= $this->baliknama_model->select_surat_dasar($pasar_id)->result();
		$data['detail'] 	= $this->baliknama_model->select_pasar_by_id($pasar_id)->row();
		$this->template->display('admin/baliknama_pilih_view', $data);
	}

	public function pilihpenduduk() {
		$data['tampil']		= 'tidak';		
		$this->template->display('admin/baliknama_pilih_penduduk_view', $data);
	}

	public function caridatapenduduk() {
		$data['tampil']			= 'ya';
		$nama 					= strtoupper(trim($this->input->post('nama')));
		$data['listPenduduk'] 	= $this->baliknama_model->select_penduduk_cari($nama)->result();		
		$this->template->display('admin/baliknama_pilih_penduduk_view', $data);
	}

	public function adddata() {
		$dasar_id 				= $this->uri->segment(4);
		$penduduk_id 			= $this->uri->segment(5);
		$data['detail']			= $this->baliknama_model->select_detail_surat($dasar_id)->row();
		$data['detailbaru']		= $this->baliknama_model->select_penduduk_baru($penduduk_id)->row();
		$data['listJenis'] 		= $this->baliknama_model->select_jenis()->result();
		$this->template->display('admin/baliknama_add_view', $data);
	}

	public function addpenduduk() {
		$data['error']			= false;
		$data['provinsi']		= $this->chain_model->ambil_provinsi();
		$this->template->display('admin/baliknama_penduduk_add_view', $data);
	}

	public function savedatapenduduk() {
		$this->form_validation->set_rules('nik','<b>N I K</b>','trim|required|min_length[16]|max_length[16]|is_unique[sipp_penduduk.penduduk_nik]');
		
		if ($this->form_validation->run() == FALSE) {
			$data['error']			= true;
			$data['provinsi']		= $this->chain_model->ambil_provinsi();
			$this->template->display('admin/baliknama_penduduk_add_view', $data);
		} else {
			if (!empty($_FILES['userfile']['name'])) {
				$jam 	= time();
				$kode 	= seo_title($this->input->post('nama'));
					
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

			// Simpan ke Tabel Pedagang
			$tgl_lahir 		= $this->input->post('tgl_lahir');
			$xtgl 			= explode("-",$tgl_lahir);
			$thn 			= $xtgl[2];
			$bln 			= $xtgl[1];
			$tgl 			= $xtgl[0];
			$tanggal_lhr 	= $thn.'-'.$bln.'-'.$tgl;

			if (!empty($_FILES['userfile']['name'])) {
				$data = array(
						'penduduk_nik'			=> strtoupper(trim($this->input->post('nik'))),
						'penduduk_no_kk'		=> strtoupper(trim($this->input->post('no_kk'))),
						'penduduk_nama'			=> strtoupper(trim($this->input->post('nama'))),
						'penduduk_tmpt_lhr'		=> strtoupper(trim($this->input->post('tmpt_lahir'))),
						'penduduk_tgl_lahir'	=> $tanggal_lhr,
						'penduduk_jk'			=> $this->input->post('rdJk'),
						'provinsi_id'			=> $this->input->post('lstProvinsi'),
						'kabupaten_id'			=> $this->input->post('lstKabupaten'),
						'kecamatan_id'			=> $this->input->post('lstKecamatan'),
						'desa_id'				=> $this->input->post('lstKelurahan'),
						'penduduk_alamat'		=> strtoupper(trim($this->input->post('alamat'))),
						'penduduk_foto' 		=> $this->upload->file_name,
				   		'user_username' 		=> $this->session->userdata('username'),
				   		'penduduk_date_update' 	=> date('Y-m-d'),
				   		'penduduk_time_update' 	=> date('Y-m-d H:i:s')
				);
			} else {		
				$data = array(
						'penduduk_nik'			=> strtoupper(trim($this->input->post('nik'))),
						'penduduk_no_kk'		=> strtoupper(trim($this->input->post('no_kk'))),
						'penduduk_nama'			=> strtoupper(trim($this->input->post('nama'))),
						'penduduk_tmpt_lhr'		=> strtoupper(trim($this->input->post('tmpt_lahir'))),
						'penduduk_tgl_lahir'	=> $tanggal_lhr,
						'penduduk_jk'			=> $this->input->post('rdJk'),
						'provinsi_id'			=> $this->input->post('lstProvinsi'),
						'kabupaten_id'			=> $this->input->post('lstKabupaten'),
						'kecamatan_id'			=> $this->input->post('lstKecamatan'),
						'desa_id'				=> $this->input->post('lstKelurahan'),
						'penduduk_alamat'		=> strtoupper(trim($this->input->post('alamat'))),
				   		'user_username' 		=> $this->session->userdata('username'),
				   		'penduduk_date_update' 	=> date('Y-m-d'),
				   		'penduduk_time_update' 	=> date('Y-m-d H:i:s')
				);
			}
			$this->db->insert('sipp_penduduk', $data);
			$id = $this->db->insert_id();
	 		redirect(site_url('admin/baliknama/adddata/'.$this->uri->segment(4).'/'.$id));
	 	}
	}

	public function savedata() {
		$id_lama = $this->input->post('penduduk_id_lama');
		$id_baru = $this->uri->segment(5);
		
		if ($id_baru == $id_lama) {
			$this->session->set_flashdata('notification','Data Pedagang Tidak Boleh Sama.');
			redirect(site_url('admin/baliknama/adddata/'.$this->uri->segment(4)));
		} else {
			if (!empty($_FILES['userfile']['name'])) {
				$jam 	= time();
				$kode 	= $this->uri->segment(5);
					
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

			$this->baliknama_model->insert_data();
			$this->session->set_flashdata('notification','Simpan Data Sukses.');
		 	redirect(site_url('admin/baliknama'));
		}
	}

	public function savedataacc() {
		$baliknama_id 	= $this->uri->segment(4);
		$detail			= $this->baliknama_model->select_detail_by_id($baliknama_id)->row();				
		$dasar_id 		= $detail->dasar_id;
		$detaillama		= $this->baliknama_model->select_detail_surat($dasar_id)->row();

		// Tahun Pembuatan Surat
		$tanggal 		= date('Y-m-d');
		$xtgl1 			= explode("-",$tanggal);
		$tahun 			= $xtgl1[0];
		$nomor 			= $detaillama->dasar_nomor;
		$kode_pasar		= $detaillama->pasar_kode;
		// No Surat Pendasaran
		$nosurat 		= $this->baliknama_model->getkodeuniksurat();
		$No_Surat 		= $nosurat.'/'.$nomor.'/'.$kode_pasar.'/'.$tahun;
		// NPWRD = KodePasar+KodeJenis+Tahun+NoUrut		
		$kodepasar 		= $detaillama->pasar_inisial;
		$jenisdagang 	= $detaillama->jenis_kode;
		$no_urut 		= $this->baliknama_model->getkodeuniknpwrd();
		$No_NPWRD		= $kodepasar.$jenisdagang.$tahun.$no_urut;

		// Update Temporary Surat
		$data = array(
				'no_surat'		=> strtoupper(trim($No_Surat)),
				'no_npwrd'		=> strtoupper(trim($No_NPWRD)),
				'tahun'			=> $tahun,
				'no'			=> $no_urut
			);

		$this->db->where('id', 1);
		$this->db->update('sipp_tmp_surat', $data);		

		// Update NPWRD Pedagang Baru
		$data = array(
				'baliknama_npwrd'			=> strtoupper(trim($No_NPWRD)),
				'baliknama_data'			=> 1, // ACC Status
		   		'user_username' 			=> $this->session->userdata('username'),
		   		'baliknama_date_update' 	=> date('Y-m-d'),
		   		'baliknama_time_update' 	=> date('Y-m-d H:i:s')
		);
		$this->db->where('baliknama_id', $baliknama_id);
		$this->db->update('sipp_baliknama', $data);
		
		// Update ke Table Dasar = Tidak Berlaku
		$data = array(
				'dasar_data'			=> 1,				
		   		'user_username' 		=> $this->session->userdata('username'),
		   		'dasar_date_update' 	=> date('Y-m-d'),
		   		'dasar_time_update' 	=> date('Y-m-d H:i:s')
		);
		
		$this->db->where('dasar_id', $dasar_id);
		$this->db->update('sipp_dasar', $data);

		// Insert ke Tabel Pendasaran Baru
		$data = array(
				'dasar_no'				=> strtoupper(trim($No_Surat)),
				'dasar_no_lama'			=> $detaillama->dasar_no,
				'dasar_npwrd'			=> strtoupper(trim($No_NPWRD)),
				'dasar_status'			=> 'Balik Nama',
				'penduduk_id'			=> $detail->penduduk_id,
				'pasar_id'				=> $detail->pasar_id,
				'jenis_id'				=> $detail->jenis_id,
				'tempat_id'				=> $detail->tempat_id,
				'dasar_tgl_surat'		=> date('Y-m-d'),
				'dasar_blok'			=> $detaillama->dasar_blok,
				'dasar_nomor'			=> $detaillama->dasar_nomor,
				'dasar_panjang'			=> $detaillama->dasar_panjang,
				'dasar_lebar'			=> $detaillama->dasar_lebar,
				'dasar_luas'			=> $detaillama->dasar_luas,
		   		'user_username' 		=> $this->session->userdata('username'),
		   		'dasar_date_update' 	=> date('Y-m-d'),
		   		'dasar_time_update' 	=> date('Y-m-d H:i:s')
		);
		
		$this->db->insert('sipp_dasar', $data);
		$id = $this->db->insert_id();
	 	redirect(site_url('admin/pendasaran/editdata/'.$id));
	}

	
	public function editdata($baliknama_id) {
		$dasar_id 				= $this->uri->segment(5);
		$data['detail']			= $this->baliknama_model->select_detail_surat($dasar_id)->row();
		$data['listJenis'] 		= $this->baliknama_model->select_jenis()->result();
		$data['detailbalik']	= $this->baliknama_model->select_detail_by_id($baliknama_id)->row();
		$this->template->display('admin/baliknama_edit_view', $data);		
	}

	public function updatedata() {
		$this->baliknama_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/baliknama'));
	}

	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));
		
		if ($kode == null) {
			redirect(site_url('admin/baliknama'));
		} else {
			$this->baliknama_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/baliknama'));
		}
	}
}
/* Location: ./application/controller/admin/Baliknama.php */