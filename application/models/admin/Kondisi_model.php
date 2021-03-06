<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kondisi_model extends CI_Model {
	var $table 			= 'sipp_kondisi';
    var $column_order 	= array(null, 'kondisi_nama', null);
    var $column_search 	= array('kondisi_nama');
    var $order 			= array('kondisi_nama' => 'asc');

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
		$this->db->from('sipp_kondisi');
		$this->db->order_by('kondisi_id','asc');
		
		return $this->db->get();
	}
	
	function insert_data() {		
		$data = array(
				'kondisi_nama'			=> strtoupper(trim($this->input->post('nama', 'true'))),
		   		'kondisi_date_update' 	=> date('Y-m-d'),
		   		'kondisi_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_kondisi', $data);
	}	

	function update_data() {
		$kondisi_id     = $this->input->post('id', 'true');
		
		$data = array(
				'kondisi_nama'			=> strtoupper(trim($this->input->post('nama', 'true'))),
		   		'kondisi_date_update' 	=> date('Y-m-d'),
		   		'kondisi_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('kondisi_id', $kondisi_id);
		$this->db->update('sipp_kondisi', $data);
	}

	function delete_data($kode) {		
		$this->db->where('kondisi_id', $kode);
		$this->db->delete('sipp_kondisi');
	}
}
/* Location: ./application/model/admin/Kondisi_model.php */