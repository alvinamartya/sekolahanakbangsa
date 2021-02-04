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

<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top py-0 navbar-dark">
            <a class="navbar-brand" href="<?= site_url('/') ?>">
                <h2 class="font-weight-bold">SAB</h2>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

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
        </nav>
    </header>

    <div id="carouselExampleIndicators" class="carousel slide carousel-header" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-caption">
                    <h1 class="mb-3">Sekolah Anak Bangsa</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium at nunc vitae scelerisque. Fusce rutrum sem dapibus lorem ornare aliquet. Orci varius natoque penatibus et magnis dis parturient montes</p>
                    <a href="#" class="btn btn-danger d-inline">Mari Berdonasi</a>
                </div>
                <img class="d-block w-100" src="<?php echo base_url('assets/images/yannis-h-uaPaEM7MiQQ-unsplash-min.png') ?>" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo base_url('assets/images/husniati-salma-J17gyn1adEM-unsplash-min.png') ?>" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo base_url('assets/images/husniati-salma-DIC2XZd_YgQ-unsplash-min.png') ?>" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Section Summary -->
    <section id="aksi">
        <div class="section-summary shadow">
            <div class="row">
                <div class="col-2">
                    <h4><?= $jumlah_aksi ?></h4>
                    <p>Aksi</p>
                </div>
                <div class="col-4">
                    <h4><?php echo 'Rp ' . number_format($total_donasi, 2, ',', '.'); ?></h4>
                    <p>Donasi Terkumpul</p>
                </div>
                <div class="col-3">
                    <h4><?= $jumlah_relawan ?></h4>
                    <p>Relawan</p>
                </div>
                <div class="col-3">
                    <h4><?= $jumlah_donatur ?></h4>
                    <p>Donatur</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Summary -->

    <!-- Section Aksi -->
    <section class="aksi bg-white">
        <div class="section-title">
            <div>
                <h3>Aksi</h3>
                <p>Mari bantu saudara kita di Rumah Singgah dan Sekolah Pedalaman</p>
            </div>
        </div>
        <div class="row mt-4">
            <?php foreach ($aksi as $a) { ?>
                <div class="col-xs-12 col-sm-6 col-md-4 my-2">
                    <a href="<?= site_url('donasi?id=' . $a->id_aksi); ?>">
                        <div class="card h-100">
                            <img class="card-img-top" src="<?php echo base_url('assets/images/aksi/' . $a->gambar) ?>" alt="<?= $a->nama_aksi ?>">
                            <div class="card-body">
                                <div class="card-title aksi-title"><?= $a->nama_aksi ?></div>
                                <div class="card-content">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $a->percentage ?>%" aria-valuenow="<?= $a->percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="aksi-content">
                                        <div>
                                            <p class="mb-2">Sisa Waktu</p>
                                            <h6 class="font-weight-bold text-danger"><?= $a->selisih_hari ?> hari</h6>
                                        </div>
                                        <div>
                                            <p class="mb-2 text-right">Terkumpul</p>
                                            <h6 class="font-weight-bold text-danger text-right"><?= 'Rp ' . number_format($a->total_donasi, 2, ',', '.');  ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <a href="<?= site_url('home/aksi') ?>" class="btn btn-danger">Lihat Semua Aksi <i class="fa fa-chevron-right ml-2"></i></a>
        </div>
    </section>
    <!-- End Section Aksi -->

    <!-- Section Do'a donatur -->
    <section class="bg-white doa">
        <div class="section-title mt-5">
            <div>
                <h3>Do'a Para Donatur</h3>
                <p>Beberapa pesan, harapan, dan do'a donatur</p>
            </div>
        </div>
        <div class="owl-carousel owl-theme mt-5">
            <div class="item doa-items">
                <div class="doa-box card p-2">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Teddyanto Jamal</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium at nunc vitae scelerisque. Fusce rutrum sem dapibus lorem ornare aliquet</p>
                    </div>
                </div>
            </div>
            <div class="item doa-items">
                <div class="doa-box card p-2">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Alvin Amartya</h5>
                        <p class="card-text">Orci varius natoque penatibus et magnis dis parturient montes.</p>
                    </div>
                </div>
            </div>
            <div class="item doa-items">
                <div class="doa-box card p-2">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Ivan Firman</h5>
                        <p class="card-text">Nascetur ridiculus mus. Quisque eget volutpat purus. Nulla facilisi. Morbi pharetra leo urna</p>
                    </div>
                </div>
            </div>
            <div class="item doa-items">
                <div class="doa-box card p-2">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Arnida Laili</h5>
                        <p class="card-text">Vestibulum lectus lectus, porttitor vitae risus in, semper ullamcorper ligula. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Do'a donatur -->

    <!-- Section Subscription -->
    <section class="subscription bg-white my-5 d-flex justify-content-center align-items-center">
        <div class="d-flex align-items-center flex-column">
            <h3 class="text-center font-weight-bold">Jadilah bagian dari kami</h3>
            <p class="text-center">Tunggu apa lagi! Mari bantu saudara-saudara kita yang membutuhkan</p>
            <div class="d-flex mt-3">
                <a href="<?= site_url('register/relawan') ?>" class="btn btn-danger mr-4">Jadi Relawan</a>
                <a href="<?= site_url('register/donatur') ?>" class="btn btn-outline-danger">Jadi Donatur</a>
            </div>
        </div>
    </section>

    <hr>
    <footer>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-5 about mr-5">
                <div class="footer-logo">
                    Sekolah Anak Bangsa
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque consectetur at sapien eu porta.
                    Vivamus nec commodo justo. Donec quis neque ullamcorper, interdum ex ac, euismod justo.</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 list">
                <h5 class="list-title">Menu</h5>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Aksi</a></li>
                    <li><a href="#">Masuk</a></li>
                    <li><a href="#">Daftar</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 list">
                <h5 class="list-title">Temukan Kami</h5>
                <ul>
                    <li>
                        <a href="#">
                            <div class="contact-list">
                                <div class="icon"><i class="fab fa-instagram mr-2 mt-1"></i></div>
                                <div class="text">sekolahanakbangsa.id</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="contact-list">
                                <div class="icon"><i class="fab fa-facebook mr-2 mt-1"></i></div>
                                <div class="text">Sekolah Anak Bangsa</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="contact-list">
                                <div class="icon"><i class="fa fa-envelope mr-2 mt-1"></i></div>
                                <div class="text">cs@sekolahanakbangsa.id</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-down">
            <p class="text-center mb-0">&copy; 2020 Sekolah Anak Bangsa</p>
        </div>
    </footer>

    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/owl.carousel.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/home-script.js') ?>"></script>
</body>

</html>