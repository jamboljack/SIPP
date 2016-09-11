<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$this->db->select('*');
		$this->db->from('sipp_kelas');
		$this->db->order_by('kelas_id','asc');
		
		return $this->db->get();
	}
	
	function insert_data() {		
		$data = array(
				'kelas_nama'			=> strtoupper(trim($this->input->post('nama'))),
		   		'kelas_date_update' 	=> date('Y-m-d'),
		   		'kelas_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_kelas', $data);
	}	

	function update_data() {
		$kelas_id     = $this->input->post('id');
		
		$data = array(
				'kelas_nama'			=> strtoupper(trim($this->input->post('nama'))),				
		   		'kelas_date_update' 	=> date('Y-m-d'),
		   		'kelas_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('kelas_id', $kelas_id);
		$this->db->update('sipp_kelas', $data);
	}

	function delete_data($kode) {		
		$this->db->where('kelas_id', $kode);
		$this->db->delete('sipp_kelas');
	}
}
/* Location: ./application/model/admin/Kelas_model.php */