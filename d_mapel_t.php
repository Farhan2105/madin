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

            <div class="form-group <?= form_error('mapel') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama Mapel
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" class="form-control col-md-7 col-xs-12" name="mapel" value="<?= $mapel; ?>">
                    <?= form_error('mapel') ?>
                </div>
            </div>

            <div class="form-group <?= form_error('kitab') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama Kitab
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" class="form-control col-md-7 col-xs-12" name="kitab" value="<?= $kitab; ?>">
                    <?= form_error('kitab') ?>
                </div>
            </div>


            <div class="ln_solid"></div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success" name="submit" value="Submit">Simpan</button>
                    <a href="<?= base_url('daftar'); ?>" class="btn btn-primary"><i class="fa fa-undo"></i> Kembali</a>
                </div>
            </div>

        </form>
    </div>
</div>
<script>
    $('#mess_alert').delay(3000).slideUp('slow');
</script>