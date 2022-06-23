<?php

class M_absensi extends CI_Model {

	var $table 			= 'data_absn';
	var $column_order 	= array(null, 'nama_user', 'tglx_absn', 'jamx_msuk', 'jamx_klar', null);
	var $column_search 	= array('nama_user', 'tglx_absn', 'jamx_msuk', 'jamx_klar');
	var $order 			= array('idxx_absn' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query(){
		
		$this->db->select('a.*, b.nama_user');
		$this->db->from($this->table . ' a');
		$this->db->join('mstx_user b', 'a.idxx_user = b.idxx_user');

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
		
		$this->db->select('a.*, b.nama_user');
		$this->db->from($this->table . ' a');
		$this->db->join('mstx_user b', 'a.idxx_user = b.idxx_user');
		$this->db->where('a.idxx_absn', $id);

		$query = $this->db->get();

		return $query->row();
	}

	public function delete_by_id($id){
		$this->db->where('idxx_absn', $id);
		$this->db->delete($this->table);
	}

	function get_data_user($search, $start, $limit) {

		$select  = "select idxx_user as id, nama_user AS nama ";
		$counter = "select count(*) as count ";

		if( $this->session->userdata('nama_role') == 'Administrator' ){
			$sql = " from mstx_user where idxx_role = 9 and nama_user like '%".$search."%'";
		}else{
			$sql = " from mstx_user where idxx_role = 9 and idxx_user = '".$this->session->userdata('idxx_user')."' and nama_user like '%".$search."%'";
		}
		
		$order   = " order by nama_user";

		$limitation    = " limit $start, $limit";
		$data['data']  = $this->db->query($select . $sql . $order . $limitation)->result();
		$data['total'] = $this->db->query($counter . $sql)->row()->count;

		return $data;	
	}

	function cek_data($idxx_user, $tglx_absn, $idxx_absn){
        $tglSplit  = explode('-', $tglx_absn);
        $tglx_absn = $tglSplit[2] . '-' . $tglSplit[1] . '-' . $tglSplit[0];

		$sql = $this->db->query("SELECT COUNT(*) AS total FROM data_absn WHERE idxx_user = '".$idxx_user."' AND tglx_absn = '".$tglx_absn."' AND idxx_absn != '".$idxx_absn."'")->row();

		return $sql->total;
	}
}
