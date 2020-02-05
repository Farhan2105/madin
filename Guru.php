<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
    }

    public function index()
    {
        $this->cek_login();
        $this->load->view('guru/guru_v');
    }
    public function edit_profil()
    {
        // $this->cek_login();
        $get = $this->admin->get_where('guru', array('username' => $this->session->userdata('admin')))->row();
        $data['username'] = $get->username;
        $data['password'] = $get->password;
        $this->template->admin('admin/edit_profil');
    }
    function cek_login()
    {
        $sess = $this->session->userdata('level');
        if ($sess != 3) {
            redirect('login');
            // echo $sess;
            // die();
        }
    }
}
