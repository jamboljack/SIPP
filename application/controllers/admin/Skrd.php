<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skrd extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/skrd_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['listPasar'] 	= $this->skrd_model->select_pasar()->result();
			$data['listTempat'] = $this->skrd_model->select_tempat()->result();

			$this->template->display('admin/skrd_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}

	public function data_list() {
        $List = $this->skrd_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row = array();
            $skrd_id 	= $r->skrd_id;
            $bln        = $r->skrd_bulan;
			switch ($bln) {
                        	case 1:
	                            $bulan = "Januari";
	                            break;
                            case 2:
	                            $bulan = "Februari";
	                            break;
                            case 3:
	                            $bulan = "Maret";
	                            break;
                            case 4:
	                            $bulan = "April";
	                            break;
                            case 5:
	                            $bulan = "Mei";
	                            break;
                            case 6:
	                            $bulan = "Juni";
	                            break;
                            case 7:
	                            $bulan = "Juli";
	                            break;
                            case 8:
	                            $bulan = "Agustus";
	                            break;
                            case 9:
	                            $bulan = "September";
	                            break;
                            case 10:
	                            $bulan = "Oktober";
	                            break;
                            case 11:
	                            $bulan = "November";
	                            break;
                            case 12:
	                            $bulan = "Desember";
	                            break;
                       	}

            $ttl    = ($r->skrd_total+$r->skrd_bunga+$r->skrd_kenaikan);
			$total  = '<b>Rp. '.number_format($ttl, 0, '.', ',').'</b>';

			if ($r->skrd_status == 1) {
				$status = '<span class="label label-danger">BELUM BAYAR</span>';
			} else {
            	$status = '<span class="label label-success">BAYAR</span>';
			}

			if ($r->skrd_st_print == 1) {
				$statuscetak = '<span class="label label-warning">BELUM CETAK</span>';
			} else {
            	$statuscetak = '<span class="label label-primary">SUDAH CETAK</span>';
			}

            $row[] = $no;
            $row[] = $r->skrd_no;
            $row[] = $bulan.'<br>'.$r->skrd_tahun;
            $row[] = $r->dasar_npwrd.'<br>'.$r->penduduk_nama;
            $row[] = $r->pasar_nama.'<br>'.$r->tempat_nama.' Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2';
            $row[] = $total;
            $row[] = $status.'<br>'.$statuscetak;
            
            if ($r->skrd_status == 1) {
            	$linkedit 	= site_url('admin/skrd/editdata/'.$r->skrd_id);
            	$linkprint 	= site_url('admin/skrd/printdata/'.$r->skrd_id);

            	$tomboledit = 	'<a href="'.$linkedit.'">
								<button class="btn btn-primary btn-xs" title="Edit Data">
                                	<i class="icon-pencil"></i>
								</button>
                               	</a>
                               	<a href="'.$linkprint.'" target="_blank">
                               	<button class="btn btn-default btn-xs" title="Cetak Surat Tagihan">
                                	<i class="icon-printer"></i>
                                </button>
                                </a>';
            } else {
            	$tomboledit = '';
            }

            if ($this->session->userdata('level')<>'Operator' && $r->skrd_status==1) {
            	$tombolhapus = '<a onclick="hapusData('.$skrd_id.')">
            					<button class="btn btn-danger btn-xs" title="Hapus Data">
                                	<i class="icon-trash"></i>
								</button>
                                </a>';
            } else {
            	$tombolhapus = '';
            }

            $row[] = $tomboledit.''.$tombolhapus;
            
            $data[] = $row;
        }
 
        $output = array(
                        "draw" 				=> $_POST['draw'],
                        "recordsTotal" 		=> $this->skrd_model->count_all(),
                        "recordsFiltered" 	=> $this->skrd_model->count_filtered(),
                        "data" 				=> $data,
                );
        
        echo json_encode($output);
    }

	public function caridataskrd() {
		$data['listPasar'] 	= $this->skrd_model->select_pasar()->result();
		$data['listTempat'] = $this->skrd_model->select_tempat()->result();
		$data['daftarlist'] = $this->skrd_model->select_by_criteria()->result();
		$this->template->display('admin/skrd_view', $data);
	}	

	public function adddata() {
		$data['error'] 		= 'false';
		$data['listPasar'] 	= $this->skrd_model->select_pasar()->result();
		$data['listTempat'] = $this->skrd_model->select_tempat()->result();
		$this->template->display('admin/skrd_add_view', $data);
	}

	public function deletedataskrd() {
		$data['info'] 		= 'false';
		$data['listPasar'] 	= $this->skrd_model->select_pasar()->result();
		$data['listTempat'] = $this->skrd_model->select_tempat()->result();
		$this->template->display('admin/skrd_delete_view', $data);
	}

	public function caridataskrdhapus() {		
		$data = array(
			'Pasar' 	=> $this->input->post('lstPasar', 'true'),
			'Tempat' 	=> $this->input->post('lstTempat', 'true'),
			'Bulan' 	=> $this->input->post('lstBulan', 'true'),
			'Tahun' 	=> $this->input->post('tahun', 'true')
		);

		$data['info'] 		= 'true';
		$data['listPasar'] 	= $this->skrd_model->select_pasar()->result();
		$data['listTempat'] = $this->skrd_model->select_tempat()->result();
		$data['daftarlist'] = $this->skrd_model->select_by_criteria()->result();

		$this->template->display('admin/skrd_delete_view', $data);
	}

	public function deletedataskrdaksi() {
		$this->skrd_model->delete_data_skrd();
		$this->session->set_flashdata('notification','Hapus Data Sukses.');
		redirect(site_url('admin/skrd'));
	}

	public function savedata() {
		$pasar_id	= $this->input->post('lstPasar', 'true');
		// Cari Data Pedagang by Pasar
		$pedagang 	= $this->skrd_model->select_pedagang($pasar_id)->result();
		foreach ($pedagang as $p) {
			$dasar_id 	= $p->dasar_id;
			$cek_skrd 	= $this->skrd_model->select_skrd($dasar_id)->row(); // Cari Data SKRD by Periode
			if (count($cek_skrd) == 0) { // Belum Ada
				$this->skrd_model->insert_data($dasar_id);
			}
		}
		
		$this->session->set_flashdata('notification','Simpan Data Sukses.');
	 	redirect(site_url('admin/skrd'));
	}

	public function editdata($skrd_id) {
		$data['detail'] 		= $this->skrd_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] 	= $this->skrd_model->select_list_item($skrd_id)->result();
		$this->template->display('admin/skrd_edit_view', $data);
	}

	public function updatedataitem() {
		$this->skrd_model->update_data_item();
		$this->session->set_flashdata('notification','Update Data Item Sukses.');
		redirect(site_url('admin/skrd/editdata/'.$this->uri->segment(4)));
	}

	public function updatedata() {
		$this->skrd_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/skrd'));
	}

	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));

		if ($kode == null) {
			redirect(site_url('admin/skrd'));
		} else {
			$this->skrd_model->delete_data($kode);
			$this->session->set_flashdata('notification','Hapus Data Sukses.');
			redirect(site_url('admin/skrd'));
		}
	}

	public function printdata($skrd_id) {
		$data['detail'] 	= $this->skrd_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] = $this->skrd_model->select_list_item($skrd_id)->result();
		$data['petugas'] 	= $this->skrd_model->select_kadin()->row();
		$cek 				= $this->skrd_model->select_detail_by_id($skrd_id)->row();
		if ($cek->skrd_st_print == 1) {
			$this->skrd_model->update_data_print();
		}
		$this->load->view('admin/surat_tagihan_skrd_view', $data);
	}

	public function printdatapdf($skrd_id) {
		$data['detail'] 	= $this->skrd_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] = $this->skrd_model->select_list_item($skrd_id)->result();
		$data['petugas'] 	= $this->skrd_model->select_kadin()->row();

		$time 			= time();
		$filename 		= 'Surat_Tagihan_'.$time;
		$pdfFilePath 	= FCPATH."download/$filename.pdf";

		if (file_exists($pdfFilePath) == FALSE){
			ini_set('memory_limit','50M');
			$html = $this->load->view('admin/surat_tagihan_skrd_pdf', $data, true);
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
}
/* Location: ./application/controller/admin/Skrd.php */