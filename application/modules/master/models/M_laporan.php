<?php

class M_laporan extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_data_kehadiran(){

		$bulanini = $this->input->post('tahun') . '-' . $this->input->post('bulan') . '-01';
		$bulanend = date("Y-m-t", strtotime($bulanini));
		
		$start_date = date_create($bulanini);
		$end_date   = date_create($bulanend);

		$interval = DateInterval::createFromDateString('1 day');
		$daterange = new DatePeriod($start_date, $interval ,$end_date);

		$array_result = [];
		foreach($daterange as $date1){
            $array_result[] = $this->cek_kehadiran($date1->format('Y-m-d'));
		}

        $array_result[] = $this->cek_kehadiran($bulanend);

        return $array_result;
	}

	public function cek_kehadiran($tgl){
		$sql = $this->db->query("SELECT * FROM data_absn WHERE idxx_user = '".$this->input->post('idxx_user')."' AND tglx_absn = '".$tgl."'")->row();

		return $sql;
	}
}