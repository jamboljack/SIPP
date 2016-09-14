<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baliknama_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_surat_dasar($pasar_id) {		
		$this->db->select('d.*, p.pedagang_nama, s.pasar_nama, t.tempat_nama');
		$this->db->from('sipp_dasar d');
		$this->db->join('sipp_pedagang p', 'd.pedagang_id = p.pedagang_id');
		$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
		$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
		$this->db->where('d.pasar_id', $pasar_id);
		$this->db->where('d.dasar_data', 0);
		$this->db->order_by('d.dasar_id','desc');

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

	function select_pasar() {
		$user_username = $this->session->userdata('username');

		$this->db->select('p.*');
		$this->db->from('sipp_pasar p');
		$this->db->join('sipp_akses a', 'p.pasar_id = a.pasar_id');
		$this->db->where('a.user_username', $user_username);
		$this->db->order_by('p.pasar_nama', 'asc');
		
		return $this->db->get();
	}

	function select_pasar_by_id($pasar_id) {
		$this->db->select('*');
		$this->db->from('sipp_pasar');		
		$this->db->where('pasar_id', $pasar_id);
		
		return $this->db->get();
	}

	function select_all() {
		$this->db->select('b.*, d.dasar_no, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas,
		 					p.pedagang_nama as nama, pd.pedagang_nama, s.pasar_nama, t.tempat_nama');
		$this->db->from('sipp_baliknama b'); // Balik Nama
		$this->db->join('sipp_dasar d', 'b.dasar_id = d.dasar_id'); // Pendasaran
		$this->db->join('sipp_pedagang p', 'd.pedagang_id = p.pedagang_id'); // Pedagang Lama
		$this->db->join('sipp_pedagang pd', 'b.pedagang_id = pd.pedagang_id'); // Pedagang Baru
		$this->db->join('sipp_pasar s', 'b.pasar_id = s.pasar_id'); // Pasar
		$this->db->join('sipp_tempat t', 'b.tempat_id = t.tempat_id'); // Tempat
		$this->db->order_by('b.baliknama_id','desc');
		
		return $this->db->get();
	}

	function select_detail_surat($dasar_id) {
		$this->db->select('d.*, p.pedagang_nik, p.pedagang_nama, p.pedagang_tgl_lahir, p.pedagang_alamat, p.pedagang_foto, s.pasar_inisial, s.pasar_kode, s.pasar_nama, s.pasar_alamat, k.kecamatan_nama, e.desa_nama, j.jenis_kode, j.jenis_nama, t.tempat_nama');
		$this->db->from('sipp_dasar d');
		$this->db->join('sipp_pedagang p', 'd.pedagang_id = p.pedagang_id');
		$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
		$this->db->join('sipp_jenis j', 'd.jenis_id = j.jenis_id');		
		$this->db->join('sipp_kecamatan k', 's.kecamatan_id = k.kecamatan_id');
		$this->db->join('sipp_desa e', 's.desa_id = e.desa_id');
		$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
		$this->db->where('d.dasar_id', $dasar_id);
		
		return $this->db->get();
	}

	function getkodeuniksurat() {
		// Tahun Pembuatan Surat
		$tanggal 		= date('Y-m-d');
		$xtgl1 			= explode("-",$tanggal);
		$thn1 			= $xtgl1[0];

		$this->db->select('RIGHT(no, 5) as kode', FALSE);
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

        $this->db->select('RIGHT(no, 5) as kode', FALSE);
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

   	function getkodeunikbalik() {
		// Tahun Pembuatan Surat
		$tanggal 		= date('Y-m-d');
		$xtgl1 			= explode("-",$tanggal);
		$thn1 			= $xtgl1[0];

		$this->db->select('RIGHT(no, 5) as kode', FALSE);
		$this->db->where('id', 1);
		$this->db->where('tahun', $thn1);

		$query = $this->db->get('sipp_tmp_surat_balik');
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

   	function getkodeunikbalikno() {
   		// Tahun Pembuatan Surat
		$tanggal 		= date('Y-m-d');
		$xtgl1 			= explode("-",$tanggal);
		$thn1 			= $xtgl1[0];

        $this->db->select('RIGHT(no, 5) as kode', FALSE);
		$this->db->where('id', 1);
		$this->db->where('tahun', $thn1);

		$query = $this->db->get('sipp_tmp_surat_balik');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$nourut = str_pad($kode, 5, "0", STR_PAD_LEFT);		
		return $nourut;
   	}

	function select_detail_by_id($baliknama_id) {
		$this->db->select('d.*, p.pedagang_id, p.pedagang_nik, p.pedagang_nama, s.pasar_inisial, 
							s.pasar_kode, s.pasar_alamat, k.kecamatan_nama, e.desa_nama, j.jenis_kode');
		$this->db->from('sipp_baliknama d');
		$this->db->join('sipp_pedagang p', 'd.pedagang_id = p.pedagang_id');
		$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
		$this->db->join('sipp_jenis j', 'd.jenis_id = j.jenis_id');
		$this->db->join('sipp_kecamatan k', 's.kecamatan_id = k.kecamatan_id');
		$this->db->join('sipp_desa e', 'e.kecamatan_id = k.kecamatan_id');
		$this->db->where('d.baliknama_id', $baliknama_id);
		
		return $this->db->get();
	}

	function update_data() {
		$baliknama_id    	= $this->input->post('id');

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
		
		$data = array(
				'pedagang_id'			=> $this->input->post('pedagang_id'),
				'jenis_id'				=> $this->input->post('lstJenis'),
				'tempat_id'				=> $this->input->post('rdTempat'),				
				'baliknama_dari'			=> $tanggal_dari,
				'baliknama_sampai'			=> $tanggal_sampai,
				'baliknama_blok'			=> strtoupper(trim($this->input->post('blok'))),
				'baliknama_nomor'			=> strtoupper(trim($this->input->post('nomor'))),
				'baliknama_panjang'			=> $this->input->post('panjang'),
				'baliknama_lebar'			=> $this->input->post('lebar'),
				'baliknama_luas'			=> $this->input->post('luas'),
		   		'user_username' 		=> $this->session->userdata('username'),
		   		'baliknama_date_update' 	=> date('Y-m-d'),
		   		'baliknama_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('baliknama_id', $baliknama_id);
		$this->db->update('sipp_baliknama', $data);
	}

	function update_data_print() {
		$baliknama_id    	= $this->uri->segment(4);

		$data = array(
				'baliknama_st_print'		=> 1,
				'baliknama_tgl_print'		=> date('Y-m-d'),
		   		'user_username' 		=> $this->session->userdata('username'),
		   		'baliknama_date_update' 	=> date('Y-m-d'),
		   		'baliknama_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('baliknama_id', $baliknama_id);
		$this->db->update('sipp_baliknama', $data);
	}
}
/* Location: ./application/model/admin/Baliknama_model.php */