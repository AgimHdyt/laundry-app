<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <a href="" class="btn btn-success mb-3 add-submenu" data-toggle="modal" data-target="#addSubmenuModal">Add New Menu</a>
    <script>
        let nama = 'Agim Hidayat';
        console.info('nama');
    </script>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-lg">
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
                                    <th>Title</th>
                                    <th>Menu</th>
                                    <th>Url</th>
                                    <th>Icon</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($submenu as $sm) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $sm['title']; ?></td>
                                        <td><?= $sm['menu']; ?></td>
                                        <td><?= $sm['url']; ?></td>
                                        <td><?= $sm['icon']; ?></td>
                                        <td><?= $sm['is_active']; ?></td>
                                        <td>
                                            <a href="" class="btn btn-success btn-sm btn-circle edit-submenu" data-toggle="modal" data-target="#addSubmenuModal" data-id="<?= $sm['id']; ?>"><i class="fas fa-edit"></i></a>
                                            <a href="" class="btn btn-danger btn-sm btn-circle"><i class="fas fa-trash-alt"></i></a>
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

    <!-- Submenu Modal-->
    <div class="modal fade" id="addSubmenuModal" tabindex="-1" role="dialog" aria-labelledby="addSubmenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubmenuModalLabel">Add New Submenu</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('/submenu'); ?>" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="tetxt" class="form-control <?= $validation->hasError('title') ? 'is-invalid' : ''; ?>" id="title" name="title" aria-describedby="title" placeholder="Title">
                            <div class="invalid-feedback">
                                <?= $validation->getError('title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control <?= $validation->hasError('menu') ? 'is-invalid' : ''; ?>" id="menu" name="menu">
                                <option value="">Select Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('menu'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="tetxt" class="form-control <?= $validation->hasError('url') ? 'is-invalid' : ''; ?>" id="url" name="url" aria-describedby="url" placeholder="Url">
                            <div class="invalid-feedback">
                                <?= $validation->getError('url'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="tetxt" class="form-control <?= $validation->hasError('icon') ? 'is-invalid' : ''; ?>" id="icon" name="icon" aria-describedby="icon" placeholder="Icon">
                            <div class="invalid-feedback">
                                <?= $validation->getError('icon'); ?>
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>
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