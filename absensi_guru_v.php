<!-- sweetalert -->
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/sweetalert2.min.css" /><!-- sweet alert2 -->
<script src="<?php echo base_url(); ?>admin_assets/js/sweetalert/sweetalert2.min.js"></script>
<div class="x_panel">
    <div class="x_title">
        <h2><?= $title_head; ?></h2>
        <div class="clearfix"></div>


    </div>

    <?= validation_errors('<p style="color:red">', '</p>'); ?>
    <div class="x_content">
        <div class="input-group input-append date" id="datePicker">
            <span class="input-group-addon add-on">
                Tanggal <span></span></span>
            </span>
            <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= $tanggal; ?>" />
            <span class="input-group-addon add-on"><span class="fa fa-calendar-o"></span></span>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-primary">Cari Lembaga <span class="fa fa-search"></span></button>
                </span>
                <input type="hidden" id="sortByDay" name="sortByDay" value="<?= $hari_ini ?>">
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
        <div>
            <table class=" table table-responsive table-striped table-bordered" id="table-data" data-url="<?= $url_table; ?>"></table>
        </div>
        <div style="float:right;">
            <input type="hidden" value="<?= $url_cekData; ?>" id="cekData" name="cekData" />
            <div id="buttonSave">
                <button class="btn btn-primary" id="saveBtn" data-url="<?= $url_save; ?>"> <i class="fa fa-save"></i> Simpan Data</button>
            </div>
            <div id="editData">
                <a href="javascript:void(0)" onclick="_viewData('<?= $url_anchor; ?>')" class="btn btn-success">Cek / Edit Data</a>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {
        cekDataSimpan();
        tableData();
    });

    function _viewData(url) {

        var tgl = $('input[name="tanggal"]').val();
        var lembaga = $('#sortBy').val();
        var _newUrl = url + lembaga + '/' + tgl;
        if (tgl == '') {
            alert('Pilih Tanggal terlebih dahulu');
        } else {
            window.location = _newUrl;
        }
    }

    function cekDataSimpan() {
        var _newUrl = $('#cekData').val();
        var tanggal = $('#tanggal').val();
        $.post(_newUrl, {
                tanggal: tanggal
            },
            function(data) {
                hasil = JSON.parse(data)
                status = hasil.status;
                if (status == 1) {
                    $('#buttonSave').hide();
                    $('#editData').show();
                } else {
                    $('#buttonSave').show();
                    $('#editData').hide();
                }
            });

    }


    function toggle(source) {
        var checkboxes = document.getElementsByName("input_h[]");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }

    $("#saveBtn").click(function(e) {
        var url = $(this).attr('data-url');
        simpanData(url);
        // alert(url);


    });

    function tableData() {

        var urlTable = $('#table-data').attr('data-url');
        var sortBy = $('#sortBy').val();
        var tanggal = $('#tanggal').val();
        $.ajax({
            url: urlTable + sortBy + '/' + tanggal,
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
    $('#tanggal').on('change', function() {
        cekDataSimpan();
        tableData();
    });


    function simpanData(url) {
        var hadir = [];
        var sakit = [];
        var ijin = [];
        var alpha = [];
        var tanggal = $('#tanggal').val();
        var lembaga = $('#sortBy').val();
        $("input[name='input_h[]']:checked").each(function(i) {
            hadir[i] = $(this).val();
        })
        $("input[name='input_s[]']:checked").each(function(i) {
            sakit[i] = $(this).val();
        })
        $("input[name='input_i[]']:checked").each(function(i) {
            ijin[i] = $(this).val();
        })
        $("input[name='input_a[]']:checked").each(function(i) {
            alpha[i] = $(this).val();
        })

        var jmlCekList = parseInt(hadir.length) + parseInt(sakit.length) + parseInt(ijin.length) + parseInt(alpha.length);
        var jmlData = $('#jml_data').attr('data-id');

        if (jmlCekList === 0) {
            alert("Belum ada data terseleksi")
            // alert(tanggal);
        } else if (jmlCekList > jmlData) {
            alert("Ada yg terceklist ganda, cek lagi!!!");
        } else if (jmlCekList < jmlData) {
            alert("Ada Data yg belum di ceklist!!!");
        } else {
            // $.post(url, {
            //         hadir: hadir,
            //         sakit: sakit,
            //         ijin: ijin,
            //         alpha: alpha,
            //         tanggal: tanggal,
            //         lembaga: lembaga
            //     },
            //     function() {
            //         location.reload();
            //     });

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    hadir: hadir,
                    sakit: sakit,
                    ijin: ijin,
                    alpha: alpha,
                    tanggal: tanggal,
                    lembaga: lembaga
                },
                dataType: "json",
                beforeSend: function() {
                    // $('#fountainG').show();
                    swal({
                        title: 'Harap Tunggu ... ',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        timer: 2000,
                        onOpen: () => {
                            swal.showLoading();
                        }
                    }).then(
                        () => {},
                        (dismiss) => {
                            if (dismiss === 'timer') {
                                console.log('closed by timer!!!!');
                                swal({
                                    title: 'Finished!',
                                    type: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                })
                            }
                        }
                    )
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    }

    $("#btnDelete").click(function(e) {
        var page = $("#nav_currentPage").val();
        var _newUrl = $(this).attr('data-url');
        var id = [];
        $(':checkbox:checked').each(function(i) {
            id[i] = $(this).val();
        })
        if (id.length === 0) {
            swal("Peringatan!", "Belum Ada Data terseleksi", "error").catch(swal.noop);
            return false;
        } else {
            swal({
                title: "Are you sure?",
                text: "Benarkah Data ini dihapus?!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                allowOutsideClick: false,
                closeOnConfirm: false
            }).then(function(isConfirm) {
                $.post(_newUrl, {
                        id: id
                    },
                    function() {
                        for (var i = 0; i < id.length; i++) {
                            $('tr#' + id[i] + '').css('background-color', '#ccc');
                            $('tr#' + id[i] + '').fadeOut('slow');
                        }
                        setTimeout(function() {
                            showList('goto');
                        }, 2000);
                    })
            }).catch(swal.noop);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#datePicker')
            .datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy',
            })
    });
    $(document).ready(function() {
        $('#datePicker2')
            .datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            })
    });
</script>