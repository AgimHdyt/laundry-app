<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <a href="" class="btn btn-primary mb-3 add-user" data-toggle="modal" data-target="#addNewUserModal">Add New User</a>

    <div class="row">
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data User(s)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Role Id</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($users as $u) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $u['email']; ?></td>
                                        <td><?= $u['name']; ?></td>
                                        <td><?= $u['role_id']; ?></td>
                                        <td><?= $u['is_active']; ?></td>
                                        <td>
                                            <a href="" class="btn btn-success edit-user" data-toggle="modal" data-target="#addNewUserModal" data-id="<?= $u['id']; ?>"><i class="fas fa-edit"></i></a>
                                            <form method="post" class="d-inline" action="<?= base_url('/del-user') . '/' . $u['id']; ?>">
                                                <input type="hidden" name="_method" id="id" value="DELETE">
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>


    <!-- Add User Modal-->
    <div class="modal fade" id="addNewUserModal" tabindex="-1" role="dialog" aria-labelledby="tambahMenuLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserlabel">Add New User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('/add-user'); ?>" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="image" id="image">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user <?= $validation->hasError('name') ? 'is-invalid' : ''; ?>" name="name" id="name" value="<?= old('name'); ?>" placeholder="Full Name...">
                            <div class="invalid-feedback">
                                <?= $validation->getError('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= old('email'); ?>" placeholder="Enter Email Address...">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="password" class="form-control form-control-user <?= $validation->hasError('password') ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control form-control-user <?= $validation->hasError('current_password') ? 'is-invalid' : ''; ?>" name="current_password" id="current_password" placeholder="Retype password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('current_password'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <select type="role_id" class="form-control form-control-user <?= $validation->hasError('role_id') ? 'is-invalid' : ''; ?>" name="role_id" id="role_id" value="<?= old('role_id'); ?>">
                                <option value="">--Pilih Level--</option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                                <option value="3">Owner</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('role_id'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input <?= $validation->hasError('is_active') ? 'is-invalid' : ''; ?>" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Active</label>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('is_active'); ?>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="reset" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>