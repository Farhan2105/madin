<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_tunj extends CI_Controller
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
        $data['gaji'] = $this->admin->get_all('gaji');
        $data['title_head'] = "Pengaturan Nominal";
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

        $this->template->admin('admin/daftar_tunj_gapok_v', $data);
    }

    function update_nom()
    {
        $id_gaji = $this->uri->segment(3);
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('nominal', 'Nominal', 'required');
            $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required');
            $this->form_validation->set_rules('walas', 'Tunjangan Wali Kelas', 'required');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses
                $items = array(
                    'nominal' => $this->input->post('nominal', TRUE),
                    'gaji_pokok' => $this->input->post('gaji_pokok', TRUE),
                    'walas' => $this->input->post('walas', TRUE),

                );
                $this->admin->update('gaji', $items, array('id' => $id_gaji));
                $this->session->set_flashdata('alert', 'Data berhasil di perbarui');
                redirect('daftar_tunj');
            }
        }

        $gajii = $this->admin->get_where('gaji', array('id' => $id_gaji));

        foreach ($gajii->result() as $gji) {
            $data['nominal'] = $gji->nominal;
            $data['gaji_pokok'] = $gji->gaji_pokok;
            $data['walas'] = $gji->walas;
        }
        $data['title_head'] = "Update Nominal";
        $this->template->admin('admin/daftar_tunj_gapok', $data);
    }
    
}
