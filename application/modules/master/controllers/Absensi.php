<?php
 
class Absensi extends MX_Controller{
 
    function __construct(){
        parent::__construct();
        $this->load->model('m_absensi');

        if ( $this->session->userdata('status') != 'login' ) {
            redirect(base_url('index.php/login'));
        }
    }
 
    public function index(){
        $data['judul'] = 'Absensi';

        $this->load->view('v_absensi', $data);
    }

    public function list_data(){

        $list = $this->m_absensi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $val){
            $no++;

            $date = date_create($val->tglx_absn);

            $row = array();
            $row[] = $no;
            $row[] = $val->nama_user;
            $row[] = date_format($date, "d-m-Y");
            $row[] = substr($val->jamx_msuk, 0, 5);
            $row[] = substr($val->jamx_klar, 0, 5);

            $row[] = '<a class="btn btn-xs btn-warning" style="height: 25px;" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$val->idxx_absn."'".')"><i class=" mdi mdi-account-edit-outline"></i></a>
                      <a class="btn btn-xs btn-danger" style="height: 25px;" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$val->idxx_absn."'".')"><i class="mdi mdi-delete-forever"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_absensi->count_all(),
                        "recordsFiltered" => $this->m_absensi->count_filtered(),
                        "data" => $data
                );

        echo json_encode($output);
    }

    public function edit_data($id){

        $data = $this->m_absensi->get_data($id);

        echo json_encode($data);
    }

    public function save_data(){

        $cek_data = $this->m_absensi->cek_data($this->input->post('idxx_user'), $this->input->post('tglx_absn'), $this->input->post('idxx_absn'));

        if( $cek_data > 0 ){
            $result['status'] = 'ada';
        }else{

            $tglSplit = explode('-', $this->input->post('tglx_absn'));

            $data = array();
            $data['idxx_user']  = $this->input->post('idxx_user');
            $data['tglx_absn']  = $tglSplit[2] . '-' . $tglSplit[1] . '-' . $tglSplit[0];
            $data['jamx_msuk']  = $this->input->post('jamx_msuk');
            $data['jamx_klar']  = $this->input->post('jamx_klar');
            $data['crtd_date']  = date('Y-m-d H:i:s');
            $data['auth_xxxx']  = $this->session->userdata('idxx_user');

            $this->db->trans_begin();

            if( $this->input->post('idxx_absn') == '' ){
                $this->db->insert('data_absn', $data);
            }else{
                $this->db->update('data_absn', $data, array('idxx_absn' => $this->input->post('idxx_absn')));
            }

            $this->db->trans_complete();

            if($this->db->trans_status() === FALSE){
                $result['status'] = FALSE;
                $this->db->trans_rollback();
            }else{
                $result['status'] = TRUE;
                $this->db->trans_commit();
            }
        }

        echo json_encode($result);
    }

    public function delete_data($id){
        $this->m_absensi->delete_by_id($id);

        echo json_encode(array("status" => TRUE));
    }

    public function get_user() {
        $limit = 20;
        $q     = $this->input->get('q');
        $start = (($this->input->get('page') - 1) * $limit);
        $data  = $this->m_absensi->get_data_user($q, $start, $limit);
        if (($this->input->get('page') == 1) & ($q == '')) {
            $pilih[] = array('id'=>'', 'nama' => '&nbsp;   ');
            $data['data'] = array_merge($pilih, $data['data']);
            $data['total'] += 1;
        }

        echo json_encode($data);
    }
}