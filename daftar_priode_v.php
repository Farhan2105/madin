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
        <div style="float:right">
            <a href="<?= base_url(); ?>c_priode/add_priode" class="btn btn-primary">Tambah Priode</a>
        </div>
        <table class="table table-bordered table-striped-bordered jambo_table bulk_action" id="datatable">
            <thead>
                <tr>
                    <th width="10px" height="30px" class="text-center" style="vertical-align:middle">No</th>
                    <th class="text-center" style="vertical-align:middle">Tahun Priode</th>

                    <th class="text-center" style="vertical-align:middle">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($tahun->result() as $p) :
                    ?>
                    <tr>
                        <td class="text-center" style="vertical-align:middle"><?= $i++; ?></td>
                        <td class="text-center" style="vertical-align:middle"><?= $p->tahun; ?></td>
                        <td class="text-center" style="vertical-align:middle">

                            <a href="<?= base_url(); ?>c_priode/update_priode/<?= $p->id; ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                            <?php if ($sess_lev == 1) { ?>
                                <a href="<?= base_url(); ?>c_priode/delete_priode/<?= $p->id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#mess_alert').delay(3000).slideUp('slow');
</script>