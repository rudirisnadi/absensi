<?php

class M_menu extends CI_Model {

	var $table = 'mxxx_user';
	var $column_order = array(null,'kode_user', 'kode_tpsx',null);
	var $column_search = array('kode_user', 'kode_tpsx');
	var $order = array('kode_user' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_data_modul(){
		$data = $this->db->query("SELECT * FROM sett_mdul ORDER BY posx_mdul ASC");

		return $data;
	}

	public function get_data_modul_child($id){
		$data = $this->db->query("SELECT a.idxx_menu, a.nama_menu, IFNULL(b.idxx_accs,0) AS idxx FROM sett_menu a LEFT JOIN
								sett_akss b ON a.idxx_menu = b.idxx_menu WHERE a.idxx_mdul = '".$id."' GROUP BY a.nama_menu ORDER BY a.posx_menu ASC");

		return $data;
	}

	public function edit_data_modul($id){
		
		$this->db->select('*');
		$this->db->from('sett_mdul');
		$this->db->where('idxx_mdul', $id);

		$query = $this->db->get();

		return $query->row();
	}

	public function edit_data_menu($id){
		
		$this->db->select('a.*, b.nama_mdul');
		$this->db->from('sett_menu a');
		$this->db->join('sett_mdul b', 'a.idxx_mdul = b.idxx_mdul');
		$this->db->where('idxx_menu', $id);

		$query = $this->db->get();

		return $query->row();
	}
}