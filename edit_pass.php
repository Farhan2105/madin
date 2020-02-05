<div class="x_panel">
    <div class="x_title">
        <h2>Edit Password</h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <br />
        <div class="alert-warning" style="padding:10px">
            <h3>Peringatan !</h3>
            <p>Setelah password diperbarui, mohon login kembali</p>
        </div>
        <div class="clearfix"></div>
        <br />
        <form class="form-horizontal form-label-left" action="" method="post">

            <div class="form-group  <?= form_error('username') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Username
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="username" value="<?= $username; ?>">
                    <?= form_error('username') ?>
                </div>
            </div>

            <div class="form-group <?= form_error('password1') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Pasword Baru
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <input type="password" class="form-control col-md-7 col-xs-12" name="password1">
                    <em class="help-text">* Masukkan Password baru </em>
                    <?= form_error('password1') ?>
                </div>
            </div>

            <div class="form-group <?= form_error('password2') ? 'has-error' : null ?>">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Password Lama
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <input type="password" class="form-control col-md-7 col-xs-12" name="password2">
                    <em class="help-text">* Masukkan Password lama untuk konfirmasi perubahan</em>
                    <?= form_error('password2') ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                    <button type="submit" name="submit" class="btn btn-primary" value="Submit"> Simpan Perubahan</button>
                    <a href="<?= base_url('administrator'); ?>" class="btn btn-danger"><i class="fa fa-undo"></i> Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>