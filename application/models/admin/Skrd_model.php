<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skrd_model extends CI_Model {
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

	function select_pedagang($pasar_id) {
		$tempat_id 	= $this->input->post('lstTempat');

		$this->db->select('*');
		$this->db->from('sipp_dasar');
		$this->db->where('pasar_id', $pasar_id);
		$this->db->where('tempat_id', $tempat_id);
		$this->db->where('dasar_data', 0); // Aktif
		$this->db->order_by('dasar_id', 'asc');
			
		return $this->db->get();
	}

	function select_skrd($dasar_id) {
		$bulan 		= $this->input->post('lstBulan');
		$tahun 		= $this->input->post('tahun');

		$this->db->select('*');
		$this->db->from('sipp_skrd');
		$this->db->where('dasar_id', $dasar_id);
		$this->db->where('skrd_bulan', $bulan); // Bulan
		$this->db->where('skrd_tahun', $tahun); // Bulan
		
		return $this->db->get();
	}		

	function no_urut() {
		// Tahun Pembuatan Surat
		$tanggal 		= date('Y-m-d');
		$xtgl1 			= explode("-",$tanggal);
		$thn1 			= $xtgl1[0];

		$this->db->select('RIGHT(no, 5) as kode', FALSE);
		$this->db->where('id', 1);
		$this->db->where('tahun', $thn1);

		$query = $this->db->get('sipp_tmp_skrd');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$nourut = str_pad($kode, 5, "0", STR_PAD_LEFT);		
		return $nourut;
   	}

   	function select_komponen() {
		$this->db->select('*');
		$this->db->from('sipp_komponen');
		$this->db->order_by('komponen_id', 'asc');
		
		return $this->db->get();
	}

	function insert_data($dasar_id) {
		$bln    	= $this->input->post('lstBulan');
		$tahun 		= $this->input->post('tahun');
		$tempat_id 	= $this->input->post('lstTempat');
		$kelas_id 	= $this->input->post('kelas_id');

		switch ($bln) {
			case 1:
            	$bulan = "I";
                break;
			case 2:
            	$bulan = "II";
                break;
            case 3:
            	$bulan = "III";
                break;
            case 4:
            	$bulan = "IV";
                break;
            case 5:
            	$bulan = "V";
                break;
            case 6:
            	$bulan = "VI";
                break;
            case 7:
            	$bulan = "VII";
                break;
            case 8:
            	$bulan = "VIII";
                break;
            case 9:
            	$bulan = "IX";
                break;
            case 10:
            	$bulan = "X";
                break;
            case 11:
            	$bulan = "XI";
                break;
            case 12:
            	$bulan = "XII";
                break;
        }
		
		$kode_tempat= $this->input->post('kode_tempat'); // Kode Tempat
		$kode_pasar	= $this->input->post('kode_pasar'); // Kode Pasar
		$nourut 	= $this->skrd_model->no_urut(); // No Urut SKRD
		$no_skrd 	= $nourut.'/'.$kode_tempat.'/511.2/'.$kode_pasar.'/'.$bulan.'/'.$tahun;

		$data = array(
				'no_surat'		=> strtoupper(trim($no_skrd)),
				'tahun'			=> $tahun,
				'no'			=> $nourut
			);

		$this->db->where('id', 1);
		$this->db->update('sipp_tmp_skrd', $data);

		$jumHari 	= cal_days_in_month(CAL_GREGORIAN, $bln, $tahun); // Jumlah Hari 1 Bulan
		// Simpan ke SKRD
		$data = array(				
				'skrd_no'				=> $no_skrd,
				'skrd_tgl'				=> date('Y-m-d'),
				'skrd_bulan'			=> $bln,
				'skrd_tahun'			=> $tahun,
				'skrd_jml_hari'			=> $jumHari,
				'dasar_id'				=> $dasar_id,
			   	'user_username' 		=> $this->session->userdata('username'),
			   	'skrd_date_update' 		=> date('Y-m-d'),
			   	'skrd_time_update' 		=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_skrd', $data);
		$skrd_id = $this->db->insert_id();

		// Cari Komponen Retribusi
		$retribusi 	= $this->skrd_model->select_komponen()->result();
		foreach($retribusi as $r) {
			$luas = 0;
			if ($r->komponen_type == 'S') { // Jika Sub Menu
				// Cek Luas Tempat
				$cek_luas   = $this->skrd_model->select_luas($dasar_id)->row();
				$luas 		= $cek_luas->dasar_luas;

				// Cek Tarif Pasti				
				$komponen_id = $r->komponen_id;
				$sql 		= "SELECT tarif_harga FROM sipp_tarif WHERE komponen_id='$komponen_id'
								AND kelas_id = '$kelas_id' AND tempat_id = '$tempat_id'";
				$hasil 		= $this->db->query($sql)->row();
				$harga  	= $hasil->tarif_harga;
				$subtotal 	= ($harga*$jumHari);
			} elseif ($r->komponen_uraian == 'Sampah') { // Jika Sampah
				$harga  	= $hasil->tarif_harga;
				$luas 		= 1;
				$harga 		= $r->komponen_tarif;
				$subtotal 	= ($harga*$jumHari);
			} else {
				$harga  	= $hasil->tarif_harga;
				$luas 		= 0;
				$harga 		= $r->komponen_tarif;
				$subtotal 	= ($harga*$jumHari);
			}

			$data = array(				
				'skrd_id'				=> $skrd_id,
				'item_kode'				=> $r->komponen_kode,
				'item_uraian'			=> $r->komponen_uraian,
				'item_luas'				=> $luas,
				'item_tarif'			=> $harga,
				'item_subtotal'			=> $subtotal,
			   	'user_username' 		=> $this->session->userdata('username'),
			   	'item_date_update' 		=> date('Y-m-d'),
			   	'item_time_update' 		=> date('Y-m-d H:i:s')
			);

			$this->db->insert('sipp_skrd_item', $data);	
		}

		//Total Retribusi
		$Total  = $this->skrd_model->select_total($skrd_id)->row();
		$Total  = $Total->total;

		$data = array(
				'skrd_total'	=> $Total
			);

		$this->db->where('skrd_id', $skrd_id);
		$this->db->update('sipp_skrd', $data);
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
		$this->db->select('*');
		$this->db->from('sipp_skrd_item');
		$this->db->where('skrd_id', $skrd_id);
		
		return $this->db->get();
	}

	function update_data() {
		$komponen_id     = $this->input->post('id');
		
		$data = array(				
				'komponen_kode'			=> trim($this->input->post('kode')),
				'komponen_uraian'		=> ucwords(strtolower(trim($this->input->post('uraian')))),
				'komponen_type'			=> trim($this->input->post('rdType')),
				'komponen_tarif'		=> $this->input->post('tarif'),
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
}
/* Location: ./application/model/admin/Skrd_model.php */