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
            <a href="<?= base_url(); ?>kelas/add_kelas" class="btn btn-primary">Tambah Kelas</a>
        </div>
        <table class="table table-bordered table-striped-bordered jambo_table bulk_action" id="datatable-buttons">
            <thead>
                <tr>
                    <th width="10px" class="text-center" style="vertical-align:middle">No</th>
                    <th height="30px" class="text-center" style="vertical-align:middle">Tingkat Kelas</th>
                    <th height="30px" class="text-center" style="vertical-align:middle">Wali Kelas</th>

                    <th class="text-center" style="vertical-align:middle">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($kelas->result() as $k) :
                    ?>
                <tr>
                    <td class="text-center" style="vertical-align:middle"><?= $i++; ?></td>
                    <td class="text-center" style="vertical-align:middle"><?= $k->kelas; ?></td>
                    <td class="text-center" style="vertical-align:middle">
                        <?php $gur = $this->admin->get_by_id('guru', $k->id_guru);
                            if ($gur->num_rows() > 0) {
                                $nama_gur = $gur->row();
                                $nama_guru = $nama_gur->nama;
                            } else {
                                $nama_guru = "Data Guru Belum Ada";
                            }
                            ?>
                        <?= $nama_guru; ?></td>
                    <td class="text-center" style="vertical-align:middle">
                        <a href="<?= base_url(); ?>kelas/detail_k/<?= $k->id; ?>" class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></a>
                        <a href="<?= base_url(); ?>kelas/update_kelas/<?= $k->id; ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                        <?php if ($sess_lev == 1) { ?>
                        <a href="<?= base_url(); ?>kelas/delete_kelas/<?= $k->id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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