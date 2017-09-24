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
	    			'user_username' 		=> trim($this->input->post('username', 'true')),
	    			'user_password' 		=> sha1(trim($this->input->post('password', 'true'))),
	    			'user_name' 			=> strtoupper(trim($this->input->post('name', 'true'))),
	    			'user_address' 			=> strtoupper(trim($this->input->post('alamat', 'true'))),
	    			'user_phone' 			=> strtoupper(trim($this->input->post('telp', 'true'))),
	    			'user_level' 			=> trim($this->input->post('lstLevel', 'true')),
	    			'user_avatar' 			=> $this->upload->file_name,
	    			'user_date_update' 		=> date('Y-m-d'),
	    			'user_time_update' 		=> date('Y-m-d H:i:s')
				);
		} else {
			$data = array(    			
	    			'user_username' 		=> trim($this->input->post('username', 'true')),
	    			'user_password' 		=> sha1(trim($this->input->post('password', 'true'))),
	    			'user_name' 			=> strtoupper(trim($this->input->post('name', 'true'))),
	    			'user_address' 			=> strtoupper(trim($this->input->post('alamat', 'true'))),
	    			'user_phone' 			=> strtoupper(trim($this->input->post('telp', 'true'))),
	    			'user_level' 			=> trim($this->input->post('lstLevel', 'true')),
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
		$user_username  = $this->input->post('id', 'true');
		$password 		= trim($this->input->post('password', 'true'));

		if (!empty($password)) { // Jika Password Diisi / Change Password
			if (!empty($_FILES['userfile']['name'])) {
				$data = array(	    			
		    			'user_password' 		=> sha1(trim($this->input->post('password', 'true'))),
		    			'user_name' 			=> strtoupper(trim($this->input->post('name', 'true'))),
		    			'user_address' 			=> strtoupper(trim($this->input->post('alamat', 'true'))),
		    			'user_phone' 			=> strtoupper(trim($this->input->post('telp', 'true'))),
		    			'user_level' 			=> trim($this->input->post('lstLevel', 'true')),
		    			'user_avatar' 			=> $this->upload->file_name,
		    			'user_date_update' 		=> date('Y-m-d'),
		    			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
			} else {
				$data = array(	    			
		    			'user_password' 		=> sha1(trim($this->input->post('password', 'true'))),
		    			'user_name' 			=> strtoupper(trim($this->input->post('name', 'true'))),
		    			'user_address' 			=> strtoupper(trim($this->input->post('alamat', 'true'))),
		    			'user_phone' 			=> strtoupper(trim($this->input->post('telp', 'true'))),
		    			'user_level' 			=> trim($this->input->post('lstLevel', 'true')),
		    			'user_date_update' 		=> date('Y-m-d'),
		    			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
			}
		} else {
			if (!empty($_FILES['userfile']['name'])) {
				$data = array(
		    			'user_name' 			=> strtoupper(trim($this->input->post('name', 'true'))),
		    			'user_address' 			=> strtoupper(trim($this->input->post('alamat', 'true'))),
		    			'user_phone' 			=> strtoupper(trim($this->input->post('telp', 'true'))),
		    			'user_level' 			=> trim($this->input->post('lstLevel', 'true')),
		    			'user_avatar' 			=> $this->upload->file_name,
		    			'user_date_update' 		=> date('Y-m-d'),
		    			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
			} else {
				$data = array(		    					    			
	    				'user_name' 			=> strtoupper(trim($this->input->post('name', 'true'))),
		    			'user_address' 			=> strtoupper(trim($this->input->post('alamat', 'true'))),
		    			'user_phone' 			=> strtoupper(trim($this->input->post('telp', 'true'))),
		    			'user_level' 			=> trim($this->input->post('lstLevel', 'true')),
		    			'user_date_update' 		=> date('Y-m-d'),
		    			'user_time_update' 		=> date('Y-m-d H:i:s')
					);
			}
		}

		$this->db->where('user_username', $user_username);
		$this->db->update('sipp_users', $data);
	}

	function select_akses($user_username) {
		$this->db->select('a.*, p.pasar_nama');
		$this->db->from('sipp_akses a');
		$this->db->join('sipp_pasar p', 'a.pasar_id = p.pasar_id');
		$this->db->where('a.user_username', $user_username);
		$this->db->order_by('a.pasar_id', 'asc');
		
		return $this->db->get();
	}

	function select_pasar() {
		$this->db->select('*');
		$this->db->from('sipp_pasar');
		$this->db->order_by('pasar_nama', 'asc');
		
		return $this->db->get();
	}

	function insert_data_akses() {
		$data = array(		
	    		'user_username' 	=> trim($this->uri->segment(4)),
	    		'pasar_id' 			=> trim($this->input->post('lstPasar', 'true'))
			);
		
		$this->db->insert('sipp_akses', $data);
	}

	function delete_data_akses($kode) {
		$this->db->where('akses_id', $kode);
		$this->db->delete('sipp_akses');
	}
}
/* Location: ./application/model/admin/Users_model.php */