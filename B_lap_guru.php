<?php
defined('BASEPATH') or exit('No direct script access allowed');

class B_lap_guru extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'form_validation', 'hari'));
        $this->load->model(array('admin'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->cek_login();
        $data['title_head'] = "Table Data Kehadiran Guru Lembaga di MDNJ berdasarkan Bulan";
        $data['guru'] = $this->admin->get_all('guru');
        $data['lembaga'] = $this->admin->get_all('lembaga');
        $data['nm_bulan'] = $this->admin->get_all('bulan');
        $data['id_lembaga'] = $this->input->post('id_lembaga', TRUE);
        $data['bulan'] = $this->input->post('bulan', TRUE);
        $sess_lev = $this->session->userdata('level');
        $data['sess_lev'] = $sess_lev;


        $tahun = date('Y');
        $data['tahun'] = $tahun; // ini tahun hari ini

        if ($this->input->post('submit', TRUE) == 'Submit') {
            $this->form_validation->set_rules('id_lembaga', 'Lembaga', 'required|numeric');
            $this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric');

            $this->form_validation->set_message('required', '%s Belum dipilih');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

            if ($this->form_validation->run() == TRUE) {

                $id_lembaga = $this->input->post('id_lembaga', TRUE);
                $bulan = $this->input->post('bulan', TRUE);
                $tahun = $this->input->post('tahun', TRUE);
                redirect('b_lap_guru/tabel_data/' . $id_lembaga . '/' . $bulan . '/' . $tahun);
            }
        }
        $data['uri'] = "";


        $this->template->admin('admin/b_lap_guru_v', $data);
    }
    function tabel_data()
    {
        $this->cek_login();
        $id_lembaga = $this->uri->segment(3);
        $bulan = $this->uri->segment(4);
        $tahun = $this->uri->segment(5);
        $data['title_head'] = "Table Data Kehadiran Guru Lembaga di MDNJ berdasarkan Bulan " . $bulan . " Tahun " . $tahun;
        $data['lembaga'] = $this->admin->get_all('lembaga');
        $data['nm_bulan'] = $this->admin->get_all('bulan');
        $data['id_lembaga'] = $id_lembaga;
        $data['bulan'] = $bulan;
        // $tahun = date('Y');
        $data['tahun'] = $tahun;
        $sess_lev = $this->session->userdata('level');
        $data['sess_lev'] = $sess_lev;

        if ($this->input->post('submit', TRUE) == 'Submit') {

            $this->form_validation->set_rules('id_lembaga', 'Lembaga', 'required|numeric');
            $this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric');

            $this->form_validation->set_message('required', '%s Belum dipilih');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

            if ($this->form_validation->run() == TRUE) {

                $id_lembaga = $this->input->post('id_lembaga', TRUE);
                $bulan = $this->input->post('bulan', TRUE);
                $tahun = $this->input->post('tahun', TRUE);
                redirect('b_lap_guru/tabel_data/' . $id_lembaga . '/' . $bulan . '/' . $tahun);
            }
        }


        $awal = $tahun . '-' . $bulan . '-01';
        $akhir = $tahun . '-' . $bulan . '-31';
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;

        // cari data d_hadir periode tanggal
        $kehadiran = $this->admin->get_where('d_hadir', ['tanggal >=' => $awal, 'tanggal <=' => $akhir]);
        $data['kehadiran'] = $kehadiran;

        //cari data guru
        $data['uri'] = 1;
        $guru = $this->admin->get_where('guru', ['id_level' => 3, 'id_lembaga' => $id_lembaga]);
        $data['guru'] = $guru;

        //memanggil seluruh tabel
        $jabatan = $this->admin->get_all('jabatan');
        $data['jabatan'] = $jabatan;
        $gaji = $this->admin->get_all('gaji');
        $data['gaji'] = $gaji;


        $this->template->admin('admin/b_lap_guru_v', $data);
    }

    public function export_exel_guru()
    {
        $this->cek_login();
        $id_lembaga = $this->uri->segment(3);
        $bulan = $this->uri->segment(4);
        $tahun = $this->uri->segment(5);
        $data['lembaga'] = $this->admin->get_all('lembaga');
        $bln = $this->admin->get_by_id('bulan', $bulan);
        $bln2 = $bln->row();
        $bln->num_rows() > 0 ? $nm_bulan = $bln2->nama : $nm_bulan = "invalid";
        $data['nm_bulan'] = $nm_bulan;
        $data['id_lembaga'] = $id_lembaga;
        $data['bulan'] = $bulan;
        // $tahun = date('Y');
        $data['tahun'] = $tahun;

        $tgl = date('d F Y');
        $data['tanggal'] = $tgl;

        $awal = $tahun . '-' . $bulan . '-01';
        $akhir = $tahun . '-' . $bulan . '-31';
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;

        // cari data d_hadir periode tanggal
        $kehadiran = $this->admin->get_where('d_hadir', ['tanggal >=' => $awal, 'tanggal <=' => $akhir]);
        $data['kehadiran'] = $kehadiran;

        //cari data guru
        $data['uri'] = 1;
        $guru = $this->admin->get_where('guru', ['id_level' => 3, 'id_lembaga' => $id_lembaga]);
        $data['guru'] = $guru;

        //memanggil seluruh tabel
        $jabatan = $this->admin->get_all('jabatan');
        $data['jabatan'] = $jabatan;
        $gaji = $this->admin->get_all('gaji');
        $data['gaji'] = $gaji;

        $this->load->view('admin/l_exel_guru_absen', $data);
    }

    public function print_dat_guru()
    {
        $this->cek_login();
        $id_lembaga = $this->uri->segment(3);
        $bulan = $this->uri->segment(4);
        $tahun = $this->uri->segment(5);
        $data['lembaga'] = $this->admin->get_all('lembaga');
        $bln = $this->admin->get_by_id('bulan', $bulan);
        $bln2 = $bln->row();
        $bln->num_rows() > 0 ? $nm_bulan = $bln2->nama : $nm_bulan = "invalid";
        $data['nm_bulan'] = $nm_bulan;
        $data['id_lembaga'] = $id_lembaga;
        $data['bulan'] = $bulan;
        // $tahun = date('Y');
        $data['tahun'] = $tahun;

        $tgl = date('d F Y');
        $data['tanggal'] = $tgl;

        $awal = $tahun . '-' . $bulan . '-01';
        $akhir = $tahun . '-' . $bulan . '-31';
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;

        // cari data d_hadir periode tanggal
        $kehadiran = $this->admin->get_where('d_hadir', ['tanggal >=' => $awal, 'tanggal <=' => $akhir]);
        $data['kehadiran'] = $kehadiran;

        //cari data guru
        $data['uri'] = 1;
        $guru = $this->admin->get_where('guru', ['id_level' => 3, 'id_lembaga' => $id_lembaga]);
        $data['guru'] = $guru;

        //memanggil seluruh tabel
        $jabatan = $this->admin->get_all('jabatan');
        $data['jabatan'] = $jabatan;
        $gaji = $this->admin->get_all('gaji');
        $data['gaji'] = $gaji;

        $this->load->view('admin/l_pdf_guru_absen', $data);
    }
    public function detail_personal()
    {
        $this->uri->segment(3);

        $sess_id_piket = $this->session->userdata('id_pengguna');
        $guru = $this->admin->get_by_id('guru', $sess_id_piket);
        $key = $guru->row();

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

        $this->template->admin('admin/detail_personal', $data);
    }

    function cek_login()
    {
        $sess = $this->session->userdata('login');
        if ($sess != TRUE) {
            redirect('login');
        }
    }
}
