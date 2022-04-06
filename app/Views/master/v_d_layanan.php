<?php if ($detail) : ?>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Layanan</th>
                    <th>Estimasi Waktu</th>
                    <th>Tarif</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($detail as $d) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $d['layanan']; ?></td>
                        <td><?= $d['estimasi_waktu'] . ' Hari'; ?></td>
                        <td><?= 'Rp. ' . number_format($d['harga']); ?></td>
                        <td>
                            <button type="button" class="btn btn-success edit-detail-layanan" data-toggle="modal" data-target="#addDetailLayananModal" data-id="<?= $d['id']; ?>"><i class="fas fa-edit"></i></button>
                            <form method="post" class="d-inline" action="<?= base_url('/delete-jenis-layanan'); ?>">
                                <input type="hidden" name="id" id="id" value="<?= $d['id']; ?>">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteDetailLayananModal"><i class="fas fa-trash-alt"></i></button>
                                <!-- Delete Layanan Modal-->
                                <div class="modal fade" id="deleteDetailLayananModal" tabindex="-1" role="dialog" aria-labelledby="addLayananLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addLayananLabel">Delete Data Jenis Layanan</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <p>Apakah anda yakin ingin menghapus data ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="reset" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" type="submit">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./Delete Layanan Modal -->
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>



<script>
    $('.tambah-detail-layanan').on('click', function() {
        $('#addDetailLayananLabel').html('Jenis Layanan Baru');
        $('.modal-footer button[type=submit]').html('Save');
        $('.modal-body form').attr('action', '<?= base_url('/jenis-layanan'); ?>');
        $('#id_d_layanan').val('');
        $('#jenislayanan').val('');
        $('#estimasi_waktu').val('');
        $('#layanan_harga').val('');
    });

    $('.edit-detail-layanan').on('click', function() {
        $('#addDetailLayananLabel').html('Edit Jenis Layanan Baru');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', '<?= base_url('/edit-jenis-layanan'); ?>');

        const id = $(this).data('id');

        $.ajax({
            url: "<?= base_url('/getDetailLayanan') ?>",
            data: {
                id: id
            },
            method: "post",
            dataType: "json",
            success: function(data) {
                $('#id_d_layanan').val(data.id);
                $('#jenislayanan').val(data.layanan);
                $('#estimasi_waktu').val(data.estimasi_waktu);
                $('#layanan_harga').val(data.harga);
            }

        });
    });
</script>