<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_status extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'form_validation'));
        $this->load->model('admin');
    }

    public function index()
    {
        $data['s_status'] = $this->admin->get_all('status');
        $data['title_head'] = "Daftar Status";
        $sess_lev = $this->session->userdata('level');
        $data['sess_lev'] = $sess_lev;

        $this->template->admin('admin/daftar_status_v', $data);
    }

    function add_status()
    {
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('s_status', 'Nama Status', 'required');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses insert
                $items = array(
                    's_status' => $this->input->post('s_status', TRUE),

                );
                $this->admin->insert('status', $items);
                $this->session->set_flashdata('alert', 'Data berhasil di simpan');
                redirect('c_status');
            }
        }
        $data['s_status'] = $this->input->post('status', TRUE);

        $data['title_head'] = "Tambah Status";

        $this->template->admin('admin/daftar_status', $data);
    }

    function update_status()
    {
        $id_sts = $this->uri->segment(3);
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('s_status', 'Nama Status', 'required');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses
                $items = array(
                    's_status' => $this->input->post('s_status', TRUE),

                );
                $this->admin->update('status', $items, array('id' => $id_sts));
                $this->session->set_flashdata('alert', 'Data berhasil di perbarui');
                redirect('c_status');
            }
        }

        $statuss = $this->admin->get_where('status', array('id' => $id_sts));

        foreach ($statuss->result() as $st) {
            $data['s_status'] = $st->s_status;
        }
        $data['title_head'] = "Update Data Status";
        $this->template->admin('admin/daftar_status', $data);
    }

    function delete_status()
    {
        $id_sts = $this->uri->segment(3);
        $this->admin->_delete('status', $id_sts);
        $this->session->set_flashdata('alert', 'Data berhasil di hapus');
        redirect('c_status');
    }
}
