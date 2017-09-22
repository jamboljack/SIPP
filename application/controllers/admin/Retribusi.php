<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retribusi extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/retribusi_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_sipp'))
		{
			$data['listPasar'] 	= $this->retribusi_model->select_pasar()->result();
			$data['listTempat'] = $this->retribusi_model->select_tempat()->result();
			//$data['daftarlist'] = $this->retribusi_model->select_all()->result();
			$this->template->display('admin/retribusi_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}

	public function data_list() {
        $List = $this->retribusi_model->get_datatables();
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
			if ($r->skrd_status == 0) {
				$status = '<span class="label label-danger">BELUM BAYAR</span>';
			} else {
            	$status = '<span class="label label-success">BAYAR</span>';
			}

            $row[] = $no;
            $row[] = $r->skrd_no;
            $row[] = $bulan.'<br>'.$r->skrd_tahun;
            $row[] = $r->dasar_npwrd.'<br>'.$r->penduduk_nama;
            $row[] = $r->pasar_nama.'<br>'.$r->tempat_nama.' Blok '.$r->dasar_blok.' Nomor '.$r->dasar_nomor.' Luas '.$r->dasar_luas.' m2';
            $row[] = $total;
            $row[] = $status;
            
            $linkedit 	= site_url('admin/retribusi/editdata/'.$r->skrd_id);
            $tomboledit = 	'<a href="'.$linkedit.'">
								<button class="btn btn-primary btn-xs" title="Edit Data">
                                	<i class="icon-pencil"></i>
								</button>
                               	</a>';
				
            if ($r->skrd_status==1) {
            	$linkprint = site_url('admin/retribusi/printdata/'.$r->skrd_id);
            	$tombolprint = '<a href="'.$linkprint.'" target="_blank">
								<button class="btn btn-default btn-xs" title="Cetak Surat Tagihan">
                                	<i class="icon-printer"></i>
								</button>
                                </a>
                                <a onclick="hapusData('.$skrd_id.')">
								<button class="btn btn-danger btn-xs" title="Hapus Data">
                                	<i class="icon-trash"></i>
								</button>
                                </a>';
            } else {
            	$tombolprint = '';
            }

            $row[] = $tomboledit.''.$tombolprint;
            
            $data[] = $row;
        }
 
        $output = array(
                        "draw" 				=> $_POST['draw'],
                        "recordsTotal" 		=> $this->retribusi_model->count_all(),
                        "recordsFiltered" 	=> $this->retribusi_model->count_filtered(),
                        "data" 				=> $data,
                );
        
        echo json_encode($output);
    }

	public function caridataskrd() {
		$data['listPasar'] 	= $this->retribusi_model->select_pasar()->result();
		$data['listTempat'] = $this->retribusi_model->select_tempat()->result();
		$data['daftarlist'] = $this->retribusi_model->select_by_criteria()->result();
		$this->template->display('admin/retribusi_view', $data);
	}

	public function editdata($skrd_id) {
		$data['detail'] 		= $this->retribusi_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] 	= $this->retribusi_model->select_list_item($skrd_id)->result();
		$this->template->display('admin/retribusi_edit_view', $data);
	}

	public function updatedataitem() {
		$this->retribusi_model->update_data_item();
		$this->session->set_flashdata('notification','Update Data Item Sukses.');
		redirect(site_url('admin/retribusi/editdata/'.$this->uri->segment(4)));
	}

	public function updatedata() {
		$this->retribusi_model->update_data();
		$this->session->set_flashdata('notification','Update Data Sukses.');
		redirect(site_url('admin/retribusi/printdata/'.$this->uri->segment(4)));
	}

	public function deletedata($kode) {
		$kode = $this->security->xss_clean($this->uri->segment(4));

		if ($kode == null) {
			redirect(site_url('admin/retribusi'));
		} else {
			$this->retribusi_model->delete_data($kode);
			$this->session->set_flashdata('notification','Penggantian Status Sukses.');
			redirect(site_url('admin/retribusi'));
		}
	}

	public function printdata($skrd_id) {
		$data['detail'] 	= $this->retribusi_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] = $this->retribusi_model->select_list_item($skrd_id)->result();
		$data['petugas'] 	= $this->retribusi_model->select_petugas($skrd_id)->row();
		$data['kadin'] 		= $this->retribusi_model->select_kadin()->row();
		$this->load->view('admin/kwitansi_bayar_retribusi_view', $data);
	}

	public function printdatapdf($skrd_id) {
		$data['detail'] 	= $this->retribusi_model->select_detail_by_id($skrd_id)->row();
		$data['daftarItem'] = $this->retribusi_model->select_list_item($skrd_id)->result();
		$data['petugas'] 	= $this->retribusi_model->select_petugas($skrd_id)->row();
		$data['kadin'] 		= $this->retribusi_model->select_kadin()->row();

		$time 			= time();
		$filename 		= 'Surat_Tagihan_'.$time;
		$pdfFilePath 	= FCPATH."download/$filename.pdf";

		if (file_exists($pdfFilePath) == FALSE){
			ini_set('memory_limit','50M');
			$html = $this->load->view('admin/surat_tagihan_retribusi_pdf', $data, true);
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
/* Location: ./application/controller/admin/Retribusi.php */