<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coba extends CI_Controller
{

	public function index()
	{
		// $tgl = "01 July 2019";
		// $edate=strtotime($tgl); 
		// $tanggal=date("Y-m-d",$edate);

		// echo $tanggal;

		// echo $edate;
		// $this->load->model('admin');
		// $cek = $this->admin->get_where('d_hadir',['tanggal'=>$tanggal]);
		// if ($cek->num_rows()>0) {
		// 	echo $status = "TRUE";
		// }else{
		// 	echo $status = "FALSE";
		// }
		$this->load->view('coba_v');
	}
}

/* End of file Coba.php */
/* Location: .//C/Users/Harry/AppData/Local/Temp/fz3temp-2/Coba.php */
