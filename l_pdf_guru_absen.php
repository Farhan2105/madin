<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Absensi Guru</title>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>admin_assets/js/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>admin_assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>
    <style type="text/css">
        .logo-inv {
            width: 90px;
            position: absolute;
            margin-top: -8px;
        }

        .title-head {
            margin-top: 30px;
            margin-left: 120px;
            text-align: left;
        }

        .title-head h3 {
            margin-bottom: -10px;
        }

        .garis {
            border-top: 1px solid #afbcc6;
            border-bottom: 1px solid #eff2f6;
            height: 0px;
            margin-bottom: 20px;
        }
    </style>
    <div class="container">
        <div class="row">
            <main>
                <div>
                    <img class="logo-inv img img-responsive" src="<?= base_url() . "assets/image/mdnj2.png" ?>" alt="logo-lembaga">
                </div>
                <div class="title-head">
                    <h3>DATA KEHADIRAN GURU</h3>
                    <h1>MADRASAH DINIYAH NURUL JADID</h1>
                    <h5>Paiton Probolinggo</h5>
                </div>
                <table id="table_wrapper" class="table table-responsive table-bordered bulk_action" border="1" width="75%">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align:middle">NO</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle">NAMA</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle">JABATAN</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle">SATMINKAL</th>
                            <th colspan="4" class="text-center" style="vertical-align:middle">ABSENSI</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle">WAJIB HADIR</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle">KETERANGAN</th>
                        </tr>
                        <tr>
                            <td class="text-center" style="vertical-align:middle">S</td>
                            <td class="text-center" style="vertical-align:middle">I</td>
                            <td class="text-center" style="vertical-align:middle">A</td>
                            <td class="text-center" style="vertical-align:middle">H</td>
                    </thead>
                    <tbody>
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
                                $nama_jabatan = $nama_jab->jabatan;

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

                                $nm_lembaga = $this->admin->get_by_id('lembaga', $id_lembaga);
                                if ($nm_lembaga->num_rows() > 0) {
                                    $dt_lembaga = $nm_lembaga->row();
                                    $nama_lembaga = $dt_lembaga->lembaga;
                                } else {
                                    $nama_lembaga = "invalid";
                                }

                                //status
                                $sts = $this->admin->get_by_id('status', $key->id_status);
                                if ($sts->num_rows() > 0) {
                                    $nama_sts = $sts->row();
                                    $nama_status = $nama_sts->s_status;
                                } else {
                                    $nama_status = "kosong";
                                }
                                //jabatan
                                $jab = $this->admin->get_by_id('jabatan', $key->id_jabatan);
                                if ($jab->num_rows() > 0) {
                                    $nama_jab = $jab->row();
                                    $nama_jabatan = $nama_jab->jabatan;
                                } else {

                                    $nama_jabatan = "Kosong";
                                }
                                // priode bulan
                                $bln = $this->admin->get_by_id('bulan', $key->id_bulan);
                                if ($bln->num_rows() > 0) {
                                    $nama_bln = $bln->row();
                                    $bulan_priode = $nama_bln->nama;
                                } else {
                                    $bulan_priode = "Kosong";
                                }
                                //priode tahun
                                $prd = $this->admin->get_by_id('priode', $key->id_priode);
                                if ($prd->num_rows() > 0) {
                                    $nama_prd = $prd->row();
                                    $tahun_priode = $nama_prd->tahun;
                                } else {
                                    $tahun_priode = "Kosong";
                                }
                                //lamanya tahun
                                $lm_tahun = $tahun_priode - $tahun;
                                ?>

                        <tr>
                            <td style="vertical-align:middle" class="text-center"><?= $no++ ?></td>
                            <td style="vertical-align:middle" class="text-center"><?= $key->nama ?></td>
                            <td style="vertical-align:middle" class="text-center"><?= $nama_jabatan ?></td>
                            <td style="vertical-align:middle" class="text-center"><?= $nama_status ?></td>
                            <td style="vertical-align:middle" class="text-center"><?= $sakit; ?></td>
                            <td style="vertical-align:middle" class="text-center"><?= $ijin; ?></td>
                            <td style="vertical-align:middle" class="text-center"><?= $alpha; ?></td>
                            <td style="vertical-align:middle" class="text-center"><?= $hadir; ?></td>
                            <td style="vertical-align:middle" class="text-center"><?= $harusnya_hadir; ?></td>
                            <td style="vertical-align:middle" class="text-right"><?= $ket; ?></td>
                        </tr>
                        <?php
                            } ?>
                        <?php
                        } else { ?>
                        <h1>Belum Ada Data </h1>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </main>

        </div><!-- row -->
    </div><!-- container -->

</body>


<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>admin_assets/js/bootstrap.min.js"></script>

<script>
    // function printContent(el){
    //     var restorepage = document.body.innerHTML;
    //     var printcontent = document.getElementById(el).innerHTML;
    //     document.body.innerHTML = printcontent;
    //     window.print();
    //     document.body.innerHTML = restorepage;
    // }

    $(document).ready(function() {
        window.print();
    })
</script>

</body>

</html>