<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap2_model extends CI_Model {
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
		$bulan 		= $this->input->post('lstBulan', 'true');
		$tahun 		= $this->input->post('tahun', 'true');
		$pasar_id	= trim($this->input->post('lstPasar', 'true'));
		$tempat_id 	= trim($this->input->post('lstTempat', 'true'));
		
		if ($tempat_id == 'all') {
			$this->db->select('d.*, p.penduduk_nama, s.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_dasar d');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('d.pasar_id', $pasar_id);
			$this->db->where('MONTH(dasar_sampai)', $bulan);
			$this->db->where('YEAR(dasar_sampai)', $tahun);
			$this->db->where('d.dasar_data', 1);
			$this->db->order_by('d.pasar_id','asc');
			$this->db->order_by('d.tempat_id','asc');
			$this->db->order_by('d.penduduk_id','asc');
				
			return $this->db->get();
		} else {
			$this->db->select('d.*, p.penduduk_nama, s.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_dasar d');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('d.pasar_id', $pasar_id);
			$this->db->where('MONTH(dasar_sampai)', $bulan);
			$this->db->where('YEAR(dasar_sampai)', $tahun);
			$this->db->where('d.tempat_id', $tempat_id);
			$this->db->where('d.dasar_data', 1);
			$this->db->order_by('d.pasar_id','asc');
			$this->db->order_by('d.tempat_id','asc');
			$this->db->order_by('d.penduduk_id','asc');
				
			return $this->db->get();
		}
	}

	function select_detail_by_tempat($tempat_id) {
		$pasar_id	= $this->uri->segment(4);
		$bulan 		= $this->uri->segment(6);
		$tahun 		= $this->uri->segment(7);

		$this->db->select('d.*, p.penduduk_nama, s.pasar_nama, t.tempat_nama');
		$this->db->from('sipp_dasar d');
		$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
		$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
		$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
		$this->db->where('d.pasar_id', $pasar_id);
		$this->db->where('MONTH(dasar_sampai)', $bulan);
		$this->db->where('YEAR(dasar_sampai)', $tahun);
		$this->db->where('d.tempat_id', $tempat_id);
		$this->db->where('d.dasar_data', 1);
		$this->db->order_by('d.pasar_id','asc');
		$this->db->order_by('d.tempat_id','asc');
		$this->db->order_by('d.penduduk_id','asc');
		
		return $this->db->get();
	}

	function select_by_id() {
		$pasar_id	= $this->uri->segment(4);
		$tempat_id 	= $this->uri->segment(5);
		$bulan 		= $this->uri->segment(6);
		$tahun 		= $this->uri->segment(7);

		$this->db->select('d.*, p.penduduk_nama, s.pasar_nama, t.tempat_nama');
		$this->db->from('sipp_dasar d');
		$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
		$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
		$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
		$this->db->where('d.pasar_id', $pasar_id);
		$this->db->where('MONTH(dasar_sampai)', $bulan);
		$this->db->where('YEAR(dasar_sampai)', $tahun);
		$this->db->where('d.tempat_id', $tempat_id);
		$this->db->where('d.dasar_data', 1);
		$this->db->order_by('d.pasar_id','asc');
		$this->db->order_by('d.tempat_id','asc');
		$this->db->order_by('d.penduduk_id','asc');
		
		return $this->db->get();
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
/* Location: ./application/model/admin/Lap2_model.php */