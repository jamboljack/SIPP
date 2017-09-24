<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {
	
	function __construct() {
		parent::__construct();	
	}

	function select_detail() {
		$user_username = $this->session->userdata('username');
		$this->db->select('*');
		$this->db->from('sipp_users');
		$this->db->where('user_username', $user_username);
		
		return $this->db->get();
	}

	function update_data() {
		$user_username = $this->session->userdata('username');

		$data = array(
					'user_name' 		=> strtoupper(trim($this->input->post('nama', 'true'))),
	    			'user_address' 		=> strtoupper(trim($this->input->post('alamat', 'true'))),
	    			'user_phone' 		=> trim($this->input->post('telp', 'true')),
	    			'user_date_update' 	=> date('Y-m-d'),
		    		'user_time_update' 	=> date('Y-m-d H:i:s')
				);

		$this->db->where('user_username', $user_username);
		$this->db->update('sipp_users', $data);
	}

	function update_data_avatar() {
		$user_username  = trim($this->session->userdata('username'));		
		
		if (!empty($_FILES['userfile']['name'])) {
			$data = array(		   			
		   			'user_avatar' 			=> $this->upload->file_name,
		   			'user_date_update' 		=> date('Y-m-d'),
		   			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
		} else {
			$data = array(
		   			'user_date_update' 		=> date('Y-m-d'),
		   			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
		}		

		$this->db->where('user_username', $user_username);
		$this->db->update('sipp_users', $data);
	}

	function update_data_password() {
		$user_username  = trim($this->session->userdata('username'));		
		$password 		= trim($this->input->post('password', 'true'));
		
		if (!empty($password)) { // Jika Password Diisi / Change Password			
			$data = array(
		    		'user_password' 		=> sha1(trim($this->input->post('password', 'true'))),
		    		'user_date_update' 		=> date('Y-m-d'),
		    		'user_time_update' 		=> date('Y-m-d H:i:s')  			
				);
		} else {
			$data = array(
		   			'user_date_update' 		=> date('Y-m-d'),
		   			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
		}		

		$this->db->where('user_username', $user_username);
		$this->db->update('sipp_users', $data);
	}	
}
/* Location: ./application/model/admin/Account_model.php */
?>