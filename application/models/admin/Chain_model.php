<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chain_model extends CI_Model {	
	var $tabel_provinsi		= 'sipp_provinsi';
	var $tabel_kabupaten	= 'sipp_kabupaten';
	var $tabel_kecamatan	= 'sipp_kecamatan';
	var $tabel_kelurahan	= 'sipp_desa';

	function __construct() {
		parent::__construct();	
	}

	public function ambil_provinsi() {
		$sql_prov = $this->db->get($this->tabel_provinsi);	
		if($sql_prov->num_rows()>0) {
			foreach ($sql_prov->result_array() as $row)
				{
					$result['-']= '- Pilih Provinsi -';
					$result[$row['provinsi_id']] = ucwords(strtolower($row['provinsi_nama']));
				}
			return $result;
		}
	}

	public function ambil_kabupaten($kode_prop){
		$this->db->where('provinsi_id', $kode_prop);
		$this->db->order_by('kabupaten_nama', 'asc');
		$sql_kabupaten = $this->db->get($this->tabel_kabupaten);
		if($sql_kabupaten->num_rows()>0) {
			foreach ($sql_kabupaten->result_array() as $row) {
            	$result[$row['kabupaten_id']]= ucwords(strtolower($row['kabupaten_nama']));
        	}
		} else {
		   	$result['-']= '- Belum Ada Kabupaten -';
		}
        return $result;
	}
	
	public function ambil_kecamatan($kode_kab){
		$this->db->where('kabupaten_id', $kode_kab);
		$this->db->order_by('kecamatan_nama', 'asc');
		$sql_kecamatan = $this->db->get($this->tabel_kecamatan);
		if($sql_kecamatan->num_rows()>0) {
			foreach ($sql_kecamatan->result_array() as $row) {
            	$result[$row['kecamatan_id']]= ucwords(strtolower($row['kecamatan_nama']));
        	}
		} else {
		   	$result['-']= '- Belum Ada Kecamatan -';
		}
        return $result;
	}

	public function ambil_kelurahan($kode_kec){
		$this->db->where('kecamatan_id', $kode_kec);
		$this->db->order_by('desa_nama', 'asc');
		$sql_kelurahan = $this->db->get($this->tabel_kelurahan);
		if($sql_kelurahan->num_rows()>0) {
			foreach ($sql_kelurahan->result_array() as $row) {
            	$result[$row['desa_id']]= ucwords(strtolower($row['desa_nama']));
        	}
		} else {
		   $result['-']= '- Belum Ada Kelurahan -';
		}
        return $result;
	}
}
/* Location: ./application/model/admin/Chaiin_model.php */