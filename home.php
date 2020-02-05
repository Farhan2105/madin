<?php if ($this->session->userdata('level') == 1) { ?>
    <!-- INI UNTUK TAMPILAN ADMIN -->

    <div class="tile-stats">
        <div class="col-sm-6 col-md-12">
            <div class="text-center">
                <img class="logo-inv img img-responsive" src="<?= base_url() . "assets/image/mdnj2.png" ?>" style="display: block; margin: auto;" width="30%" alt="logo-lembaga">

                <div class="title-head">
                    <h3 class="text-center" style="color:black">MADRASAH DINIYAH</h3>
                    <h2 class="text-center" style="color:black">PONDOK PESANTREN NURUL JADID</h2>
                    <h5 class="text-center" style="color:black">Paiton Probolinggo</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="tile-stats">
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="count"><?= $jumlah_guru; ?></div>
                    <h3>Data Guru</h3>
                    <p>Semua Guru Madrasah Diniyah</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-pie-chart"></i></div>
                    <div class="count"><?= $jumlah_kelas; ?></div>
                    <h3>Jumlah Kelas</h3>
                    <p>Semua Kelas Madrasah Diniyah</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-book"></i></div>
                    <div class="count"><?= $jumlah_mapel; ?></div>
                    <h3>Jumlah Mapel</h3>
                    <p>Semua Mapel Madrasah Diniyah</p>
                </div>
            </div>
        </div>
    </div>



<?php } elseif ($this->session->userdata('level') == 2) { ?>

    <style type="text/css">
        .bulat {
            border-radius: 100em;
            opacity: 5;
            width: 115px;
            height: 115px;
        }
    </style>
    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
        <div class="well profile_view">
            <div class="col-sm-12">
                <h4 class="brief"><i>Profil Guru</i></h4>
                <div class="left col-xs-7">
                    <h2><?= $nama; ?></h2>
                    <p><strong>About: </strong> Bertugas Guru Piket di Lembaga : <?php $lem = $this->admin->get_by_id('lembaga', $id_lembaga);
                                                                                        $nama_lem = $lem->row();
                                                                                        $nama_lembaga = $nama_lem->lembaga;
                                                                                        ?>
                        <?= $nama_lembaga; ?> </p>
                    <ul class="list-unstyled">
                        <li>Jabatan : <?php $jab = $this->admin->get_by_id('jabatan', $id_jabatan);
                                            $nama_jab = $jab->row();
                                            $nama_jabatan = $nama_jab->jabatan;
                                            ?>
                            <?= $nama_jabatan; ?> </li>
                        <li>Username : <?= $username; ?> </li>
                    </ul>
                </div>
                <div class="right col-xs-5 text-center">
                    <img src="<?= base_url(); ?>assets/upload/<?= $this->session->userdata('gambar') ?>" alt="" class=" bulat img-circle img-responsive">
                </div>
            </div>
            <div class="col-xs-12 bottom text-center" style="background-color:#d2cfcb !important;">
                <div class="col-xs-12 col-sm-6 emphasis">
                    <a type="button" href="<?php echo base_url('b_lap_guru/detail_personal'); ?>" class="btn btn-success btn-xs">
                        <i class="fa fa-user"></i> <?= $nama; ?></a>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Jadwal KBM Hari <b> <?= $hari_ini; ?></b></h2>
                <div class="clearfix"></div>
            </div>


            <div class="x_content">
                <ul class="list-unstyled timeline">
                    <?php foreach ($jadwal_hari_ini->result()  as $ini) :
                            $hari2 = $ini->hari;
                            $id_kelas2 = $ini->id_kelas;
                            $id_jam2 = $ini->id_jam;
                            $id_mapel2 = $ini->id_mapel;
                            $id_guru2 = $ini->id_guru;
                            $id_lembaga2 = $ini->id_lembaga;
                            $get_jam2 = $this->admin->get_by_id('jam_masuk', $id_jam2)->row();
                            $get_kelas2 = $this->admin->get_by_id('kelas', $id_kelas2)->row();
                            $get_mapel2 = $this->admin->get_by_id('mapel', $id_mapel2)->row();
                            $cari_guru = $this->admin->get_by_id('guru', $id_guru2);
                            if ($cari_guru->num_rows() > 0) {
                                $get_guru2 = $cari_guru->row();
                                $nama_guru = $get_guru2->nama;
                            } else {
                                $nama_guru = "tidak ada";
                            }
                            // $nama_guru = $get_guru2->nama;
                            ?>
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="" class="tag">
                                        <span><?= $nama_guru; ?></span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a>Kelas : <?= $get_kelas2->kelas ?></a>
                                    </h2>
                                    <div class="byline">
                                        <span><?= $get_jam2->label ?></span> <a> Jam-Ke - <?= $get_jam2->jam ?></a>
                                    </div>
                                    <p class="excerpt"><a> Mata Pelaran : <b><?= $get_mapel2->mapel ?> </b>
                                            <p>Dengan Kitab : <b><?= $get_mapel2->kitab ?></b></p>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div>
    </div>



<?php } else { ?>
    <style type="text/css">
        .bulat {
            border-radius: 100em;
            opacity: 5;
            width: 115px;
            height: 115px;
        }
    </style>
    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
        <div class="well profile_view">
            <div class="col-sm-12">
                <h4 class="brief"><i>Profil Guru</i></h4>
                <div class="left col-xs-7">
                    <h2><?= $nama; ?></h2>
                    <p><strong>About: </strong> Mengajar di Lembaga : <?php $lem = $this->admin->get_by_id('lembaga', $id_lembaga);
                                                                            $nama_lem = $lem->row();
                                                                            $nama_lembaga = $nama_lem->lembaga;
                                                                            ?>
                        <?= $nama_lembaga; ?> </p>
                    <ul class="list-unstyled">

                        <li>Jabatan : <?php $jab = $this->admin->get_by_id('jabatan', $id_jabatan);
                                            $nama_jab = $jab->row();
                                            $nama_jabatan = $nama_jab->jabatan;
                                            ?>
                            <?= $nama_jabatan; ?> </li>
                        <li>Username : <?= $username; ?> </li>
                    </ul>
                </div>
                <div class="right col-xs-5 text-center">
                    <img src="<?= base_url(); ?>assets/upload/<?= $this->session->userdata('gambar') ?>" alt="" class="bulat img-circle img-responsive">
                </div>
            </div>
            <div class="col-xs-12 bottom text-center" style="background-color:#d2cfcb !important;">

                <div class="col-xs-12 col-sm-6 emphasis">
                    <a href="<?php echo base_url('b_lap_guru/detail_personal'); ?>" type="button" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"> </i> <?= $nama; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>






    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Jadwal Mengajar</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="list-unstyled timeline">
                    <?php foreach ($jadwal_ajar->result()  as $jad) {
                            $hari = $jad->hari;
                            $id_kelas = $jad->id_kelas;
                            $id_jam = $jad->id_jam;
                            $id_mapel = $jad->id_mapel;
                            $id_guru = $jad->id_guru;
                            $id_lembaga = $jad->id_lembaga;
                            $get_jam = $this->admin->get_by_id('jam_masuk', $id_jam)->row();
                            $get_kelas = $this->admin->get_by_id('kelas', $id_kelas)->row();
                            $get_mapel = $this->admin->get_by_id('mapel', $id_mapel)->row();
                            ?>
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="" class="tag">
                                        <span><?= $hari ?></span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a>Kelas : <?= $get_kelas->kelas ?></a>
                                    </h2>
                                    <div class="byline">
                                        <span><?= $get_jam->label ?></span> <a> Jam-Ke - <?= $get_jam->jam ?></a>
                                    </div>
                                    <p class="excerpt"><a> Anda Mengajar Mata Pelaran : <b><?= $get_mapel->mapel ?> </b>
                                            <p>Dengan Kitab : <b><?= $get_mapel->kitab ?></b></p>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>

            </div>
        </div>
    </div>
    <div class="tile-stats">
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-line-chart"></i></div>
                    <div class="count"><?= $percent; ?></div>
                    <h3>Prosentase Kehadiran</h3>
                    <p>Total Prosentase Kehadiran Bulan <?= $bulan; ?> Tahun <?= $tahun; ?></p>
                </div>
            </div>
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-money"></i></div>
                    <div class="count"> Rp. <?= number_format($gaji, 0, ',', '.'); ?></div>
                    <h3>Bisyaroh di Terima</h3>
                    <p>Jumlah Bisyaroh Yang di Terima Bulan <?= $bulan; ?> Tahun <?= $tahun; ?></p>
                </div>
            </div>


        <?php
        } ?>
        </div>
    </div>