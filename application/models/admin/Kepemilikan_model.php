<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kepemilikan_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$this->db->select('*');
		$this->db->from('sipp_kepemilikan');
		$this->db->order_by('kepemilikan_id','asc');
		
		return $this->db->get();
	}
	
	function insert_data() {		
		$data = array(
				'kepemilikan_nama'			=> strtoupper(trim($this->input->post('nama'))),
		   		'kepemilikan_date_update' 	=> date('Y-m-d'),
		   		'kepemilikan_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_kepemilikan', $data);
	}	

	function update_data() {
		$kepemilikan_id     = $this->input->post('id');
		
		$data = array(
				'kepemilikan_nama'			=> strtoupper(trim($this->input->post('nama'))),
		   		'kepemilikan_date_update' 	=> date('Y-m-d'),
		   		'kepemilikan_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('kepemilikan_id', $kepemilikan_id);
		$this->db->update('sipp_kepemilikan', $data);
	}

	function delete_data($kode) {		
		$this->db->where('kepemilikan_id', $kode);
		$this->db->delete('sipp_kepemilikan');
	}
}
/* Location: ./application/model/admin/Kepemilikan_model.php */