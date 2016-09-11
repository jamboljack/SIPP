<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedagang_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$this->db->select('d.*, p.provinsi_nama, k.kabupaten_nama');
		$this->db->from('sipp_pedagang d');
		$this->db->join('sipp_provinsi p', 'd.provinsi_id = p.provinsi_id');
		$this->db->join('sipp_kabupaten k', 'd.kabupaten_id = k.kabupaten_id');
		$this->db->order_by('d.pedagang_nama','asc');
		
		return $this->db->get();
	}	

	function select_prov_kab() {
		$this->db->select('p.provinsi_id, p.provinsi_nama, k.kabupaten_id, k.kabupaten_nama');
		$this->db->from('sipp_provinsi p');
		$this->db->join('sipp_kabupaten k', 'k.provinsi_id = p.provinsi_id');		
		$this->db->order_by('k.kabupaten_nama', 'asc');
		
		return $this->db->get();
	}
	
	function insert_data() {
		$tgl_lahir 		= $this->input->post('tgl_lahir');
		$xtgl 			= explode("-",$tgl_lahir);
		$thn 			= $xtgl[2];
		$bln 			= $xtgl[1];
		$tgl 			= $xtgl[0];
		$tanggal_lhr 	= $thn.'-'.$bln.'-'.$tgl;

		if (!empty($_FILES['userfile']['name'])) {
			$data = array(
					'pedagang_nik'			=> strtoupper(trim($this->input->post('nik'))),
					'pedagang_nama'			=> strtoupper(trim($this->input->post('nama'))),
					'pedagang_tgl_lahir'	=> $tanggal_lhr,
					'pedagang_alamat'		=> strtoupper(trim($this->input->post('alamat'))),
					'provinsi_id'			=> $this->input->post('provinsi_id'),
					'kabupaten_id'			=> $this->input->post('kab_id'),					
					'pedagang_foto' 		=> $this->upload->file_name,
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'pedagang_date_update' 	=> date('Y-m-d'),
			   		'pedagang_time_update' 	=> date('Y-m-d H:i:s')
			);
		} else {		
			$data = array(
					'pedagang_nik'			=> strtoupper(trim($this->input->post('nik'))),
					'pedagang_nama'			=> strtoupper(trim($this->input->post('nama'))),
					'pedagang_tgl_lahir'	=> $tanggal_lhr,
					'pedagang_alamat'		=> strtoupper(trim($this->input->post('alamat'))),
					'provinsi_id'			=> $this->input->post('provinsi_id'),
					'kabupaten_id'			=> $this->input->post('kab_id'),
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'pedagang_date_update' 	=> date('Y-m-d'),
			   		'pedagang_time_update' 	=> date('Y-m-d H:i:s')
			);
		}

		$this->db->insert('sipp_pedagang', $data);
	}

	function select_detail_by_id($pedagang_id) {
		$this->db->select('d.*, p.provinsi_nama, k.kabupaten_nama');
		$this->db->from('sipp_pedagang d');		
		$this->db->join('sipp_provinsi p', 'd.provinsi_id = p.provinsi_id');
		$this->db->join('sipp_kabupaten k', 'd.kabupaten_id = k.kabupaten_id');
		$this->db->where('d.pedagang_id', $pedagang_id);
		
		return $this->db->get();
	}

	function update_data() {
		$pedagang_id     = $this->input->post('id');

		$tgl_lahir 		= $this->input->post('tgl_lahir');
		$xtgl 			= explode("-",$tgl_lahir);
		$thn 			= $xtgl[2];
		$bln 			= $xtgl[1];
		$tgl 			= $xtgl[0];
		$tanggal_lhr 	= $thn.'-'.$bln.'-'.$tgl;
		
		if (!empty($_FILES['userfile']['name'])) {
			$data = array(
					'pedagang_nik'			=> strtoupper(trim($this->input->post('nik'))),
					'pedagang_nama'			=> strtoupper(trim($this->input->post('nama'))),
					'pedagang_tgl_lahir'	=> $tanggal_lhr,
					'pedagang_alamat'		=> strtoupper(trim($this->input->post('alamat'))),
					'provinsi_id'			=> $this->input->post('provinsi_id'),
					'kabupaten_id'			=> $this->input->post('kab_id'),					
					'pedagang_foto' 		=> $this->upload->file_name,
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'pedagang_date_update' 	=> date('Y-m-d'),
			   		'pedagang_time_update' 	=> date('Y-m-d H:i:s')
			);
		} else {		
			$data = array(
					'pedagang_nik'			=> strtoupper(trim($this->input->post('nik'))),
					'pedagang_nama'			=> strtoupper(trim($this->input->post('nama'))),
					'pedagang_tgl_lahir'	=> $tanggal_lhr,
					'pedagang_alamat'		=> strtoupper(trim($this->input->post('alamat'))),
					'provinsi_id'			=> $this->input->post('provinsi_id'),
					'kabupaten_id'			=> $this->input->post('kab_id'),
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'pedagang_date_update' 	=> date('Y-m-d'),
			   		'pedagang_time_update' 	=> date('Y-m-d H:i:s')
			);
		}

		$this->db->where('pedagang_id', $pedagang_id);
		$this->db->update('sipp_pedagang', $data);
	}

	function delete_data($kode) {		
		$this->db->where('pedagang_id', $kode);
		$this->db->delete('sipp_pedagang');
	}
}
/* Location: ./application/model/admin/Pedagang_model.php */