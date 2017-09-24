<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jenis_model extends CI_Model {
	var $table 			= 'sipp_jenis';
    var $column_order 	= array(null, 'jenis_kode', 'jenis_nama', null);
    var $column_search 	= array('jenis_kode', 'jenis_nama');
    var $order 			= array('jenis_kode' => 'asc');

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
		$this->db->from('sipp_jenis');
		$this->db->order_by('jenis_id','asc');
		
		return $this->db->get();
	}
	
	function getkodeunik() {
		$this->db->select('RIGHT(jenis_kode, 2) as kode', FALSE);
		$this->db->order_by('jenis_kode', 'desc');
		$this->db->limit(1);

		$query = $this->db->get('sipp_jenis');

		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$kodejadi = str_pad($kode, 2, "0", STR_PAD_LEFT);
		return $kodejadi;
   	}

	function insert_data() {
		// Kode Jenis
		$Kode_Jenis 	= $this->jenis_model->getkodeunik();		

		$data = array(
				'jenis_kode'			=> $Kode_Jenis,
				'jenis_nama'			=> strtoupper(trim($this->input->post('nama', 'true'))),
		   		'jenis_date_update' 	=> date('Y-m-d'),
		   		'jenis_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('sipp_jenis', $data);		
	}	

	function update_data() {
		$jenis_id     = $this->input->post('id', 'true');
		
		$data = array(
				'jenis_nama'			=> strtoupper(trim($this->input->post('nama', 'true'))),				
		   		'jenis_date_update' 	=> date('Y-m-d'),
		   		'jenis_time_update' 	=> date('Y-m-d H:i:s')
		);

		$this->db->where('jenis_id', $jenis_id);
		$this->db->update('sipp_jenis', $data);
	}

	function delete_data($kode) {		
		$this->db->where('jenis_id', $kode);
		$this->db->delete('sipp_jenis');
	}
}
/* Location: ./application/model/admin/Jenis_model.php */