<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_priode extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'form_validation'));
        $this->load->model('admin');
    }

    public function index()
    {
        $data['tahun'] = $this->admin->get_all('priode');
        $data['title_head'] = "Daftar Tahun Priode";
        $sess_lev = $this->session->userdata('level');
        $data['sess_lev'] = $sess_lev;

        $this->template->admin('admin/daftar_priode_v', $data);
    }

    function add_priode()
    {
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('tahun', 'Tahun Priode', 'required|min_length[4]');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');

            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses insert
                $items = array(
                    'tahun' => $this->input->post('tahun', TRUE),

                );
                $this->admin->insert('priode', $items);
                $this->session->set_flashdata('alert', 'Data berhasil di simpan');
                redirect('c_priode');
            }
        }
        $data['tahun'] = $this->input->post('priode', TRUE);

        $data['title_head'] = "Tambah Priode";

        $this->template->admin('admin/daftar_priode', $data);
    }

    function update_priode()
    {
        $id_prd = $this->uri->segment(3);
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('tahun', 'Tahun Status', 'required|min_length[4]');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');

            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses
                $items = array(
                    'tahun' => $this->input->post('tahun', TRUE),

                );
                $this->admin->update('priode', $items, array('id' => $id_prd));
                $this->session->set_flashdata('alert', 'Data berhasil di perbarui');
                redirect('c_priode');
            }
        }

        $ket_prd = $this->admin->get_where('priode', array('id' => $id_prd));

        foreach ($ket_prd->result() as $pd) {
            $data['tahun'] = $pd->tahun;
        }
        $data['title_head'] = "Update Tahun Priode";
        $this->template->admin('admin/daftar_priode', $data);
    }

    function delete_priode()
    {
        $id_prd = $this->uri->segment(3);
        $this->admin->_delete('priode', $id_prd);
        $this->session->set_flashdata('alert', 'Data berhasil di hapus');
        redirect('c_priode');
    }
}
