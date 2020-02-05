<style>
  #tambah-form:hover {
    cursor: pointer;
  }
</style>
<div class="x_panel">
  <div class="x_title">
    <h2><?= $title_head; ?></h2>
    <div class="clearfix"></div>


  </div>

  <?= validation_errors('<p style="color:red">', '</p>'); ?>
  <div class="x_content">
    <!-- ini form tambah update -->
    <div id="tambah-form">
      <h2>Form Tambah / Edit Data</h2>

      <table class="table table-responsive ">
        <form id="add-form" action="" class="form-horizontal" data-edit="<?= $url_edit; ?>" data-hapus="<?= $url_delete; ?>" enctype="multipart/form-data" method="post">
          <input type="hidden" name="id_data" id="id_data" />
          <tr>
            <td>
              <div class="form-group">
                <select name="hari" id="hari" class="form-control">
                  <option value="">---Pilih Hari ---</option>
                  <option value="Senin">Senin</option>
                  <option value="Selasa">Selasa</option>
                  <option value="Rabu">Rabu</option>
                  <option value="Kamis">Kamis</option>
                  <option value="Jumat">Jumat</option>
                  <option value="Sabtu">Sabtu</option>
                  <option value="Minggu">Minggu</option>
                </select>
                <span class="help-block"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <select name="id_kelas" id="id_kelas" class="form-control ">
                  <option value="">---Pilih Kelas ---</option>
                  <?php $get_kelasX = $this->admin->get_all('kelas');
                  foreach ($get_kelasX->result() as $g) : $id_kls = $g->id;
                    $kelasX = $g->kelas; ?>
                    <option value="<?= $id_kls; ?>"><?= $g->kelas; ?></option>
                  <?php endforeach; ?>
                </select>
                <span class="help-block"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <select name="id_jam" id="id_jam" class="form-control ">
                  <option value="">---Pilih Jam ---</option>
                  <?php $get_jam = $this->admin->get_all('jam_masuk');
                  foreach ($get_jam->result() as $a) : $id_jam = $a->id;
                    $label = $a->label; ?>
                    <option value="<?= $id_jam; ?>"><?= $a->jam; ?>. <?= $label; ?></option>
                  <?php endforeach; ?>
                </select>
                <span class="help-block"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <select name="id_mapel" id="id_mapel" class="form-control ">
                  <option value="">---Pilih Mapel ---</option>
                  <?php $get_map = $this->admin->get_all_order('mapel', 'mapel', 'asc');
                  $no = 1;
                  foreach ($get_map->result() as $b) : $id_map = $b->id;
                    $mapel = $b->mapel;
                    $kitab = $b->kitab; ?>
                    <option value="<?= $id_map; ?>"><?= $mapel; ?> -<?= $kitab; ?></option>
                  <?php endforeach; ?>
                </select>
                <span class="help-block"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <select name="id_guru" id="id_guru" class="form-control ">
                  <option value="">---Pilih Pengajar ---</option>
                  <?php $get_guru = $this->admin->get_all('guru');
                  $no = 1;
                  foreach ($get_guru->result() as $c) : $id_gr = $c->id;
                    $nama = $c->nama; ?>
                    <option value="<?= $id_gr; ?>"><?= $nama; ?></option>
                  <?php endforeach; ?>
                </select>
                <span class="help-block"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <select name="id_lembaga" id="id_lembaga" class="form-control ">
                  <option value="">--- Pilih Lembaga ---</option>
                  <?php $get_lbg = $this->admin->get_all('lembaga');
                  $no = 1;
                  foreach ($get_lbg->result() as $d) : $id_lbg = $d->id;
                    $lbg = $d->lembaga; ?>
                    <option value="<?= $id_lbg; ?>"><?= $lbg; ?></option>
                  <?php endforeach; ?>
                </select>
                <span class="help-block"></span>
              </div>
            </td>
        </form>
        <td>
          <button class="btn btn-primary" id="saveBtn" data-url="<?= $url_save; ?>"> <i class="fa fa-save"></i></button>
        </td>
        </tr>
      </table>
      <hr />
    </div>
    <!-- akhir form -->

    <div class="form-group">

      <div class="input-group">

        <span class="input-group-btn">
          <button type="button" class="btn btn-primary">Cari Berdasarkan Lembaga <span class="fa fa-search"></span></button>
        </span>
        <select name="lembagaX" id="sortBy" class="selectpicker  form-control">
          <?php foreach ($lembaga->result() as $b) : ?>
            <option value="<?= $b->id; ?>" <?php if ($lembagaX == $b->id) {
                                              echo "selected";
                                            } ?>>
              <?= $b->lembaga ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <br>


    <!-- INI TABELNYA -->


    <!-- <h2>Jadwal Mapel MDNJ</h2> -->
    <?php if ($sess_lev == 1) { ?>
      <div style="float:right">
        <button class="btn btn-success " onclick="bukaForm()">Tambah Data
        </button>

      </div>
    <?php } ?>
    <div>
      <table class=" table table-responsive table-striped table-bordered" id="table-data" data-url="<?= $url_table; ?>"></table>
    </div>

  </div>
</div>
<script>
  $("input").change(function() {
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });
  $("select").change(function() {
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });
  $("textarea").change(function() {
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });
  $(document).ready(function() {
    $('#tambah-form').hide();
    tableData();
  });
  $("#saveBtn").click(function(e) {
    var url = $(this).attr('data-url');
    simpanData(url);
    // alert(url);
  });

  function tableData() {

    var urlTable = $('#table-data').attr('data-url');
    var sortBy = $('#sortBy').val();
    $.ajax({
      url: urlTable + sortBy,
      methode: "POST",
      // data:'&sortBy='+sortBy,
      dataType: "json",
      // beforeSend: function () {
      //     $('#loading').show();
      // },
      success: function(data) {
        $('#table-data').html(data.data_item);
        // $('#pagination_link').html(data.pagination_link);
        // $('#loading').fadeOut("slow");
      },
      error: function() {
        alert('Jangan Klik Tombol yang sudah dipilih!, Ulangi');

      }
    });

  }

  $('#sortBy').on('change', function() {
    tableData();
  });

  function bukaForm() {
    $('#tambah-form').show();
  }

  function editData(id) {
    var idData = id;
    $('#add-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    var url_edit = $('#add-form').attr('data-edit');
    // alert(url_edit+idData);
    //Ajax Load data from ajax
    $.ajax({
      url: url_edit + idData,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        // data ini diubah berdasarkan form inputnya
        $('[name="id_data"]').val(data.jadwal.id);
        $('[name="hari"]').val(data.jadwal.hari);
        $('[name="id_kelas"]').val(data.jadwal.id_kelas);
        $('[name="id_jam"]').val(data.jadwal.id_jam);
        $('[name="id_mapel"]').val(data.jadwal.id_mapel);
        $('[name="id_guru"]').val(data.jadwal.id_guru);
        $('[name="id_lembaga"]').val(data.jadwal.id_lembaga);
        $("html, body").animate({
          scrollTop: 0
        }, 500);
        $('#tambah-form').show();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Data Error Bruuh....');
      }
    });
  }

  function hapusData(id) {
    if (confirm("Apakah Benar Data ini akan dihapus?")) {
      var urlX = $('#add-form').attr('data-hapus');
      // alert(urlX+id);
      $.ajax({
        url: urlX + id,
        type: "POST",
        data: {
          id: id
        },
        dataType: "html",
        success: function() {
          location.reload();
          $('#tambah-form').hide();
        },
        error: function(xhr, ajaxOptions, thrownError) {
          swal("Error deleting!", "Please try again", "error");
        }
      });
    } else {
      return false;
    }
  }

  function simpanData(url) {
    var id = $('input[name="id_data"]').val();
    if (id != '') {
      urlX = url + id;
    } else {
      urlX = url;
    }
    $.ajax({
      url: urlX,
      type: "POST",
      data: $('#add-form').serialize(),
      dataType: "JSON",
      success: function(data) {
        if (data.status) { // jika sukses masukkan ke tabel tutup modal
          $('#add-form')[0].reset();
          // new PNotify({
          //   title: 'Success !!!',
          //   text: 'Data yang anda masukkan sukses tersimpan!',
          //   type: 'success',
          //   styling: 'bootstrap3'
          // });
          // alert('sukses disimpan');
          location.reload();
        } else {
          for (var i = 0; i < data.inputerror.length; i++) {
            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
          }
        }
      },
      error: function(xhr, status, error) {
        // var err = eval("(" + xhr.responseText + ")");
        // alert(err.Message);
        alert('error broo...')
      }
    });
  }
</script>
<!-- Back to Top -->
<!-- <script type="text/javascript">
    var backToTop = $("#tambah-form");
    $(window).on('scroll', function() {
      if ($(this).scrollTop() > 200) {
        backToTop.fadeIn();
      } else {
        backToTop.fadeOut();
      }
    });

    // $backToTop.on('click', function(e) {
      
    // });
</script>