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
            <a class="navbar-brand" href="#">
                <h2 class="font-weight-bold">SBA</h2>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav align-items-center">
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav align-items-center">
                            <a class="nav-item-2" href="#home">Home</a>
                            <a class="btn btn-rounded btn-transparent ml-3 h-50" href="#"><i class="fa fa-user mr-2"></i> User</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <section class="bg-gray section-page mb-5 container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-body d-flex align-items-center">
                        <img src="<?php echo base_url('assets/images/rumah-singgah.jpg') ?>" alt="Bantu Renovasi Rumah Oky" class="img-pembayaran">
                        <h3 class="card-title mb-0 ml-4 font-weight-bold text-left">Bantu Renovasi Rumah Oky</h3>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="nominal">Nominal Donasi</label>
                                <input type="text" class="form-control" name="nominal" placeholder="Rp.">
                            </div>
                            <div class="form-group">
                                <label for="pesan">Pesan</label>
                                <textarea name="keterangan" rows="10" class="form-control" placeholder="Tulis Keterangan / Pesan"></textarea>
                            </div>
                            <div class="mt-3 row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-warning btn-lg font-weight-bold mt-3 d-block w-100"><i class="fa fa-chevron-left mr-2"></i> Kembali</button>
                                </div>
                                <div class="col-md-6 pl-0">
                                    <button type="submit" class="btn btn-danger btn-lg font-weight-bold mt-3 d-block w-100">Lanjut ke Pembayaran <i class="fa fa-chevron-right ml-2"></i></button>
                                </div>
                            </div>
                        </form>
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