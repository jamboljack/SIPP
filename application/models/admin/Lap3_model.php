<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap3_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}
		
	function select_pasar() {
		$user_username = $this->session->userdata('username');

		if ($this->session->userdata('level') == 'Admin') {
			$this->db->select('*');
			$this->db->from('sipp_pasar');			
			$this->db->order_by('pasar_nama', 'asc');
			
			return $this->db->get();
		} else {
			$this->db->select('p.*');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_akses a', 'p.pasar_id = a.pasar_id');
			$this->db->where('a.user_username', $user_username);
			$this->db->order_by('p.pasar_nama', 'asc');
			
			return $this->db->get();
		}
	}

	function select_tempat() {
		$this->db->select('*');
		$this->db->from('sipp_tempat');		
		$this->db->order_by('tempat_id', 'asc');
		
		return $this->db->get();
	}

	function select_by_criteria() {
		$bulan 		= $this->input->post('lstBulan');
		$tahun 		= $this->input->post('tahun');
		$pasar_id	= trim($this->input->post('lstPasar'));
		$tempat_id 	= trim($this->input->post('lstTempat'));
		$status 	= trim($this->input->post('lstStatus')); // Status
		
		if ($tempat_id == 'all' && $status == 'all') { // Semua Tempat dan Semua Status
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
								p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.pasar_id', $pasar_id);
			$this->db->where('s.skrd_bulan', $bulan);
			$this->db->where('s.skrd_tahun', $tahun);
			$this->db->order_by('s.skrd_id','asc');
			$this->db->order_by('s.skrd_tgl_bayar','asc');
				
			return $this->db->get();
		} elseif ($tempat_id == 'all' && $status <> 'all') { // Semua Tempat dan by Status
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
								p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.pasar_id', $pasar_id);
			$this->db->where('s.skrd_bulan', $bulan);
			$this->db->where('s.skrd_tahun', $tahun);
			$this->db->where('s.skrd_status', $status);
			$this->db->order_by('s.skrd_id','asc');
			$this->db->order_by('s.skrd_tgl_bayar','asc');
				
			return $this->db->get();
		} elseif ($tempat_id <> 'all' && $status == 'all') { // by Tempat dan Semua Status
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
								p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.pasar_id', $pasar_id);
			$this->db->where('s.skrd_bulan', $bulan);
			$this->db->where('s.skrd_tahun', $tahun);
			$this->db->where('s.tempat_id', $tempat_id);
			$this->db->order_by('s.skrd_id','asc');
			$this->db->order_by('s.skrd_tgl_bayar','asc');
				
			return $this->db->get();
		} elseif ($tempat_id <> 'all' && $status <> 'all') { // by Tempat dan by Status
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
								p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.pasar_id', $pasar_id);
			$this->db->where('s.skrd_bulan', $bulan);
			$this->db->where('s.skrd_tahun', $tahun);
			$this->db->where('s.tempat_id', $tempat_id);
			$this->db->where('s.skrd_status', $status);
			$this->db->order_by('s.skrd_id','asc');
			$this->db->order_by('s.skrd_tgl_bayar','asc');
				
			return $this->db->get();
		}
	}

	function select_detail_by_tempat($tempat_id) {
		$pasar_id	= $this->uri->segment(4);
		$bulan 		= $this->uri->segment(6);
		$tahun 		= $this->uri->segment(7);

		$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
								p.penduduk_nama, r.pasar_nama, t.tempat_nama');
		$this->db->from('sipp_skrd s');
		$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
		$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
		$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
		$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
		$this->db->where('s.pasar_id', $pasar_id);
		$this->db->where('s.skrd_bulan', $bulan);
		$this->db->where('s.skrd_tahun', $tahun);
		$this->db->where('s.tempat_id', $tempat_id);		
		$this->db->order_by('s.skrd_id','asc');
		$this->db->order_by('s.skrd_tgl_bayar','asc');
		
		return $this->db->get();
	}

	function select_by_id() {
		$pasar_id	= $this->uri->segment(4);
		$tempat_id 	= $this->uri->segment(5);
		$bulan 		= $this->uri->segment(6);
		$tahun 		= $this->uri->segment(7);
		$status		= $this->uri->segment(8);

		if ($status == 'all') {
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
									p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.pasar_id', $pasar_id);
			$this->db->where('s.skrd_bulan', $bulan);
			$this->db->where('s.skrd_tahun', $tahun);
			$this->db->where('s.tempat_id', $tempat_id);		
			$this->db->order_by('s.skrd_id','asc');
			$this->db->order_by('s.skrd_tgl_bayar','asc');
			
			return $this->db->get();
		} else {
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
									p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.pasar_id', $pasar_id);
			$this->db->where('s.skrd_bulan', $bulan);
			$this->db->where('s.skrd_tahun', $tahun);
			$this->db->where('s.tempat_id', $tempat_id);
			$this->db->where('s.skrd_status', $status);
			$this->db->order_by('s.skrd_id','asc');
			$this->db->order_by('s.skrd_tgl_bayar','asc');
			
			return $this->db->get();
		}
	}

	function select_pasar_by_id($pasar_id) {
		$this->db->select('pasar_nama');
		$this->db->from('sipp_pasar');		
		$this->db->where('pasar_id', $pasar_id);
		
		return $this->db->get();
	}

	function select_tempat_by_id($tempat_id) {
		$this->db->select('tempat_nama');
		$this->db->from('sipp_tempat');		
		$this->db->where('tempat_id', $tempat_id);
		
		return $this->db->get();
	}			
}
/* Location: ./application/model/admin/Lap3_model.php */