<?php
 
class Group extends MX_Controller{
 
    function __construct(){
        parent::__construct();
        $this->load->model('m_group');

        if ( $this->session->userdata('status') != 'login' ) {
            redirect(base_url('index.php/login'));
        }
    }
 
    public function index(){
        $data['judul'] = 'Group Access';

        $this->load->view('v_group', $data);
    }

    public function list_data(){

        $list = $this->m_group->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $val){
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $val->nama_role;
            $row[] = $val->desc_role;

            $row[] = '<a class="btn btn-xs btn-warning" style="height: 25px;" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$val->idxx_role."'".')"><i class=" mdi mdi-account-edit-outline"></i></a>
                      <a class="btn btn-xs btn-danger" style="height: 25px;" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$val->idxx_role."'".')"><i class="mdi mdi-delete-forever"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_group->count_all(),
                        "recordsFiltered" => $this->m_group->count_filtered(),
                        "data" => $data
                );

        echo json_encode($output);
    }

    public function edit_data($id){

        $data = $this->m_group->get_data($id);

        echo json_encode($data);
    }

    public function save_data(){

        $data = array();
        $data['nama_role']  = $this->input->post('nama_role');
        $data['desc_role']  = $this->input->post('desc_role');

        $this->db->trans_begin();

        if( $this->input->post('idxx_role') == '' ){
            $this->db->insert('sett_role', $data);
        }else{
            $this->db->update('sett_role', $data, array('idxx_role' => $this->input->post('idxx_role')));
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
        $this->m_group->delete_by_id($id);

        echo json_encode(array("status" => TRUE));
    }
}