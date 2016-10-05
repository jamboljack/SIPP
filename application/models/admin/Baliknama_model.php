<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baliknama_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$this->db->select('b.*, d.dasar_no, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas,
		 					p.penduduk_nama as nama, pd.penduduk_nama, s.pasar_nama, t.tempat_nama');
		$this->db->from('sipp_baliknama b'); // Balik Nama
		$this->db->join('sipp_dasar d', 'b.dasar_id = d.dasar_id'); // Pendasaran
		$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id'); // Pedagang Lama
		$this->db->join('sipp_penduduk pd', 'b.penduduk_id = pd.penduduk_id'); // Pedagang Baru
		$this->db->join('sipp_pasar s', 'b.pasar_id = s.pasar_id'); // Pasar
		$this->db->join('sipp_tempat t', 'b.tempat_id = t.tempat_id'); // Tempat
		$this->db->order_by('b.baliknama_id','desc');
		
		return $this->db->get();
	}

	function select_surat_dasar($pasar_id) {		
		$this->db->select('d.*, p.penduduk_nama, s.pasar_nama, t.tempat_nama');
		$this->db->from('sipp_dasar d');
		$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
		$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
		$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
		$this->db->where('d.pasar_id', $pasar_id);
		$this->db->where('d.dasar_data', 0);
		$this->db->order_by('d.dasar_id','desc');

		return $this->db->get();
	}

	function select_penduduk() {
		$this->db->select('p.*, v.provinsi_nama, b.kabupaten_nama, c.kecamatan_nama, d.desa_nama');
		$this->db->from('sipp_penduduk p');
		$this->db->join('sipp_provinsi v', 'p.provinsi_id = v.provinsi_id');
		$this->db->join('sipp_kabupaten b', 'p.kabupaten_id = b.kabupaten_id');
		$this->db->join('sipp_kecamatan c', 'p.kecamatan_id = c.kecamatan_id');
		$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
		$this->db->order_by('p.penduduk_nama', 'asc');
		
		return $this->db->get();
	}

	function select_penduduk_baru($penduduk_id) {
		$this->db->select('p.*, v.provinsi_nama, b.kabupaten_nama, c.kecamatan_nama, d.desa_nama');
		$this->db->from('sipp_penduduk p');
		$this->db->join('sipp_provinsi v', 'p.provinsi_id = v.provinsi_id');
		$this->db->join('sipp_kabupaten b', 'p.kabupaten_id = b.kabupaten_id');
		$this->db->join('sipp_kecamatan c', 'p.kecamatan_id = c.kecamatan_id');
		$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
		$this->db->where('p.penduduk_id', $penduduk_id);
		
		return $this->db->get();
	}

	function select_penduduk_cari($nama) {
		$this->db->select('p.*, v.provinsi_nama, k.kabupaten_nama, c.kecamatan_nama, d.desa_nama');
		$this->db->from('sipp_penduduk p');
		$this->db->join('sipp_provinsi v', 'p.provinsi_id = v.provinsi_id');
		$this->db->join('sipp_kabupaten k', 'p.kabupaten_id = k.kabupaten_id');
		$this->db->join('sipp_kecamatan c', 'p.kecamatan_id = c.kecamatan_id');
		$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
		$this->db->or_like('p.penduduk_nik', $nama);
		$this->db->or_like('p.penduduk_nama', $nama);
		$this->db->limit(20);
		
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

		if ($this->session->userdata('level') == 'Admin') {
			$this->db->select('p.*, k.kecamatan_nama, d.desa_nama');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
			$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
			$this->db->order_by('p.pasar_nama', 'asc');
			
			return $this->db->get();
		} else {
			$this->db->select('p.*, k.kecamatan_nama, d.desa_nama');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
			$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
			$this->db->join('sipp_akses a', 'p.pasar_id = a.pasar_id');
			$this->db->where('a.user_username', $user_username);
			$this->db->order_by('p.pasar_nama', 'asc');
			
			return $this->db->get();
		}
	}

	function select_pasar_by_id($pasar_id) {
		$this->db->select('*');
		$this->db->from('sipp_pasar');		
		$this->db->where('pasar_id', $pasar_id);
		
		return $this->db->get();
	}	

	function select_detail_surat($dasar_id) {
		$this->db->select('d.*, p.*,
			v.provinsi_nama, b.kabupaten_nama, c.kecamatan_nama as kecamatan_lama, i.desa_nama as desa_lama,
		 	p.penduduk_foto, s.pasar_inisial, s.pasar_kode, s.pasar_nama, s.pasar_alamat, k.kecamatan_nama, 
		 	e.desa_nama, j.jenis_kode, j.jenis_nama, t.tempat_nama');
		$this->db->from('sipp_dasar d');
		$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
		$this->db->join('sipp_provinsi v', 'p.provinsi_id = v.provinsi_id');
		$this->db->join('sipp_kabupaten b', 'p.kabupaten_id = b.kabupaten_id');
		$this->db->join('sipp_kecamatan c', 'p.kecamatan_id = c.kecamatan_id');
		$this->db->join('sipp_desa i', 'p.desa_id = i.desa_id');
		$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
		$this->db->join('sipp_kecamatan k', 's.kecamatan_id = k.kecamatan_id');
		$this->db->join('sipp_desa e', 's.desa_id = e.desa_id');
		$this->db->join('sipp_jenis j', 'd.jenis_id = j.jenis_id');				
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

	function insert_data() {
		// Update Foto
		if (!empty($_FILES['userfile']['name'])) {
			$data = array(
					'penduduk_foto' 		=> $this->upload->file_name,
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'penduduk_date_update' 	=> date('Y-m-d'),
			   		'penduduk_time_update' 	=> date('Y-m-d H:i:s')
			);
		} else {		
			$data = array(
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'penduduk_date_update' 	=> date('Y-m-d'),
			   		'penduduk_time_update' 	=> date('Y-m-d H:i:s')
			);
		}
		$penduduk_id = $this->uri->segment(5);
		$this->db->where('penduduk_id', $penduduk_id);
		$this->db->update('sipp_penduduk', $data);		

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

		// No Surat Balik Nama
		$no_urut_balik	= $this->baliknama_model->getkodeunikbalikno();
		$no_balik		= $this->baliknama_model->getkodeunikbalik();
		$No_BalikNama 	= $no_balik.'/BN/'.$tahun;
			// Update Temporary Surat Balik
		$data = array(
				'no_surat'		=> strtoupper(trim($No_BalikNama)),
				'tahun'			=> $tahun,
				'no'			=> $no_urut_balik
			);

		$this->db->where('id', 1);
		$this->db->update('sipp_tmp_surat_balik', $data);

		// Insert ke Tabel Balik Nama
		$data = array(
				'dasar_id'					=> $this->input->post('id'),
				'penduduk_id'				=> $this->uri->segment(5),
				'jenis_id'					=> $this->input->post('jenis_id'),
				'pasar_id'					=> $this->input->post('pasar_id'),
				'tempat_id'					=> $this->input->post('tempat_id'),
				'baliknama_no'				=> strtoupper(trim($No_BalikNama)), // 511.2/00001/BN/2016
				'baliknama_tgl'				=> $tanggal_srt,
		   		'user_username' 			=> $this->session->userdata('username'),
		   		'baliknama_date_update' 	=> date('Y-m-d'),
		   		'baliknama_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_baliknama', $data);	
	}

	function select_detail_by_id($baliknama_id) {
		$this->db->select('b.*, p.penduduk_nik, p.penduduk_nama, p.penduduk_tgl_lahir, p.penduduk_alamat,
						p.penduduk_jk, p.penduduk_foto, v.provinsi_nama, k.kabupaten_nama, 
						c.kecamatan_nama, d.desa_nama');
		$this->db->from('sipp_baliknama b');
		$this->db->join('sipp_penduduk p', 'b.penduduk_id = p.penduduk_id');
		$this->db->join('sipp_provinsi v', 'p.provinsi_id = v.provinsi_id');
		$this->db->join('sipp_kabupaten k', 'p.kabupaten_id = k.kabupaten_id');
		$this->db->join('sipp_kecamatan c', 'p.kecamatan_id = c.kecamatan_id');
		$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
		$this->db->where('b.baliknama_id', $baliknama_id);
		
		return $this->db->get();
	}

	function update_data() {
		$baliknama_id    	= $this->input->post('baliknama_id');

		// Tgl. Balik Nama
		$tgl_surat 		= $this->input->post('tgl_surat');
		$xtgl 			= explode("-",$tgl_surat);
		$thn 			= $xtgl[2];
		$bln 			= $xtgl[1];
		$tgl 			= $xtgl[0];
		$tanggal_srt 	= $thn.'-'.$bln.'-'.$tgl;
		
		// Insert ke Tabel Balik Nama
		$data = array(
				'baliknama_tgl'				=> $tanggal_srt,
		   		'user_username' 			=> $this->session->userdata('username'),
		   		'baliknama_date_update' 	=> date('Y-m-d'),
		   		'baliknama_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('baliknama_id', $baliknama_id);
		$this->db->update('sipp_baliknama', $data);
	}

	function delete_data($kode) {		
		$this->db->where('baliknama_id', $kode);
		$this->db->delete('sipp_baliknama');
	}
}
/* Location: ./application/model/admin/Baliknama_model.php */