<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jab_tunj extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'form_validation'));
        $this->load->model('admin');
    }

    public function index()
    {
        // $this->cek_login();
        // $data['lembaga'] = $this->admin->get_by_id('lembaga');
        $data['jabatan'] = $this->admin->get_all('jabatan');
        $data['title_head'] = "Daftar Jabatan";
        $sess_lev = $this->session->userdata('level');
        $data['sess_lev'] = $sess_lev;
        // $this->template->admin('admin/daftar_mapel', $data);
        // memanggil seluruh tabel jabatan dan lembaga
        // $nama = $this->admin->get_all('guru');
        // $data['nama'] = $nama;
        // $jam = $this->admin->get_all('jam_masuk');
        // $data['jam'] = $jam;
        // $hari = $this->admin->get_all('hari');
        // $data['hari'] = $hari;

        $this->template->admin('admin/jab_tunj_guru', $data);
    }

    function add_jab()
    {
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|min_length[4]');
            $this->form_validation->set_rules('tunjangan', 'Tunjangan', 'required');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses insert
                $items = array(
                    'jabatan' => $this->input->post('jabatan', TRUE),
                    'tunjangan' => $this->input->post('tunjangan', TRUE),

                );
                $this->admin->insert('jabatan', $items);
                $this->session->set_flashdata('alert', 'Data berhasil di simpan');
                redirect('jab_tunj');
            }
        }
        $data['jabatan'] = $this->input->post('jabatan', TRUE);
        $data['tunjangan'] = $this->input->post('tunjangan', TRUE);

        $data['title_head'] = "Tambah Jabatan";

        $this->template->admin('admin/jab_tunj_guru_v', $data);
    }

    function update_jab()
    {
        $id_jab = $this->uri->segment(3);
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|min_length[4]');
            $this->form_validation->set_rules('tunjangan', 'Tunjangan', 'required');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses
                $items = array(
                    'jabatan' => $this->input->post('jabatan', TRUE),
                    'tunjangan' => $this->input->post('tunjangan', TRUE),

                );
                $this->admin->update('jabatan', $items, array('id' => $id_jab));
                $this->session->set_flashdata('alert', 'Data berhasil di perbarui');
                redirect('jab_tunj');
            }
        }

        $jabtun = $this->admin->get_where('jabatan', array('id' => $id_jab));

        foreach ($jabtun->result() as $jt) {
            $data['jabatan'] = $jt->jabatan;
            $data['tunjangan'] = $jt->tunjangan;
        }
        $data['title_head'] = "Update Jabatan";
        $this->template->admin('admin/jab_tunj_guru_v', $data);
    }

    function delete_jab()
    {
        $id_tunnjab = $this->uri->segment(3);
        $this->admin->_delete('jabatan', $id_tunnjab);
        $this->session->set_flashdata('alert', 'Data berhasil di hapus');
        redirect('jab_tunj');
    }
}
