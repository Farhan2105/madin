<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
    }

    public function index()
    {

        if ($this->input->post('submit') == 'Submit') {
            $user = $this->input->post('username', TRUE);
            $pass = $this->input->post('password', TRUE);

            $cek = $this->admin->get_where('guru', array('username' => $user));

            if ($cek->num_rows() > 0) {
                $data = $cek->row();

                if (password_verify($pass, $data->password)) {
                    $datauser = array(
                        'id_pengguna' => $data->id,
                        'username' => $data->username,
                        'nama' => $data->nama,
                        'gambar' => $data->gambar,
                        'level' => $data->id_level,
                        'login' => TRUE
                    );

                    $this->session->set_userdata($datauser);
                    redirect('administrator');
                } else {
                    $this->session->set_flashdata('alert', "Password yang anda masukkan salah");
                }
            } else {
                $this->session->set_flashdata('alert', "user name dan password belum terdaftar");
            }
        }
        $session = $this->session->userdata('login');
        if ($session == TRUE) {
            redirect('administrator');
        }
        $this->load->view('admin/login_form');
    }
    public function logout()
    {
        $this->session->sess_destroy();

        redirect('login');
    }
}
