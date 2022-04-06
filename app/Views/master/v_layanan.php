<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">Data Layanan</h6>
                    <a href="" class="btn btn-success add-layana" data-toggle="modal" data-target="#addLayananModal">Layanan Baru</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($layanan as $l) : ?>
                            <div class="col m-2">
                                <div class="card text-center" style="width: 10rem;">
                                    <img class="card-img-top" src="<?= base_url('/assets/img') . '/' . $l['img']; ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h6 class="card-title"><?= $l['nama_layanan']; ?></h6>
                                        <a href="" class="btn btn-success btn-sm btn-circle edit-layanan" data-toggle="modal" data-target="#addLayananModal" data-id="<?= $l['id']; ?>"><i class="fas fa-edit"></i></a>
                                        <a href="" class="btn btn-warning btn-sm btn-circle detail-layanan" data-toggle="modal" data-id="<?= $l['id']; ?>"><i class="fas fa-plus"></i></a>
                                        <a href="" class="btn btn-danger btn-block my-2 delete-layanan" data-toggle="modal" data-target="#deleteLayananModal" data-id="<?= $l['id']; ?>">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success title-layanan">Layanan</h6>
                    <a href="" class="btn btn-success d-none tambah-detail-layanan" data-toggle="modal" data-target="#addDetailLayananModal">Tambah</a>
                </div>
                <div class="card-body">
                    <div class="show-detail-layanan">

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Delete Layanan Modal-->
<div class="modal fade" id="deleteLayananModal" tabindex="-1" role="dialog" aria-labelledby="deleteLayananLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLayananLabel">Delete Data Layanan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form method="post" action="<?= base_url('/delete-layanan'); ?>">
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                    <input type="hidden" name="id" id="delete_layanan">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="reset" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" type="submit">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./Delete Layanan Modal -->

<!-- Add $ Edit Detail Layanan Modal-->
<div class="modal fade" id="addDetailLayananModal" tabindex="-1" role="dialog" aria-labelledby="addDetailLayananLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDetailLayananLabel">Jenis Layanan Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="my-2 form-detail-layanan" action="<?= base_url('/jenis-layanan'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_layanan" id="id_layanan" value="">
                    <input type="hidden" name="id" id="id_d_layanan" value="">
                    <div class="form-group">
                        <label for="jenislayanan">Nama jenis layanan:</label>
                        <input type="tetxt" class="form-control <?= $validation->hasError('jenislayanan') ? 'is-invalid' : ''; ?>" id="jenislayanan" name="jenislayanan" aria-describedby="jenislayanan" placeholder="Masukan Nama Jenis Layanan">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jenislayanan'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="estimasi_waktu">Estimasi Waktu:</label>
                                <input type="tetxt" class="form-control <?= $validation->hasError('estimasi_waktu') ? 'is-invalid' : ''; ?>" id="estimasi_waktu" name="estimasi_waktu" aria-describedby="estimasi_waktu" placeholder="Estimasi Waktu">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('estimasi_waktu'); ?>
                                </div>
                                <div id="info_estimasi_waktu" class="font-weight-bold mt-1"></div>
                            </div>
                            <div class="col-lg-6">
                                <label for="estimasi_waktu">Tarif/KG:</label>
                                <input type="tetxt" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : ''; ?>" id="layanan_harga" name="harga" aria-describedby="harga" placeholder="Masukan Tarif">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('harga'); ?>
                                </div>
                                <div id="info_tarif" class="font-weight-bold mt-1"></div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary save-detail-layanan" type="reset" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success save-detail-layanan">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ./Delete Detail Layanan Modal -->


<!-- Add & Edit Layanan Modal-->
<div class="modal fade" id="addLayananModal" tabindex="-1" role="dialog" aria-labelledby="addLayananLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLayananLabel">Layanan Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="my-2" action="<?= base_url('/add-layanan'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <input type="tetxt" class="form-control <?= $validation->hasError('layanan') ? 'is-invalid' : ''; ?>" id="edit-layanan" name="layanan" aria-describedby="layanan" placeholder="Layanan">
                        <div class="invalid-feedback">
                            <?= $validation->getError('layanan'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= $validation->hasError('img') ? 'is-invalid' : ''; ?>" id="img" name="img">
                            <label class="custom-file-label img-label" for="img"></label>
                            <div class="invalid-feedback">
                                <?= $validation->getError('img'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="reset" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<?= $this->endSection(); ?>