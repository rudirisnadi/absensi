<?php
 
class User extends MX_Controller{
 
    function __construct(){
        parent::__construct();
        $this->load->model('m_user');

        if ( $this->session->userdata('status') != 'login' ) {
            redirect(base_url('index.php/login'));
        }
    }
 
    public function index(){
        $data['judul'] = 'Karyawan';

        $this->load->view('v_user', $data);
    }

    public function list_data(){

        $list = $this->m_user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $val){
            $no++;

            $delete = '';
            if( $this->session->userdata('nama_role') == 'Administrator' ){
                $delete = '<a class="btn btn-xs btn-danger" style="height: 25px;" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$val->idxx_user."'".')"><i class="mdi mdi-delete-forever"></i></a>';
            }

            $row = array();
            $row[] = $no;
            $row[] = $val->user_name;
            $row[] = $val->nama_user;
            $row[] = $val->mail_user;
            $row[] = $val->telp_user;
            $row[] = $val->nama_role;

            $row[] = '<a class="btn btn-xs btn-warning" style="height: 25px;" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$val->idxx_user."'".')"><i class=" mdi mdi-account-edit-outline"></i></a>'.$delete;
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_user->count_all(),
                        "recordsFiltered" => $this->m_user->count_filtered(),
                        "data" => $data
                );

        echo json_encode($output);
    }

    public function edit_data($id){

        $data = $this->m_user->get_data($id);

        echo json_encode($data);
    }

    public function save_data(){

        $data = array();

        $dir_folder  = $_SERVER['DOCUMENT_ROOT'].'/absensi/upload/';
        $dir_folder2 = 'upload/';
        
        $imgx_user = '';
        if( !empty($_FILES['imgx_user']['name']) ){
            $file        = $_FILES[ 'imgx_user' ];
            $filename    = str_replace('#', '', $file[ 'name' ]);
            $tmp_name    = $file[ 'tmp_name' ];
            $url_photo   = $dir_folder;
            $upload      = move_uploaded_file( $tmp_name, $url_photo.time().'_'.$filename );
            $imgx_user   = $dir_folder2.time().'_'.$filename;

            chmod($dir_folder, 0777);
        }

        if( $imgx_user != '' ){
            $data['imgx_user'] = $imgx_user;
        }

        $data['user_name']  = $this->input->post('user_name');
        $data['nama_user']  = $this->input->post('nama_user');
        $data['mail_user']  = $this->input->post('mail_user');
        $data['telp_user']  = $this->input->post('telp_user');
        $data['idxx_role']  = $this->input->post('idxx_role');
        $data['imgx_user']  = $imgx_user;
        $data['idxx_webx']  = $this->input->post('idxx_webx');

        $this->db->trans_begin();

        if( $this->input->post('idxx_user') == '' ){
            $data['pass_word']  = md5($this->input->post('pass_word'));
            $this->db->insert('mstx_user', $data);
        }else{
            if( $this->input->post('pass_word') != '' ){
                $data['pass_word']  = md5($this->input->post('pass_word'));
            }
            $this->db->update('mstx_user', $data, array('idxx_user' => $this->input->post('idxx_user')));
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

    public function delete_data($id){
        $this->m_user->delete_by_id($id);

        echo json_encode(array("status" => TRUE));
    }

    public function get_role() {
        $limit = 20;
        $q     = $this->input->get('q');
        $start = (($this->input->get('page') - 1) * $limit);
        $data  = $this->m_user->get_data_role($q, $start, $limit);
        if (($this->input->get('page') == 1) & ($q == '')) {
            $pilih[] = array('id'=>'', 'nama' => '&nbsp;   ');
            $data['data'] = array_merge($pilih, $data['data']);
            $data['total'] += 1;
        }

        echo json_encode($data);
    }

    public function get_user() {
        $limit = 20;
        $q     = $this->input->get('q');
        $start = (($this->input->get('page') - 1) * $limit);
        $data  = $this->m_user->get_data_user($q, $start, $limit);
        if (($this->input->get('page') == 1) & ($q == '')) {
            $pilih[] = array('id'=>'', 'nama' => '&nbsp;   ');
            $data['data'] = array_merge($pilih, $data['data']);
            $data['total'] += 1;
        }

        echo json_encode($data);
    }

    public function get_modul() {
        $limit = 20;
        $q     = $this->input->get('q');
        $start = (($this->input->get('page') - 1) * $limit);
        $data  = $this->m_user->get_data_modul($q, $start, $limit);
        if (($this->input->get('page') == 1) & ($q == '')) {
            $pilih[] = array('id'=>'', 'nama' => '&nbsp;   ');
            $data['data'] = array_merge($pilih, $data['data']);
            $data['total'] += 1;
        }

        echo json_encode($data);
    }

    public function get_web() {
        $limit = 20;
        $q     = $this->input->get('q');
        $start = (($this->input->get('page') - 1) * $limit);
        $data  = $this->m_user->get_data_web($q, $start, $limit);
        if (($this->input->get('page') == 1) & ($q == '')) {
            $pilih[] = array('id'=>'', 'nama' => '&nbsp;   ');
            $data['data'] = array_merge($pilih, $data['data']);
            $data['total'] += 1;
        }

        echo json_encode($data);
    }

    public function save_data_image(){
        $dir_folder  = $_SERVER['DOCUMENT_ROOT'].'/perpustakaan/upload/';
        $dir_folder2 = 'upload/';
        $file        = $_FILES[ 'images' ];
        $filename    = str_replace('#', '', $file[ 'name' ]);
        $tmp_name    = $file[ 'tmp_name' ];
        $url_photo   = $dir_folder;
        $upload      = move_uploaded_file( $tmp_name, $url_photo.time().'_'.$filename );

        chmod($dir_folder, 0777);

        $param  = array(
            'path_image' => $dir_folder2.time().'_'.$filename
        );

        echo json_encode($param);
    }
}