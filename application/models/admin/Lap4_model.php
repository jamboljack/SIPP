<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap4_model extends CI_Model {
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
		$tgl1 		= date("Y-m-d", strtotime($this->input->post('tgl1', 'true')));
		$tgl2 		= date("Y-m-d", strtotime($this->input->post('tgl2', 'true')));
		$pasar_id	= trim($this->input->post('lstPasar', 'true'));
		$tempat_id 	= trim($this->input->post('lstTempat', 'true'));
		
		if ($tempat_id == 'all') { // Semua Tempat
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
								p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.pasar_id', $pasar_id);
			$this->db->where('s.skrd_tgl_bayar >=', $tgl1);
			$this->db->where('s.skrd_tgl_bayar <=', $tgl2);
			$this->db->order_by('s.skrd_id','asc');
			$this->db->order_by('s.skrd_tgl_bayar','asc');
				
			return $this->db->get();
		} elseif ($tempat_id <> 'all') { // by Tempat
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
								p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.pasar_id', $pasar_id);
			$this->db->where('s.tempat_id', $tempat_id);
			$this->db->where('s.skrd_tgl_bayar >=', $tgl1);
			$this->db->where('s.skrd_tgl_bayar <=', $tgl2);
			$this->db->order_by('s.skrd_id','asc');
			$this->db->order_by('s.skrd_tgl_bayar','asc');
				
			return $this->db->get();
		}
	}

	function select_detail_by_tempat($tempat_id) {
		$pasar_id	= $this->uri->segment(4);
		$tgl1 		= $this->uri->segment(6);
		$tgl2 		= $this->uri->segment(7);

		$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
							p.penduduk_nama, r.pasar_nama, t.tempat_nama, t.tempat_kd_rek');
		$this->db->from('sipp_skrd s');
		$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
		$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
		$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
		$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
		$this->db->where('s.pasar_id', $pasar_id);
		$this->db->where('s.tempat_id', $tempat_id);
		$this->db->where('s.skrd_tgl_bayar >=', $tgl1);
		$this->db->where('s.skrd_tgl_bayar <=', $tgl2);
		$this->db->order_by('s.skrd_id','asc');
		$this->db->order_by('s.skrd_tgl_bayar','asc');
			
		return $this->db->get();
	}

	function select_by_id() {
		$pasar_id	= $this->uri->segment(4);
		$tempat_id 	= $this->uri->segment(5);
		$tgl1 		= $this->uri->segment(6);
		$tgl2 		= $this->uri->segment(7);

		$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
							p.penduduk_nama, r.pasar_nama, t.tempat_nama');
		$this->db->from('sipp_skrd s');
		$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
		$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
		$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
		$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
		$this->db->where('s.pasar_id', $pasar_id);
		$this->db->where('s.tempat_id', $tempat_id);
		$this->db->where('s.skrd_tgl_bayar >=', $tgl1);
		$this->db->where('s.skrd_tgl_bayar <=', $tgl2);
		$this->db->order_by('s.skrd_id','asc');
		$this->db->order_by('s.skrd_tgl_bayar','asc');
			
		return $this->db->get();
	}

	function select_total_bayar($pasar_id, $tempat_id, $tgl1, $tgl2) {
		if ($tempat_id == 'all') { // Semua Tempat
			$this->db->select('SUM(skrd_bayar) as totalbayar');
			$this->db->from('sipp_skrd');
			$this->db->where('pasar_id', $pasar_id);
			$this->db->where('skrd_tgl_bayar >=', $tgl1);
			$this->db->where('skrd_tgl_bayar <=', $tgl2);
			$this->db->where('skrd_status', 2); // Di Bayar
				
			return $this->db->get();
		} else {
			$this->db->select('SUM(skrd_bayar) as totalbayar');
			$this->db->from('sipp_skrd');
			$this->db->where('pasar_id', $pasar_id);
			$this->db->where('tempat_id', $tempat_id);
			$this->db->where('skrd_tgl_bayar >=', $tgl1);
			$this->db->where('skrd_tgl_bayar <=', $tgl2);
			$this->db->where('skrd_status', 2); // Di Bayar
				
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
		$this->db->select('tempat_nama, tempat_kd_rek');
		$this->db->from('sipp_tempat');		
		$this->db->where('tempat_id', $tempat_id);
		
		return $this->db->get();
	}

	function select_rincian($skrd_id) {
		$this->db->select('*');
		$this->db->from('sipp_skrd_item');		
		$this->db->where('skrd_id', $skrd_id);
		
		return $this->db->get();
	}

	function select_komponen() {
		$this->db->select('*');
		$this->db->from('sipp_komponen');		
		$this->db->order_by('komponen_id', 'asc');
		
		return $this->db->get();
	}

	function select_total($pasar_id, $tempat_id, $tgl1, $tgl2, $komponen_id) {
		$this->db->select('SUM(i.item_subtotal) as subtotal');
		$this->db->from('sipp_skrd_item i');
		$this->db->join('sipp_skrd s', 'i.skrd_id = s.skrd_id');
		$this->db->where('s.pasar_id', $pasar_id);
		$this->db->where('s.tempat_id', $tempat_id);
		$this->db->where('s.skrd_tgl_bayar >=', $tgl1);
		$this->db->where('s.skrd_tgl_bayar <=', $tgl2);
		$this->db->where('s.skrd_status', 2); // Di Bayar
		$this->db->where('i.komponen_id', $komponen_id);
		
		return $this->db->get();
	}
}
/* Location: ./application/model/admin/Lap4_model.php */