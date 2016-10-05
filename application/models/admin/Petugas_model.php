<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_model extends CI_Model {
	
	function __construct() {
		parent::__construct();	
	}

	function select_detail() {
		$this->db->select('*');
		$this->db->from('sipp_petugas');
		$this->db->where('petugas_id', 1);
		
		return $this->db->get();
	}

	function update_data() {
		$user_username = $this->session->userdata('username');

		$data = array(
					'petugas_nik_kadin' 		=> trim($this->input->post('nip_kadin')),
	    			'petugas_nama_kadin' 		=> trim($this->input->post('nama_kadin')),
	    			'petugas_jab_kadin' 		=> trim($this->input->post('jab_kadin')),
	    			'petugas_title_kadin' 		=> trim($this->input->post('title_kadin')),
	    			'petugas_nik_skrd' 			=> trim($this->input->post('nip_skrd')),
	    			'petugas_nama_skrd' 		=> trim($this->input->post('nama_skrd')),
	    			'petugas_jab_skrd' 			=> trim($this->input->post('jab_skrd')),
	    			'petugas_title_skrd' 		=> trim($this->input->post('title_skrd'))
				);

		$this->db->where('petugas_id', 1);
		$this->db->update('sipp_petugas', $data);
	}	
}
/* Location: ./application/model/admin/Petugas_model.php */
?>