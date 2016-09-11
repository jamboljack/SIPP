<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kondisi_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$this->db->select('*');
		$this->db->from('sipp_kondisi');
		$this->db->order_by('kondisi_id','asc');
		
		return $this->db->get();
	}
	
	function insert_data() {		
		$data = array(
				'kondisi_nama'			=> strtoupper(trim($this->input->post('nama'))),
		   		'kondisi_date_update' 	=> date('Y-m-d'),
		   		'kondisi_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_kondisi', $data);
	}	

	function update_data() {
		$kondisi_id     = $this->input->post('id');
		
		$data = array(
				'kondisi_nama'			=> strtoupper(trim($this->input->post('nama'))),
		   		'kondisi_date_update' 	=> date('Y-m-d'),
		   		'kondisi_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('kondisi_id', $kondisi_id);
		$this->db->update('sipp_kondisi', $data);
	}

	function delete_data($kode) {		
		$this->db->where('kondisi_id', $kode);
		$this->db->delete('sipp_kondisi');
	}
}
/* Location: ./application/model/admin/Kondisi_model.php */