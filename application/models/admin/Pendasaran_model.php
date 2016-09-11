<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendasaran_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$this->db->select('d.*, p.pedagang_nama, s.pasar_nama');
		$this->db->from('sipp_dasar d');
		$this->db->join('sipp_pedagang p', 'd.pedagang_id = p.pedagang_id');
		$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
		$this->db->order_by('d.dasar_id','desc');
		
		return $this->db->get();
	}	

	function select_pasar() {
		$this->db->select('p.*, k.kecamatan_nama, d.desa_nama');
		$this->db->from('sipp_pasar p');
		$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
		$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
		$this->db->order_by('p.pasar_nama', 'asc');
		
		return $this->db->get();
	}

	function select_tempat() {
		$this->db->select('*');
		$this->db->from('sipp_tempat');		
		$this->db->order_by('tempat_id', 'asc');
		
		return $this->db->get();
	}

	function select_pedagang() {
		$this->db->select('*');
		$this->db->from('sipp_pedagang');		
		$this->db->order_by('pedagang_nama', 'asc');
		
		return $this->db->get();
	}

	function select_jenis() {
		$this->db->select('*');
		$this->db->from('sipp_jenis');		
		$this->db->order_by('jenis_nama', 'asc');
		
		return $this->db->get();
	}

	function getkodeuniksurat() {
		// Tahun Pembuatan Surat
		$tanggal 		= date('Y-m-d');
		$xtgl1 			= explode("-",$tanggal);
		$thn1 			= $xtgl1[0];

		$this->db->select('RIGHT(no_npwrd, 5) as kode', FALSE);
		$this->db->where('id', 1);
		$this->db->where('tahun', $thn1);

		$query = $this->db->get('sipp_tmp_surat');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$nourut = str_pad($kode, 5, "0", STR_PAD_LEFT);
		$kodesurat = '511.2/'.$nourut;
		return $kodesurat;
   	}

   	function getkodeuniknpwrd() {
   		// Tahun Pembuatan Surat
		$tanggal 		= date('Y-m-d');
		$xtgl1 			= explode("-",$tanggal);
		$thn1 			= $xtgl1[0];

        $this->db->select('RIGHT(no_npwrd, 5) as kode', FALSE);
		$this->db->where('id', 1);
		$this->db->where('tahun', $thn1);

		$query = $this->db->get('sipp_tmp_surat');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$nourut = str_pad($kode, 5, "0", STR_PAD_LEFT);		
		return $nourut;
   	}
	
	function insert_data() {
		// Tgl. Surat
		$tgl_surat 		= $this->input->post('tgl_surat');
		$xtgl 			= explode("-",$tgl_surat);
		$thn 			= $xtgl[2];
		$bln 			= $xtgl[1];
		$tgl 			= $xtgl[0];
		$tanggal_srt 	= $thn.'-'.$bln.'-'.$tgl;
		// Dari Tanggal
		$tgl_dari 		= $this->input->post('tgl1');
		$xtgld 			= explode("-",$tgl_dari);
		$thnd 			= $xtgld[2];
		$blnd 			= $xtgld[1];
		$tgld 			= $xtgld[0];
		$tanggal_dari 	= $thnd.'-'.$blnd.'-'.$tgld;
		// Sampai Tanggal
		$tgl_sampai 	= $this->input->post('tgl2');
		$xtgls 			= explode("-",$tgl_sampai);
		$thns 			= $xtgls[2];
		$blns 			= $xtgls[1];
		$tgls 			= $xtgls[0];
		$tanggal_sampai	= $thns.'-'.$blns.'-'.$tgls;

		// Tahun Pembuatan Surat
		$tanggal 		= date('Y-m-d');
		$xtgl1 			= explode("-",$tanggal);
		$tahun 			= $xtgl1[0];
		// Nomor
		$nomor 			= strtoupper(trim($this->input->post('nomor')));
		// Kode Pasar
		$kode_pasar		= trim($this->input->post('pasar_kode'));
		// No Surat
		$nosurat 		= $this->pendasaran_model->getkodeuniksurat();
		$No_Surat 		= $nosurat.'/'.$nomor.'/'.$kode_pasar.'/'.$tahun; // 511.2/No Urut/Nomor/Kode Pasar/Tahun Surat
		// NPWRD = KodePasar+KodeJenis+Tahun+NoUrut		
		$kodepasar 		= trim($this->input->post('pasar_inisial'));
		$jenisdagang 	= trim($this->input->post('jenis_kode'));
		$no_urut 		= $this->pendasaran_model->getkodeuniknpwrd();
		$No_NPWRD		= $kodepasar.$jenisdagang.$tahun.$no_urut;

		// Update Temporary Surat
		$data = array(
				'no_surat'		=> strtoupper(trim($No_Surat)),
				'no_npwrd'		=> strtoupper(trim($No_NPWRD)),
				'tahun'			=> $tahun
			);

		$this->db->where('id', 1);
		$this->db->update('sipp_tmp_surat', $data);

		// Insert ke Tabel Pendasaran
		$data = array(
				'dasar_no'				=> strtoupper(trim($No_Surat)),
				'dasar_npwrd'			=> strtoupper(trim($No_NPWRD)),
				'pedagang_id'			=> $this->input->post('pedagang_id'),
				'pasar_id'				=> $this->input->post('lstPasar'),
				'jenis_id'				=> $this->input->post('lstJenis'),
				'tempat_id'				=> $this->input->post('rdTempat'),
				'dasar_tgl_surat'		=> $tanggal_srt,
				'dasar_dari'			=> $tanggal_dari,
				'dasar_sampai'			=> $tanggal_sampai,
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
	}

	function select_detail_by_id($pendasaran_id) {
		$this->db->select('d.*, p.provinsi_nama, k.kabupaten_nama');
		$this->db->from('sipp_pedagang d');		
		$this->db->join('sipp_provinsi p', 'd.provinsi_id = p.provinsi_id');
		$this->db->join('sipp_kabupaten k', 'd.kabupaten_id = k.kabupaten_id');
		$this->db->where('d.pedagang_id', $pedagang_id);
		
		return $this->db->get();
	}

	function update_data() {
		$pedagang_id     = $this->input->post('id');

		$tgl_lahir 		= $this->input->post('tgl_lahir');
		$xtgl 			= explode("-",$tgl_lahir);
		$thn 			= $xtgl[2];
		$bln 			= $xtgl[1];
		$tgl 			= $xtgl[0];
		$tanggal_lhr 	= $thn.'-'.$bln.'-'.$tgl;
		
		if (!empty($_FILES['userfile']['name'])) {
			$data = array(
					'pedagang_nik'			=> strtoupper(trim($this->input->post('nik'))),
					'pedagang_nama'			=> strtoupper(trim($this->input->post('nama'))),
					'pedagang_tgl_lahir'	=> $tanggal_lhr,
					'pedagang_alamat'		=> strtoupper(trim($this->input->post('alamat'))),
					'provinsi_id'			=> $this->input->post('provinsi_id'),
					'kabupaten_id'			=> $this->input->post('kab_id'),					
					'pedagang_foto' 		=> $this->upload->file_name,
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'pedagang_date_update' 	=> date('Y-m-d'),
			   		'pedagang_time_update' 	=> date('Y-m-d H:i:s')
			);
		} else {		
			$data = array(
					'pedagang_nik'			=> strtoupper(trim($this->input->post('nik'))),
					'pedagang_nama'			=> strtoupper(trim($this->input->post('nama'))),
					'pedagang_tgl_lahir'	=> $tanggal_lhr,
					'pedagang_alamat'		=> strtoupper(trim($this->input->post('alamat'))),
					'provinsi_id'			=> $this->input->post('provinsi_id'),
					'kabupaten_id'			=> $this->input->post('kab_id'),
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'pedagang_date_update' 	=> date('Y-m-d'),
			   		'pedagang_time_update' 	=> date('Y-m-d H:i:s')
			);
		}

		$this->db->where('pedagang_id', $pedagang_id);
		$this->db->update('sipp_pedagang', $data);
	}

	function delete_data($kode) {		
		$this->db->where('pedagang_id', $kode);
		$this->db->delete('sipp_pedagang');
	}
}
/* Location: ./application/model/admin/Pendasaran_model.php */