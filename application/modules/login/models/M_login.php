<?php
 
class M_login extends CI_Model{

    function cek_login($table, $where){
        return $this->db->get_where($table, $where);
    }

    function get_user($username, $password){
        $sql = $this->db->query("SELECT a.*, b.nama_role FROM mstx_user a JOIN sett_role b ON a.idxx_role = b.idxx_role WHERE a.user_name ='".$username."' AND a.pass_word ='".md5($password)."'")->row();

        return $sql;
    }
}