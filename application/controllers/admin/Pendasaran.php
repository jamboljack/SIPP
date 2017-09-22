<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendasaran extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/pendasaran_model');
		$this->load->model('admin/chain_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['listPasar'] 	= $this->pendasaran_model->select_pasar()->result();
			$data['listTempat'] = $this->pendasaran_model->select_tempat()->result();
			$this->template->display('admin/pendasaran_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}

	public function data_list() {
        $List = $this->pendasaran_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row = array();
            $dasar_id = $r->dasar_id;

            $row[] = $no;
            $row[] = $r->dasar_no;
            $row[] = date("d-m-Y", strtotime($r->dasar_sampai));
            $row[] = $r->dasar_npwrd;
            $row[] = $r->penduduk_nama;
            $row[] = ucwords($r->pasar_nama).'<br>'.$r->tempat_nama.' Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2';

            // Status NPWRD
            if ($r->dasar_status=='Baru') {
            	$status = '<span class="label label-info"><i class="fa fa-plus-circle"></i> '.$r->dasar_status.'</span>';
            } elseif ($r->dasar_status=='Perpanjangan') {
            	$status = '<span class="label label-warning"><i class="fa fa-copy (alias)"></i> '.$r->dasar_status.'</span>';
            } else {
            	$status = '<span class="label label-primary"><i class="fa fa-random"></i> '.$r->dasar_status.'</span>';
            }

            // Status Print
            if ($r->dasar_st_print == 1) {
            	$statusprint = '<span class="label label-warning"><i class="fa fa-print"></i> Di Cetak</span>';
            } else {
            	$statusprint = '<span class="label label-danger"><i class="fa fa-print"></i> Belum Cetak</span>';
            }
            
            // Status ACC
            if ($r->dasar_acc == 0) {
            	$statusacc 	= '<span class="label label-warning"><i class="fa fa-times-circle"></i> Belum ACC SPV</span>';
            } else {
            	$statusacc = '<span class="label label-success"><i class="fa fa-check-square"></i> ACC SPV</span>';
            }
            
            $row[] = $status.'<br>'.$statusprint.'<br>'.$statusacc;

            
	        $linkedit  = site_url('admin/pendasaran/editdata/'.$r->dasar_id);
	        $edit = '<a href="'.$linkedit.'">
	        		<button class="btn btn-primary btn-xs" title="Edit Data">
	                	<i class="icon-pencil"></i>
	                </button>
	                </a>';
            
            if ($r->dasar_acc == 1) {
	            $linkprint = site_url('admin/pendasaran/printdata/'.$r->dasar_id);
				$print = '<a href="'.$linkprint.'">
						<button class="btn btn-default btn-xs" title="Cetak Surat Pendasaran">
							<i class="icon-printer"></i>
						</button>
	                    </a>';
			} else {
				$print = '';
			}


			if ($this->session->userdata('level') <> 'Operator' && $r->dasar_acc == 0) {
	            $tombolacc = '<a onclick="ACCData('.$dasar_id.')">
	            				<button class="btn btn-success btn-xs" title="ACC"><i class="icon-check"></i> ACC Data</button>
	            			</a>';
			} else {
				$tombolacc = '';
			}
			
			if ($r->dasar_st_print == 1) {
	            $linkperpanjang = site_url('admin/pendasaran/perpanjangan/'.$r->dasar_id);			
	           	$tombolperpanjang = '<a href="'.$linkperpanjang.'">
	           						<button class="btn btn-warning btn-xs" title="Perpanjangan Surat">
	           							<i class="icon-docs"></i>
	           						</button>
	                                </a>';
			} else {
				$tombolperpanjang = '';
			}

            $tombolhapus = '<a onclick="hapusData('.$dasar_id.')">
            				<button class="btn btn-danger btn-xs" title="Hapus Data">
                            	<i class="icon-trash"></i>
                            </button>
                            </a>';
            
            if ($r->dasar_data == 0) {
            	$row[] = $edit.''.$print.''.$tombolacc.''.$tombolperpanjang.''.$tombolhapus;
            } else {
            	$row[] = '<span class="label label-danger"><i class="fa fa-remove (alias)"></i> Tidak Berlaku</span>';
            }
            
            $data[] = $row;
        }
 
        $output = array(
                        "draw" 				=> $_POST['draw'],
                        "recordsTotal" 		=> $this->pendasaran_model->count_all(),
                        "recordsFiltered" 	=> $this->pendasaran_model->count_filtered(),
                        "data" 				=> $data,
                );
        
        echo json_encode($output);
    }

	public function pilihpenduduk() {
		$data['tampil']		= 'tidak';
		$this->template->display('admin/penduduk_pilih_view', $data);
	}

	public function caridatapenduduk() {
		$data['tampil']			= 'ya';
		$nama 					= strtoupper(trim($this->input->post('nama')));
		$data['listPenduduk'] 	= $this->pendasaran_model->select_penduduk_cari($nama)->result();
		$this->template->display('admin/penduduk_pilih_view', $data);
	}

	public function addpenduduk() {
		$data['error']			= false;
		$data['provinsi']		= $this->chain_model->ambil_provinsi();
		$this->template->display('admin/penduduk_add_view', $data);
	}

	// dijalankan saat provinsi di klik
	public function pilih_kabupaten() {
		$data['kabupaten'] 		= $this->chain_model->ambil_kabupaten($this->uri->segment(4));
		$this->load->view('admin/v_drop_down_kabupaten',$data);
	}

	// dijalankan saat kabupaten di klik
	public function pilih_kecamatan() {
		$data['kecamatan'] 		= $this->chain_model->ambil_kecamatan($this->uri->segment(4));
		$this->load->view('admin/v_drop_down_kecamatan',$data);
	}

	// dijalankan saat kecamatan di klik
	public function pilih_kelurahan() {
		$data['kelurahan'] 		= $this->chain_model->ambil_kelurahan($this->uri->segment(4));
		$this->load->view('admin/v_drop_down_kelurahan',$data);
	}

	public function savedatapenduduk() {
		$this->form_validation->set_rules('nik','<b>N I K</b>','trim|required|min_length[16]|max_length[16]|is_unique[sipp_penduduk.penduduk_nik]');

		if ($this->form_validation->run() == FALSE) {
			$data['error']			= true;
			$data['provinsi']		= $this->chain_model->ambil_provinsi();
			$this->template->display('admin/penduduk_add_view', $data);
		} else {
			if (!empty($_FILES['userfile']['name'])) {
				$jam 	= time();
				$kode 	= seo_title($this->input->post('nama'));

				$config['file_name']    = 'Penduduk_'.$kode.'_'.$jam.'.jpg';
				$config['upload_path'] = './penduduk_image/';
				$config['allowed_types'] = 'jpg|png|gif|jpeg';
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('userfile');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config['maintain_ratio'] = TRUE;

				$config['width'] = 500;
				$config['height'] = 750;
				$this->load->library('image_lib',$config);

				$this->image_lib->resize();
			} elseif (empty($_FILES['userfile']['name'])){
				$config['file_name'] = '';
			}

			// Simpan ke Tabel Pedagang
			$tgl_lahir 		= $this->input->post('tgl_lahir');
			$xtgl 			= explode("-",$tgl_lahir);
			$thn 			= $xtgl[2];
			$bln 			= $xtgl[1];
			$tgl 			= $xtgl[0];
			$tanggal_lhr 	= $thn.'-'.$bln.'-'.$tgl;

			if (!empty($_FILES['userfile']['name'])) {
				$data = array(
						'penduduk_nik'			=> strtoupper(trim($this->input->post('nik'))),
						'penduduk_no_kk'		=> strtoupper(trim($this->input->post('no_kk'))),
						'penduduk_nama'			=> strtoupper(trim($this->input->post('nama'))),
						'penduduk_tmpt_lhr'		=> strtoupper(trim($this->input->post('tmpt_lahir'))),
						'penduduk_tgl_lahir'	=> $tanggal_lhr,
						'penduduk_jk'			=> $this->input->post('rdJk'),
						'provinsi_id'			=> $this->input->post('lstProvinsi'),
						'kabupaten_id'			=> $this->input->post('lstKabupaten'),
						'kecamatan_id'			=> $this->input->post('lstKecamatan'),
						'desa_id'				=> $this->input->post('lstKelurahan'),
						'penduduk_alamat'		=> strtoupper(trim($this->input->post('alamat'))),
						'penduduk_foto' 		=> $this->upload->file_name,
				   		'user_username' 		=> $this->session->userdata('username'),
				   		'penduduk_date_update' 	=> date('Y-m-d'),
				   		'penduduk_time_update' 	=> date('Y-m-d H:i:s')
				);
			} else {
				$data = array(
						'penduduk_nik'			=> strtoupper(trim($this->input->post('nik'))),
						'penduduk_no_kk'		=> strtoupper(trim($this->input->post('no_kk'))),
						'penduduk_nama'			=> strtoupper(trim($this->input->post('nama'))),
						'penduduk_tmpt_lhr'		=> strtoupper(trim($this->input->post('tmpt_lahir'))),
						'penduduk_tgl_lahir'	=> $tanggal_lhr,
						'penduduk_jk'			=> $this->input->post('rdJk'),
						'provinsi_id'			=> $this->input->post('lstProvinsi'),
						'kabupaten_id'			=> $this->input->post('lstKabupaten'),
						'kecamatan_id'			=> $this->input->post('lstKecamatan'),
						'desa_id'				=> $this->input->post('lstKelurahan'),
						'penduduk_alamat'		=> strtoupper(trim($this->input->post('alamat'))),
				   		'user_username' 		=> $this->session->userdata('username'),
				   		'penduduk_date_update' 	=> date('Y-m-d'),
				   		'penduduk_time_update' 	=> date('Y-m-d H:i:s')
				);
			}
			$this->db->insert('sipp_penduduk', $data);
			$id = $this->db->insert_id();
	 		redirect(site_url('admin/pendasaran/adddata/'.$id));
	 	}
	}

	public function adddata() {
		$penduduk_id 			= $this->uri->segment(4);
		$data['listTempat']		= $this->pendasaran_model->select_tempat()->result();
		$data['listPasar'] 		= $this->pendasaran_model->select_pasar()->result();
		$data['listJenis'] 		= $this->pendasaran_model->select_jenis()->result();
		$data['detailpenduduk'] = $this->pendasaran_model->select_penduduk($penduduk_id)->row(); // Data Penduduk
		$this->template->display('admin/pendasaran_add_view', $data);
	}

	public function savedata() {
		if (!empty($_FILES['userfile']['name'])) {
			$jam 	= time();
			$kode 	= $this->input->post('penduduk_id');

			$config['file_name']    = 'Penduduk_'.$kode.'_'.$jam.'.jpg';
			$config['upload_path'] = './penduduk_image/';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->do_upload('userfile');
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = 500;
			$config['height'] = 750;
			$this->load->library('image_lib',$config);

			$this->image_lib->resize();
		} elseif (empty($_FILES['userfile']['name'])){
			$config['file_name'] = '';
		}

		$this->pendasaran_model->insert_data();
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
	 	redirect(site_url('admin/pendasaran'));
	}

	public function accdata() {
		$this->pendasaran_model->update_data_acc();
		$this->session->set_flashdata('notification','Data Telah di ACC.');
	 	redirect(site_url('admin/pendasaran'));
	}

	public function editdata($dasar_id) {
		$data['listTempat']		= $this->pendasaran_model->select_tempat()->result();
		$data['listPasar'] 		= $this->pendasaran_model->select_pasar()->result();
		$data['listJenis'] 		= $this->pendasaran_model->select_jenis()->result();
		$data['detail'] 		= $this->pendasaran_model->select_detail_by_id($dasar_id)->row();
		$this->template->display('admin/pendasaran_edit_view', $data);
	}

	public function updatedata() {
		if (!empty($_FILES['userfile']['name'])) {
			$jam 	= time();
			$kode 	= $this->input->post('penduduk_id');

			$config['file_name']    = 'Penduduk_'.$kode.'_'.$jam.'.jpg';
			$config['upload_path'] = './penduduk_image/';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->do_upload('userfile');
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 500;
			$config['height'] = 750;
			$this->load->library('image_lib',$config);

			$this->image_lib->resize();
		} elseif (empty($_FILES['userfile']['name'])){
			$config['file_name'] = '';
		}

		$this->pendasaran_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/pendasaran'));
	}

	public function printdata($dasar_id) {
		$data['detail'] = $this->pendasaran_model->select_detail_by_id($dasar_id)->row();
		$cek 			= $this->pendasaran_model->select_detail_by_id($dasar_id)->row();

		if ($cek->dasar_st_print == 0) {
			$this->pendasaran_model->update_data_print();
		}
		$this->template->display('admin/pendasaran_preview_view', $data);
	}

	public function preview($dasar_id) {
		$data['detail'] 		= $this->pendasaran_model->select_detail_by_id($dasar_id)->row();
		$data['petugas'] 		= $this->pendasaran_model->select_petugas()->row();
		$this->load->view('admin/pendasaran_preview_print', $data);
	}

	public function exportpdf($dasar_id) {
		$data['detail'] 		= $this->pendasaran_model->select_detail_by_id($dasar_id)->row();
		$data['petugas'] 		= $this->pendasaran_model->select_petugas()->row();

		$time 			= time();
		$npwrd 			= $this->uri->segment(5);
		$filename 		= 'Surat_Pendasaran_'.$npwrd.'_'.$time;
		$pdfFilePath 	= FCPATH."download/$filename.pdf";

		if (file_exists($pdfFilePath) == FALSE){
			ini_set('memory_limit','50M');
			$html = $this->load->view('admin/pendasaran_preview_pdf', $data, true);
			$this->load->library('pdf');
			$param = '"en-GB-x","A4","","",10,10,10,10,6,3,"L"'; // Landscape
			$pdf = $this->pdf->load($param);
			$pdf->SetHeader('');
			$pdf->SetFooter('');
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		redirect("download/$filename.pdf");
	}

	public function perpanjangan($dasar_id) {
		$data['listTempat']		= $this->pendasaran_model->select_tempat()->result();
		$data['listPasar'] 		= $this->pendasaran_model->select_pasar()->result();
		$data['listJenis'] 		= $this->pendasaran_model->select_jenis()->result();
		$data['detail'] 		= $this->pendasaran_model->select_detail_by_id($dasar_id)->row();
		$this->template->display('admin/pendasaran_perpanjangan_view', $data);
	}

	public function savedataperpanjangan() {
		$this->pendasaran_model->insert_data_perpanjangan();
		$this->session->set_flashdata('notification','Simpan Data Perpanjangan Sukses.');
	 	redirect(site_url('admin/pendasaran'));
	}

	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));

		if ($kode == null) {
			redirect(site_url('admin/pendasaran'));
		} else {
			// Cek jika sudah ada SKRD
			$cek_data = $this->pendasaran_model->check_data_skrd($kode)->result();
			if (count($cek_data) > 0) { // Jika sudah ada SKRD, tidak bisa diHapus
				$this->session->set_flashdata('notification','Data tidak bisa di Hapus, Sudah ada SKRD.');
			} else {
				$this->pendasaran_model->delete_data($kode);
				$this->session->set_flashdata('notification','Hapus Data Sukses.');
			}
			redirect(site_url('admin/pendasaran'));
		}
	}

	public function accdata_all() {
		$this->pendasaran_model->update_data_acc_all();
		$this->session->set_flashdata('notification','Data Telah di ACC Semua.');
	 	redirect(site_url('admin/pendasaran'));
	}
}
/* Location: ./application/controller/admin/Pendasaran.php */