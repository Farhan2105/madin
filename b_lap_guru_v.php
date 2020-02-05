<div class="x_panel">
    <div class="x_title">
        <h2><?= $title_head; ?></h2>
        <div class="clearfix"></div>
    </div>
    <div id="mess_alert">
        <?php
        if ($this->session->flashdata('alert')) {
            echo '<div class="alert alert-success alert-message">';
            echo $this->session->flashdata('alert');
            echo '</div>';
        }
        ?>
    </div>

    <div class="x_content">
        <br />
        <form class="form-vertical form-label-left " action="" enctype="multipart/form-data" method="post">
            <div class="form-group <?= form_error('id_lembaga') ? 'has-error' : null ?>">
                <div class="col-md-3 col-xs-12">
                    <?php if ($sess_lev == 1) { ?>
                    <select name="id_lembaga" class="form-control">
                        <option value="">--Pilih Lembaga--</option>
                        <?php foreach ($lembaga->result() as $b) : ?>
                        <option value="<?= $b->id; ?>" <?php if ($id_lembaga == $b->id) {
                                                                    echo "selected";
                                                                } ?>>
                            <?= $b->lembaga ?>
                            <?php endforeach; ?>
                        </option>
                    </select>
                    <?php } elseif ($sess_lev == 2) { ?>
                    <?php $id_piket = $this->session->userdata('id_pengguna');
                        $cek_data = $this->admin->get_by_id('guru', $id_piket);
                        $get = $cek_data->row();
                        $id_lembagaa = $get->id_lembaga;
                        ?>

                    <?php $lmg = $this->admin->get_by_id('lembaga', $id_lembagaa);
                        if ($lmg->num_rows() > 0) {
                            $nama_lmg = $lmg->row();
                            $nama_lembaga = $nama_lmg->lembaga;
                        } ?>



                    <input type="hidden" name="id_lembaga" class="form-control" value="<?= $id_lembagaa ?>">
                    <input type="text" name="" class="form-control" value="<?= $nama_lembaga ?>" readonly>


                    <?php } ?>
                    <?= form_error('id_lembaga') ?>
                </div>
            </div>

            <div class="form-group <?= form_error('bulan') ? 'has-error' : null ?>">
                <div class="col-md-3 col-xs-12">
                    <select name="bulan" class="form-control">
                        <?php foreach ($nm_bulan->result() as $c) : ?>
                        <option value="<?= $c->id; ?>" <?php if ($bulan == $c->id) {
                                                                echo "selected";
                                                            } ?>>
                            <?= $c->nama ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('bulan') ?>
                </div>
            </div>
            <div class="form-group <?= form_error('tahun') ? 'has-error' : null ?>">
                <div class="col-md-3 col-xs-12">
                    <input type="text" name="tahun" class="form-control" value="<?= $tahun; ?>" readonly />
                    <?= form_error('tahun') ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-xs-12">
                    <button type="submit" class="btn btn-primary" name="submit" value="Submit"><i class="fa fa-search"></i> Cari</button>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-download"></i> Export <span class="caret"></span>
                        </button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="<?= base_url('b_lap_guru/print_dat_guru/') . $id_lembaga . '/' . $bulan . '/' . $tahun; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></li>
                            <li><a href="<?= base_url('b_lap_guru/export_exel_guru/') . $id_lembaga . '/' . $bulan . '/' . $tahun; ?>" target="_blank"><i class="fa fa-file-text-o"></i> Exel Guru</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </form>
        <br>

        <!-- INI TABEL DATANTYA -->
        <!-- table table-bordered table-responsive dt-responsive bulk_action nowrap -->
        <table id="datatable" class="table table-responsive table-bordered bulk_action">
            <tr>
                <th rowspan="2" class="text-center" style="vertical-align:middle">No</th>
                <th rowspan="2" class="text-center" style="vertical-align:middle">Nama</th>
                <th rowspan="2" class="text-center" style="vertical-align:middle">Jabatan</th>
                <th rowspan="2" class="text-center" style="vertical-align:middle">Satminkal</th>
                <th colspan="4" class="text-center">Absensi</th>
                <th rowspan="2" class="text-center" style="vertical-align:middle" class="text-center">% Hadir</th>
                <th rowspan="2" class="text-center" style="vertical-align:middle" class="text-center">Wajib Hadir</th>
                <th rowspan="2" class="text-center" style="vertical-align:middle">Keterangan</th>
            </tr>
            <tr>
                <th style="vertical-align:middle" class="text-center">S</th>
                <th style="vertical-align:middle" class="text-center">I</th>
                <th style="vertical-align:middle" class="text-center">A</th>
                <th style="vertical-align:middle" class="text-center">H</th>
            </tr>
            <?php if ($uri == 1) { ?>
            <?php $no = 1;
                foreach ($guru->result() as $key) {

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

                    $gaji = ($jumlah_hadir - $jml_ijin - $jml_sakit) * $nominal;

                    // pencarian Wali Kelas
                    $cari_walas = $this->admin->get_where('kelas', ['id_guru' => $key->id]);
                    $cari_walas->num_rows() > 0 ? $ada_walas = $nom_walas : $ada_walas = 0;

                    // INI UNTUK GAPOK
                    $jml_jdwl_seminggu = $this->admin->_count_where('jadwal', ['id_guru' => $key->id]);
                    $jml_jdwl_seminggu >= 12 ? $gapok = $nom_gapok : $gapok = 0;

                    //gaji Struktural
                    $nom_jab = $this->admin->get_by_id('jabatan', $key->id_jabatan);
                    $nama_jab = $nom_jab->row();
                    $nom_struktural = $nama_jab->tunjangan;

                    //Jumlah Bisyaroh
                    $jml_bisyaroh = $gaji + $ada_walas + $gapok + $nom_struktural;

                    if ($percent == 0) {
                        $ket = "Belum Ada Jadwal";
                        $color = "Black";
                    } else if ($percent > 80) {
                        $ket = "Valid";
                        $color = "green";
                    } else {
                        $ket = "Pemanggilan / SP";
                        $color = "red";
                    }

                    ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td class="text-center"><?= $key->nama; ?></td>
                <td class="text-center"><?php $jab = $this->admin->get_by_id('jabatan', $key->id_jabatan);
                                                $nama_jab = $jab->row();
                                                $nama_jabatan = $nama_jab->jabatan;
                                                ?>
                    <?= $nama_jabatan; ?></td>

                <td class="text-center"><?php $sts = $this->admin->get_by_id('status', $key->id_status);
                                                if ($sts->num_rows() > 0) {
                                                    $nama_sts = $sts->row();
                                                    $nama_status = $nama_sts->s_status;
                                                } else {
                                                    $nama_status = "kosong";
                                                }
                                                ?>
                    <?= $nama_status; ?></td>

                <td style="vertical-align:middle" class="text-center"><?= $sakit; ?></td>
                <td style="vertical-align:middle" class="text-center"><?= $ijin; ?></td>
                <td style="vertical-align:middle" class="text-center"><?= $alpha; ?></td>
                <td style="vertical-align:middle" class="text-center"><?= $hadir; ?></td>
                <td style="vertical-align:middle" class="text-center"><?= number_format($percent); ?><?= $string; ?></td>
                <td style="color:<?= $color ?>" class="text-center"><?= $harusnya_hadir; ?></td>
                <td style="color:<?= $color ?>" class="text-center"><?= $ket; ?></td>
            </tr>
            <?php
                } ?>
            <?php
            } else { ?>
            <tr>
                <td colspan="19" class="text-center">Belum Ada Data</td>
            </tr>
            <?php
            } ?>
        </table>
    </div>

</div>
<script>
    $('#mess_alert').delay(3000).slideUp('slow');
</script>