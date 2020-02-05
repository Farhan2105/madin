<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
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
        $data['guru'] = $this->admin->get_all('guru');
        $count_guru = $this->admin->count('guru');
        $count_mapel = $this->admin->count('mapel');
        $count_kelas = $this->admin->count('kelas');
        $data['jumlah_guru'] = $count_guru;
        $data['jumlah_mapel'] = $count_mapel;
        $data['jumlah_kelas'] = $count_kelas;
        //ini untuk tampilan detail guru
        $id_guru = id_session();
        $data['id_guru'] = $id_guru;
        $guruku = $this->admin->get_where('guru', array('id' => $id_guru));
        foreach ($guruku->result() as $key) {
            $data['nip'] = $key->nip;
            $data['nama'] = $key->nama;
            $data['username'] = $key->username;
            $data['gambar'] = $key->gambar;
            $data['kelamin'] = $key->kelamin;
            $data['id_jabatan'] = $key->id_jabatan;
            $data['id_lembaga'] = $key->id_lembaga;
        }
        $tahun = date('Y');
        $bulan = date('m');
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $awal = $tahun . '-' . $bulan . '-01';
        $akhir = $tahun . '-' . $bulan . '-31';
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;
        // cari data d_hadir periode tanggal
        $kehadiran = $this->admin->get_where('d_hadir', ['tanggal >=' => $awal, 'tanggal <=' => $akhir]);
        // $data['kehadiran'] = $kehadiran;

        //============================================================================================================================================HITUNG KEHADIRAN DAN BISYAROH
        $table = 'd_hadir d JOIN jadwal j ON(d.id_jadwal = j.id)';
        $where = ['d.tanggal >=' => $awal, 'd.tanggal <=' => $akhir, 'j.id_guru' => $id_guru, 'd.absensi' => 1];
        $hadir = $this->admin->_count_where($table, $where);

        // ini sakit
        $table2 = 'd_hadir d JOIN jadwal j ON(d.id_jadwal = j.id)';
        $where2 = ['d.tanggal >=' => $awal, 'd.tanggal <=' => $akhir, 'j.id_guru' => $id_guru, 'd.absensi' => 3];
        $sakit = $this->admin->_count_where($table2, $where2);

        // ini ijin
        $table3 = 'd_hadir d JOIN jadwal j ON(d.id_jadwal = j.id)';
        $where3 = ['d.tanggal >=' => $awal, 'd.tanggal <=' => $akhir, 'j.id_guru' => $id_guru, 'd.absensi' => 2];
        $ijin = $this->admin->_count_where($table3, $where3);

        // ini alpha
        $table4 = 'd_hadir d JOIN jadwal j ON(d.id_jadwal = j.id)';
        $where4 = ['d.tanggal >=' => $awal, 'd.tanggal <=' => $akhir, 'j.id_guru' => $id_guru, 'd.absensi' => 0];
        $alpha = $this->admin->_count_where($table4, $where4);

        $harusnya_hadir = $hadir + $ijin + $sakit + $alpha;
        $ijin > 0 ? $jml_ijin = $ijin / 2 : $jml_ijin = 0;
        $sakit > 0 ? $jml_sakit = $sakit / 2 : $jml_sakit = 0;

        $jumlah_hadir = $hadir + $jml_ijin + $jml_sakit;
        $jumlah_hadir > 0 ? $percent = $jumlah_hadir * 100 / $harusnya_hadir : $percent = 0;
        $percent == 0 ? $string = " "  : $string = "%";
        $data['percent'] = $percent . "" . $string;

        //hitung gaji
        $id_gaji = $key->id_gaji;
        $get_nom = $this->admin->get_by_id('gaji', $id_gaji)->row();
        $nominal = $get_nom->nominal;

        $gaji = $jumlah_hadir * $nominal;
        $data['gaji'] = $gaji;
        // =================================================================AKHIR HITUNG============================================
        // ini untuk tampilan jadwal guru
        $id_guru = $this->session->userdata('id_pengguna');
        $jadwal = $this->admin->get_where('jadwal', array('id_guru' => $id_guru));
        $data['jadwal_ajar'] = $jadwal;

        // ini untuk dashboard piket
        $tgl = date('d-m-Y');
        $hari_ini = $this->hari->hari_ini($tgl);
        $jadwal_hari = $this->admin->get_where('jadwal', array('hari' => $hari_ini));
        $data['jadwal_hari_ini'] = $jadwal_hari;
        $data['hari_ini'] = $hari_ini;

        $this->template->admin('admin/home', $data);
    }

    public function edit_password()
    {
        $this->cek_login();

        $get_data = $this->admin->get_where('guru', array('id' => $this->session->userdata('id_pengguna')))->row();
        if ($this->input->post('submit', TRUE) == 'Submit') {
            // validasi form
            // $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password1', 'Password Baru', 'required');
            $this->form_validation->set_rules('password2', 'Password Lama', 'required');

            $this->form_validation->set_message('required', '%s belum terisi, mohon di isi kembali');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


            if ($this->form_validation->run() == TRUE) {

                // validasi password
                if (!password_verify($this->input->post('password2', TRUE), $get_data->password)) {
                    echo '<script type="text/javascript">alert("Password lama yang anda masukkan salah");window.location.replace("' . base_url() . 'login/logout")</script>';
                } else {

                    $pass = $this->input->post('password1', TRUE);
                    $data['password'] = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
                    // $data['username'] = $get_data->username;
                    $cond = array('id' => $this->session->userdata('id_pengguna'));
                    $this->admin->update('guru', $data, $cond);
                    redirect('login/logout');
                }
            }
        }
        // $data['username'] = $this->input->post('username', TRUE);
        $data['username'] = $get_data->username;
        $this->template->admin('admin/edit_pass', $data);
    }

    public function backup_db()
    {
        $this->load->dbutil();

        $prefts = array(
            'format' => 'sql',
            'filename' => "madin" . date("Ymd-His") . '.sql'
        );
        $backup = &$this->dbutil->backup($prefts);
        $db_name = "madin " . date("Ymd-His") . '.sql';
        $save = FCPATH . 'assets/db/' . 'db_name';
        $this->load->helper('file');
        write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    function cek_login()
    {
        $sess = $this->session->userdata('login');
        if ($sess != TRUE) {
            redirect('login');
        }
    }
}
