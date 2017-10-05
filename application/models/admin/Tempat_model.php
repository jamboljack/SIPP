<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tempat_model extends CI_Model {
	var $table 			= 'sipp_tempat';
    var $column_order 	= array(null, 'tempat_kode', 'tempat_nama', 'tempat_kd_rek', null);
    var $column_search 	= array('tempat_nama', 'tempat_kd_rek');
    var $order 			= array('tempat_id' => 'asc');

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
		$this->db->from('sipp_tempat');
		$this->db->order_by('tempat_id','asc');
		
		return $this->db->get();
	}
	
	function insert_data() {
		$nama 	= strtoupper(trim($this->input->post('nama', 'true')));
		$kode 	= substr($nama, 0, 1);
		
		$data = array(
				'tempat_kode'			=> $kode,
				'tempat_nama'			=> $nama,
				'tempat_kd_rek'			=> $this->input->post('kd_rek', 'true'),
		   		'tempat_date_update' 	=> date('Y-m-d'),
		   		'tempat_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_tempat', $data);
	}	

	function update_data() {
		$tempat_id     = $this->input->post('id', 'true');

		$nama 	= strtoupper(trim($this->input->post('nama', 'true')));
		$kode 	= substr($nama, 0, 1);		
		
		$data = array(
				'tempat_kode'			=> $kode,
				'tempat_nama'			=> $nama,
				'tempat_kd_rek'			=> $this->input->post('kd_rek', 'true'),
		   		'tempat_date_update' 	=> date('Y-m-d'),
		   		'tempat_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('tempat_id', $tempat_id);
		$this->db->update('sipp_tempat', $data);
	}

	function delete_data($kode) {		
		$this->db->where('tempat_id', $kode);
		$this->db->delete('sipp_tempat');
	}
}
/* Location: ./application/model/admin/Tempat_model.php */