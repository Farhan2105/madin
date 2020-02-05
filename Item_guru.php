<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item_guru extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'form_validation'));
        $this->load->model('admin');
    }
    public function index()
    {
        $this->cek_login();
        $data['guru'] = $this->admin->get_all('guru');
        $sess_lev = $this->session->userdata('level');
        $data['sess_lev'] = $sess_lev;
        $data['title_head'] = "Daftar Guru";
        $this->template->admin('admin/daftar_guru', $data);
    }
    public function add_guru()
    {
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('nip', '*NIP', 'required|numeric');
            $this->form_validation->set_rules('nik', '*NIK', 'required|numeric');
            $this->form_validation->set_rules('tlp', '*No Telepon', 'required|numeric');
            $this->form_validation->set_rules('nama', '*Nama', 'required|min_length[4]');
            $this->form_validation->set_rules('username', '*Username', 'required|min_length[4]');
            $this->form_validation->set_rules('kelamin', 'Kelamin', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[4]');
            $this->form_validation->set_rules('id_jabatan', '*Jabatan', 'required|numeric');
            $this->form_validation->set_rules('id_bulan', '*Bulan', 'required|numeric');
            $this->form_validation->set_rules('id_status', '*Status', 'required|numeric');
            $this->form_validation->set_rules('id_priode', '*Priode', 'required|numeric');
            $this->form_validation->set_rules('id_lembaga', '*Lembaga', 'required|numeric');
            $this->form_validation->set_rules('id_level', '*Level', 'required|numeric');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {
                // proses insert
                $level_post = $this->input->post('id_level', TRUE);
                if ($level_post == 1) {
                    // $username = "admin";
                    $password = password_hash('admin', PASSWORD_DEFAULT, ['cost' => 10]);
                } elseif ($level_post == 2) {
                    // $username = "piket";
                    $password = password_hash('piket', PASSWORD_DEFAULT, ['cost' => 10]);
                } else {
                    // $username = "guru";
                    $password = password_hash('guru', PASSWORD_DEFAULT, ['cost' => 10]);
                };
                $config['upload_path'] = './assets/upload';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '5048';
                $config['file_name'] = 'gambar' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {

                    $gbr = $this->upload->data();
                    $items = array(
                        'nip' => $this->input->post('nip', TRUE),
                        'nik' => $this->input->post('nik', TRUE),
                        'tlp' => $this->input->post('tlp', TRUE),
                        'nama' => $this->input->post('nama', TRUE),
                        'username' => $this->input->post('username', TRUE),
                        'gambar' => $gbr['file_name'],
                        'kelamin' => $this->input->post('kelamin', TRUE),
                        'alamat' => $this->input->post('alamat', TRUE),
                        'id_jabatan' => $this->input->post('id_jabatan', TRUE),
                        'id_status' => $this->input->post('id_status', TRUE),
                        'id_bulan' => $this->input->post('id_bulan', TRUE),
                        'id_priode' => $this->input->post('id_priode', TRUE),
                        'id_lembaga' => $this->input->post('id_lembaga', TRUE),
                        'id_gaji' => 1,
                        'id_level' => $level_post,
                        'password' => $password,

                    );


                    $this->admin->insert('guru', $items);
                    $this->session->set_flashdata('alert', 'Data berhasil di simpan');
                    redirect('item_guru/add_guru');

                    // $this->admin->insert('guru', $items);
                    // redirect('item_guru/add_guru');

                } else {
                    $items = array(
                        'nip' => $this->input->post('nip', TRUE),
                        'nik' => $this->input->post('nik', TRUE),
                        'tlp' => $this->input->post('tlp', TRUE),
                        'nama' => $this->input->post('nama', TRUE),
                        'username' => $this->input->post('username', TRUE),
                        'kelamin' => $this->input->post('kelamin', TRUE),
                        'alamat' => $this->input->post('alamat', TRUE),
                        'id_jabatan' => $this->input->post('id_jabatan', TRUE),
                        'id_status' => $this->input->post('id_status', TRUE),
                        'id_bulan' => $this->input->post('id_bulan', TRUE),
                        'id_priode' => $this->input->post('id_priode', TRUE),
                        'id_lembaga' => $this->input->post('id_lembaga', TRUE),
                        'id_gaji' => 1,
                        'id_level' => $level_post,
                        'password' => $password,

                    );



                    $this->admin->insert('guru', $items);
                    $this->session->set_flashdata('alert', 'Data berhasil di simpan');
                    redirect('item_guru/add_guru');
                }
            }
        }

        $data['nip'] = $this->input->post('nip', TRUE);
        $data['nik'] = $this->input->post('nik', TRUE);
        $data['tlp'] = $this->input->post('tlp', TRUE);
        $data['nama'] = $this->input->post('nama', TRUE);
        $data['foto'] = $this->input->post('gambar', TRUE);
        $data['kelamin'] = $this->input->post('kelamin', TRUE);
        $data['username'] = $this->input->post('username', TRUE);
        $data['alamat'] = $this->input->post('alamat', TRUE);
        $data['id_jabatan'] = $this->input->post('id_jabatan', TRUE);
        $data['id_status'] = $this->input->post('id_status', TRUE);
        $data['id_bulan'] = $this->input->post('id_bulan', TRUE);
        $data['id_priode'] = $this->input->post('id_priode', TRUE);
        $data['id_lembaga'] = $this->input->post('id_lembaga', TRUE);
        $data['id_level'] = $this->input->post('id_level', TRUE);

        $data['title_head'] = "Tambah Guru";


        // memanggil seluruh tabel jabatan, lembaga dan yang berhubungan
        $jabatan = $this->admin->get_all('jabatan');
        $data['jabatan'] = $jabatan;
        $status = $this->admin->get_all('status');
        $data['status'] = $status;
        $bulan = $this->admin->get_all('bulan');
        $data['bulan'] = $bulan;
        $priode = $this->admin->get_all('priode');
        $data['priode'] = $priode;
        $lembaga = $this->admin->get_all('lembaga');
        $data['lembaga'] = $lembaga;
        $level = $this->admin->get_all('level');
        $data['level'] = $level;

        $this->template->admin('admin/guru_v', $data);
    }
    public function detail()
    {
        $id_guru = $this->uri->segment(3);
        $guruku = $this->admin->get_where('guru', array('id' => $id_guru));
        foreach ($guruku->result() as $key) {
            $data['nip'] = $key->nip;
            $data['nik'] = $key->nik;
            $data['tlp'] = $key->tlp;
            $data['nama'] = $key->nama;
            $data['username'] = $key->username;
            $data['gambar'] = $key->gambar;
            $data['kelamin'] = $key->kelamin;
            $data['alamat'] = $key->alamat;
            $data['id_jabatan'] = $key->id_jabatan;
            $data['id_status'] = $key->id_status;
            $data['id_bulan'] = $key->id_bulan;
            $data['id_priode'] = $key->id_priode;
            $data['id_lembaga'] = $key->id_lembaga;
        }
        $this->template->admin('admin/detail_guru', $data);
    }

    public function update_guru()
    {
        $id_guru = $this->uri->segment(3);
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi
            $this->form_validation->set_rules('nip', '*NIP', 'required|numeric');
            $this->form_validation->set_rules('nik', '*NIK', 'required|numeric');
            $this->form_validation->set_rules('tlp', '*No Telepon', 'required|numeric');
            $this->form_validation->set_rules('nama', '*Nama', 'required|min_length[4]');
            $this->form_validation->set_rules('username', '*Username', 'required|min_length[4]');
            $this->form_validation->set_rules('kelamin', 'Kelamin', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[4]');
            $this->form_validation->set_rules('id_jabatan', '*Jabatan', 'required|numeric');
            $this->form_validation->set_rules('id_status', '*Status', 'required|numeric');
            $this->form_validation->set_rules('id_bulan', '*Bulan', 'required|numeric');
            $this->form_validation->set_rules('id_priode', '*Priode', 'required|numeric');
            $this->form_validation->set_rules('id_lembaga', '*Lembaga', 'required|numeric');
            $this->form_validation->set_rules('id_level', '*Level', 'required|numeric');

            $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
            $this->form_validation->set_message('min_length', '{field} minimmal 4 karakter');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');



            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = './assets/upload';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '5048';
                $config['file_name'] = 'gambar' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $gbr = $this->upload->data();
                    $items = array(
                        'gambar' => $gbr['file_name'],
                    );
                    $this->admin->update('guru', $items, array('id' => $id_guru));
                    $this->session->set_flashdata('alert', 'Data Berhasil di perbarui');
                    redirect('item_guru');
                } else {
                    $items = array(
                        'nip' => $this->input->post('nip', TRUE),
                        'nik' => $this->input->post('nik', TRUE),
                        'tlp' => $this->input->post('tlp', TRUE),
                        'nama' => $this->input->post('nama', TRUE),
                        'kelamin' => $this->input->post('kelamin', TRUE),
                        'alamat' => $this->input->post('alamat', TRUE),
                        'id_jabatan' => $this->input->post('id_jabatan', TRUE),
                        'id_status' => $this->input->post('id_status', TRUE),
                        'id_bulan' => $this->input->post('id_bulan', TRUE),
                        'id_priode' => $this->input->post('id_priode', TRUE),
                        'id_lembaga' => $this->input->post('id_lembaga', TRUE),
                        'username' => $this->input->post('username', TRUE),
                        'id_level' => $this->input->post('id_level', TRUE),
                        'id_gaji' => 1,

                    );
                    $this->admin->update('guru', $items, array('id' => $id_guru));
                    $this->session->set_flashdata('alert', 'Data Berhasil di perbarui');
                    redirect('item_guru');
                }
            }
        }


        $gurukul = $this->admin->get_where('guru', array('id' => $id_guru));


        foreach ($gurukul->result() as $kuy) {
            $photo = $kuy->gambar;
            $filename = "./assets/upload/" . $photo;
            $ada_foto = (!file_exists($filename) || $photo == '') ? base_url() . "assets/upload/default.jpg" : base_url() . "assets/upload/" . $photo;
            $data['nip'] = $kuy->nip;
            $data['nik'] = $kuy->nik;
            $data['tlp'] = $kuy->tlp;
            $data['nama'] = $kuy->nama;
            $data['username'] = $kuy->username;
            $data['gambar'] = $kuy->gambar;
            $data['photo'] = $ada_foto;
            $data['kelamin'] = $kuy->kelamin;
            $data['alamat'] = $kuy->alamat;
            $data['id_jabatan'] = $kuy->id_jabatan;
            $data['id_status'] = $kuy->id_status;
            $data['id_bulan'] = $kuy->id_bulan;
            $data['id_priode'] = $kuy->id_priode;
            $data['id_lembaga'] = $kuy->id_lembaga;
            $data['id_level'] = $kuy->id_level;
        }
        $data['title_head'] = "Update Data Guru";


        // memanggil seluruh tabel jabatan, lembaga dan yang berhubungan
        $jabatan = $this->admin->get_all('jabatan');
        $data['jabatan'] = $jabatan;
        $status = $this->admin->get_all('status');
        $data['status'] = $status;
        $bulan = $this->admin->get_all('bulan');
        $data['bulan'] = $bulan;
        $priode = $this->admin->get_all('priode');
        $data['priode'] = $priode;
        $lembaga = $this->admin->get_all('lembaga');
        $data['lembaga'] = $lembaga;
        $level = $this->admin->get_all('level');
        $data['level'] = $level;

        $this->template->admin('admin/guru_v', $data);
    }

    function delete_guru()
    {
        $id_guru = $this->uri->segment(3);
        $this->admin->_delete('guru', $id_guru);
        $this->session->set_flashdata('alert', 'Data Berhasil di hapus');
        redirect('item_guru');
    }
    function cek_login()
    {
        $sess = $this->session->userdata('login');
        if ($sess != TRUE) {
            redirect('login');
        }
    }
}
