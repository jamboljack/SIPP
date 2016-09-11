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
}
/* Location: ./application/model/admin/Home_model.php */