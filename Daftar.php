<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
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
        $data['mapel'] = $this->admin->get_all('mapel');
        $data['title_head'] = "Daftar Mapel";
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

        $this->template->admin('admin/daftar_mapel', $data);
    }

    function add_mapel()
    {
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('mapel', 'Nama Mapel', 'required|min_length[4]');
            $this->form_validation->set_rules('kitab', 'Nama Kitab', 'required|min_length[4]');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses insert
                $items = array(
                    'mapel' => $this->input->post('mapel', TRUE),
                    'kitab' => $this->input->post('kitab', TRUE),

                );
                $this->admin->insert('mapel', $items);
                $this->session->set_flashdata('alert', 'Data berhasil di simpan');
                redirect('daftar');
            }
        }
        $data['mapel'] = $this->input->post('mapel', TRUE);
        $data['kitab'] = $this->input->post('kitab', TRUE);

        $data['title_head'] = "Tambah Mapel";

        $this->template->admin('admin/d_mapel_t', $data);
    }

    function update_mapel()
    {
        $id_mapel = $this->uri->segment(3);
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('mapel', 'Nama Mapel', 'required|min_length[4]');
            $this->form_validation->set_rules('kitab', 'Nama Kitab', 'required|min_length[4]');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses
                $items = array(
                    'mapel' => $this->input->post('mapel', TRUE),
                    'kitab' => $this->input->post('kitab', TRUE),

                );
                $this->admin->update('mapel', $items, array('id' => $id_mapel));
                $this->session->set_flashdata('alert', 'Data berhasil di perbarui');
                redirect('daftar');
            }
        }

        $mapels = $this->admin->get_where('mapel', array('id' => $id_mapel));

        foreach ($mapels->result() as $map) {
            $data['mapel'] = $map->mapel;
            $data['kitab'] = $map->kitab;
        }
        $data['title_head'] = "Update Data Kitab";
        $this->template->admin('admin/d_mapel_t', $data);
    }

    public function detail()
    {
        $mapell = $this->uri->segment(3);
        $kitab = $this->admin->get_where('mapel', array('id' => $mapell));
        foreach ($kitab->result() as $ui) {
            $batik['mapel'] = $ui->mapel;
            $batik['kitab'] = $ui->kitab;
        }
        $this->template->admin('admin/detail_kitab', $batik);
    }

    function delete_mapel()
    {
        $id_mapel = $this->uri->segment(3);
        $this->admin->_delete('mapel', $id_mapel);
        $this->session->set_flashdata('alert', 'Data berhasil di hapus');
        redirect('daftar');
    }
}
