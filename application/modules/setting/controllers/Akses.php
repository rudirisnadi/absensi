<?php
 
class Akses extends MX_Controller{
 
    function __construct(){
        parent::__construct();     
        $this->load->model('m_akses');

        if ( $this->session->userdata('status') != 'login' ) {
            redirect(base_url('index.php/login'));
        }
    }
 
    public function index(){
        $data['judul'] = 'Akses Menu Panel';

        $this->load->view('v_akses', $data);
    }

    public function get_modul(){
        $data = $this->m_akses->get_data_modul()->result();

        echo json_encode($data);
    }

    public function get_modul_child($id, $kt){
        $data = $this->m_akses->get_data_modul_child($id, $kt)->result();

        echo json_encode($data);
    }

    public function save_data(){

        $getMenu = $this->db->query('SELECT * FROM sett_menu');

        $data    = array();

        $this->db->trans_begin();

        $this->db->delete('sett_akss', array('idxx_role' => $this->input->post('idxx_role')));

        foreach ($getMenu->result() as $value) {

            $mnu = 'mnu_'.$value->idxx_menu;

            if( $this->input->post($mnu) == 'on' ){
                $data['idxx_role'] = $this->input->post('idxx_role');
                $data['idxx_menu'] = $value->idxx_menu;

                $this->db->insert('sett_akss', $data);
            }
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

}