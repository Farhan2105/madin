
<div class="x_panel">
  <div class="x_title">
    <h2><?= $title_head; ?></h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <!-- INI TABELNYA -->
    <table class="table table-responsive table-striped">
        <tr>
          <th>Kelas</th>
          <th>Jam-Ke</th>
          <th>Mapel</th>
          <th>Nama Guru</th>
          <th>Status</th>
          <th>Edit</th>
        </tr>
        <?php foreach ($absensi as $key) {
          $id_jadwal = $key->id_jadwal;
          $id = $key->id;
          $jadwal = $this->admin->get_where('jadwal', ['id'=>$id_jadwal])->row();
          $kelas = $this->admin->get_where('kelas', ['id'=>$jadwal->id_kelas])->row();
          $jam = $this->admin->get_where('jam_masuk', ['id'=>$jadwal->id_jam])->row();
          $mapel = $this->admin->get_where('mapel', ['id'=>$jadwal->id_mapel])->row();
          $guru = $this->admin->get_where('guru', ['id'=>$jadwal->id_guru])->row();

          $status = $key->absensi; //1=hadir, 2=ijin, 3=sakit, 0=alpha
          
          ?>
        <tr>
          <td><?=$kelas->kelas?></td>
          <td><?=$jam->jam?> - <?=$jam->label?></td>
          <td><?=$mapel->mapel?> (<?=$mapel->kitab?>)</td>
          <td><?=$guru->nama?></td>
          <?php if ($status == 1) {?>
            <td><span class="label label-success"> Masuk</span></td>
            <td>
              <div class="dropdown">
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="menu11" data-toggle="dropdown">Edit 
                <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/3">Sakit</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/2">Ijin</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/0">Alpha</a></li>
                  
                </ul>
              </div>
            </td>
          <?php } elseif ($status == 2) {?>
            <td><span class="label label-warning"> Ijin</span></td>
            <td>
              <div class="dropdown">
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="menu11" data-toggle="dropdown">Edit 
                <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/3">Sakit</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/1">Masuk</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/0">Alpha</a></li>
                  
                </ul>
              </div>
            </td>
          <?php } elseif ($status == 3) {?>
            <td><span class="label label-warning"> Sakit</span></td>
            <td>
              <div class="dropdown">
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="menu11" data-toggle="dropdown">Edit 
                <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/1">Masuk</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/2">Ijin</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/0">Alpha</a></li>
                  
                </ul>
              </div>
            </td>
          <?php } elseif ($status == 0) {?>
            <td><span class="label label-danger"> Alpha</span></td> 
            <td>
              <div class="dropdown">
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="menu11" data-toggle="dropdown">Edit 
                <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/3">Sakit</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/2">Ijin</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url()?>absensi_guru/edit_data_hadir/<?=$lembaga?>/<?=$tanggal?>/<?=$id;?>/1">Masuk</a></li>
                  
                </ul>
              </div>
            </td>   
          <?php } ?>
          
        </tr>
        <?php }?>
    </table>
  </div>
</div>