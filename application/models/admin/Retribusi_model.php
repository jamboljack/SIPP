<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retribusi_model extends CI_Model {
	var $column_order 	= array(null, 's.skrd_no', 's.skrd_bulan', 'd.dasar_npwrd', 'r.pasar_nama', 's.skrd_total', 's.skrd_status', null);
    var $column_search 	= array('s.skrd_no', 's.skrd_bulan', 'd.dasar_npwrd', 'r.pasar_nama', 'p.penduduk_nama', 's.skrd_total', 's.skrd_status');
    var $order 			= array('s.skrd_id' => 'asc', 'r.pasar_nama' => 'asc');

	function __construct() {
		parent::__construct();
	}

	private function _get_datatables_query() {
       	$user_username 	= $this->session->userdata('username');

		if ($this->session->userdata('level') == 'Admin') {
			if ($this->input->post('lstBulan', 'true')) {
            	$this->db->where('s.skrd_bulan', $this->input->post('lstBulan', 'true'));
			}
        	if ($this->input->post('tahun', 'true')) {
            	$this->db->where('s.skrd_tahun', $this->input->post('tahun', 'true'));
        	}
        	if ($this->input->post('lstPasar', 'true')) {
            	$this->db->where('s.pasar_id', $this->input->post('lstPasar', 'true'));
        	}
        	if ($this->input->post('lstTempat', 'true')) {
            	$this->db->where('s.tempat_id', $this->input->post('lstTempat', 'true'));
        	}
        	if ($this->input->post('blok', 'true')) {
            	$this->db->where('d.dasar_blok', strtoupper($this->input->post('blok', 'true')));
        	}
        	if ($this->input->post('lstStatusBayar', 'true')) {
            	$this->db->where('s.skrd_status', $this->input->post('lstStatusBayar', 'true'));
        	}

			$this->db->select('s.skrd_id, s.skrd_no, s.skrd_bulan, s.skrd_tahun, s.skrd_total, s.skrd_bunga, s.skrd_kenaikan, s.skrd_status,
			 d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
		} else {
			if ($this->input->post('lstBulan', 'true')) {
            	$this->db->where('s.skrd_bulan', $this->input->post('lstBulan', 'true'));
			}
        	if ($this->input->post('tahun', 'true')) {
            	$this->db->where('s.skrd_tahun', $this->input->post('tahun', 'true'));
        	}
        	if ($this->input->post('lstPasar', 'true')) {
            	$this->db->where('s.pasar_id', $this->input->post('lstPasar', 'true'));
        	}
        	if ($this->input->post('lstTempat', 'true')) {
            	$this->db->where('s.tempat_id', $this->input->post('lstTempat', 'true'));
        	}
        	if ($this->input->post('blok', 'true')) {
            	$this->db->where('d.dasar_blok', strtoupper($this->input->post('blok', 'true')));
        	}
        	if ($this->input->post('lstStatusBayar', 'true')) {
            	$this->db->where('s.skrd_status', $this->input->post('lstStatusBayar', 'true'));
        	}

			$this->db->select('s.skrd_id, s.skrd_no, s.skrd_bulan, s.skrd_tahun, s.skrd_total, s.skrd_bunga, s.skrd_kenaikan, s.skrd_status,
			 d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->join('sipp_akses a', 'r.pasar_id = a.pasar_id');
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
        $user_username 	= $this->session->userdata('username');

		if ($this->session->userdata('level') == 'Admin') {
			if ($this->input->post('lstBulan', 'true')) {
            	$this->db->where('s.skrd_bulan', $this->input->post('lstBulan', 'true'));
			}
        	if ($this->input->post('tahun', 'true')) {
            	$this->db->where('s.skrd_tahun', $this->input->post('tahun', 'true'));
        	}
        	if ($this->input->post('lstPasar', 'true')) {
            	$this->db->where('s.pasar_id', $this->input->post('lstPasar', 'true'));
        	}
        	if ($this->input->post('lstTempat', 'true')) {
            	$this->db->where('s.tempat_id', $this->input->post('lstTempat', 'true'));
        	}
        	if ($this->input->post('blok', 'true')) {
            	$this->db->where('d.dasar_blok', strtoupper($this->input->post('blok', 'true')));
        	}
        	if ($this->input->post('lstStatusBayar', 'true')) {
            	$this->db->where('s.skrd_status', $this->input->post('lstStatusBayar', 'true'));
        	}

			$this->db->select('s.skrd_id, s.skrd_no, s.skrd_bulan, s.skrd_tahun, s.skrd_total, s.skrd_bunga, s.skrd_kenaikan, s.skrd_status,
			 d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
		} else {
			if ($this->input->post('lstBulan', 'true')) {
            	$this->db->where('s.skrd_bulan', $this->input->post('lstBulan', 'true'));
			}
        	if ($this->input->post('tahun', 'true')) {
            	$this->db->where('s.skrd_tahun', $this->input->post('tahun', 'true'));
        	}
        	if ($this->input->post('lstPasar', 'true')) {
            	$this->db->where('s.pasar_id', $this->input->post('lstPasar', 'true'));
        	}
        	if ($this->input->post('lstTempat', 'true')) {
            	$this->db->where('s.tempat_id', $this->input->post('lstTempat', 'true'));
        	}
        	if ($this->input->post('blok', 'true')) {
            	$this->db->where('d.dasar_blok', strtoupper($this->input->post('blok', 'true')));
        	}
        	if ($this->input->post('lstStatusBayar', 'true')) {
            	$this->db->where('s.skrd_status', $this->input->post('lstStatusBayar', 'true'));
        	}

			$this->db->select('s.skrd_id, s.skrd_no, s.skrd_bulan, s.skrd_tahun, s.skrd_total, s.skrd_bunga, s.skrd_kenaikan, s.skrd_status,
			 d.dasar_npwrd, d.dasar_blok, d.dasar_nomor, d.dasar_luas, p.penduduk_nama, r.pasar_nama, t.tempat_nama');
			$this->db->from('sipp_skrd s');
			$this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
			$this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
			$this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
			$this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
			$this->db->join('sipp_akses a', 'r.pasar_id = a.pasar_id');
			$this->db->where('a.user_username', $user_username);
		}

        return $this->db->count_all_results();
    }

	function select_by_criteria() {
		$bulan 		= $this->input->post('lstBulan', 'true');
		$tahun 		= $this->input->post('tahun', 'true');
		$pasar_id	= $this->input->post('lstPasar', 'true');
		$tempat_id 	= $this->input->post('lstTempat', 'true');

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
		$item_id     = $this->input->post('id', 'true');

		$data = array(
				'item_luas'				=> $this->input->post('luas', 'true'),
				'item_tarif'			=> $this->input->post('harga', 'true'),
				'item_satuan'			=> $this->input->post('satuan', 'true'),
				'item_hari'				=> $this->input->post('hari', 'true'),
				'item_subtotal'			=> $this->input->post('subtotal', 'true'),
			   	'user_username' 		=> $this->session->userdata('username'),
			   	'item_date_update' 		=> date('Y-m-d'),
			   	'item_time_update' 		=> date('Y-m-d H:i:s')
		);

		$this->db->where('item_id', $item_id);
		$this->db->update('sipp_skrd_item', $data);

		//Total Retribusi
		$skrd_id 	= $this->input->post('skrd_id', 'true');
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
				'skrd_status'		=> 2,
				'skrd_bayar'		=> $this->input->post('jumlahbayar', 'true'),
				'skrd_kembali'		=> $this->input->post('kembalian', 'true'),
			   	'user_username' 	=> $this->session->userdata('username'),
			   	'skrd_date_update' 	=> date('Y-m-d'),
			   	'skrd_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('skrd_id', $skrd_id);
		$this->db->update('sipp_skrd', $data);
	}

	function delete_data($kode) {
		$data = array(
				'skrd_tgl_bayar'	=> '',
				'skrd_status'		=> 1,
				'skrd_bayar'		=> 0,
			   	'user_username' 	=> $this->session->userdata('username'),
			   	'skrd_date_update' 	=> date('Y-m-d'),
			   	'skrd_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('skrd_id', $kode);
		$this->db->update('sipp_skrd', $data);
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