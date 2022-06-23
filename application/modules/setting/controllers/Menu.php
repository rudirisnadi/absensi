<?php
 
class Menu extends MX_Controller{
 
    function __construct(){
        parent::__construct();     
        $this->load->model('m_menu');

        if ( $this->session->userdata('status') != 'login' ) {
            redirect(base_url('index.php/login'));
        }
    }
 
    public function index(){
        $data['judul'] = 'Menu Panel';

        $this->load->view('v_menu', $data);
    }

    public function get_modul(){
        $data = $this->m_menu->get_data_modul()->result();

        echo json_encode($data);
    }

    public function get_modul_child($id){
        $data = $this->m_menu->get_data_modul_child($id)->result();

        echo json_encode($data);
    }

    public function save_data_modul(){

        $data = array();
        $data['nama_mdul']  = $this->input->post('nama_mdul');
        $data['icon_mdul']  = $this->input->post('icon_mdul');
        $data['posx_mdul']  = $this->input->post('posx_mdul');

        $this->db->trans_begin();

        if( $this->input->post('idxx_mdul') == '' ){
            $this->db->insert('sett_mdul', $data);
        }else{
            $this->db->update('sett_mdul', $data, array('idxx_mdul' => $this->input->post('idxx_mdul')));
        }

        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $result['status'] = FALSE;
            $this->db->trans_rollback();
        }else{
            $result['status'] = TRUE;
            $this->db->trans_commit();
        }

        echo json_encode($result);
    }

    public function save_data_menu(){

        $data = array();
        $data['nama_menu']  = $this->input->post('nama_menu');
        $data['idxx_mdul']  = $this->input->post('idxx_mdul_accs');
        $data['urlx_menu']  = $this->input->post('urlx_menu');
        $data['posx_menu']  = $this->input->post('posx_menu');

        $this->db->trans_begin();

        if( $this->input->post('idxx_menu') == '' ){
            $this->db->insert('sett_menu', $data);
        }else{
            $this->db->update('sett_menu', $data, array('idxx_menu' => $this->input->post('idxx_menu')));
        }

        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $result['status'] = FALSE;
            $this->db->trans_rollback();
        }else{
            $result['status'] = TRUE;
            $this->db->trans_commit();
        }

        echo json_encode($result);
    }

    public function delete_data_modul($id){
        
        $this->db->where('idxx_mdul', $id);
        $this->db->delete('sett_mdul');

        echo json_encode(array("status" => TRUE));
    }

    public function delete_data_menu($id){
        
        $this->db->where('idxx_menu', $id);
        $this->db->delete('sett_menu');

        echo json_encode(array("status" => TRUE));
    }

    public function edit_data_modul($id){

        $data = $this->m_menu->edit_data_modul($id);

        echo json_encode($data);
    }

    public function edit_data_menu($id){

        $data = $this->m_menu->edit_data_menu($id);

        echo json_encode($data);
    }

}