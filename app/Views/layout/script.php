<script>
    $(document).ready(function() {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        $('#estimasi_waktu').on('keyup', function() {
            const value = $(this).val();
            $('#info_estimasi_waktu').html(value + ' Hari');
        });

        $('#layanan_harga').on('keyup', function() {
            const value = $(this).val();
            $('#info_tarif').html('Rp. ' + format_rupiah(value));
        });

        $('.tambah-detail-layanan').on('click', function() {
            $('#jenislayanan').val('');
            $('#estimasi_waktu').val('');
            $('#layanan_harga').val('');
        });

        $('.detail-layanan').on('click', function() {
            const id = $(this).data('id');
            $.ajax({
                url: "<?= base_url('/getLayanan') ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('.title-layanan').html('Layanan ' + data.nama_layanan);
                    $('#id_layanan').val(data.id);
                    $('.show-detail-layanan').load('<?= base_url('/d-layanan')  ?>' + '/' + data.id);
                    $('.tambah-detail-layanan').removeClass('d-none');
                }

            });
        });


        $('.add-layana').on('click', function() {
            $('#addLayananLabel').html('Layanan Baru');
            $('.modal-footer button[type=submit]').html('Tambah');
            $('.modal-body form').attr('action', '<?= base_url('/add-layanan'); ?>');

            $('#id').val('');
            $('#edit-layanan').val('');
            $('#img').val('');
            $('.img-label').html('');
        });

        $('.edit-layanan').on('click', function() {
            $('#addLayananLabel').html('Edit Layanan');
            $('.modal-footer button[type=submit]').html('Edit');
            $('.modal-body form').attr('action', '<?= base_url('/edit-layanan'); ?>');

            const id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('/getLayanan') ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#edit-layanan').val(data.nama_layanan);
                    $('#img').val(data.img);
                    $('.img-label').html(data.img);
                }
            });

        });

        $('.delete-layanan').on('click', function() {
            const id = $(this).data('id');
            console.info(id);
            $.ajax({
                url: "<?= base_url('/getLayanan') ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#delete_layanan').val(data.id);
                }
            });

        });


        // JQuery Transaksi
        $('#member').on('change', function() {
            const id = $(this).val();
            $.ajax({
                url: "<?= base_url('/getMember') ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#nama').val(data.nama);
                    $('#alamat').val(data.alamat);
                    $('#tlp').val(data.tlp);
                    $('#jenis_kelamin[value=' + data.jenis_kelamin + ']').attr('checked', true);
                }
            });
        });


        // JQuery Transaksi
        $('#transaksi_layanan').on('change', function() {
            const id = $(this).val();
            $.ajax({
                url: "<?= base_url('/layananTable') ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    let html = '';
                    let i;
                    for (i = 0; i < data.length; i++) {
                        if (data.length == 0) {
                            html += '<option value="' + data[0].id + '">' + data[0].layanan + '</option>';
                        } else {
                            html += '<option value="' + data[i].id + '">' + data[i].layanan + '</option>';
                        }
                    }
                    $('#jenis_layanan').html(html).change();
                }
            });

        });

        // Merubah Kondisi transaksi
        $('#transaksi_layanan').change();

        $('#jenis_layanan').on('change', function() {
            const id = $(this).val();
            $.ajax({
                url: "<?= base_url('/getJenisLayanan') ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    let img = '<img src="' + "<?= base_url('/assets/img') . '/' ?>" + data.img + '"  width="80" id="image-table" alt="">';
                    $('#image-table-td').html(img);
                    $('#tabel-nama-layanan').html(data.nama_layanan)
                    $('#tabel-jenis-layanan').html(data.layanan)
                    $('#tabel-waktu-layanan').html(data.estimasi_waktu)
                    $('#tabel-tarif-layanan').html(format_rupiah(data.harga))
                }
            });
        });


        $('#berat').change(function() {

            const kilo = $(this).val();
            const id = $('#jenis_layanan').val();
            $.ajax({
                url: "<?= base_url('/get-harga') ?>",
                data: {
                    kilo: kilo,
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#total_biaya').html(format_rupiah(data));
                    $('#tot').val(data);
                    $('#jenis_layanan').change(function() {
                        const id = $(this).val();
                        const kilo = $('#berat').val();
                        $.ajax({
                            url: "<?= base_url('/get-harga') ?>",
                            data: {
                                kilo: kilo,
                                id: id
                            },
                            method: "post",
                            dataType: "json",
                            success: function(data) {
                                $('#total_biaya').html(format_rupiah(data));
                                $('#tot').val(data);

                            }
                        });
                    });
                }
            });
        });


        $('#tgl_masuk').on('change', function() {
            const id = $('#jenis_layanan').val();
            const date_th = $(this).val();
            $.ajax({
                url: "<?= base_url('/get-tanggal') ?>",
                data: {
                    date_th: date_th,
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#tgl_selesai').val(data);

                }
            });
        });

        $('#edit-data-transaksi').click(function() {
            const id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('/get-id-transaksi'); ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#invoice').val(data.invoice);
                    $('#member').val(data.id_member).change();
                    $('#jenis_layanan').val(data.id_layanan).change();
                    $('#berat').val(data.berat).change();
                    $('#tgl_masuk').val(data.tanggal_mulai).change();
                    $('#keterangan').val(data.keterangan);

                    // let pembayaran_awal = $('input:radio[name=name');


                    let pembayaran_awal = [
                        'Telah Dibayar',
                        'Belum Dibayar'
                    ];

                    if (pembayaran_awal[0] == data.pembayaran) {
                        $('#status_bayar[status=telah_dibayar]').attr('checked', true);
                    } else {
                        $('#status_bayar[status=belum_dibayar]').attr('checked', true);
                    }

                    $('#status[value=' + data.status + ']').attr('checked', true);
                }
            });

        });


        $('.add-submenu').on('click', function() {
            $('#addSubmenuModalLabel').html('Add New Submenu');
            $('.modal-footer button[type=submit]').html('Add');
            $('.modal-body form').attr('action', '<?= base_url('/submenu'); ?>');

            $('#title').val();
            $('#menu').val();
            $('#url').val();
            $('#icon').val();
            $('#is_active').val();

        });

        $('.edit-submenu').on('click', function() {
            $('#addSubmenuModalLabel').html('Edit Submenu');
            $('.modal-footer button[type=submit]').html('Edit');
            $('.modal-body form').attr('action', '<?= base_url('/edit-submenu'); ?>');

            const id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('/get-submenu') ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#title').val(data.title);
                    $('#menu').val(data.menu_id);
                    $('#url').val(data.url);
                    $('#icon').val(data.icon);
                    $('#is_active').val(data.is_active);
                }
            });

        });


        $('.add-user').on('click', function() {
            $('#addUserlabel').html('Add New User');
            $('.modal-footer button[type=submit]').html('Add');
            $('.modal-body form').attr('action', '<?= base_url('/add-user'); ?>');

            $('#name').val();
            $('#email').val();
            $('#password').val();
            $('#role_id').val();

        });

        $('.edit-user').on('click', function() {
            $('#addUserlabel').html('Edit User');
            $('.modal-footer button[type=submit]').html('Edit');
            $('.modal-body form').attr('action', '<?= base_url('/edit-user'); ?>');

            const id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('/get-user') ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#image').val(data.image);
                    $('#role_id').val(data.role_id);
                }
            });

        });


        $('.add-member').on('click', function() {
            $('#addmemberlabel').html('Add New Member');
            $('.modal-footer button[type=submit]').html('Add');
            $('.modal-body form').attr('action', '<?= base_url('/add-member'); ?>');

            $('#nama').val();
            $('#alamat').val();
            $('#tlp').val();

        });

        $('.edit-member').on('click', function() {
            $('#addmemberlabel').html('Edit Member');
            $('.modal-footer button[type=submit]').html('Edit');
            $('.modal-body form').attr('action', '<?= base_url('/edit-member'); ?>');

            const id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('/getMember') ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#id_member').val(data.id);
                    $('#nama').val(data.nama);
                    $('#alamat').val(data.alamat);
                    $('#tlp').val(data.tlp);
                    $('#jenis_kelamin[value=' + data.jenis_kelamin + ']').attr('checked', true);
                }
            });

        });





    });
</script>

<script>
    $(function() {
        $("#kjkj").keyup(function(e) {
            $(this).val(format_rupiah($(this).val()));
        });
    });

    var format_rupiah = function(num) {
        var str = num.toString().replace("", ""),
            parts = false,
            output = [],
            i = 1,
            formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
</script>