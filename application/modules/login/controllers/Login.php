<?php
 
class Login extends MX_Controller{
 
    function __construct(){
        parent::__construct();     
        $this->load->model('m_login');
    }
 
    function index(){

        if ( $this->session->userdata('status') != 'login' ) {
            $this->session->sess_destroy();
            $this->load->view('v_login');
        }else{
            redirect(base_url("dashboard"));
        }
    }
 
    function aksi_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'user_name' => $username,
            'pass_word' => md5($password)
            );
        $cek   = $this->m_login->cek_login("mstx_user", $where)->num_rows();
        $datax = $this->m_login->get_user( $username, $password );
        $datay = array();
        if($cek > 0){
 
            $data_session = array(
                'idxx_user' => $datax->idxx_user,
                'nama_user' => $datax->nama_user,
                'telp_user' => $datax->telp_user,
                'idxx_role' => $datax->idxx_role,
                'nama_role' => $datax->nama_role,
	            'status'    => 'login'
            );
 
            $this->session->set_userdata($data_session);
 
            $location         = "dashboard";
        }else{
            $location         = "login";
            $datay["statusx"] = "username/ Password Salah !.";
        }

        $this->session->set_flashdata($datay);
        redirect(base_url($location));
    }
 
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}