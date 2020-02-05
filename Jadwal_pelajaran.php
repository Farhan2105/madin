<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_pelajaran extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin'));
		$this->load->library(array('template', 'form_validation'));
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['title_head'] = "Jadwal Pelajaran";
		$sess_lev = $this->session->userdata('level');
		$data['sess_lev'] = $sess_lev;
		$data['jadwal_group'] = $this->admin->get_all_group_by('jadwal', 'hari');
		$data['jadwal_plj'] = $this->admin->get_all('jadwal');
		$data['lembaga'] = $this->admin->get_all('lembaga');
		$data['lembagaX'] = $this->input->post('lembagaX', TRUE);

		$data['id_data'] = '';
		$data['url_save'] = base_url() . 'jadwal_pelajaran/save_data/';
		$data['url_edit'] = base_url() . 'jadwal_pelajaran/edit_data/';
		$data['url_delete'] = base_url() . 'jadwal_pelajaran/hapus_data/';
		$data['url_table'] = base_url() . 'jadwal_pelajaran/table_data/';
		$this->template->admin('admin/jadwal_pelajaran_v', $data);
	}

	function table_data()
	{
		$input_lembaga = $this->uri->segment(3);
		$hasil = "";
		// head table
		$sess_lev = $this->session->userdata('level');
		$group1 = $this->admin->get_where_group('jadwal', ['id_lembaga' => $input_lembaga], 'hari');
		$no = 1;
		$hasil .= '<tr>
				    <td style="text-align: center;">HARI</td>
				    <td>KELAS</td>
				    <td>JAM</td>
				    <td>MAPEL</td>
				    <td>USTADZ</td>
				    ';
		if ($sess_lev == 1) {
			$hasil .= '<td>Opsi</td>';
		}
		$hasil .= ' </tr>';
		if ($group1->num_rows() > 0) {
			# code...
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
						if ($sess_lev == 1) {
							$hasil .= '<td> <button id="editBtn" class="btn btn-warning btn-xs" onclick="editData(' . $list2->id . ')"><i class="fa fa-edit"></i></button>
                  					<button id="deleteBtn" class="btn btn-danger btn-xs" onclick="hapusData(' . $list2->id . ')"><i class="fa fa-trash"></i></button>
              						</td>';
						}
						$hasil .= '</tr>';
					}
				}
				$no++;
			}
		} else {
			if ($sess_lev == 1) {
				$col = 6;
			} else {
				$col = 5;
			}
			$hasil .= '<tr><td colspan="' . $col . '" style="text-align:center;">Data Belum Ada / Tidak ditemukan</td></tr>';
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
		$id = $this->uri->segment(3);
		$this->_validate($id);
		$data = $this->_fetch();
		if ($id == "") {
			$this->admin->insert('jadwal', $data);
			$this->output->set_output(json_encode(array("status" => TRUE)));
		} else {
			$this->admin->update('jadwal', $data, ['id' => $id]);
			$this->output->set_output(json_encode(array("status" => TRUE)));
		}
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
}

/* End of file Jadwal_pelajaran.php */
/* Location: .//C/Users/Harry/AppData/Local/Temp/fz3temp-2/Jadwal_pelajaran.php */
