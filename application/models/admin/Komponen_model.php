<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komponen_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$this->db->select('*');
		$this->db->from('sipp_komponen');		
		$this->db->order_by('komponen_id','asc');
		
		return $this->db->get();
	}

	function insert_data() {		
		$data = array(				
				'komponen_kode'			=> trim($this->input->post('kode')),
				'komponen_uraian'		=> ucwords(strtolower(trim($this->input->post('uraian')))),
				'komponen_type'			=> trim($this->input->post('rdType')),
				'komponen_tarif'		=> $this->input->post('tarif'),
				'komponen_satuan'		=> $this->input->post('satuan'),
			   	'user_username' 		=> $this->session->userdata('username'),
			   	'komponen_date_update' 	=> date('Y-m-d'),
			   	'komponen_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_komponen', $data);
	}

	function select_detail_by_id($komponen_id) {
		$this->db->select('*');
		$this->db->from('sipp_komponen');
		$this->db->where('komponen_id', $komponen_id);
		
		return $this->db->get();
	}

	function update_data() {
		$komponen_id     = $this->input->post('id');
		
		$data = array(				
				'komponen_kode'			=> trim($this->input->post('kode')),
				'komponen_uraian'		=> ucwords(strtolower(trim($this->input->post('uraian')))),
				'komponen_type'			=> trim($this->input->post('rdType')),
				'komponen_tarif'		=> $this->input->post('tarif'),
				'komponen_satuan'		=> $this->input->post('satuan'),
			   	'user_username' 		=> $this->session->userdata('username'),
			   	'komponen_date_update' 	=> date('Y-m-d'),
			   	'komponen_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('komponen_id', $komponen_id);
		$this->db->update('sipp_komponen', $data);
	}

	function delete_data($kode) {		
		$this->db->where('komponen_id', $kode);
		$this->db->delete('sipp_komponen');
	}

	function select_tarif($komponen_id) {
		$this->db->select('f.*, l.kelas_nama, t.tempat_nama');
		$this->db->from('sipp_tarif f');
		$this->db->join('sipp_komponen k', 'f.komponen_id=k.komponen_id');
		$this->db->join('sipp_kelas l', 'f.kelas_id=l.kelas_id');
		$this->db->join('sipp_tempat t', 'f.tempat_id=t.tempat_id');
		$this->db->where('k.komponen_id', $komponen_id);
		$this->db->order_by('l.kelas_id', 'asc');
		$this->db->order_by('t.tempat_id', 'asc');
		
		return $this->db->get();
	}

	function select_kelas() {
		$this->db->select('*');
		$this->db->from('sipp_kelas');		
		$this->db->order_by('kelas_id','asc');
		
		return $this->db->get();
	}

	function select_tempat() {
		$this->db->select('*');
		$this->db->from('sipp_tempat');		
		$this->db->order_by('tempat_id','asc');
		
		return $this->db->get();
	}

	function insert_data_tarif() {		
		$data = array(				
				'komponen_id'			=> $this->uri->segment(4),
				'kelas_id'				=> trim($this->input->post('lstKelas')),
				'tempat_id'				=> trim($this->input->post('lstTempat')),
				'tarif_harga'			=> $this->input->post('harga'),
			   	'user_username' 		=> $this->session->userdata('username'),
			   	'tarif_date_update' 	=> date('Y-m-d'),
			   	'tarif_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_tarif', $data);
	}

	function update_data_tarif() {
		$tarif_id     = $this->input->post('id');
		
		$data = array(
				'kelas_id'				=> trim($this->input->post('lstKelas')),
				'tempat_id'				=> trim($this->input->post('lstTempat')),
				'tarif_harga'			=> $this->input->post('harga'),
			   	'user_username' 		=> $this->session->userdata('username'),
			   	'tarif_date_update' 	=> date('Y-m-d'),
			   	'tarif_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('tarif_id', $tarif_id);
		$this->db->update('sipp_tarif', $data);
	}

	function delete_data_tarif($kode) {		
		$this->db->where('tarif_id', $kode);
		$this->db->delete('sipp_tarif');
	}
}
/* Location: ./application/model/admin/Komponen_model.php */