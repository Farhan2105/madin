<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jam_masuk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'form_validation'));
        $this->load->model('admin');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        // $this->cek_login();
        // $data['lembaga'] = $this->admin->get_by_id('lembaga');
        $data['jam'] = $this->admin->get_all('jam_masuk');
        $data['title_head'] = "Daftar Jam Mata Pelajaran";
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
        

        $this->template->admin('admin/jam_mapel_v', $data);
    }

    function add_jam()
    {
        
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('jam', 'Jam', 'required');
            $this->form_validation->set_rules('label', 'Label', 'required|min_length[4]');
            $this->form_validation->set_rules('waktu', 'Waktu', 'required|min_length[4]');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses insert
                $items = array(
                    'jam' => $this->input->post('jam', TRUE),
                    'label' => $this->input->post('label', TRUE),
                    'waktu' => $this->input->post('waktu', TRUE),

                );
                $this->admin->insert('jam_masuk', $items);
                $this->session->set_flashdata('alert', 'Data berhasil di simpan');
                redirect('jam_masuk');
            }
        }

        

        $data['jam'] = $this->input->post('jam', TRUE);
        $data['label'] = $this->input->post('label', TRUE);
        $data['waktu'] = $this->input->post('waktu', TRUE);

        $data['title_head'] = "Tambah Jam";

        $this->template->admin('admin/jam_mapel', $data);
    }

    function update_jam()
    {
        $id_jam = $this->uri->segment(3);
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('jam', 'Jam', 'required');
            $this->form_validation->set_rules('label', 'Label', 'required|min_length[4]');
            $this->form_validation->set_rules('waktu', 'Waktu', 'required|min_length[4]');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses
                $items = array(
                    'jam' => $this->input->post('jam', TRUE),
                    'label' => $this->input->post('label', TRUE),
                    'waktu' => $this->input->post('waktu', TRUE),

                );
                $this->admin->update('jam_masuk', $items, array('id' => $id_jam));
                $this->session->set_flashdata('alert', 'Data berhasil di perbarui');
                redirect('jam_masuk');
            }
        }

        $jamm = $this->admin->get_where('jam_masuk', array('id' => $id_jam));

        foreach ($jamm->result() as $jm) {
            $data['jam'] = $jm->jam;
            $data['label'] = $jm->label;
            $data['waktu'] = $jm->waktu;
        }
        $data['title_head'] = "Update Jam Pelajaran";
        $this->template->admin('admin/jam_mapel', $data);
    }

    function delete_jam()
    {
        $id_jam = $this->uri->segment(3);
        $this->admin->_delete('jam_masuk', $id_jam);
        $this->session->set_flashdata('alert', 'Data berhasil di hapus');
        redirect('jam_masuk');
    }
}
