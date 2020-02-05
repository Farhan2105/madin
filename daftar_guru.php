<div class="col-md-12 col-sm-12 col-xs-12">
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
                <a href="<?= base_url(); ?>item_guru/add_guru" class="btn btn-primary">Tambah Guru</a>
            </div>
            <table id="datatable-buttons" class="table table-bordered table-respoonsive table-striped nowrap jambo_table">
                <thead>
                    <tr>
                        <th width="5%" height="30px" style="vertical-align:middle">No</th>
                        <th class="text-center" style="vertical-align:middle">NIK</th>
                        <th class="text-center" style="vertical-align:middle">No Telp</th>
                        <th class="text-center" style="vertical-align:middle">Nama Guru</th>
                        <th width="5%" class="text-center" style="vertical-align:middle">Kelamin</th>
                        <th class="text-center" style="vertical-align:middle">Alamat</th>
                        <th class="text-center" style="vertical-align:middle">Jabatan</th>
                        <th class="text-center" style="vertical-align:middle">Satminkal</th>
                        <!-- <th colspan="2" class="text-center" style="vertical-align:middle">Priode</th> -->
                        <th class="text-center" style="vertical-align:middle">Bulan</th>
                        <th class="text-center" style="vertical-align:middle">Tahun</th>
                        <th class="text-center" style="vertical-align:middle">Lembaga</th>
                        <th class="text-center" style="vertical-align:middle">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($guru->result() as $items) :
                    ?>
                        <tr>
                            <td class="text-center" style="vertical-align:middle"><?= $i++; ?></td>
                            <td class="text-center" style="vertical-align:middle"><?= $items->nik; ?></td>
                            <td class="text-center" style="vertical-align:middle"><?= $items->tlp; ?></td>
                            <td class="text-center" style="vertical-align:middle"><?= $items->nama; ?></td>
                            <td class="text-center" style="vertical-align:middle"><?= $items->kelamin; ?></td>
                            <td class="text-center" style="vertical-align:middle"><?= $items->alamat; ?></td>

                            <td class="text-center" style="vertical-align:middle">
                                <?php $jab = $this->admin->get_by_id('jabatan', $items->id_jabatan);
                                $nama_jab = $jab->row();
                                $nama_jabatan = $nama_jab->jabatan;
                                ?>
                                <?= $nama_jabatan; ?>
                            </td>

                            <td class="text-center" style="vertical-align:middle">
                                <?php $sts = $this->admin->get_by_id('status', $items->id_status);
                                if ($sts->num_rows() > 0) {
                                    $nama_sts = $sts->row();
                                    $nama_status = $nama_sts->s_status;
                                } else {
                                    $nama_status = "kosong";
                                }
                                ?>
                                <?= $nama_status; ?>
                            </td>

                            <td class="text-center" style="vertical-align:middle">
                                <?php $bulann = $this->admin->get_by_id('bulan', $items->id_bulan);
                                if ($bulann->num_rows() > 0) {
                                    $n_bln = $bulann->row();
                                    $nama_bulan = $n_bln->nama;
                                } else {
                                    $nama_bulan = "";
                                }
                                ?>
                                <?= $nama_bulan; ?>
                            </td>

                            <td class="text-center" style="vertical-align:middle">
                                <?php $prd = $this->admin->get_by_id('priode', $items->id_priode);
                                if ($prd->num_rows() > 0) {
                                    $nama_prd = $prd->row();
                                    $nama_priode = $nama_prd->tahun;
                                } else {
                                    $nama_priode = "Kosong";
                                }
                                ?>

                                <?= $nama_priode; ?>
                            </td>

                            <td class="text-center" style="vertical-align:middle">
                                <?php $lem = $this->admin->get_by_id('lembaga', $items->id_lembaga);
                                $nama_lem = $lem->row();
                                $nama_lembaga = $nama_lem->lembaga;
                                ?>
                                <?= $nama_lembaga; ?>
                            </td>
                            <td class="text-center" style="vertical-align:middle">
                                <a href=" <?= base_url(); ?>item_guru/detail/<?= $items->id; ?>" class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></a>
                                <a href="<?= base_url(); ?>item_guru/update_guru/<?= $items->id; ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                <?php if ($sess_lev == 1) { ?>
                                    <a href="<?= base_url(); ?>item_guru/delete_guru/<?= $items->id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                <?php } ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- jQuery -->
<!-- <script src="<?php echo base_url(); ?>admin_assets/js/jquery.min.js"></script> -->
<script>
    $('#mess_alert').delay(3000).slideUp('slow');
</script>