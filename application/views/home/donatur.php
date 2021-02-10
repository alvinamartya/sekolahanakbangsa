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

<body class="page-1 bg-gray">
    <header class="bg-gray">
        <nav class="navbar navbar-expand-lg fixed-top py-0 nav-sticky">
            <a class="navbar-brand" href="<?= site_url('/') ?>">
                <h2 class="font-weight-bold">SAB</h2>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav align-items-center">
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <?php if ($isLogin == true) { ?>
                            <div class="navbar-nav align-items-center">
                                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                                    <div class="navbar-nav align-items-center">
                                        <a class="nav-item-2" href="<?= site_url('/') ?>">Home</a>
                                        <a class="nav-item-2" href="<?= site_url('home/aksi') ?>">Aksi</a>
                                        <a class="nav-item-2" href="<?= site_url('login/logout') ?>">Keluar</a>
                                        <a class="btn btn-rounded btn-transparent ml-3 h-50" href="<?= site_url('home/donatur') ?>"><i class="fa fa-user mr-2"></i> User</a>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="navbar-nav align-items-center">
                                <a class="nav-item-2" href="<?= site_url('/') ?>">Home</a>
                                <a class="nav-item-2" href="<?= site_url('home/aksi') ?>">Aksi</a>
                                <a class="nav-item-2" href="<?= site_url('login') ?>">Masuk</a>
                                <a class="btn btn-rounded btn-transparent ml-3 h-50" href="<?= site_url('register/donatur') ?>"><i class="fa fa-user mr-2"></i> Buat Akun</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <section class="bg-gray section-page mb-5 container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <div class="card-title h4 font-weight-bold">Donasi Anda</div>
                        </div>
                        <?php foreach ($data as $d) { ?>
                            <div class="card my-4">
                                <div class="card-body py-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="font-weight-bold">
                                                <?php foreach ($data_aksi as $data2) { ?>
                                                    <?php
                                                        if($data2->id_aksi == $d->id_aksi){
                                                            echo $data2->nama_aksi;
                                                        }
                                                    ?>
                                                <?php } ?>
                                            </h5>
                                            <p class="m-0 font-weight-bold text-danger"><?= "Rp" . number_format($d->donasi, 2, ",", "."); ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text-center font-weight-bold">Status</h5>
                                            <p class="m-0 text-center">
                                            <?php foreach ($status as $s) { ?>
                                                <?php
                                                    if($s->id_status_aksi == $d->id_status_aksi){
                                                        echo $s->nama_status_aksi;
                                                    }
                                                ?>
                                            <?php } ?>
                                            </p>
                                        </div>
                                        <?php
                                            if ($d->id_status_aksi == 1) {
                                                ?>
                                                <div class="col-md-2 d-flex justify-content-end align-items-center">
                                                    <a href="<?= site_url('donasi/upload_bukti/' .  $d->id) ?>" class="btn btn-danger"><i class="fa fa-money-bill-wave-alt mr-2"></i>Transfer</a>
                                                </div>
                                            <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/owl.carousel.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/home-script.js') ?>"></script>
</body>

</html>