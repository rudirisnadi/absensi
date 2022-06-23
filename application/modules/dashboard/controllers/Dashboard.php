<?php
 
class Dashboard extends MX_Controller{
 
    function __construct(){
        parent::__construct();     
        $this->load->model('m_dashboard');

        if ( $this->session->userdata('status') != 'login' ) {
            redirect(base_url('login'));
        }
    }

    function cek_session(){
        echo $this->session->userdata('status');
    }
 
    function index(){

        $data['judul']      = 'Home';
        $data['content']    = 'v_dashboard_isi';
        $data['data_menu']  = $this->m_dashboard->get_menu( $this->session->userdata('idxx_role') );

        $this->load->view('v_dashboard', $data);
    }
}