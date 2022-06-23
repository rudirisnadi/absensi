<?php

class M_user extends CI_Model {

	var $table 			= 'mstx_user';
	var $column_order 	= array(null, 'user_name', 'nama_user', 'mail_user', 'telp_user', 'nama_role', null);
	var $column_search 	= array('user_name', 'nama_user', 'mail_user', 'telp_user', 'nama_role');
	var $order 			= array('idxx_user' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query(){
		
		$this->db->select('a.idxx_user, a.user_name, a.nama_user, a.mail_user, a.telp_user, a.idxx_role, b.nama_role');
		$this->db->from($this->table . ' a');
		$this->db->join('sett_role b', 'a.idxx_role = b.idxx_role');
	
		if( $this->session->userdata('nama_role') != 'Administrator' ){
			$this->db->where('a.idxx_user', $this->session->userdata('idxx_user'));
		}

		$i = 0;
	
		foreach ($this->column_search as $item){
			if($_POST['search']['value']){
				
				if($i===0){
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}else{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i){
					$this->db->group_end();
				}
			}
			$i++;
		}
		
		if(isset($_POST['order'])){
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables(){
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered(){
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all(){
		$this->_get_datatables_query();
		$query = $this->db;
		return $query->count_all_results();
	}

	public function get_data($id){
		
		$this->db->select('a.idxx_user, a.user_name, a.nama_user, a.mail_user, a.telp_user, a.idxx_role, b.nama_role, a.imgx_user');
		$this->db->from($this->table . ' a');
		$this->db->join('sett_role b', 'a.idxx_role = b.idxx_role');
		$this->db->where('a.idxx_user', $id);

		$query = $this->db->get();

		return $query->row();
	}

	public function delete_by_id($id){
		$this->db->where('idxx_user', $id);
		$this->db->delete($this->table);
	}

	function get_data_role($search, $start, $limit) {

		$select  = "select idxx_role as id, nama_role AS nama ";
		$counter = "select count(*) as count ";
		$sql     = " from sett_role where nama_role like '%".$search."%'";
		$order   = " order by idxx_role";

		$limitation    = " limit $start, $limit";
		$data['data']  = $this->db->query($select . $sql . $order . $limitation)->result();
		$data['total'] = $this->db->query($counter . $sql)->row()->count;

		return $data;	
	}

	function get_data_user($search, $start, $limit) {

		$select  = "select a.idxx_user as id, a.nama_user AS nama, b.nama_role ";
		$counter = "select count(*) as count ";
		$sql     = " from mstx_user a join sett_role b on a.idxx_role = b.idxx_role where a.nama_user like '%".$search."%'";
		$order   = " order by a.nama_user";

		$limitation    = " limit $start, $limit";
		$data['data']  = $this->db->query($select . $sql . $order . $limitation)->result();
		$data['total'] = $this->db->query($counter . $sql)->row()->count;

		return $data;	
	}

	function get_data_modul($search, $start, $limit) {

		$select  = "select idxx_mdul as id, nama_mdul AS nama ";
		$counter = "select count(*) as count ";
		$sql     = " from sett_mdul where nama_mdul like '%".$search."%'";
		$order   = " order by posx_mdul";

		$limitation    = " limit $start, $limit";
		$data['data']  = $this->db->query($select . $sql . $order . $limitation)->result();
		$data['total'] = $this->db->query($counter . $sql)->row()->count;

		return $data;	
	}
}
