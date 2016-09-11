<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tempat_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$this->db->select('*');
		$this->db->from('sipp_tempat');
		$this->db->order_by('tempat_id','asc');
		
		return $this->db->get();
	}
	
	function insert_data() {		
		$data = array(
				'tempat_nama'			=> strtoupper(trim($this->input->post('nama'))),
		   		'tempat_date_update' 	=> date('Y-m-d'),
		   		'tempat_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_tempat', $data);
	}	

	function update_data() {
		$tempat_id     = $this->input->post('id');
		
		$data = array(
				'tempat_nama'			=> strtoupper(trim($this->input->post('nama'))),				
		   		'tempat_date_update' 	=> date('Y-m-d'),
		   		'tempat_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('tempat_id', $tempat_id);
		$this->db->update('sipp_tempat', $data);
	}

	function delete_data($kode) {		
		$this->db->where('tempat_id', $kode);
		$this->db->delete('sipp_tempat');
	}
}
/* Location: ./application/model/admin/Tempat_model.php */