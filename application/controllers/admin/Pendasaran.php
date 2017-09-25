<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendasaran extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('admin/pendasaran_model');
		$this->load->model('admin/chain_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp')) {
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
            if ($r->dasar_status == 'Baru') {
            	$status = '<span class="label label-info"><i class="fa fa-plus-circle"></i> '.$r->dasar_status.'</span>';
            } elseif ($r->dasar_status=='Perpanjangan') {
            	$status = '<span class="label label-warning"><i class="fa fa-copy (alias)"></i> '.$r->dasar_status.'</span>';
            } else {
            	$status = '<span class="label label-primary"><i class="fa fa-random"></i> '.$r->dasar_status.'</span>';
            }

            // Status Print
            if ($r->dasar_st_print == 2) {
            	$statusprint = '<span class="label label-warning"><i class="fa fa-print"></i> Di Cetak</span>';
            } elseif ($r->dasar_st_print == 1) {
            	$statusprint = '<span class="label label-danger"><i class="fa fa-print"></i> Belum Cetak</span>';
            }
            
            // Status ACC
            if ($r->dasar_acc == 1) {
            	$statusacc 	= '<span class="label label-warning"><i class="fa fa-times-circle"></i> Belum ACC SPV</span>';
            } elseif ($r->dasar_acc == 2) {
            	$statusacc = '<span class="label label-success"><i class="fa fa-check-square"></i> ACC SPV</span>';
            }
            
            $row[] = $status.'<br>'.$statusprint.'<br>'.$statusacc;

            
	        $linkedit  = site_url('admin/pendasaran/editdata/'.$r->dasar_id);
	        $edit = '<a href="'.$linkedit.'">
	        		<button class="btn btn-primary btn-xs" title="Edit Data">
	                	<i class="icon-pencil"></i>
	                </button>
	                </a>';
            
            if ($r->dasar_acc == 2) {
	            $linkprint = site_url('admin/pendasaran/printdata/'.$r->dasar_id);
				$print = '<a href="'.$linkprint.'">
						<button class="btn btn-default btn-xs" title="Cetak Surat Pendasaran">
							<i class="icon-printer"></i>
						</button>
	                    </a>';
			} else {
				$print = '';
			}


			if ($this->session->userdata('level') <> 'Operator' && $r->dasar_acc == 1) {
	            $tombolacc = '<a onclick="ACCData('.$dasar_id.')">
	            				<button class="btn btn-success btn-xs" title="ACC"><i class="icon-check"></i> ACC Data</button>
	            			</a>';
			} else {
				$tombolacc = '';
			}
			
			if ($r->dasar_st_print == 2) {
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
            
            if ($r->dasar_data == 1) {
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
		$nama 					= strtoupper(trim($this->input->post('nama', 'true')));
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
				$kode 	= seo_title($this->input->post('nama', true));

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
						'penduduk_tmpt_lhr'		=> strtoupper(trim($this->input->post('tmpt_lahir', 'true'))),
						'penduduk_tgl_lahir'	=> $tanggal_lhr,
						'penduduk_jk'			=> $this->input->post('rdJk', 'true'),
						'provinsi_id'			=> $this->input->post('lstProvinsi', 'true'),
						'kabupaten_id'			=> $this->input->post('lstKabupaten', 'true'),
						'kecamatan_id'			=> $this->input->post('lstKecamatan', 'true'),
						'desa_id'				=> $this->input->post('lstKelurahan', 'true'),
						'penduduk_alamat'		=> strtoupper(trim($this->input->post('alamat', 'true'))),
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
						'penduduk_tmpt_lhr'		=> strtoupper(trim($this->input->post('tmpt_lahir', 'true'))),
						'penduduk_tgl_lahir'	=> $tanggal_lhr,
						'penduduk_jk'			=> $this->input->post('rdJk', 'true'),
						'provinsi_id'			=> $this->input->post('lstProvinsi', 'true'),
						'kabupaten_id'			=> $this->input->post('lstKabupaten', 'true'),
						'kecamatan_id'			=> $this->input->post('lstKecamatan', 'true'),
						'desa_id'				=> $this->input->post('lstKelurahan', 'true'),
						'penduduk_alamat'		=> strtoupper(trim($this->input->post('alamat', 'true'))),
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
			$kode 	= $this->input->post('penduduk_id', 'true');

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
			$kode 	= $this->input->post('penduduk_id', 'true');

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

		if ($cek->dasar_st_print == 1) {
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

	public function excel() {
    	$data['listPasar'] 	= $this->pendasaran_model->select_pasar()->result();
		$data['listTempat'] = $this->pendasaran_model->select_tempat()->result();
		$this->template->display('admin/pendasaran_excel_view', $data);
    }

    public function exportexcel() {
		// Data Export
		$List 	= $this->pendasaran_model->select_data_export()->result();
		
		if (count($List) > 0) {
			// Setting Excel
			$objPHPExcel = new PHPExcel();
			// Set document properties
			$objPHPExcel->getProperties()->setCreator("Jama' Rochmad Muttaqin")
				->setLastModifiedBy("Laporan Detail Pendasaran Pedagang")
				->setTitle("Data Detail Pendasaran Pedagang")
				->setSubject("Data Detail Pendasaran Pedagang");
			// Create the worksheet
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('A6', "NO")
				->setCellValue('B6', "NO. NPWRD")
				->setCellValue('C6', "NIK")
				->setCellValue('D6', "NAMA PEDAGANG")
				->setCellValue('E6', "TEMPAT LHR")
				->setCellValue('F6', "TGL. LAHIR")
				->setCellValue('G6', "ALAMAT")
				->setCellValue('H6', "ALAMAT2")
				->setCellValue('I6', "TEMPAT")
				->setCellValue('J6', "BLOK")
				->setCellValue('K6', "NO.")
				->setCellValue('L6', "UKURAN")
				->setCellValue('M6', "JENIS DAGANG")
				->setCellValue('N6', "DARI TGL.")
				->setCellValue('O6', "SAMPAI TGL.")
				->setCellValue('P6', "STATUS")
				->setCellValue('Q6', "BERLAKU")
				->setCellValue('R6', "ACC")
				->setCellValue('S6', "CETAK");

			$dataArray = array();
			$no = 0;

			foreach ($List as $r) {
				if ($r->dasar_data == 1) {
	                $berlaku = 'Masih Berlaku';
	            } else {
	                $berlaku = 'Tidak Berlaku';
	            }

	            if ($r->dasar_acc == 1) {
	                $acc = 'Belum ACC';
	            } else {
	                $acc = 'Sudah ACC';
	            }

	            if ($r->dasar_st_print == 1) {
	                $print = 'Belum Di Cetak';
	            } else {
	                $print = 'Sudah Di Cetak';
	            }

				$no++;
				$row_array['no'] 		= $no;
				$row_array['npwrd']		= trim($r->dasar_npwrd);
				$row_array['nik'] 		= '@'.$r->penduduk_nik;
				$row_array['nama'] 		= trim($r->penduduk_nama);
				$row_array['tempatlhr'] = trim(ucwords(strtolower($r->penduduk_tmpt_lhr)));
				$row_array['tgllhr'] 	= tgl_indo($r->penduduk_tgl_lahir);
				$row_array['alamat'] 	= ucwords(strtolower($r->penduduk_alamat)).' Desa '.ucwords(strtolower($r->desa_nama)).' Kecamatan '.ucwords(strtolower($r->kecamatan_nama));
				$row_array['kabupaten'] = ucwords(strtolower($r->kabupaten_nama)).' - '.ucwords(strtolower($r->provinsi_nama));
				$row_array['tempat'] 	= ucwords(strtolower($r->tempat_nama)).' '.ucwords(strtolower($r->pasar_nama));
				$row_array['blok'] 		= trim($r->dasar_blok);
				$row_array['nomor'] 	= trim($r->dasar_nomor);
				$row_array['luas'] 		= $r->dasar_panjang.' x '.$r->dasar_lebar;
				$row_array['jenis'] 	= trim($r->jenis_nama);
				$row_array['dari'] 		= tgl_indo($r->dasar_dari);
				$row_array['sampai'] 	= tgl_indo($r->dasar_sampai);
				$row_array['status'] 	= trim($r->dasar_status);
				$row_array['berlaku'] 	= $berlaku;
				$row_array['acc'] 		= $acc;
				$row_array['print'] 	= $print;

				array_push($dataArray, $row_array);
			}
			
			$nox = $no+6;

			$objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'A7');

			// Set page orientation and size
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.50);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.50);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.50);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.50);
			//$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');		 
			$objPHPExcel->getActiveSheet()
    			->getHeaderFooter()->setOddFooter('&R&F Page &P / &N');
			$objPHPExcel->getActiveSheet()
    			->getHeaderFooter()->setEvenFooter('&R&F Page &P / &N');

			// Set title row bold;
			$objPHPExcel->getActiveSheet()->getStyle('A6:S6')->getFont()->setBold(true);
			// Set fills
			$objPHPExcel->getActiveSheet()->getStyle('A6:S6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(60);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(16);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(16);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
			
			$objPHPExcel->setActiveSheetIndex(0);
			$sharedStyle1 = new PHPExcel_Style();
			$sharedStyle2 = new PHPExcel_Style();

			$sharedStyle1->applyFromArray(
			 array(
			 		'borders' 	=> array(
			 		'bottom' 	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
			 		'top' 		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
			 		'right' 	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
			 		'left' 		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
			 	),
			));
			 
			$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A6:S$nox");
			$objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(20); // Row Height Header
			$objPHPExcel->getActiveSheet()->getStyle()->getAlignment()->setWrapText(true); 
			
			$objPHPExcel->getActiveSheet()->getStyle('A6:S6')->applyFromArray(
				array(
			 		'font' => array(
			 			'bold' 		=> true
			 		),
			 		'alignment' 	=> array(
			 			'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			 			'vertical' 		=> PHPExcel_Style_Alignment::VERTICAL_CENTER
			 		),
			 		'borders' 		=> array(
			 			'top' 		=> array(
			 				'style' => PHPExcel_Style_Border::BORDER_THIN
			 			)
			 		)
			 	)
			);

			$objPHPExcel->getActiveSheet()->getStyle('A4:S1000')->getFont()->setName('Tahoma');
			$objPHPExcel->getActiveSheet()->getStyle('A4:S1000')->getFont()->setSize(8);
			// Merge cells
			$objPHPExcel->getActiveSheet()->mergeCells('A2:S2');
			$objPHPExcel->getActiveSheet()->setCellValue('A2', "LAPORAN DATA PENDASARAN PEDAGANG");
			$objPHPExcel->getActiveSheet()->mergeCells('A3:S3');
			$objPHPExcel->getActiveSheet()->setCellValue('A3', "KABUPATEN KUDUS");
			//$objPHPExcel->getActiveSheet()->mergeCells('A4:S4');
			//$objPHPExcel->getActiveSheet()->setCellValue('A4', "TAHUN : ".$Tahun1." s/d ".$Tahun2);
			$objPHPExcel->getActiveSheet()->getStyle('A2:S4')->getFont()->setName('Tahoma');
			$objPHPExcel->getActiveSheet()->getStyle('A2:S4')->getFont()->setSize(10);
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(10);
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(10);
			$objPHPExcel->getActiveSheet()->getStyle('A2:S6')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2:S6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A7:A1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('B7:B1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('C7:C1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('D7:D1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('E7:E1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('F7:F1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('G7:G1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('H7:H1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('I7:I1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('J7:J1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('K7:K1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('L7:L1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('M7:M1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('N7:N1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('O7:O1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('P7:P1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('Q7:Q1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('R7:R1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('S7:S1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);            
			$date = date('Y-m-d');
			$time = time();
			$objWriter->save('download/Data_Pendasaran_'.$date.'_'.$time.'.xlsx');
			redirect(base_url('download/Data_Pendasaran_'.$date.'_'.$time.'.xlsx'));
		} else {
			$this->session->set_flashdata('notification','Data Tidak Ada.');
	 		redirect(site_url('admin/pendasaran/excel'));
		}
	}
}
/* Location: ./application/controller/admin/Pendasaran.php */