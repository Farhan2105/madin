<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lembaga extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'form_validation'));
        $this->load->model('admin');
    }

    public function index()
    {
        $data['lembaga'] = $this->admin->get_all('lembaga');
        $data['title_head'] = "Daftar Lembaga";
        $sess_lev = $this->session->userdata('level');
        $data['sess_lev'] = $sess_lev;

        $this->template->admin('admin/daftar_lembaga_v', $data);
    }

    function add_lembaga()
    {
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('lembaga', 'Nama Lembaga', 'required|min_length[4]');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses insert
                $items = array(
                    'lembaga' => $this->input->post('lembaga', TRUE),

                );
                $this->admin->insert('lembaga', $items);
                $this->session->set_flashdata('alert', 'Data berhasil di simpan');
                redirect('lembaga');
            }
        }
        $data['lembaga'] = $this->input->post('lembaga', TRUE);

        $data['title_head'] = "Tambah Lembaga";

        $this->template->admin('admin/daftar_lembaga', $data);
    }

    function update_lembaga()
    {
        $id_lemb = $this->uri->segment(3);
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('lembaga', 'Nama Lembaga', 'required|min_length[4]');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses
                $items = array(
                    'lembaga' => $this->input->post('lembaga', TRUE),

                );
                $this->admin->update('lembaga', $items, array('id' => $id_lemb));
                $this->session->set_flashdata('alert', 'Data berhasil di perbarui');
                redirect('lembaga');
            }
        }

        $mapels = $this->admin->get_where('lembaga', array('id' => $id_lemb));

        foreach ($mapels->result() as $mel) {
            $data['lembaga'] = $mel->lembaga;
        }
        $data['title_head'] = "Update Data Lembaga";
        $this->template->admin('admin/daftar_lembaga', $data);
    }

    function delete_lembaga()
    {
        $id_lem = $this->uri->segment(3);
        $this->admin->_delete('lembaga', $id_lem);
        $this->session->set_flashdata('alert', 'Data berhasil di hapus');
        redirect('lembaga');
    }
}
