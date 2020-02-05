<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
        $data['kelas'] = $this->admin->get_all('kelas');
        $data['title_head'] = "Daftar Kelas";
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

        $this->template->admin('admin/daftar_kelas', $data);
    }

    function add_kelas()
    {
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('kelas', 'Tingkat Kelas', 'required|min_length[4]');
            $this->form_validation->set_rules('id_guru', 'Wali Kelas', 'required');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses insert
                $items = array(
                    'kelas' => $this->input->post('kelas', TRUE),
                    'id_guru' => $this->input->post('id_guru', TRUE),

                );
                $this->admin->insert('kelas', $items);
                $this->session->set_flashdata('alert', 'Data berhasil di simpan');
                redirect('kelas');
            }
        }
        $data['kelas'] = $this->input->post('kelas', TRUE);
        $data['id_guru'] = $this->input->post('id_guru', TRUE);

        $data['title_head'] = "Tambah Kelas";
        $guru = $this->admin->get_all('guru');
        $data['guru'] = $guru;
        $this->template->admin('admin/d_kelas', $data);
    }



    function update_kelas()
    {
        $id_kelas = $this->uri->segment(3);
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('kelas', 'Tingkat Kelas', 'required|min_length[4]');
            $this->form_validation->set_rules('id_guru', 'Wali Kelas', 'required');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses
                $items = array(
                    'kelas' => $this->input->post('kelas', TRUE),
                    'id_guru' => $this->input->post('id_guru', TRUE),

                );
                $this->admin->update('kelas', $items, array('id' => $id_kelas));
                $this->session->set_flashdata('alert', 'Data berhasil di perbarui');
                redirect('kelas');
            }
        }

        $kell = $this->admin->get_where('kelas', array('id' => $id_kelas));

        foreach ($kell->result() as $map) {
            $data['kelas'] = $map->kelas;
            $data['id_guru'] = $map->id_guru;
        }
        $data['title_head'] = "Update Data Kelas";

        $data['title_head'] = "Tambah Kelas";
        $guru = $this->admin->get_all('guru');
        $data['guru'] = $guru;

        $this->template->admin('admin/d_kelas', $data);
    }


    public function detail_k()
    {
        $kelass = $this->uri->segment(3);
        $nama_k = $this->admin->get_where('kelas', array('id' => $kelass));
        foreach ($nama_k->result() as $ui) {
            $namk['kelas'] = $ui->kelas;
            $namk['id_guru'] = $ui->id_guru;
        }
        $this->template->admin('admin/detail_kelas', $namk);
    }

    function delete_kelas()
    {
        $id_kelas = $this->uri->segment(3);
        $this->admin->_delete('kelas', $id_kelas);
        $this->session->set_flashdata('alert', 'Data berhasil di hapus');
        redirect('kelas');
    }
}
