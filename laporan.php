<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Slip Bisyaroh Madin</title>
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
                    ?>
                    <!-- contentnya -->
                    <div class="col-md-12">

                        <div class="header-inv">
                            <img class="logo-inv img img-responsive" src="<?= base_url() . "assets/image/mdnj2.png" ?>" alt="logo-lembaga">
                        </div>
                        <div class="title-head">
                            <h3>MADRASAH DINIYAH</h3>
                            <h4>PONDOK PESANTREN NURUL JADID</h4>
                            <h5>PAITON PROBOLINGGO</h5>
                        </div>

                        <div class="garis"></div>
                    </div>
                    <div class="col-md-6">
                        <table style="margin-left: 10px;">
                            <tr>
                                <td width="80"><b>Nama</b></td>
                                <td>: <?= $key->nama; ?></td>
                            </tr>
                            <tr>
                                <td width="80"><b>Lembaga</b></td>
                                <td>: <?= $nama_lembaga ?></td>
                            </tr>
                            <tr>
                                <td width="80"><b>Jabatan</b></td>
                                <td>: <?= $nama_jabatan ?></td>
                            </tr>
                            <tr>
                                <td width="80"><b>No. Rek</b></td>
                                <td>: <?= $key->nip ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div style="float:right">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="140"><b>Bisyaroh Bulan</b></td>
                                    <td>: <?= $nm_bulan ?> <?= $tahun ?></td>
                                </tr>

                                <tr>
                                    <td><b>Printed Tanggal</b></td>
                                    <td>: <?= $tanggal ?></td>
                                </tr>
                            </table>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="garis"></div>
                    </div>
                    <div class="col-md-6">
                        <h5>Sistem Pembayaran : Tunai</h5>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td width="140"><b>Struktural</b></td>
                                <td class="text-right">Rp.<?= number_format($nom_struktural, 0, ',', '.'); ?></td>
                            <tr>
                            <tr>
                                <td width="140"><b>Insentif Kehadiran</b></td>
                                <td class="text-right">Rp.<?= number_format($gaji, 0, ',', '.'); ?></td>
                            <tr>
                                <td><b>Gaji Pokok</b></td>
                                <td class="text-right">Rp.<?= number_format($gapok, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><b>Tunjangan Walas</b></td>
                                <td class="text-right">Rp.<?= number_format($ada_walas, 0, ',', '.'); ?></td>
                            </tr>
                        </table>
                        <!-- <div class="garis"></div> -->
                        <table class="table">
                            <tr>
                                <td width="180"><b>Jumlah Keseluruhan :</b></td>
                                <td class="text-right"><b> Rp.<?= number_format($jml_bisyaroh, 0, ',', '.'); ?></b></td>
                            <tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="garis"></div>
                    </div>
                <?php
                } ?>
            <?php
            } else { ?>
                <h1>Belum Ada Data </h1>
            <?php
            } ?>

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