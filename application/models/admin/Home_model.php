<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_count_pasar() {
		$this->db->select('*');
		$this->db->from('sipp_pasar');		
		
		return $this->db->get();
	}

	function select_count_pedagang() {
		$this->db->select('*');
		$this->db->from('sipp_dasar');
		$this->db->where('dasar_data', 0);
		
		return $this->db->get();
	}

	function select_sum_tagihan() {
		$this->db->select('SUM(skrd_total) as subtotal, SUM(skrd_bunga) as bunga, SUM(skrd_kenaikan) as kenaikan');
		$this->db->from('sipp_skrd');
		$this->db->where('skrd_tahun', date('Y'));
		
		return $this->db->get();
	}

	function select_sum_tagihan_bayar() {
		$this->db->select('SUM(skrd_total) as subtotal, SUM(skrd_bunga) as bunga, SUM(skrd_kenaikan) as kenaikan');
		$this->db->from('sipp_skrd');
		$this->db->where('skrd_tahun', date('Y'));
		$this->db->where('skrd_status', 1);
		
		return $this->db->get();
	}

	function select_pendasaran() {
		$bulan = date('m'); // Bulan Ini
		$tahun = date('Y'); // Tahun Ini
		$this->db->select('*');
		$this->db->from('sipp_dasar');
		$this->db->where('MONTH(dasar_sampai)', $bulan);
		$this->db->where('YEAR(dasar_sampai)', $tahun);
		
		return $this->db->get();
	}

	function select_pembayaran() {
		$bulan = date('m'); // Bulan Ini
		$tahun = date('Y'); // Tahun Ini

		$this->db->select('*');
		$this->db->from('sipp_skrd');
		$this->db->where('MONTH(skrd_tgl_tempo)', $bulan);
		$this->db->where('YEAR(skrd_tgl_tempo)', $tahun);
		$this->db->where('skrd_status', 0);
		
		return $this->db->get();
	}

	function select_pendasaran_baru() {
		$this->db->select('*');
		$this->db->from('sipp_dasar');
		$this->db->where('dasar_acc', 0);
		
		return $this->db->get();
	}

	function select_baliknama() {
		$this->db->select('*');
		$this->db->from('sipp_baliknama');
		$this->db->where('baliknama_data', 0);
		
		return $this->db->get();
	}
}
/* Location: ./application/model/admin/Home_model.php */