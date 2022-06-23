<?php
 
class Gift extends MX_Controller{
 
    function __construct(){
        parent::__construct();
        $this->load->model('m_gift');

        if ( $this->session->userdata('status') != 'login' ) {
            redirect(base_url('index.php/login'));
        }
    }
 
    public function index(){
        $data['judul'] = 'Gift';

        $this->load->view('v_gift', $data);
    }

    public function list_data(){

        $list = $this->m_gift->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $val){
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $val->nama_gift;
            $row[] = $val->noxx_rekx;
            $row[] = $val->ketx_rekx;

            $row[] = '<a class="btn btn-xs btn-warning" style="height: 25px;" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$val->idxx_gift."'".')"><i class=" mdi mdi-account-edit-outline"></i></a>
                      <a class="btn btn-xs btn-danger" style="height: 25px;" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$val->idxx_gift."'".')"><i class="mdi mdi-delete-forever"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_gift->count_all(),
                        "recordsFiltered" => $this->m_gift->count_filtered(),
                        "data" => $data
                );

        echo json_encode($output);
    }

    public function edit_data($id){

        $data = $this->m_gift->get_data($id);

        echo json_encode($data);
    }

    public function save_data(){

        $data = array();
        $data['nama_gift']  = $this->input->post('nama_gift');
        $data['noxx_rekx']  = $this->input->post('noxx_rekx');
        $data['ketx_rekx']  = $this->input->post('ketx_rekx');
        $data['date_xxxx']  = date('Y-m-d H:i:s');

        $this->db->trans_begin();

        if( $this->input->post('idxx_gift') == '' ){
    
            $data['user_xxxx']  = $this->session->userdata('idxx_user');
    
            $this->db->insert('gift_wedd', $data);
    
        }else{
            $this->db->update('gift_wedd', $data, array('idxx_gift' => $this->input->post('idxx_gift')));
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
        $this->m_gift->delete_by_id($id);

        echo json_encode(array("status" => TRUE));
    }
}