<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Anak Bangsa</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sf_pro.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.theme.default.css') ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/extra-libs/font-awesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/home-style.css') ?>">
</head>

<body class="page-1">
    <header>
        <nav class="navbar navbar-expand-lg fixed-top py-0 nav-sticky">
            <a class="navbar-brand" href="#">
                <h2 class="font-weight-bold">SBA</h2>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <?php if ($isLogin == true) { ?>
                    <div class="navbar-nav align-items-center">
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                            <div class="navbar-nav align-items-center">
                                <a class="nav-item-2" href="#home">Home</a>
                                <a class="nav-item-2" href="#aksi">Aksi</a>
                                <a class="btn btn-rounded btn-transparent ml-3 h-50" href="#"><i class="fa fa-user mr-2"></i> User</a>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="navbar-nav align-items-center">
                        <a class="nav-item-2" href="<?= site_url('home') ?>">Home</a>
                        <a class="nav-item-2" href="aksi.html">Aksi</a>
                        <a class="nav-item-2" href="masuk.html">Masuk</a>
                        <a class="btn btn-rounded btn-transparent ml-3 h-50" href="#"><i class="fa fa-user mr-2"></i> Buat Akun</a>
                    </div>
                <?php } ?>
            </div>
        </nav>
    </header>