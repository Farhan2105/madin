<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_user extends CI_Controller
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

        $data['nm_bulan'] = $this->admin->get_all('bulan');
        $data['bulan'] = $this->input->post('bulan', TRUE);


        $tahun = date('Y');
        $data['tahun'] = $tahun; // ini tahun hari ini

        if ($this->input->post('submit', TRUE) == 'Submit') {
            $this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric');

            $this->form_validation->set_message('required', '%s Belum dipilih');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

            if ($this->form_validation->run() == TRUE) {

                $bulan = $this->input->post('bulan', TRUE);
                $tahun = $this->input->post('tahun', TRUE);
                redirect('Laporan_user/detail/'. $bulan . '/' . $tahun);

            }

        }

        $data['uri'] = "";
        $data['nip'] = "";
        $data['nama'] = "";
        $data['jabatan'] = "";
        $data['persen'] = 0;
        $data['string'] = "";
        $data['inhadir'] = 0;
        $data['gapok'] = 0;
        $data['walas'] = 0;
        $data['struktur'] = 0;
        $data['jumlah'] = 0;


        $this->template->admin('admin/Laporan_user_v', $data);
    }

    function detail()
    {
    	 $this->cek_login();
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        $data['nm_bulan'] = $this->admin->get_all('bulan');
        $data['bulan'] = $bulan;
        $tahun = date('Y');
        $data['tahun'] = $tahun;

        if ($this->input->post('submit', TRUE) == 'Submit') {
            $this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric');

            $this->form_validation->set_message('required', '%s Belum dipilih');

            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

            if ($this->form_validation->run() == TRUE) {

                
                $bulan = $this->input->post('bulan', TRUE);
                $tahun = $this->input->post('tahun', TRUE);
                redirect('Laporan_user/detail/'. $bulan . '/' . $tahun);
            }
        }

        $awal = $tahun . '-' . $bulan . '-01';
        $akhir = $tahun . '-' . $bulan . '-31';
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;

        // cari data d_hadir periode tanggal
        $kehadiran = $this->admin->get_where('d_hadir', ['tanggal >=' => $awal, 'tanggal <=' => $akhir]);
        $data['kehadiran'] = $kehadiran;

        // ambil data guru berdasarkan session
        $sess_id = $this->session->userdata('id_pengguna');
        $guru = $this->admin->get_by_id('guru', $sess_id);
        $key = $guru->row();

        

       				// ini hadir
                    // $select = 'd.absensi AS hadir';
                    $table = 'd_hadir d JOIN jadwal j ON(d.id_jadwal = j.id)';
                    $where = ['d.tanggal >=' => $awal, 'd.tanggal <=' => $akhir, 'j.id_guru' => $key->id, 'd.absensi' => 1];
                    $hadir = $this->admin->_count_where($table, $where);

                    // ini sakit
                    $table2 = 'd_hadir d JOIN jadwal j ON(d.id_jadwal = j.id)';
                    $where2 = ['d.tanggal >=' => $awal, 'd.tanggal <=' => $akhir, 'j.id_guru' => $key->id, 'd.absensi' => 3];
                    $sakit = $this->admin->_count_where($table2, $where2);

                    // ini ijin
                    $table3 = 'd_hadir d JOIN jadwal j ON(d.id_jadwal = j.id)';
                    $where3 = ['d.tanggal >=' => $awal, 'd.tanggal <=' => $akhir, 'j.id_guru' => $key->id, 'd.absensi' => 2];
                    $ijin = $this->admin->_count_where($table3, $where3);

                    // ini alpha
                    $table4 = 'd_hadir d JOIN jadwal j ON(d.id_jadwal = j.id)';
                    $where4 = ['d.tanggal >=' => $awal, 'd.tanggal <=' => $akhir, 'j.id_guru' => $key->id, 'd.absensi' => 0];
                    $alpha = $this->admin->_count_where($table4, $where4);


                    $harusnya_hadir = $hadir + $ijin + $sakit + $alpha;
                    $ijin > 0 ? $jml_ijin = $ijin : $jml_ijin = 0;
                    $sakit > 0 ? $jml_sakit = $sakit : $jml_sakit = 0;

                    $jumlah_hadir = $hadir + $jml_ijin + $jml_sakit;
                    $jumlah_hadir > 0 ? $percent = $jumlah_hadir * 100 / $harusnya_hadir : $percent = 0;
                    $percent == 0 ? $string = " "  : $string = "%";

                    //hitung gaji
                    $id_gaji = $key->id_gaji;
                    $get_nom = $this->admin->get_by_id('gaji', $id_gaji)->row();
                    $nominal = $get_nom->nominal;

                    //gaji pokok nominal
                    $nom_gapok = $get_nom->gaji_pokok;
                    $nom_walas = $get_nom->walas;
                    //insentif
                    $gaji = ($jumlah_hadir-$jml_ijin-$jml_sakit) * $nominal;

                    // pencarian Wali Kelas
                     $cari_walas = $this->admin->get_where('kelas',['id_guru'=> $key->id]);
                     $cari_walas->num_rows()>0 ? $ada_walas = $nom_walas : $ada_walas = 0;

                    // INI UNTUK GAPOK
                    $jml_jdwl_seminggu = $this->admin->_count_where('jadwal', ['id_guru'=>$key->id]);
                    $jml_jdwl_seminggu >= 12? $gapok =$nom_gapok:$gapok=0;

                    //gaji Struktural
                    $nom_jab = $this->admin->get_by_id('jabatan', $key->id_jabatan);
                    $nama_jab = $nom_jab->row();
					$nom_struktural = $nama_jab->tunjangan;
                    $nama_jabatan = $nama_jab->jabatan;

                    //Jumlah Bisyaroh
                    $jml_bisyaroh = $gaji + $ada_walas + $gapok + $nom_struktural;

			        $data['nip'] = $key->nip;
			        $data['nama'] = $key->nama;
			        $data['jabatan'] = $nama_jabatan;
			        $data['persen'] = $percent;
			        $data['string'] = $string;
			        $data['inhadir'] = $gaji;
			        $data['gapok'] = $gapok;
			        $data['walas'] = $ada_walas;
			        $data['struktur'] = $nom_struktural;
			        $data['jumlah'] = $jml_bisyaroh;


        $this->template->admin('admin/Laporan_user_v', $data);
    }

     function cek_login()
    {
        $sess = $this->session->userdata('login');
        if ($sess != TRUE) {
            redirect('login');
        }
    }
}