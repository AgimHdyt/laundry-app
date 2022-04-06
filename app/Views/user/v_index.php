<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>


    <div class="card text-center" style="width: 18rem;">
        <img class="card-img-top" src="<?= base_url('/assets/img/profile') . '/' . $user['image']; ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?= $user['name']; ?></h5>
            <p class="card-text"><?= $user['email']; ?></p>
            <a href="<?= base_url('/edit-profile'); ?>" class="btn btn-outline-dark btn-table">Edit Profile</a>
            <a href="<?= base_url('/edit-password'); ?>" class="btn btn-outline-dark btn-table">Edit Password</a>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>