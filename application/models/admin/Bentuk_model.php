<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bentuk_model extends CI_Model {
	var $table 			= 'sipp_bentuk';
    var $column_order 	= array(null, 'bentuk_nama', null);
    var $column_search 	= array('bentuk_nama');
    var $order 			= array('bentuk_nama' => 'asc');

	function __construct() {
		parent::__construct();	
	}

	private function _get_datatables_query() {
       	$this->db->from($this->table);

        $i = 0;
        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
         
        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

	function select_all() {
		$this->db->select('*');
		$this->db->from('sipp_bentuk');
		$this->db->order_by('bentuk_id','asc');
		
		return $this->db->get();
	}
	
	function insert_data() {		
		$data = array(
				'bentuk_nama'			=> strtoupper(trim($this->input->post('nama'))),
		   		'bentuk_date_update' 	=> date('Y-m-d'),
		   		'bentuk_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_bentuk', $data);
	}	

	function update_data() {
		$bentuk_id     = $this->input->post('id');
		
		$data = array(
				'bentuk_nama'			=> strtoupper(trim($this->input->post('nama'))),
		   		'bentuk_date_update' 	=> date('Y-m-d'),
		   		'bentuk_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('bentuk_id', $bentuk_id);
		$this->db->update('sipp_bentuk', $data);
	}

	function delete_data($kode) {		
		$this->db->where('bentuk_id', $kode);
		$this->db->delete('sipp_bentuk');
	}
}
/* Location: ./application/model/admin/Bentuk_model.php */