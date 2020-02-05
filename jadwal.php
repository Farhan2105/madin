<div class="x_panel">
    <div class="x_title">
        <h2><?= $title_head; ?></h2>

        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <div id="mess_alert">
            <?php
            if ($this->session->flashdata('alert')) {
                echo '<div class="alert alert-success alert-message">';
                echo $this->session->flashdata('alert');
                echo '</div>';
            }
            ?>
        </div>
        <div style="float:right">
            <a href="<?= base_url(); ?>item_guru/add_guru" class="btn btn-primary">Tambah Guru
            </a>

        </div>

        <table class="table table-striped table-bordered table-striped-bordered jambo_table bulk_action" id="datatable">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Mapel</th>
                    <th>Nama Guru</th>
                    <th>Lembaga</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($jadwal->result() as $items) :
                    ?>
                    <tr>
                        <td><?= $i++; ?></td>

                        <td>
                            <?php $jab = $this->admin->get_by_id('jabatan', $items->id_jabatan);
                            $nama_jab = $jab->row();
                            $nama_jabatan = $nama_jab->jabatan;
                            ?>
                            <?= $nama_jabatan; ?>
                        </td>
                        <td>
                            <?php $lem = $this->admin->get_by_id('lembaga', $items->id_lembaga);
                            $nama_lem = $lem->row();
                            $nama_lembaga = $nama_lem->lembaga;
                            ?>
                            <?= $nama_lembaga; ?>
                        </td>
                        <td>
                            <a href="<?= base_url(); ?>item_guru/detail/<?= $items->id; ?>" class="btn btn-success"><i class="fa fa-search-plus"></i></a>
                            <a href="<?= base_url(); ?>item_guru/update_guru/<?= $items->id; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                            <?php if ($sess_lev == 1) { ?>
                                <a href="<?= base_url(); ?>item_guru/delete_guru/<?= $items->id; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- jQuery -->
<!-- <script src="<?php echo base_url(); ?>admin_assets/js/jquery.min.js"></script> -->
<script>
    $('#mess_alert').slideUp('slow');
</script>