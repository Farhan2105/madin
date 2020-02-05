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

        <form class="form-horizontal form-label-left" action="" enctype="multipart/form-data" method="post">

            <div class="form-group <?= form_error('kelas') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Kelas
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" class="form-control col-md-7 col-xs-12" name="kelas" value="<?= $kelas; ?>">
                    <?= form_error('kelas') ?>
                </div>
            </div>

            <div class="form-group <?= form_error('id_guru') ? 'has-error' : null ?>">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Wali Kelas</label>
        <div class="col-md-4 col-sm-6">
            <select name="id_guru" class="form-control">
                <option value="">--Pilih Guru--</option>
                <?php foreach ($guru->result() as $b) : ?>
                    <option value="<?= $b->id; ?>" <?php if ($id_guru == $b->id) {
                                                        echo "selected";
                                                    } ?>>
                        <?= $b->nama ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= form_error('id_guru') ?>
        </div>
    </div>


            <div class="ln_solid"></div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success" name="submit" value="Submit">Simpan</button>
                    <a href="<?= base_url('kelas'); ?>" class="btn btn-primary"><i class="fa fa-undo"></i> Kembali</a>
                </div>
            </div>

        </form>
    </div>
</div>
<script>
    $('#mess_alert').delay(3000).slideUp('slow');
</script>