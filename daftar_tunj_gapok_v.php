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
        <table class="table table-bordered table-striped-bordered jambo_table bulk_action" id="datatable">
            <thead>
                <tr>
                    <th width="10px" height="30px" class="text-center" style="vertical-align:middle">No</th>
                    <th class="text-center" style="vertical-align:middle">Insentif Kehadiran</th>
                    <th class="text-center" style="vertical-align:middle">Gaji Pokok</th>
                    <th class="text-center" style="vertical-align:middle">Wali Kelas</th>

                    <th class="text-center" style="vertical-align:middle">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($gaji->result() as $g) :
                    ?>
                    <tr>
                        <td class="text-center" style="vertical-align:middle"><?= $i++; ?></td>
                        <td class="text-center" style="vertical-align:middle"><?= number_format($g->nominal, 0, ',', '.'); ?></td>
                        <td class="text-center" style="vertical-align:middle"><?= number_format($g->gaji_pokok, 0, ',', '.'); ?></td>
                        <td class="text-center" style="vertical-align:middle"><?= number_format($g->walas, 0, ',', '.'); ?></td>
                        <td class="text-center" style="vertical-align:middle">

                            <?php if ($sess_lev == 1) { ?>
                            <a href="<?= base_url(); ?>daftar_tunj/update_nom/<?= $g->id; ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                            
                                
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