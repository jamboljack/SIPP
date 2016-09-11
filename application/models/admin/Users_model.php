<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
	function __construct() {
		parent::__construct();	
	}
		
	function select_all() {
		$this->db->select('*');
		$this->db->from('sipp_users');		
		$this->db->order_by('user_username','asc');
		
		return $this->db->get();
	}
	
	function insert_data() {
		if (!empty($_FILES['userfile']['name'])) {
			$data = array(    			
	    			'user_username' 		=> trim($this->input->post('username')),
	    			'user_password' 		=> sha1(trim($this->input->post('password'))),
	    			'user_name' 			=> strtoupper(trim($this->input->post('name'))),
	    			'user_address' 			=> strtoupper(trim($this->input->post('alamat'))),
	    			'user_phone' 			=> strtoupper(trim($this->input->post('telp'))),
	    			'user_level' 			=> trim($this->input->post('lstLevel')),
	    			'user_avatar' 			=> $this->upload->file_name,
	    			'user_date_update' 		=> date('Y-m-d'),
	    			'user_time_update' 		=> date('Y-m-d H:i:s')
				);
		} else {
			$data = array(    			
	    			'user_username' 		=> trim($this->input->post('username')),
	    			'user_password' 		=> sha1(trim($this->input->post('password'))),
	    			'user_name' 			=> strtoupper(trim($this->input->post('name'))),
	    			'user_address' 			=> strtoupper(trim($this->input->post('alamat'))),
	    			'user_phone' 			=> strtoupper(trim($this->input->post('telp'))),
	    			'user_level' 			=> trim($this->input->post('lstLevel')),
	    			'user_date_update' 		=> date('Y-m-d'),
	    			'user_time_update' 		=> date('Y-m-d H:i:s')  			
				);
		}
		
		$this->db->insert('sipp_users', $data);
	}
	
	function select_by_id($user_username) {
		$this->db->select('*');
		$this->db->from('sipp_users');		
		$this->db->where('user_username', $user_username);
		
		return $this->db->get();
	}

	function update_data() {
		$user_username  = $this->input->post('id');
		$password 		= trim($this->input->post('password'));

		if (!empty($password)) { // Jika Password Diisi / Change Password
			if (!empty($_FILES['userfile']['name'])) {
				$data = array(	    			
		    			'user_password' 		=> sha1(trim($this->input->post('password'))),
		    			'user_name' 			=> strtoupper(trim($this->input->post('name'))),
		    			'user_address' 			=> strtoupper(trim($this->input->post('alamat'))),
		    			'user_phone' 			=> strtoupper(trim($this->input->post('telp'))),
		    			'user_level' 			=> trim($this->input->post('lstLevel')),
		    			'user_avatar' 			=> $this->upload->file_name,
		    			'user_date_update' 		=> date('Y-m-d'),
		    			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
			} else {
				$data = array(	    			
		    			'user_password' 		=> sha1(trim($this->input->post('password'))),
		    			'user_name' 			=> strtoupper(trim($this->input->post('name'))),
		    			'user_address' 			=> strtoupper(trim($this->input->post('alamat'))),
		    			'user_phone' 			=> strtoupper(trim($this->input->post('telp'))),
		    			'user_level' 			=> trim($this->input->post('lstLevel')),		    			
		    			'user_date_update' 		=> date('Y-m-d'),
		    			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
			}
		} else {
			if (!empty($_FILES['userfile']['name'])) {
				$data = array(
		    			'user_name' 			=> strtoupper(trim($this->input->post('name'))),
		    			'user_address' 			=> strtoupper(trim($this->input->post('alamat'))),
		    			'user_phone' 			=> strtoupper(trim($this->input->post('telp'))),
		    			'user_level' 			=> trim($this->input->post('lstLevel')),
		    			'user_avatar' 			=> $this->upload->file_name,
		    			'user_date_update' 		=> date('Y-m-d'),
		    			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
			} else {
				$data = array(		    					    			
	    				'user_name' 			=> strtoupper(trim($this->input->post('name'))),
		    			'user_address' 			=> strtoupper(trim($this->input->post('alamat'))),
		    			'user_phone' 			=> strtoupper(trim($this->input->post('telp'))),
		    			'user_level' 			=> trim($this->input->post('lstLevel')),
		    			'user_date_update' 		=> date('Y-m-d'),
		    			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
			}
		}

		$this->db->where('user_username', $user_username);
		$this->db->update('sipp_users', $data);
	}	
}
/* Location: ./application/model/admin/Users_model.php */