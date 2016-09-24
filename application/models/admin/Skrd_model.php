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
		$bulan 		= $this->input->post('lstBulan');
		$tahun 		= $this->input->post('tahun');
		$pasar_id	= $this->input->post('lstPasar');

		$this->db->select('LEFT(skrd_no, 5) as kode', FALSE);
		$this->db->where('skrd_bulan', $bulan);
		$this->db->where('skrd_tahun', $tahun);
		$this->db->where('pasar_id', $pasar_id);
		$this->db->order_by('skrd_id', 'desc');
		$this->db->limit(1);

		$query = $this->db->get('sipp_skrd');

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
		$pasar_id	= $this->input->post('lstPasar');

		$tglAkhir 	= tglAkhirBulan($tahun, $bln); // Cari Tgl. AKhir Bulan
		$Tgl_tempo 	= $tahun.'-'.$bln.'-'.$tglAkhir; // Tgl. Tempo

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

		$jumHari 	= cal_days_in_month(CAL_GREGORIAN, $bln, $tahun); // Jumlah Hari 1 Bulan
		
		// Simpan ke SKRD
		$data = array(				
				'skrd_no'				=> $no_skrd,
				'skrd_tgl'				=> date('Y-m-d'),
				'skrd_bulan'			=> $bln,
				'skrd_tahun'			=> $tahun,
				'skrd_jml_hari'			=> $jumHari,
				'dasar_id'				=> $dasar_id,
				'pasar_id'				=> $pasar_id,
				'tempat_id'				=> $tempat_id,
				'skrd_tgl_tempo'		=> $Tgl_tempo,
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
				$subtotal 	= ($harga*$jumHari*$luas);
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
				'item_satuan'			=> $r->komponen_satuan,
				'item_hari'				=> $jumHari,
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
				'skrd_bunga'		=> $this->input->post('bunga'),
				'skrd_kenaikan'		=> $this->input->post('kenaikan'),
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

	function update_data_print() {
		$skrd_id    	= $this->uri->segment(4);

		$data = array(
				'skrd_st_print'			=> 1,
				'skrd_tgl_print'		=> date('Y-m-d'),
		   		'user_username' 		=> $this->session->userdata('username'),
		   		'skrd_date_update' 		=> date('Y-m-d'),
		   		'skrd_time_update' 		=> date('Y-m-d H:i:s')
		);

		$this->db->where('skrd_id', $skrd_id);
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
/* Location: ./application/model/admin/Skrd_model.php */