<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendasaran_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}

	function select_all() {
		$this->db->select('d.*, p.pedagang_nama, s.pasar_nama');
		$this->db->from('sipp_dasar d');
		$this->db->join('sipp_pedagang p', 'd.pedagang_id = p.pedagang_id');
		$this->db->join('sipp_pasar s', 'd.pasar_id = s.pasar_id');
		$this->db->order_by('d.dasar_tgl_surat','desc');
		
		return $this->db->get();
	}	

	function select_pasar() {
		$this->db->select('p.*, k.kecamatan_nama, d.desa_nama');
		$this->db->from('sipp_pasar p');
		$this->db->join('sipp_kecamatan k', 'p.kecamatan_id = k.kecamatan_id');
		$this->db->join('sipp_desa d', 'p.desa_id = d.desa_id');
		$this->db->order_by('p.pasar_nama', 'asc');
		
		return $this->db->get();
	}

	function select_pedagang() {
		$this->db->select('*');
		$this->db->from('sipp_pedagang');		
		$this->db->order_by('pedagang_nama', 'asc');
		
		return $this->db->get();
	}

	function select_jenis() {
		$this->db->select('*');
		$this->db->from('sipp_jenis');		
		$this->db->order_by('jenis_nama', 'asc');
		
		return $this->db->get();
	}

	function getkodeuniksurat() {
        $q 	= $this->db->query("SELECT MAX(dasar_id) AS idmax FROM sipp_dasar");
        $kd = 0;
        if($q->num_rows() > 0)
        {
           	foreach($q->result() as $k)
           	{
                $mkd = ((int)$k->idmax)+1;
            }
        }
        else
        {
            $mkd  = 1;
        }

        return '511.2/'.$mkd;
   	}

   	function getkodeuniknpwrd() {
        $q 	= $this->db->query("SELECT MAX(dasar_id) AS idmax FROM sipp_dasar");
        $kd = 0;
        if($q->num_rows() > 0)
        {
           	foreach($q->result() as $k)
           	{
                $mkd = ((int)$k->idmax)+1;
            }
        }
        else
        {
            $mkd  = 1;
        }

        return $mkd;
   	}
	
	function insert_data() {
		$tgl_surat 		= $this->input->post('tgl_surat');
		$xtgl 			= explode("-",$tgl_surat);
		$thn 			= $xtgl[2];
		$bln 			= $xtgl[1];
		$tgl 			= $xtgl[0];
		$tanggal_srt 	= $thn.'-'.$bln.'-'.$tgl;

		// Tahun Pembuatan Surat
		$tanggal 		= date('Y-m-d');
		$xtgl1 			= explode("-",$tanggal);
		$thn1 			= $xtgl1[0];
		// No KIOS
		$no_kios 		= $this->input->post('kios');
		// Kode Pasar
		$kode_pasar		= trim($this->input->post('pasar_kode'));
		// No Surat
		$nosurat 		= $this->pendasaran_model->getkodeuniksurat();
		$No_Surat 		= $nosurat.'/'.$no_kios.'/'.$kode_pasar.'/'.$thn1; // 511.2/No Urut/No. Kios/Kode Pasar/Tahun Surat
		// NPWRD = No. Urut+Kode Pedagang+Kodepasar+Jenis Dagangan+Tahun
		$kodepedagang 	= $this->input->post('pedagang_id');
		$kodepasar 		= $this->input->post('lstPasar');
		$jenisdagang 	= $this->input->post('lstJenis');
		$nourut 		= $this->pendasaran_model->getkodeuniknpwrd();
		$No_NPWRD		= $nourut.$kodepedagang.$kodepasar.$jenisdagang.$thn1;

		$data = array(
				'dasar_no'				=> strtoupper(trim($No_Surat)),
				'dasar_npwrd'			=> strtoupper(trim($No_NPWRD)),
				'pedagang_id'			=> $this->input->post('pedagang_id'),
				'pasar_id'				=> $this->input->post('lstPasar'),
				'jenis_id'				=> $this->input->post('lstJenis'),
				'dasar_tgl_surat'		=> $tanggal_srt,
				'dasar_blok'			=> strtoupper(trim($this->input->post('blok'))),
				'dasar_ruko'			=> $this->input->post('ruko'),
				'dasar_kios'			=> $this->input->post('kios'),
				'dasar_los'				=> $this->input->post('los'),
				'dasar_luas'			=> $this->input->post('luas'),
		   		'user_username' 		=> $this->session->userdata('username'),
		   		'dasar_date_update' 	=> date('Y-m-d'),
		   		'dasar_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_dasar', $data);
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
/* Location: ./application/model/admin/Pendasaran_model.php */