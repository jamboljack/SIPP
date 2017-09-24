<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penduduk_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$this->db->select('d.*, p.provinsi_nama, k.kabupaten_nama, c.kecamatan_nama, s.desa_nama');
		$this->db->from('sipp_penduduk d');
		$this->db->join('sipp_provinsi p', 'd.provinsi_id = p.provinsi_id');
		$this->db->join('sipp_kabupaten k', 'd.kabupaten_id = k.kabupaten_id');
		$this->db->join('sipp_kecamatan c', 'd.kecamatan_id = c.kecamatan_id');
		$this->db->join('sipp_desa s', 'd.desa_id = s.desa_id');
		$this->db->order_by('d.penduduk_nama','asc');
		
		return $this->db->get();
	}

	function select_detail_by_id($penduduk_id) {
		$this->db->select('d.*, p.provinsi_nama, k.kabupaten_nama, c.kecamatan_nama, s.desa_nama');
		$this->db->from('sipp_penduduk d');
		$this->db->join('sipp_provinsi p', 'd.provinsi_id = p.provinsi_id');
		$this->db->join('sipp_kabupaten k', 'd.kabupaten_id = k.kabupaten_id');
		$this->db->join('sipp_kecamatan c', 'd.kecamatan_id = c.kecamatan_id');
		$this->db->join('sipp_desa s', 'd.desa_id = s.desa_id');
		$this->db->where('d.penduduk_id', $penduduk_id);
		
		return $this->db->get();
	}

	function update_data() {
		$penduduk_id     = $this->input->post('id', 'true');

		$tgl_lahir 		= $this->input->post('tgl_lahir', 'true');
		$xtgl 			= explode("-",$tgl_lahir);
		$thn 			= $xtgl[2];
		$bln 			= $xtgl[1];
		$tgl 			= $xtgl[0];
		$tanggal_lhr 	= $thn.'-'.$bln.'-'.$tgl;
		
		if (!empty($_FILES['userfile']['name'])) {
			$data = array(
					'penduduk_nik'			=> strtoupper(trim($this->input->post('nik', 'true'))),
					'penduduk_no_kk'		=> strtoupper(trim($this->input->post('no_kk', 'true'))),
					'penduduk_nama'			=> strtoupper(trim($this->input->post('nama', 'true'))),
					'penduduk_tgl_lahir'	=> $tanggal_lhr,
					'penduduk_jk'			=> $this->input->post('rdJk', 'true'),
					'penduduk_alamat'		=> strtoupper(trim($this->input->post('alamat', 'true'))),
					'penduduk_rt'			=> $this->input->post('rt', 'true'),
					'penduduk_rw'			=> $this->input->post('rw', 'true'),
					'penduduk_foto' 		=> $this->upload->file_name,
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'penduduk_date_update' 	=> date('Y-m-d'),
			   		'penduduk_time_update' 	=> date('Y-m-d H:i:s')
			);
		} else {		
			$data = array(
					'penduduk_nik'			=> strtoupper(trim($this->input->post('nik', 'true'))),
					'penduduk_no_kk'		=> strtoupper(trim($this->input->post('no_kk', 'true'))),
					'penduduk_nama'			=> strtoupper(trim($this->input->post('nama', 'true'))),
					'penduduk_tgl_lahir'	=> $tanggal_lhr,
					'penduduk_jk'			=> $this->input->post('rdJk', 'true'),
					'penduduk_alamat'		=> strtoupper(trim($this->input->post('alamat', 'true'))),
					'penduduk_rt'			=> $this->input->post('rt', 'true'),
					'penduduk_rw'			=> $this->input->post('rw', 'true'),
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'penduduk_date_update' 	=> date('Y-m-d'),
			   		'penduduk_time_update' 	=> date('Y-m-d H:i:s')
			);
		}

		$this->db->where('penduduk_id', $penduduk_id);
		$this->db->update('sipp_penduduk', $data);
	}

	function delete_data($kode) {		
		$this->db->where('penduduk_id', $kode);
		$this->db->delete('sipp_penduduk');
	}
}
/* Location: ./application/model/admin/Penduduk_model.php */