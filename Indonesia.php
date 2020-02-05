<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Indonesia extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Maaf';
		$this->load->view('admin/bendera', $data);
	}
}
