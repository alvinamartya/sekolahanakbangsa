<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sekolah Anak Bangsa</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/apercu.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sf_pro.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
</head>

<body>
    <div class="login-container">
        <div class="login-aside">
            <h2 class="">Sekolah Anak Bangsa</h2>
            <p>Jadilah bagian dari Sekolah Anak Bangsa</p>
            <p>Mari bantu mereka yang membutuhkan, demi Indonesia yang lebih baik</p>
        </div>
        <div class="login-form">
            <div class="w-50">
                <h5 class="">Masuk</h5>
                <form action="<?= site_url("login/login") ?>" method="POST">
                    <div class="form-group">
                        <label for="nama_pengguna">Nama Pengguna</label>
                        <input type="text" class="form-control" name="username" value="<?= isset($l['username']) ? $l['username'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" class="form-control" name="password" value="<?= isset($l['password']) ? $l['password'] : '' ?>">
                    </div>

                    <!-- ============================================================== -->
                    <!-- Start Error Alert -->
                    <!-- ============================================================== -->

                    <?php if (isset($err)) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <!-- Error Message -->
                            <?= $err ?>
                            <!-- Close Button -->
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>

                    <!-- ============================================================== -->
                    <!-- End Error Alert -->
                    <!-- ============================================================== -->

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-danger w-100"><i class="fa fa-sign-in"></i> Masuk</button>
                    </div>
                </form>

                <p class="form-footer">Belum punya akun?</p>
                <p><a href="<?php echo site_url('register/relawan') ?>">Jadi Relawan</a> atau <a href="<?php echo site_url('register/donatur') ?>">Donatur</a></p>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>