<div class="x_panel">
    <div class="x_title">
        <h2>Detail Bisyaroh</h2>
        <div class="clearfix"></div>
    </div>
    <br>
    <form class="form-vertical form-label-left " action="" enctype="multipart/form-data" method="post">
        <div class="form-group <?= form_error('bulan') ? 'has-error' : null ?>">
            <div class="col-md-3 col-xs-12">
                <select name="bulan" class="form-control">
                    <option value="">--Pilih Bulan--</option>
                    <?php foreach ($nm_bulan->result() as $d) : ?>
                    <option value="<?= $d->id; ?>" <?php if ($bulan == $d->id) {
                                                            echo "selected";
                                                        } ?>>
                        <?= $d->nama ?>
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
                <button type="submit" class="btn btn-primary" name="submit" value="Submit"><i class="fa fa-search"></i> Lihat</button>

            </div>
    </form>
    </br>

    <div class="x_content">

        <div class="row">


            <div class="col-md-5 col-sm-6">

                <table class="table table-striped jambo_table bulk_action">


                    <tr>
                        <td width="150px">No. Rek</td>
                        <td>: <?= $nip ?> </td>
                    </tr>
                    <tr>
                        <td width="100px">Nama</td>
                        <td>: <?= $nama ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Jabatan</td>
                        <td>: <?= $jabatan ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Prosentase Kehadiran</td>
                        <td>: <?= number_format($persen); ?><?= $string; ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Insentif Kehadiran</td>
                        <td>: <?= number_format($inhadir, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Gaji Pokok</td>
                        <td>: <?= number_format($gapok, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Wali Kelas</td>
                        <td>: <?= number_format($walas, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Struktural</td>
                        <td>: <?= number_format($struktur, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td width="100px">Jumlah Bisyaroh</td>
                        <td>: <?= number_format($jumlah, 0, ',', '.'); ?></td>
                    </tr>

                </table>
                <a href="<?= base_url('administrator'); ?>" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </div>
</div>