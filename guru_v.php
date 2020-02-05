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

        <form class="form-horizontal form-label-left " action="" enctype="multipart/form-data" method="post">
            <div class=" item form-group <?= form_error('nip') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">NIP
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" class="form-control col-md-7 col-xs-12" name="nip" value="<?= $nip; ?>">
                    <?= form_error('nip') ?>
                </div>
            </div>

            <div class="form-group <?= form_error('nik') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">NIK
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" class="form-control col-md-7 col-xs-12" name="nik" value="<?= $nik; ?>">
                    <?= form_error('nik') ?>
                </div>
            </div>

            <div class="form-group <?= form_error('tlp') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">No Telepon
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" class="form-control col-md-7 col-xs-12" name="tlp" value="<?= $tlp; ?>">
                    <?= form_error('tlp') ?>
                </div>
            </div>

            <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama Lengkap
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" class="form-control col-md-7 col-xs-12" name="nama" value="<?= $nama; ?>">
                    <?= form_error('nama') ?>
                </div>
            </div>

            <div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Username
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" class="form-control col-md-7 col-xs-12" name="username" value="<?= $username; ?>">
                    <?= form_error('username') ?>
                </div>
            </div>

            <div class="form-group <?= form_error('foto') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Foto
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <?php
                    if (isset($gambar)) {
                        echo '<input type="hidden" name="old_pict" value="' . $gambar . '">';
                        echo '<img src ="' . $photo . '" width="30%">';
                    }
                    ?>
                    <div class="clear-fix">
                        </br>
                    </div>
                    <input type="file" class="form-control col-md-7 col-xs-12" name="foto">
                    <?= form_error('foto') ?>
                </div>
            </div>


            <div class="form-group ">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Kelamin</label>
                <div class="col-md-4 col-sm-6">
                    <select name="kelamin" class="form-control">
                        <option value="L" <?php if ($kelamin == "L") {
                                                echo "selected";
                                            } ?>>Laki-Laki</div>
                <option value="P" <?php if ($kelamin == "P") {
                                        echo "selected";
                                    } ?>>Perempuan</option>
                </select>
            </div>
    </div>

    <div class="form-group <?= form_error('alamat') ? 'has-error' : null ?>">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Domisili
        </label>
        <div class="col-md-7 col-sm-6 col-xs-12">
            <input type="text" class="form-control col-md-7 col-xs-12" name="alamat" value="<?= $alamat; ?>">
            <?= form_error('alamat') ?>
        </div>
    </div>

    <div class="form-group <?= form_error('id_jabatan') ? 'has-error' : null ?>">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Jabatan</label>
        <div class="col-md-4 col-sm-6">
            <select name="id_jabatan" class="form-control">
                <option value="">--Pilih Jabatan--</option>
                <?php foreach ($jabatan->result() as $a) : ?>
                    <option value="<?= $a->id; ?>" <?php if ($id_jabatan == $a->id) {
                                                            echo "selected";
                                                        } ?>>
                        <?= $a->jabatan ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= form_error('id_jabatan') ?>
        </div>
    </div>

    <div class="form-group <?= form_error('id_status') ? 'has-error' : null ?>">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Status</label>
        <div class="col-md-4 col-sm-6">
            <select name="id_status" class="form-control">
                <option value="">--Pilih Status--</option>
                <?php foreach ($status->result() as $s) : ?>
                    <option value="<?= $s->id; ?>" <?php if ($id_status == $s->id) {
                                                            echo "selected";
                                                        } ?>>
                        <?= $s->s_status ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= form_error('id_status') ?>
        </div>
    </div>


    <div class="form-group <?= form_error('id_bulan') ? 'has-error' : null ?>">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Bulan</label>
        <div class="col-md-4 col-sm-6">
            <select name="id_bulan" class="form-control">
                <option value="">--Pilih Bulan--</option>
                <?php foreach ($bulan->result() as $b) : ?>
                    <option value="<?= $b->id; ?>" <?php if ($id_bulan == $b->id) {
                                                            echo "selected";
                                                        } ?>>
                        <?= $b->nama; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= form_error('id_bulan') ?>
        </div>
    </div>

    <div class="form-group <?= form_error('id_priode') ? 'has-error' : null ?>">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Priode</label>
        <div class="col-md-4 col-sm-6">
            <select name="id_priode" class="form-control">
                <option value="">--Pilih Priode--</option>
                <?php foreach ($priode->result() as $p) : ?>
                    <option value="<?= $p->id; ?>" <?php if ($id_priode == $p->id) {
                                                            echo "selected";
                                                        } ?>>
                        <?= $p->tahun ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= form_error('id_priode') ?>
        </div>
    </div>

    <div class="form-group <?= form_error('id_lembaga') ? 'has-error' : null ?>">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Lembaga</label>
        <div class="col-md-4 col-sm-6">
            <select name="id_lembaga" class="form-control">
                <option value="">--Pilih Lembaga--</option>
                <?php foreach ($lembaga->result() as $b) : ?>
                    <option value="<?= $b->id; ?>" <?php if ($id_lembaga == $b->id) {
                                                            echo "selected";
                                                        } ?>>
                        <?= $b->lembaga ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= form_error('id_lembaga') ?>
        </div>
    </div>

    <div class="form-group <?= form_error('id_level') ? 'has-error' : null ?>">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Level</label>
        <div class="col-md-4 col-sm-6">
            <select name="id_level" class="form-control">
                <option value="">--Pilih Level Pengguna--</option>
                <?php foreach ($level->result() as $c) : ?>
                    <option value="<?= $c->id; ?>" <?php if ($id_level == $c->id) {
                                                            echo "selected";
                                                        } ?>>
                        <?= $c->level ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= form_error('id_level') ?>
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">ID Gaji
        </label>
        <div class="col-md-4 col-sm-6">
            <input class="form-control col-md-7 col-xs-12" type="number" name="id_gaji" value="<?= $id_gaji; ?>">
            <p class="help_text">* Sesuai Id tabel guru</p>
        </div>
    </div> -->





    <div class="ln_solid"></div>

    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success" name="submit" value="Submit">Submit</button>
            <a href="<?= base_url('item_guru'); ?>" class="btn btn-primary"><i class="fa fa-undo"></i> Back</a>

        </div>
    </div>

    </form>
</div>
<script>
    $('#mess_alert').delay(3000).slideUp('slow');
</script>