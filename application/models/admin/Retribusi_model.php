<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retribusi_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$user_username 	= $this->session->userdata('username');
		$bulan 			= date('m');
		$tahun 			= date('Y');

		if ($this->session->userdata('level') == 'Admin') {
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
				p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.skrd_bulan', $bulan);
			$this->db->where('s.skrd_tahun', $tahun);
			$this->db->order_by('s.skrd_id','asc');
			
			return $this->db->get();
		} else {
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
				p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->join('sipp_akses a', 'r.pasar_id = a.pasar_id');
			$this->db->where('a.user_username', $user_username);
			$this->db->where('s.skrd_bulan', $bulan);
			$this->db->where('s.skrd_tahun', $tahun);
			$this->db->order_by('s.skrd_id','asc');
			
			return $this->db->get();
		}
	}

	function select_by_criteria() {
		$bulan 		= $this->input->post('lstBulan');
		$tahun 		= $this->input->post('tahun');
		$pasar_id	= $this->input->post('lstPasar');
		$tempat_id 	= $this->input->post('lstTempat');
		
		if ($tempat_id == 'all') { 
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
				p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.skrd_bulan', $bulan);
			$this->db->where('s.skrd_tahun', $tahun);
			$this->db->where('s.pasar_id', $pasar_id);
			$this->db->order_by('s.skrd_id','asc');
				
			return $this->db->get();
		} else {
			$this->db->select('s.*, d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, 
				p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->where('s.skrd_bulan', $bulan);
			$this->db->where('s.skrd_tahun', $tahun);
			$this->db->where('s.pasar_id', $pasar_id);
			$this->db->where('s.tempat_id', $tempat_id);
			$this->db->order_by('s.skrd_id','asc');
				
			return $this->db->get();
		}
	}

	function select_pasar() {
		$user_username = $this->session->userdata('username');

		if ($this->session->userdata('level') == 'Admin') {
			$this->db->select('p.*, k.kecamatan_nama, d.desa_nama');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
			$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
			$this->db->order_by('p.pasar_nama', 'asc');
			
			return $this->db->get();
		} else {
			$this->db->select('p.*, k.kecamatan_nama, d.desa_nama');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
			$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
			$this->db->join('sipp_akses a', 'p.pasar_id = a.pasar_id');
			$this->db->where('a.user_username', $user_username);
			$this->db->order_by('p.pasar_nama', 'asc');
			
			return $this->db->get();
		}
	}

	function select_tempat() {
		$this->db->select('*');
		$this->db->from('sipp_tempat');		
		$this->db->order_by('tempat_id','asc');
		
		return $this->db->get();
	}

	function select_total($skrd_id) {
		$this->db->select('SUM(item_subtotal) as total');
		$this->db->from('sipp_skrd_item');
		$this->db->where('skrd_id', $skrd_id);
		
		return $this->db->get();
	}

	function select_luas($dasar_id) {
		$this->db->select('dasar_luas');
		$this->db->from('sipp_dasar');
		$this->db->where('dasar_id', $dasar_id);
		
		return $this->db->get();
	}

	function select_detail_by_id($skrd_id) {
		$this->db->select('s.*, p.penduduk_nik, p.penduduk_nama, p.penduduk_alamat, p.penduduk_rt, p.penduduk_rw,
							k.kabupaten_nama, d.dasar_npwrd, r.pasar_nama');
		$this->db->from('sipp_skrd s');
		$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
		$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
		$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
		$this->db->join('sipp_kabupaten k', 'p.kabupaten_id = k.kabupaten_id');
		$this->db->where('s.skrd_id', $skrd_id);
		
		return $this->db->get();
	}

	function select_list_item($skrd_id) {
		$this->db->select('*');
		$this->db->from('sipp_skrd_item');
		$this->db->where('skrd_id', $skrd_id);
		
		return $this->db->get();
	}

	function update_data_item() {
		$item_id     = $this->input->post('id');
		
		$data = array(				
				'item_luas'				=> $this->input->post('luas'),
				'item_tarif'			=> $this->input->post('harga'),
				'item_satuan'			=> $this->input->post('satuan'),
				'item_hari'				=> $this->input->post('hari'),
				'item_subtotal'			=> $this->input->post('subtotal'),
			   	'user_username' 		=> $this->session->userdata('username'),
			   	'item_date_update' 		=> date('Y-m-d'),
			   	'item_time_update' 		=> date('Y-m-d H:i:s')
		);

		$this->db->where('item_id', $item_id);
		$this->db->update('sipp_skrd_item', $data);

		//Total Retribusi
		$skrd_id 	= $this->input->post('skrd_id');
		$Total  	= $this->skrd_model->select_total($skrd_id)->row();
		$Total  	= $Total->total;

		$data = array(
				'skrd_total'	=> $Total
			);

		$this->db->where('skrd_id', $skrd_id);
		$this->db->update('sipp_skrd', $data);
	}

	function update_data() {
		$skrd_id     = $this->input->post('id');
		
		$data = array(				
				'skrd_tgl_bayar'	=> date('Y-m-d'),
				'skrd_status'		=> 1,
				'skrd_bayar'		=> $this->input->post('jumlahbayar'),
				'skrd_kembali'		=> $this->input->post('kembalian'),
			   	'user_username' 	=> $this->session->userdata('username'),
			   	'skrd_date_update' 	=> date('Y-m-d'),
			   	'skrd_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('skrd_id', $skrd_id);
		$this->db->update('sipp_skrd', $data);
	}

	function delete_data($kode) {		
		$this->db->where('skrd_id', $kode);
		$this->db->delete('sipp_skrd_item');

		$this->db->where('skrd_id', $kode);
		$this->db->delete('sipp_skrd');
	}	

	function select_petugas($skrd_id) {
		$this->db->select('p.pasar_nip, p.pasar_koordinator');
		$this->db->from('sipp_skrd s');
		$this->db->join('sipp_pasar p', 's.pasar_id = p.pasar_id');
		$this->db->where('s.skrd_id', $skrd_id);
		
		return $this->db->get();
	}

	function select_kadin() {
		$this->db->select('*');
		$this->db->from('sipp_petugas');		
		$this->db->where('petugas_id', 1);
		
		return $this->db->get();
	}
}
/* Location: ./application/model/admin/Retribusi_model.php */