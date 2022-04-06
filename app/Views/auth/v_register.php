<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>G-sok - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('/assets'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('/assets'); ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Alert Flash Massage -->
        <div class="flash-success" data-success="<?= session()->getFlashdata('success'); ?>"></div>
        <div class="flash-wrong" data-wrong="<?= session()->getFlashdata('wrong'); ?>"></div>
        <div class="flash-warning" data-warning="<?= session()->getFlashdata('warning'); ?>"></div>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">G-sok Register!</h1>
                                    </div>
                                    <form class="user" action="<?= base_url('/register'); ?>" method="post">
                                        <?= csrf_field(); ?>
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
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Register
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('/'); ?>">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('/assets'); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('/assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('/assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('/assets'); ?>/js/sb-admin-2.min.js"></script>
    <script src="<?= base_url('/assets'); ?>/js/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('/assets'); ?>/js/javascript.js"></script>


</body>

</html>