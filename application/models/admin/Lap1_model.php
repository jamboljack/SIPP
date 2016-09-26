<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap1_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}
		
	function select_pasar() {
		$this->db->select('*');
		$this->db->from('sipp_pasar');		
		$this->db->order_by('pasar_nama','asc');
		
		return $this->db->get();
	}

	function select_tempat() {
		$this->db->select('*');
		$this->db->from('sipp_tempat');		
		$this->db->order_by('tempat_nama','asc');
		
		return $this->db->get();
	}		
}
/* Location: ./application/model/admin/Lap1_model.php */