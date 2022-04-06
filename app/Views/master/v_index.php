<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <a href="" class="btn btn-success mb-3 add-menu" data-toggle="modal" data-target="#addMenuModal">Add New Menu</a>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Data Menu</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($menu as $m) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $m['menu']; ?></td>
                                        <td>
                                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#addMenuModal"><i class="fas fa-edit"></i></a>
                                            <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="tambahMenuLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('/menu'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahMenuLabel">Add New Menu</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="tetxt" class="form-control <?= $validation->hasError('menu') ? 'is-invalid' : ''; ?>" id="menu" name="menu" aria-describedby="menu" placeholder="Menu">
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('menu'); ?>
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
<!-- /.container-fluid -->

<?= $this->endSection(); ?>