<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - Sekolah Anak Bangsa</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/apercu.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sf_pro.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/home-style.css') ?>">
</head>

<body>
    <div class="login-container">
        <div class="login-aside">
            <h2 class="">Sekolah Anak Bangsa</h2>
            <p>Jadilah bagian dari Sekolah Anak Bangsa</p>
            <p>Mari bantu mereka yang membutuhkan, demi Indonesia yang lebih baik</p>
        </div>
        <div class="login-form register-form">
            <div class="w-50">
                <h5 class="">Daftar Donatur</h5>
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>
                <form action="<?= site_url("register/register_donatur") ?>" method="POST">
                    <div class="form-group">
                        <label for="nama_donatur">Nama Donatur</label>
                        <input type="text" id="nama_donatur" class="form-control <?php echo (form_error('nama_donatur') != null ? 'is-invalid' : '') ?>" name="nama_donatur" value="<?php echo set_value('nama_donatur'); ?>">
                        <div class="invalid-feedback"><?php echo form_error('nama_donatur'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="L" class="d-block">Jenis Kelamin</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="L" name="jenis_kelamin" value="L" <?php echo (set_value('jenis_kelamin') == 'L' ? 'checked' : '') ?>>
                            <label class="form-check-label" for="L">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="P" name="jenis_kelamin" value="P" <?php echo (set_value('jenis_kelamin') == 'P' ? 'checked' : '') ?>>
                            <label class="form-check-label" for="P">Perempuan</label>
                        </div>
                        <small class="text-danger"><?php echo form_error('jenis_kelamin') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">No. Telepon</label>
                        <input type="number" id="no_telepon" class="form-control <?php echo (form_error('no_telepon') != null ? 'is-invalid' : '') ?>" name="no_telepon" value="<?php echo set_value('no_telepon'); ?>">
                        <div class="invalid-feedback"><?php echo form_error('no_telepon'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" class="form-control <?php echo (form_error('email_donatur') != null ? 'is-invalid' : '') ?>" name="email_donatur" value="<?php echo set_value('email_donatur'); ?>">
                        <div class="invalid-feedback"><?php echo form_error('email_donatur'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="username">Nama Pengguna</label>
                        <input type="text" id="username" class="form-control <?php echo (form_error('username') != null ? 'is-invalid' : '') ?>" name="username" value="<?php echo set_value('username'); ?>">
                        <div class="invalid-feedback"><?php echo form_error('username'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" id="password" class="form-control <?php echo (form_error('password') != null ? 'is-invalid' : '') ?>" name="password" value="<?php echo set_value('password'); ?>">
                        <div class="invalid-feedback"><?php echo form_error('password'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control <?php echo (form_error('password_confirmation') != null ? 'is-invalid' : '') ?>" name="password_confirmation" value="<?php echo set_value('password_confirmation'); ?>">
                        <div class="invalid-feedback"><?php echo form_error('password_confirmation'); ?></div>
                    </div>

                    <div class="form-group mt-4">
                    <button type="submit" class="btn btn-danger d-inline-block text-center w-100">Daftar</button>
                    </div>
                </form>

                <p class="form-footer">Sudah punya akun?</p>
                <p><a href="<?php echo site_url('login') ?>" class="text-primary">Masuk</a></p>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>