<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>


    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('/changepassword'); ?>">
                        <input type="hidden" name="id" id="id" value="<?= $user['id']; ?>">

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Curren Password</label>
                            <input type="password" class="form-control <?= $validation->hasError('current_password') ? 'is-invalid' : ''; ?>" id="current_password" name="current_password">
                            <div class="invalid-feedback">
                                <?= $validation->getError('current_password'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="new_password1" class="form-label">New Password</label>
                            <input type="password" class="form-control <?= $validation->hasError('new_password1') ? 'is-invalid' : ''; ?>" id="new_password1" name="new_password1">
                            <div class="invalid-feedback">
                                <?= $validation->getError('new_password1'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="new_password2" class="form-label">Repeat Password</label>
                            <input type="password" class="form-control <?= $validation->hasError('new_password1') ? 'is-invalid' : ''; ?>" id="new_password2" name="new_password2">
                            <div class="invalid-feedback">
                                <?= $validation->getError('new_password1'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="<?= base_url('/user'); ?>" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>