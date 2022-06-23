<?php
 
class M_dashboard extends CI_Model{

    function get_menu( $idxx_role ){
        $sql = $this->db->query("SELECT
									a.idxx_mdul,
									a.nama_mdul,
									a.icon_mdul
								FROM
									sett_mdul a
								JOIN sett_menu b ON a.idxx_mdul = b.idxx_mdul
								JOIN sett_akss c ON b.idxx_menu = c.idxx_menu
								WHERE c.idxx_role = '".$idxx_role."'
								GROUP BY a.idxx_mdul
								ORDER BY a.posx_mdul ASC
							");
        return $sql;
    }

    function get_menu_child( $idxx_mdul, $idxx_role ){
    	$sql = $this->db->query("SELECT
									a.nama_menu, a.urlx_menu
								FROM
									sett_menu a
								JOIN sett_akss b ON a.idxx_menu = b.idxx_menu
								WHERE
									a.idxx_mdul = '".$idxx_mdul."'
								AND
									b.idxx_role = '".$idxx_role."'
								ORDER BY a.posx_menu ASC
							");

    	return $sql;
    }
}