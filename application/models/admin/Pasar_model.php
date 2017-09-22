<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasar_model extends CI_Model {
	//var $table 			= 'sipp_pasar';
    var $column_order 	= array(null, 'p.pasar_inisial', 'p.pasar_nama', 'p.pasar_jenis', 'p.pasar_thn_berdiri', 'p.pasar_alamat', 'p.pasar_nip', 'p.pasar_koordinator', null);
    var $column_search 	= array('p.pasar_inisial', 'p.pasar_nama', 'p.pasar_jenis', 'p.pasar_thn_berdiri', 'p.pasar_alamat', 'p.pasar_nip', 'p.pasar_koordinator');
    var $order 			= array('p.pasar_id' => 'asc');

    // Kecamatan
    var $column_order1 	= array(null, 'd.desa_nama', 'c.kecamatan_nama', 'k.kabupaten_nama', 'p.provinsi_nama');
    var $column_search1	= array('d.desa_nama', 'c.kecamatan_nama', 'k.kabupaten_nama', 'p.provinsi_nama');
    var $order1 		= array('d.desa_nama' => 'asc', 'c.kecamatan_nama' => 'asc');

	function __construct() {
		parent::__construct();	
	}

	private function _get_datatables_query() {
       	$user_username = $this->session->userdata('username');
		
		if ($this->session->userdata('level') == 'Admin') {
			$this->db->select('p.pasar_id,p.pasar_inisial,p.pasar_nama,p.pasar_kode,p.pasar_jenis,p.pasar_thn_berdiri,p.pasar_alamat,
			p.pasar_nip,p.pasar_koordinator, k.kecamatan_nama, d.desa_nama');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
			$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
		} else {
			$this->db->select('p.pasar_id,p.pasar_inisial,p.pasar_nama,p.pasar_kode,p.pasar_jenis,p.pasar_thn_berdiri,p.pasar_alamat,
			p.pasar_nip,p.pasar_koordinator, k.kecamatan_nama, d.desa_nama');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
			$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
			$this->db->join('sipp_akses a', 'p.pasar_id = a.pasar_id');
			$this->db->where('a.user_username', $user_username);
		}

        $i = 0;

        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
         
        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $user_username = $this->session->userdata('username');
		
		if ($this->session->userdata('level') == 'Admin') {
			$this->db->select('p.pasar_id,p.pasar_inisial,p.pasar_nama,p.pasar_kode,p.pasar_jenis,p.pasar_thn_berdiri,p.pasar_alamat,
			p.pasar_nip,p.pasar_koordinator, k.kecamatan_nama, d.desa_nama');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
			$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
		} else {
			$this->db->select('p.pasar_id,p.pasar_inisial,p.pasar_nama,p.pasar_kode,p.pasar_jenis,p.pasar_thn_berdiri,p.pasar_alamat,
			p.pasar_nip,p.pasar_koordinator, k.kecamatan_nama, d.desa_nama');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
			$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
			$this->db->join('sipp_akses a', 'p.pasar_id = a.pasar_id');
			$this->db->where('a.user_username', $user_username);
		}

        return $this->db->count_all_results();
    }

	function select_all() {
		$user_username = $this->session->userdata('username');
		
		if ($this->session->userdata('level') == 'Admin') {
			$this->db->select('p.*, k.kecamatan_nama, d.desa_nama');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
			$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
			$this->db->order_by('p.pasar_id', 'asc');
			
			return $this->db->get();
		} else {
			$this->db->select('p.*, k.kecamatan_nama, d.desa_nama');
			$this->db->from('sipp_pasar p');
			$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
			$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
			$this->db->join('sipp_akses a', 'p.pasar_id = a.pasar_id');
			$this->db->where('a.user_username', $user_username);
			$this->db->order_by('p.pasar_id', 'asc');
			
			return $this->db->get();
		}
	}

	function select_kelas() {
		$this->db->select('*');
		$this->db->from('sipp_kelas');		
		$this->db->order_by('kelas_id','asc');
		
		return $this->db->get();
	}

	function select_bentuk_bangunan() {
		$this->db->select('*');
		$this->db->from('sipp_bentuk');		
		$this->db->order_by('bentuk_id','asc');
		
		return $this->db->get();
	}

	function select_kondisi_bangunan() {
		$this->db->select('*');
		$this->db->from('sipp_kondisi');		
		$this->db->order_by('kondisi_id','asc');
		
		return $this->db->get();
	}

	function select_surat_kepemilikan() {
		$this->db->select('*');
		$this->db->from('sipp_kepemilikan');		
		$this->db->order_by('kepemilikan_id','asc');
		
		return $this->db->get();
	}

	function select_desa_kecamatan() {
		$this->db->select('p.provinsi_id, p.provinsi_nama, k.kabupaten_id, k.kabupaten_nama,
							c.kecamatan_id, c.kecamatan_nama, d.desa_id, d.desa_nama');
		$this->db->from('sipp_provinsi p');
		$this->db->join('sipp_kabupaten k', 'k.provinsi_id = p.provinsi_id');
		$this->db->join('sipp_kecamatan c', 'c.kabupaten_id = k.kabupaten_id');
		$this->db->join('sipp_desa d', 'd.kecamatan_id = c.kecamatan_id');
		$this->db->where('p.provinsi_id', '33');
		$this->db->where('c.kabupaten_id', '3319');		
		
		return $this->db->get();
	}

	// Data Kecamatan Datatables
	private function _get_datatables_kecamatan_query() {
       	$this->db->select('p.provinsi_id, p.provinsi_nama, k.kabupaten_id, k.kabupaten_nama,
							c.kecamatan_id, c.kecamatan_nama, d.desa_id, d.desa_nama');
		$this->db->from('sipp_provinsi p');
		$this->db->join('sipp_kabupaten k', 'k.provinsi_id = p.provinsi_id');
		$this->db->join('sipp_kecamatan c', 'c.kabupaten_id = k.kabupaten_id');
		$this->db->join('sipp_desa d', 'd.kecamatan_id = c.kecamatan_id');
		$this->db->where('p.provinsi_id', '33');
		$this->db->where('c.kabupaten_id', '3319');	

        $i = 0;

        foreach ($this->column_search1 as $item) {
            if($_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search1) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
         
        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order1)) {
            $order = $this->order1;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_kecamatan_datatables() {
        $this->_get_datatables_kecamatan_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered_kecamatan() {
        $this->_get_datatables_kecamatan_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_kecamatan() {
        $this->db->select('p.provinsi_id, p.provinsi_nama, k.kabupaten_id, k.kabupaten_nama,
							c.kecamatan_id, c.kecamatan_nama, d.desa_id, d.desa_nama');
		$this->db->from('sipp_provinsi p');
		$this->db->join('sipp_kabupaten k', 'k.provinsi_id = p.provinsi_id');
		$this->db->join('sipp_kecamatan c', 'c.kabupaten_id = k.kabupaten_id');
		$this->db->join('sipp_desa d', 'd.kecamatan_id = c.kecamatan_id');
		$this->db->where('p.provinsi_id', '33');
		$this->db->where('c.kabupaten_id', '3319');	

        return $this->db->count_all_results();
    }
	
	function getkodeunik() {
		$this->db->select('RIGHT(pasar_inisial, 2) as kode', FALSE);
		$this->db->order_by('pasar_inisial', 'desc');
		$this->db->limit(1);

		$query = $this->db->get('sipp_pasar');

		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$kodejadi = str_pad($kode, 2, "0", STR_PAD_LEFT);
		return $kodejadi;
   	}

	function insert_data() {
		// Kode Pasar
		$Kode_Pasar 	= $this->pasar_model->getkodeunik();

		if (!empty($_FILES['userfile']['name'])) {
			$data = array(
					'pasar_inisial'			=> $Kode_Pasar,
					'pasar_kode'			=> strtoupper(trim($this->input->post('kode'))),
					'pasar_nama'			=> strtoupper(trim($this->input->post('nama'))),
					'pasar_thn_berdiri'		=> trim($this->input->post('tahun')),
					'pasar_alamat'			=> strtoupper(trim($this->input->post('alamat'))),
					'provinsi_id'			=> $this->input->post('provinsi_id'),
					'kabupaten_id'			=> $this->input->post('kab_id'),
					'kecamatan_id'			=> $this->input->post('kec_id'),
					'desa_id'				=> $this->input->post('desa_id'),
					'pasar_lat'				=> trim($this->input->post('latitude')),
					'pasar_long'			=> trim($this->input->post('longitude')),
					'pasar_luas_tnh'		=> trim($this->input->post('luas_tanah')),
					'pasar_luas_bangun'		=> trim($this->input->post('luas_bangunan')),
					'pasar_jml_lantai'		=> trim($this->input->post('jml_lantai')),
					'pasar_jml_blok'		=> trim($this->input->post('jml_blok')),
					'pasar_jml_ruko'		=> trim($this->input->post('jml_ruko')),
					'pasar_jml_kios'		=> trim($this->input->post('jml_kios')),
					'pasar_jml_los'			=> trim($this->input->post('jml_los')),
					'pasar_jml_dasaran'		=> trim($this->input->post('jml_dasaran')),
					'pasar_jenis'			=> $this->input->post('rdJenis'),
					'kelas_id'				=> $this->input->post('lstKelas'),
					'pasar_operasional'		=> $this->input->post('rdOperasional'),
					'bentuk_id'				=> $this->input->post('rdBentuk'),
					'kondisi_id'			=> $this->input->post('rdKondisi'),
					'kepemilikan_id'		=> $this->input->post('rdLahan'),
					'pasar_omzet_hari'		=> $this->input->post('omzet_harian'),
					'pasar_omzet_minggu'	=> $this->input->post('omzet_mingguan'),
					'pasar_omzet_bulan'		=> $this->input->post('omzet_bulanan'),
					'pasar_omzet_tahun'		=> $this->input->post('omzet_tahunan'),
					'pasar_parkir'			=> $this->input->post('chkParkir'),
					'pasar_mck'				=> $this->input->post('chkMCK'),
					'pasar_tps'				=> $this->input->post('chkTPS'),
					'pasar_mushola'			=> $this->input->post('chkIbadah'),
					'pasar_pengelola'		=> $this->input->post('rdKelola'),
					'pasar_nip'				=> $this->input->post('nip'),
					'pasar_koordinator'		=> strtoupper(trim($this->input->post('nama_koordinator'))),
					'pasar_foto' 			=> $this->upload->file_name,
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'pasar_date_update' 	=> date('Y-m-d'),
			   		'pasar_time_update' 	=> date('Y-m-d H:i:s')
			);
		} else {		
			$data = array(
					'pasar_inisial'				=> $Kode_Pasar,
					'pasar_kode'			=> strtoupper(trim($this->input->post('kode'))),
					'pasar_nama'			=> strtoupper(trim($this->input->post('nama'))),
					'pasar_thn_berdiri'		=> trim($this->input->post('tahun')),
					'pasar_alamat'			=> strtoupper(trim($this->input->post('alamat'))),
					'provinsi_id'			=> $this->input->post('provinsi_id'),
					'kabupaten_id'			=> $this->input->post('kab_id'),
					'kecamatan_id'			=> $this->input->post('kec_id'),
					'desa_id'				=> $this->input->post('desa_id'),
					'pasar_lat'				=> trim($this->input->post('latitude')),
					'pasar_long'			=> trim($this->input->post('longitude')),
					'pasar_luas_tnh'		=> trim($this->input->post('luas_tanah')),
					'pasar_luas_bangun'		=> trim($this->input->post('luas_bangunan')),
					'pasar_jml_lantai'		=> trim($this->input->post('jml_lantai')),
					'pasar_jml_blok'		=> trim($this->input->post('jml_blok')),
					'pasar_jml_ruko'		=> trim($this->input->post('jml_ruko')),
					'pasar_jml_kios'		=> trim($this->input->post('jml_kios')),
					'pasar_jml_los'			=> trim($this->input->post('jml_los')),
					'pasar_jml_dasaran'		=> trim($this->input->post('jml_dasaran')),
					'pasar_jenis'			=> $this->input->post('rdJenis'),
					'kelas_id'				=> $this->input->post('lstKelas'),
					'pasar_operasional'		=> $this->input->post('rdOperasional'),
					'bentuk_id'				=> $this->input->post('rdBentuk'),
					'kondisi_id'			=> $this->input->post('rdKondisi'),
					'kepemilikan_id'		=> $this->input->post('rdLahan'),
					'pasar_omzet_hari'		=> $this->input->post('omzet_harian'),
					'pasar_omzet_minggu'	=> $this->input->post('omzet_mingguan'),
					'pasar_omzet_bulan'		=> $this->input->post('omzet_bulanan'),
					'pasar_omzet_tahun'		=> $this->input->post('omzet_tahunan'),
					'pasar_parkir'			=> $this->input->post('chkParkir'),
					'pasar_mck'				=> $this->input->post('chkMCK'),
					'pasar_tps'				=> $this->input->post('chkTPS'),
					'pasar_mushola'			=> $this->input->post('chkIbadah'),
					'pasar_pengelola'		=> $this->input->post('rdKelola'),
					'pasar_nip'				=> $this->input->post('nip'),
					'pasar_koordinator'		=> strtoupper(trim($this->input->post('nama_koordinator'))),
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'pasar_date_update' 	=> date('Y-m-d'),
			   		'pasar_time_update' 	=> date('Y-m-d H:i:s')
			);
		}

		$this->db->insert('sipp_pasar', $data);
	}

	function select_detail_by_id($pasar_id) {
		$this->db->select('p.*, k.kecamatan_nama, d.desa_nama, l.kelas_nama');
		$this->db->from('sipp_pasar p');
		$this->db->join('sipp_kelas l', 'p.kelas_id = l.kelas_id');
		$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
		$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
		$this->db->where('p.pasar_id', $pasar_id);
		
		return $this->db->get();
	}

	function update_data() {
		$pasar_id     = $this->input->post('id');
		
		if (!empty($_FILES['userfile']['name'])) {
			$data = array(
					'pasar_kode'			=> strtoupper(trim($this->input->post('kode'))),
					'pasar_nama'			=> strtoupper(trim($this->input->post('nama'))),
					'pasar_thn_berdiri'		=> trim($this->input->post('tahun')),
					'pasar_alamat'			=> strtoupper(trim($this->input->post('alamat'))),					
					'kecamatan_id'			=> $this->input->post('kec_id'),
					'desa_id'				=> $this->input->post('desa_id'),
					'pasar_lat'				=> trim($this->input->post('latitude')),
					'pasar_long'			=> trim($this->input->post('longitude')),
					'pasar_luas_tnh'		=> trim($this->input->post('luas_tanah')),
					'pasar_luas_bangun'		=> trim($this->input->post('luas_bangunan')),
					'pasar_jml_lantai'		=> trim($this->input->post('jml_lantai')),
					'pasar_jml_blok'		=> trim($this->input->post('jml_blok')),
					'pasar_jml_ruko'		=> trim($this->input->post('jml_ruko')),
					'pasar_jml_kios'		=> trim($this->input->post('jml_kios')),
					'pasar_jml_los'			=> trim($this->input->post('jml_los')),
					'pasar_jml_dasaran'		=> trim($this->input->post('jml_dasaran')),
					'pasar_jenis'			=> $this->input->post('rdJenis'),
					'kelas_id'				=> $this->input->post('lstKelas'),
					'pasar_operasional'		=> $this->input->post('rdOperasional'),
					'bentuk_id'				=> $this->input->post('rdBentuk'),
					'kondisi_id'			=> $this->input->post('rdKondisi'),
					'kepemilikan_id'		=> $this->input->post('rdLahan'),
					'pasar_omzet_hari'		=> $this->input->post('omzet_harian'),
					'pasar_omzet_minggu'	=> $this->input->post('omzet_mingguan'),
					'pasar_omzet_bulan'		=> $this->input->post('omzet_bulanan'),
					'pasar_omzet_tahun'		=> $this->input->post('omzet_tahunan'),
					'pasar_parkir'			=> $this->input->post('chkParkir'),
					'pasar_mck'				=> $this->input->post('chkMCK'),
					'pasar_tps'				=> $this->input->post('chkTPS'),
					'pasar_mushola'			=> $this->input->post('chkIbadah'),
					'pasar_pengelola'		=> $this->input->post('rdKelola'),
					'pasar_nip'				=> $this->input->post('nip'),
					'pasar_koordinator'		=> strtoupper(trim($this->input->post('nama_koordinator'))),
					'pasar_foto' 			=> $this->upload->file_name,
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'pasar_date_update' 	=> date('Y-m-d'),
			   		'pasar_time_update' 	=> date('Y-m-d H:i:s')
			);
		} else {		
			$data = array(
					'pasar_kode'			=> strtoupper(trim($this->input->post('kode'))),
					'pasar_nama'			=> strtoupper(trim($this->input->post('nama'))),
					'pasar_thn_berdiri'		=> trim($this->input->post('tahun')),
					'pasar_alamat'			=> strtoupper(trim($this->input->post('alamat'))),					
					'kecamatan_id'			=> $this->input->post('kec_id'),
					'desa_id'				=> $this->input->post('desa_id'),
					'pasar_lat'				=> trim($this->input->post('latitude')),
					'pasar_long'			=> trim($this->input->post('longitude')),
					'pasar_luas_tnh'		=> trim($this->input->post('luas_tanah')),
					'pasar_luas_bangun'		=> trim($this->input->post('luas_bangunan')),
					'pasar_jml_lantai'		=> trim($this->input->post('jml_lantai')),
					'pasar_jml_blok'		=> trim($this->input->post('jml_blok')),
					'pasar_jml_ruko'		=> trim($this->input->post('jml_ruko')),
					'pasar_jml_kios'		=> trim($this->input->post('jml_kios')),
					'pasar_jml_los'			=> trim($this->input->post('jml_los')),
					'pasar_jml_dasaran'		=> trim($this->input->post('jml_dasaran')),
					'pasar_jenis'			=> $this->input->post('rdJenis'),
					'kelas_id'				=> $this->input->post('lstKelas'),
					'pasar_operasional'		=> $this->input->post('rdOperasional'),
					'bentuk_id'				=> $this->input->post('rdBentuk'),
					'kondisi_id'			=> $this->input->post('rdKondisi'),
					'kepemilikan_id'		=> $this->input->post('rdLahan'),
					'pasar_omzet_hari'		=> $this->input->post('omzet_harian'),
					'pasar_omzet_minggu'	=> $this->input->post('omzet_mingguan'),
					'pasar_omzet_bulan'		=> $this->input->post('omzet_bulanan'),
					'pasar_omzet_tahun'		=> $this->input->post('omzet_tahunan'),
					'pasar_parkir'			=> $this->input->post('chkParkir'),
					'pasar_mck'				=> $this->input->post('chkMCK'),
					'pasar_tps'				=> $this->input->post('chkTPS'),
					'pasar_mushola'			=> $this->input->post('chkIbadah'),
					'pasar_pengelola'		=> $this->input->post('rdKelola'),
					'pasar_nip'				=> $this->input->post('nip'),
					'pasar_koordinator'		=> strtoupper(trim($this->input->post('nama_koordinator'))),
			   		'user_username' 		=> $this->session->userdata('username'),
			   		'pasar_date_update' 	=> date('Y-m-d'),
			   		'pasar_time_update' 	=> date('Y-m-d H:i:s')
			);
		}

		$this->db->where('pasar_id', $pasar_id);
		$this->db->update('sipp_pasar', $data);
	}

	function delete_data($kode) {		
		$this->db->where('pasar_id', $kode);
		$this->db->delete('sipp_pasar');
	}
}
/* Location: ./application/model/admin/Pasar_model.php */