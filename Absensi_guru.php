<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_guru extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin'));
		$this->load->library(array('template', 'form_validation', 'hari'));
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->cek_login();
		$tanggal = date('d F Y');
		$hari_ini = $this->hari->hari_ini($tanggal);
		$data['title_head'] = "Absensi Hari ini, " . $hari_ini . " Tanggal " . $tanggal;
		$data['hari_ini'] = $hari_ini;

		$input_tgl = date('d-m-Y');
		$data['tanggal'] = $input_tgl;
		$sess_lev = $this->session->userdata('level');
		$data['sess_lev'] = $sess_lev;
		$data['jadwal_group'] = $this->admin->get_all_group_by('jadwal', 'hari');
		$data['jadwal_plj'] = $this->admin->get_all('jadwal');
		$data['lembaga'] = $this->admin->get_all('lembaga');
		$data['lembagaX'] = $this->input->post('lembagaX', TRUE);

		$data['id_data'] = '';
		$data['url_save'] = base_url() . 'absensi_guru/save_data/';
		$data['url_edit'] = base_url() . 'absensi_guru/edit_data/';
		$data['url_delete'] = base_url() . 'absensi_guru/hapus_data/';
		$data['url_table'] = base_url() . 'absensi_guru/table_data/';

		$data['url_cekData'] = base_url() . 'absensi_guru/cek_data_absensi';
		$data['url_anchor'] = base_url() . 'absensi_guru/view_data_absensi/';

		// cek data jika sudah tersimpan
		$this->template->admin('admin/absensi_guru_v', $data);
	}

	function view_data_absensi()
	{

		$this->cek_login();
		$tgl = $this->uri->segment(4);
		$lembaga = $this->uri->segment(3);
		$edate = strtotime($tgl);
		$tanggal = date("Y-m-d", $edate);
		$datanya = $this->admin->get_where_order('d_hadir', ['tanggal' => $tanggal, 'id_lembaga' => $lembaga], 'id', 'asc')->result();
		$data['absensi'] = $datanya;
		$data['lembaga'] = $lembaga;
		$data['tanggal'] = $tanggal;

		$tgl2 = date("d F Y", $edate);
		$data['title_head'] = "Data Absensi Tanggal " . $tgl2;

		$this->template->admin('admin/data_absensi_v', $data);
	}

	function edit_data_hadir()
	{
		$this->cek_login();
		$tgl = $this->uri->segment(4);
		$lembaga = $this->uri->segment(3);
		$id_jadwal = $this->uri->segment(5);
		$ubah_status = $this->uri->segment(6);

		$edit['absensi'] = $ubah_status;
		$this->admin->update('d_hadir', ['absensi' => $ubah_status], ['id' => $id_jadwal]);
		// echo $id_jadwal;
		redirect('absensi_guru/view_data_absensi/' . $lembaga . '/' . $tgl);
	}
	function cek_data_absensi()
	{
		$tgl = $this->input->post('tanggal');
		$edate = strtotime($tgl);
		$tanggal = date("Y-m-d", $edate);
		$cek = $this->admin->get_where('d_hadir', ['tanggal' => $tanggal]);
		if ($cek->num_rows() > 0) {
			$data['status'] = 1;
		} else {
			$data['status'] = 0;
		}

		echo json_encode($data);
	}
	function table_data()
	{
		$input_lembaga = $this->uri->segment(3);
		$tanggal = $this->uri->segment(4);
		$hari = $this->hari->hari_ini($tanggal);
		$hasil = "";
		// head table
		$sess_lev = $this->session->userdata('level');
		$group1 = $this->admin->get_where_group('jadwal', ['id_lembaga' => $input_lembaga, 'hari' => $hari], 'hari');
		$no = 1;
		$hasil .= '<tr>
				    <td style="text-align: center;">HARI</td>
				    <td>KELAS</td>
				    <td>JAM</td>
				    <td>MAPEL</td>
				    <td>USTADZ</td>
				    ';
		$hasil .= '<td style="text-align: center;"><input type="checkbox" onclick="toggle(this);" /> * H</td>
					<td style="text-align: center;">I</td>
					<td style="text-align: center;">S</td>
					<td style="text-align: center;">A</td>
		';
		$hasil .= ' </tr>';
		if ($group1->num_rows() > 0) {
			$jml_data = $this->admin->get_where('jadwal', ['id_lembaga' => $input_lembaga, 'hari' => $hari])->num_rows();
			foreach ($group1->result() as $group1) {

				$hasil .= '<tr>';
				$list = $this->admin->get_where('jadwal', ['hari' => $group1->hari]);
				$hasil .= '<td rowspan="' . $list->num_rows() . '" style="vertical-align: middle; text-align: center;">' . $group1->hari . '</td>';

				$group2 = $this->admin->get_where_group('jadwal', ['hari' => $group1->hari], 'id_kelas');
				foreach ($group2->result() as $group2) {
					$list2 = $this->admin->get_where('jadwal', ['hari' => $group2->hari, 'id_kelas' => $group2->id_kelas]);
					$get_kelas = $this->admin->get_where('kelas', ['id' => $group2->id_kelas]);
					if ($get_kelas->num_rows() > 0) {
						$c = $get_kelas->row();
						$kls = $c->kelas;
					} else {
						$kls = "Kelas tdk ada";
					}

					$hasil .= '<td rowspan="' . $list2->num_rows() . '" style="vertical-align: middle; text-align: center;">' . $kls . '</td>';

					foreach ($list2->result() as $list2) {
						$id = $list2->id;
						$jam_ke = $list2->id_jam;
						$mapel = $list2->id_mapel;
						$guru = $list2->id_guru;

						$get_jam = $this->admin->get_where('jam_masuk', ['id' => $jam_ke])->row();
						$get_mapel = $this->admin->get_where('mapel', ['id' => $mapel]);
						if ($get_mapel->num_rows() > 0) {
							$b = $get_mapel->row();
							$mpl = $b->mapel;
							$kitab = $b->kitab;
						} else {
							$mpl = "Mapel tdk ada";
							$kitab = "Kitab blm Terdaftar";
						}
						$get_guru = $this->admin->get_where('guru', ['id' => $guru]);
						if ($get_guru->num_rows() > 0) {
							$a = $get_guru->row();
							$guru = $a->nama;
						} else {
							$guru = "data guru tdk ada";
						}



						// MASUKKAN KE LIST
						$hasil .= '<td>' . $jam_ke . ' - ' . $get_jam->label . '</td>';
						$hasil .= '<td>' . $mpl . ' - ' . $kitab . '</td>';
						$hasil .= '<td>' . $guru . '</td>';

						$hasil .= '<td style="text-align: center;"> <input type="checkbox" name="input_h[]" class="input_row" value="' . $id . '" />
              						</td>';
						$hasil .= '<td style="text-align: center;"> <input type="checkbox" name="input_i[]" class="input_row" value="' . $id . '" />
              						</td>';
						$hasil .= '<td style="text-align: center;"> <input type="checkbox" name="input_s[]" class="input_row" value="' . $id . '" />
              						</td>';
						$hasil .= '<td style="text-align: center;"> <input type="checkbox" name="input_a[]" class="input_row" value="' . $id . '" />
              						</td>';
						$hasil .= '</tr>';
					}
				}
				$no++;
			}
			$hasil .= '<tr><td colspan="9" style="text-align:right;" id="jml_data" data-id="' . $jml_data . '">Ada ' . $jml_data . ' Jumlah Data</td></tr>';
		} else {

			$hasil .= '<tr><td colspan="9" style="text-align:center;">Data Belum Ada / Tidak ditemukan</td></tr>';
		}

		$list = $hasil;



		$output = array(
			'data_item' => $list,
		);
		echo json_encode($output);
	}
	function edit_data($id)
	{
		$get['jadwal'] = $this->admin->get_where('jadwal', ['id' => $id])->row();
		$this->output->set_output(json_encode($get));
	}

	function hapus_data($id)
	{


		$this->admin->_delete('jadwal', $id);
		echo json_encode(array("status" => TRUE));
	}

	function save_data()
	{
		$hadir = $this->input->post('hadir', TRUE); //  = 1
		$ijin = $this->input->post('ijin', TRUE); // = 2
		$sakit = $this->input->post('sakit', TRUE); // = 3
		$alpha = $this->input->post('alpha', TRUE); // = 0
		$tgl = $this->input->post('tanggal', TRUE);
		$lembaga = $this->input->post('lembaga', TRUE);
		$edate = strtotime($tgl);
		$tanggal = date("Y-m-d", $edate);
		$hari = $this->hari->hari_ini($tanggal);
		$petugas = $this->session->userdata('id_pengguna');

		// echo $hadir;die();

		// SAVE ABSENSI
		foreach ($hadir as $hadir) {
			$yg_hadir = array(
				'tanggal' => $tanggal,
				'hari'	=> $hari,
				'absensi' => 1,
				'id_jadwal' => $hadir,
				'id_petugas' => $petugas,
				'id_lembaga' => $lembaga,
				// 'date_edit'=>0,

			);
			$this->admin->insert('d_hadir', $yg_hadir);
		}

		//jika Ada yg ijin
		if ($ijin != "") {
			foreach ($ijin as $ijin) {
				$yg_ijin = array(
					'tanggal' => $tanggal,
					'hari'	=> $hari,
					'absensi' => 2,
					'id_jadwal' => $ijin,
					'id_petugas' => $petugas,
					'id_lembaga' => $lembaga,

				);
				$this->admin->insert('d_hadir', $yg_ijin);
			}
		}

		//jika Ada yg sakit
		if ($sakit != "") {
			foreach ($sakit as $sakit) {
				$yg_sakit = array(
					'tanggal' => $tanggal,
					'hari'	=> $hari,
					'absensi' => 3,
					'id_jadwal' => $sakit,
					'id_petugas' => $petugas,
					'id_lembaga' => $lembaga,

				);
				$this->admin->insert('d_hadir', $yg_sakit);
			}
		}

		//jika Ada yg alpha
		if ($alpha != "") {
			foreach ($alpha as $alpha) {
				$yd_alpha = array(
					'tanggal' => $tanggal,
					'hari'	=> $hari,
					'absensi' => 0,
					'id_jadwal' => $alpha,
					'id_petugas' => $petugas,
					'id_lembaga' => $lembaga,

				);
				$this->admin->insert('d_hadir', $yd_alpha);
			}
		}

		$this->output->set_output(json_encode(array("status" => TRUE)));
	}

	function _fetch()
	{
		$data['hari'] = $this->input->post('hari', TRUE);
		$data['id_kelas'] = $this->input->post('id_kelas', TRUE);
		$data['id_jam'] = $this->input->post('id_jam', TRUE);
		$data['id_mapel'] = $this->input->post('id_mapel', TRUE);
		$data['id_guru'] = $this->input->post('id_guru', TRUE);
		$data['id_lembaga'] = $this->input->post('id_lembaga', TRUE);

		return $data;
	}

	function _validate($id)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post("hari") == "") {
			$data["inputerror"][] = "hari";
			$data["error_string"][] = "Harap Diisi";
			$data["status"] = FALSE;
		}

		if ($this->input->post("id_kelas") == "") {
			$data["inputerror"][] = "id_kelas";
			$data["error_string"][] = "Harap Diisi";
			$data["status"] = FALSE;
		}

		if ($this->input->post("id_jam") == "") {
			$data["inputerror"][] = "id_jam";
			$data["error_string"][] = "Harap Diisi";
			$data["status"] = FALSE;
		}
		if ($this->input->post("id_mapel") == "") {
			$data["inputerror"][] = "id_mapel";
			$data["error_string"][] = "Harap Diisi";
			$data["status"] = FALSE;
		}
		if ($this->input->post("id_guru") == "") {
			$data["inputerror"][] = "id_guru";
			$data["error_string"][] = "Harap Diisi";
			$data["status"] = FALSE;
		}
		if ($this->input->post("id_lembaga") == "") {
			$data["inputerror"][] = "id_lembaga";
			$data["error_string"][] = "Harap Diisi";
			$data["status"] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}


	function cek_login()
	{
		$login = $this->session->userdata('login');
		if ($login != TRUE) {
			redirect('login');
		}
	}
}

/* End of file Jadwal_pelajaran.php */
/* Location: .//C/Users/Harry/AppData/Local/Temp/fz3temp-2/Jadwal_pelajaran.php */
