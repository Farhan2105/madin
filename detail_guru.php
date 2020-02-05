<div class="x_panel">
    <div class="x_title">
        <h2>Detail Guru</h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <img src="<?= base_url(); ?>assets/upload/<?= $gambar; ?> " style="width:100%">
            </div>
            <div class="col-md-5 col-sm-6">
                <table class="table table-striped jambo_table bulk_action">
                    <tr>
                        <td width="150px">No Rekening</td>
                        <td>: <?= $nip; ?></td>
                    </tr>
                    <tr>
                        <td width="150px">NIK</td>
                        <td>: <?= $nik; ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Nama Lengkap</td>
                        <td>: <?= $nama; ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Username</td>
                        <td>: <?= $username; ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Kelamin</td>
                        <td>: <?php if ($kelamin == "L") {
                                    $lk = "laki-laki";
                                } else {
                                    $lk = "Perempuan";
                                } ?> <?= $lk; ?></td>
                    </tr>
                    <tr>
                        <td width="100px">No Telepon</td>
                        <td>: <?= $tlp; ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Jabatan</td>
                        <td>: <?php $jab = $this->admin->get_by_id('jabatan', $id_jabatan);
                                $nama_jab = $jab->row();
                                $nama_jabatan = $nama_jab->jabatan;
                                ?>
                            <?= $nama_jabatan; ?></td>
                    </tr>

                    <tr>
                        <td width="100px">Satminkal</td>
                        <td>: <?php $sts = $this->admin->get_by_id('status', $id_status);
                                if ($sts->num_rows() > 0) {
                                    $nama_sts = $sts->row();
                                    $nama_status = $nama_sts->s_status;
                                } else {
                                    $nama_status = "kosong";
                                }
                                ?>
                            <?= $nama_status; ?></td>
                    </tr>

                    <tr>
                        <td width="100px">Tahun Masuk</td>
                        <td>: <?php $prd = $this->admin->get_by_id('priode', $id_priode);
                                if ($prd->num_rows() > 0) {
                                    $nama_prd = $prd->row();
                                    $tahun_priode = $nama_prd->tahun;
                                } else {
                                    $tahun_priode = "kosong";
                                }
                                ?>
                            <?= $tahun_priode; ?></td>
                    </tr>

                    <tr>
                        <td width="100px">Bulan Masuk</td>
                        <td>: <?php $bln = $this->admin->get_by_id('bulan', $id_bulan);
                                if ($bln->num_rows() > 0) {
                                    $nama_bln = $bln->row();
                                    $priode_bulan = $nama_bln->nama;
                                } else {
                                    $priode_bulan = "kosong";
                                }
                                ?>
                            <?= $priode_bulan; ?></td>
                    </tr>

                    <tr>
                        <td width="100px">Lembaga</td>
                        <td>: <?php $lem = $this->admin->get_by_id('lembaga', $id_lembaga);
                                $nama_lem = $lem->row();
                                $nama_lembaga = $nama_lem->lembaga;
                                ?>
                            <?= $nama_lembaga; ?></td>
                    </tr>

                    <tr>
                        <td width="100px">Domisili</td>
                        <td>: <?= $alamat; ?></td>
                    </tr>
                </table>
                <a href="#" class="btn btn-default" onclick="window.history.go(-1)">Kembali</a>
            </div>
        </div>
    </div>
</div>