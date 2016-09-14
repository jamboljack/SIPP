<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baliknama extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/baliknama_model');
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

	public function pilihpasar() {
		$data['tampil']		= 'tidak';
		$data['listPasar'] 	= $this->baliknama_model->select_pasar()->result();		
		$this->template->display('admin/baliknama_pilih_view', $data);
	}

	public function caridatapasar() {
		$data['tampil']		= 'ya';
		$pasar_id 			= $this->input->post('lstPasar');
		$data['listPasar'] 	= $this->baliknama_model->select_pasar()->result();
		$data['listSurat']	= $this->baliknama_model->select_surat_dasar($pasar_id)->result();
		$data['detail'] 	= $this->baliknama_model->select_pasar_by_id($pasar_id)->row();
		$this->template->display('admin/baliknama_pilih_view', $data);
	}

	public function adddata() {
		$dasar_id 				= $this->uri->segment(4);
		$data['detail']			= $this->baliknama_model->select_detail_surat($dasar_id)->row();
		$data['listPedagang'] 	= $this->baliknama_model->select_pedagang()->result();
		$data['listJenis'] 		= $this->baliknama_model->select_jenis()->result();
		$this->template->display('admin/baliknama_add_view', $data);
	}

	public function savedata() {
		$id_lama = $this->input->post('pedagang_id_lama');
		$id_baru = $this->input->post('pedagang_id');
		
		if ($id_baru == $id_lama) {
			$this->session->set_flashdata('notification','Data Pedagang Tidak Boleh Sama.');
			redirect(site_url('admin/baliknama/adddata/'.$this->uri->segment(4)));
		} else {
			// Tgl. Balik Nama
			$tgl_surat 		= $this->input->post('tgl_surat');
			$xtgl 			= explode("-",$tgl_surat);
			$thn 			= $xtgl[2];
			$bln 			= $xtgl[1];
			$tgl 			= $xtgl[0];
			$tanggal_srt 	= $thn.'-'.$bln.'-'.$tgl;

			// Tahun Pembuatan Surat
			$tanggal 		= date('Y-m-d');
			$xtgl1 			= explode("-",$tanggal);
			$tahun 			= $xtgl1[0];
			// Nomor
			$nomor 			= strtoupper(trim($this->input->post('nomor')));
			// Kode Pasar
			$kode_pasar		= trim($this->input->post('pasar_kode'));
			// No Surat Pendasaran
			$nosurat 		= $this->baliknama_model->getkodeuniksurat();
			$No_Surat 		= $nosurat.'/'.$nomor.'/'.$kode_pasar.'/'.$tahun;
			// NPWRD = KodePasar+KodeJenis+Tahun+NoUrut		
			$kodepasar 		= trim($this->input->post('pasar_inisial'));
			$jenisdagang 	= trim($this->input->post('jenis_kode'));
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

			// No Surat Balik Nama
			$no_urut_balik	= $this->baliknama_model->getkodeunikbalikno();
			$no_balik		= $this->baliknama_model->getkodeunikbalik();
			$No_BalikNama 	= $no_balik.'/BN/'.$tahun;

			// Insert ke Tabel Balik Nama
			$data = array(
					'dasar_id'					=> $this->input->post('id'),
					'pedagang_id'				=> $this->input->post('pedagang_id'),
					'jenis_id'					=> $this->input->post('jenis_id'),
					'pasar_id'					=> $this->input->post('pasar_id'),
					'tempat_id'					=> $this->input->post('tempat_id'),
					'baliknama_no'				=> strtoupper(trim($No_BalikNama)), // 511.2/00001/BN/2016
					'baliknama_npwrd'			=> strtoupper(trim($No_NPWRD)),
					'baliknama_tgl'				=> $tanggal_srt,
			   		'user_username' 			=> $this->session->userdata('username'),
			   		'baliknama_date_update' 	=> date('Y-m-d'),
			   		'baliknama_time_update' 	=> date('Y-m-d H:i:s')
			);

			$this->db->insert('sipp_baliknama', $data);

			// Update Temporary Surat Balik
			$data = array(
					'no_surat'		=> strtoupper(trim($No_BalikNama)),
					'tahun'			=> $tahun,
					'no'			=> $no_urut_balik
				);

			$this->db->where('id', 1);
			$this->db->update('sipp_tmp_surat_balik', $data);

			// Update ke Table Dasar = Tidak Berlaku
			$dasar_id 	= $this->input->post('id');		
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
					'dasar_no_lama'			=> $this->input->post('dasar_no'),
					'dasar_npwrd'			=> strtoupper(trim($No_NPWRD)),
					'dasar_status'			=> 'Balik Nama',
					'pedagang_id'			=> $this->input->post('pedagang_id'),
					'pasar_id'				=> $this->input->post('pasar_id'),
					'jenis_id'				=> $this->input->post('jenis_id'),
					'tempat_id'				=> $this->input->post('tempat_id'),
					'dasar_tgl_surat'		=> $tanggal_srt,
					'dasar_blok'			=> strtoupper(trim($this->input->post('blok'))),
					'dasar_nomor'			=> strtoupper(trim($this->input->post('nomor'))),
					'dasar_panjang'			=> $this->input->post('panjang'),
					'dasar_lebar'			=> $this->input->post('lebar'),
					'dasar_luas'			=> $this->input->post('luas'),
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'dasar_date_update' 	=> date('Y-m-d'),
			   		'dasar_time_update' 	=> date('Y-m-d H:i:s')
			);

			$this->db->insert('sipp_dasar', $data);
			$id = $this->db->insert_id();
			$this->session->set_flashdata('notification','Simpan Data Balik Nama Sukses.');
		 	redirect(site_url('admin/pendasaran/editdata/'.$id));
		}
	}
	
	public function editdata($dasar_id) {		
		$data['listTempat']		= $this->baliknama_model->select_tempat()->result();
		$data['listPasar'] 		= $this->baliknama_model->select_pasar()->result();
		$data['listPedagang'] 	= $this->baliknama_model->select_pedagang()->result();
		$data['listJenis'] 		= $this->baliknama_model->select_jenis()->result();
		$data['detail'] 		= $this->baliknama_model->select_detail_by_id($dasar_id)->row();
		$this->template->display('admin/baliknama_edit_view', $data);
	}

	public function updatedata() {
		if ($this->input->post('status_print') == 1) {
			$this->session->set_flashdata('notification','Surat Pendasaran sudah di Print, Tidak bisa di Edit.');
			redirect(site_url('admin/baliknama/editdata/'.$this->uri->segment(4)));
		} else {
			$this->baliknama_model->update_data();
			$this->session->set_flashdata('notification','Update Data Sukses.');
			redirect(site_url('admin/baliknama'));
		}
	}	
}
/* Location: ./application/controller/admin/Baliknama.php */