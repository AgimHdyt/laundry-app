<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <a href="" class="btn btn-primary mb-3 add-member" data-toggle="modal" data-target="#addMemberModal">Add New Member</a>

    <div class="row">
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Member(s)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Telephone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($member as $m) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $m['nama']; ?></td>
                                        <td><?= $m['alamat']; ?></td>
                                        <td><?= $m['jenis_kelamin']; ?></td>
                                        <td><?= $m['tlp']; ?></td>
                                        <td>
                                            <a href="" class="btn btn-success edit-member" data-toggle="modal" data-target="#addMemberModal" data-id="<?= $m['id']; ?>"><i class="fas fa-edit"></i></a>
                                            <form method="post" class="d-inline" action="<?= base_url('/del-member') . '/' . $m['id']; ?>">
                                                <input type="hidden" name="_method" id="id" value="DELETE">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- Add Member Modal-->
    <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberLabel">Add New Member</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('/add-member'); ?>" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" id="id_member" value="">
                        <div class="form-group">
                            <input type="tetxt" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : ''; ?>" id="nama" name="nama" aria-describedby="nama" placeholder="Nama">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="tetxt" class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" aria-describedby="alamat" placeholder="Alamat">
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="tetxt" class="form-control <?= $validation->hasError('tlp') ? 'is-invalid' : ''; ?>" id="tlp" name="tlp" aria-describedby="tlp" placeholder="Telephone">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tlp'); ?>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input <?= $validation->hasError('jenis_kelamin') ? 'is-invalid' : ''; ?>" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="L">
                            <label class="form-check-label" for="jenis_kelamin">
                                Man
                            </label>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_kelamin'); ?>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input <?= $validation->hasError('jenis_kelamin') ? 'is-invalid' : ''; ?>" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P">
                            <label class="form-check-label" for="jenis_kelamin">
                                Wonam
                            </label>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_kelamin'); ?>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="reset" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>