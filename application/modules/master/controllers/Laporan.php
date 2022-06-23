<?php
 
class Laporan extends MX_Controller{
 
    function __construct(){
        parent::__construct();     
        $this->load->model('m_laporan');

        if ( $this->session->userdata('status') != 'login' ) {
            redirect(base_url('index.php/login'));
        }
    }
 
    public function index(){
        $data['judul'] = 'Laporan Kehadiran';

        $this->load->view('v_laporan', $data);
    }

    public function get_data(){
        $data = $this->m_laporan->get_data_kehadiran();

        echo json_encode($data);
    }

}