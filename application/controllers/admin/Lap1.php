<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap1 extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in_sipp')) redirect(base_url());
		$this->load->library('template');
		$this->load->model('admin/lap1_model');	
	}
	
	public function index(){
		if($this->session->userdata('logged_in_sipp')) {
			$data['tampil']		= 'tidak';
			$data['listPasar'] 	= $this->lap1_model->select_pasar()->result();
			$data['listTempat'] = $this->lap1_model->select_tempat()->result();
			$this->template->display('admin/lap1_view', $data);
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		} 
	}

	public function caridata() {
		$pasar_id	= trim($this->input->post('lstPasar'));
		$tempat_id 	= trim($this->input->post('lstTempat'));

		if ($tempat_id == 'all') { 
			$data = array(
				'Pasar' 	=> $pasar_id,
				'Tempat' 	=> 'all'
			);
		} else {
			$data = array(
				'Pasar' 	=> $pasar_id,
				'Tempat' 	=> $tempat_id
			);
		}

		$data['Report'] 	= $data;
		$data['tampil']		= 'ya';
		$data['listPasar'] 	= $this->lap1_model->select_pasar()->result();
		$data['listTempat'] = $this->lap1_model->select_tempat()->result();			
		$data['daftarlist'] = $this->lap1_model->select_by_criteria()->result();
		$this->template->display('admin/lap1_view', $data);
	}	
	
	public function preview($pasar_id = '', $tempat_id = '') {  
		$pasar_id 	= $this->uri->segment(4);
		$tempat_id 	= $this->uri->segment(5);

		if ($tempat_id == 'all') {
			$data['daftarlist'] = $this->lap1_model->select_by_criteria()->result();
			$this->load->view('admin/lap1_preview_all', $data);
		} else {
			$data['daftarlist'] = $this->lap1_model->select_by_criteria()->result();
			$this->load->view('admin/lap1_preview_by_id', $data);
		}
	}
	
	public function print_report() {
		$master 	= trim($this->uri->segment(4));

		switch ($master) {
		    case "blood":
		       	$data['daftarlist'] = $this->listmaster_model->select_blood()->result();
				$this->load->view('report/master/listmasterblood_report', $data);
		        break;
		    case "marriage":
		    	$data['daftarlist'] = $this->listmaster_model->select_marriage()->result();
				$this->load->view('report/master/listmastermarriage_report', $data);
		        break;
		    case "religion":
		        $data['daftarlist'] = $this->listmaster_model->select_religion()->result();
				$this->load->view('report/master/listmasterreligion_report', $data);
		        break;
			case "education":
		        $data['daftarlist'] = $this->listmaster_model->select_education()->result();
				$this->load->view('report/master/listmastereducation_report', $data);
		        break;
		    case "relation":
		        $data['daftarlist'] = $this->listmaster_model->select_relation()->result();
				$this->load->view('report/master/listmasterrelation_report', $data);
		        break;
		    case "status":
		        $data['daftarlist'] = $this->listmaster_model->select_status()->result();
				$this->load->view('report/master/listmasterstatus_report', $data);
		        break;
		    case "deparment":
		        $data['daftarlist'] = $this->listmaster_model->select_department()->result();
				$this->load->view('report/master/listmasterdepartment_report', $data);
		        break;
		    case "position":
		        $data['daftarlist'] = $this->listmaster_model->select_position()->result();
				$this->load->view('report/master/listmasterposition_report', $data);
		        break;
		    case "absent":
		        $data['daftarlist'] = $this->listmaster_model->select_absent()->result();
				$this->load->view('report/master/listmasterabsent_report', $data);
		        break;		       
		    default:
		       redirect(site_url('report/listmaster'));
		}
	}

	public function print_report_pdf() {
		$master 	= trim($this->uri->segment(4));

		$time = time();
		$filename = 'Report_PDF_'.$master.'_'.$time;
		$pdfFilePath = FCPATH."download/$filename.pdf";
			
		if (file_exists($pdfFilePath) == FALSE){
			ini_set('memory_limit','50M');

			switch ($master) {
			    case "blood":
			       	$data['daftarlist'] = $this->listmaster_model->select_blood()->result();
			       	$html = $this->load->view('report/master/listmasterblood_report_pdf', $data, true);
			        break;
			    case "marriage":
			    	$data['daftarlist'] = $this->listmaster_model->select_marriage()->result();
			    	$html = $this->load->view('report/master/listmastermarriage_report_pdf', $data, true);
			        break;
			    case "religion":
			        $data['daftarlist'] = $this->listmaster_model->select_religion()->result();
			        $html = $this->load->view('report/master/listmasterreligion_report_pdf', $data, true);
			        break;
				case "education":
			        $data['daftarlist'] = $this->listmaster_model->select_education()->result();
			        $html = $this->load->view('report/master/listmastereducation_report_pdf', $data, true);
			        break;
			    case "relation":
			        $data['daftarlist'] = $this->listmaster_model->select_relation()->result();
			        $html = $this->load->view('report/master/listmasterrelation_report_pdf', $data, true);
			        break;
			    case "status":
			        $data['daftarlist'] = $this->listmaster_model->select_status()->result();
			        $html = $this->load->view('report/master/listmasterstatus_report_pdf', $data, true);
			        break;
			    case "deparment":
			        $data['daftarlist'] = $this->listmaster_model->select_department()->result();
			        $html = $this->load->view('report/master/listmasterdepartment_report_pdf', $data, true);
			        break;
			    case "position":
			        $data['daftarlist'] = $this->listmaster_model->select_position()->result();
			        $html = $this->load->view('report/master/listmasterposition_report_pdf', $data, true);
			        break;
			    case "absent":
			        $data['daftarlist'] = $this->listmaster_model->select_absent()->result();
			        $html = $this->load->view('report/master/listmasterabsent_report_pdf', $data, true);
			        break;		       
			    default:
			       redirect(site_url('report/listmaster'));
			    }

			$this->load->library('pdf');
			$param = '"en-GB-x","A4-L","","",10,10,10,10,6,3'; // Landscape
			$pdf = $this->pdf->load($param);
			$pdf->SetHeader(''); 
			$pdf->SetFooter('');
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		redirect("download/$filename.pdf");			
	}	
}
/* Location: ./application/controllers/admin/Lap1.php */