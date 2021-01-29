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
                            <a class="nav-item-2" href="#aksi">Aksi</a>
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
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="card-title h4 font-weight-bold">Unggah Bukti Transfer</div>
                            <h4 class="m-0">Bantu Renovasi Rumah Oky</h4>
                        </div>
                        <div class="mb-5">
                            <p class="mb-2">Silahkan Transfer dengan nominal <text class="text-danger font-weight-bold">Rp250.000</text> ke</p>
                            <p>Rekening BRI <text class="text-danger font-weight-bold">6716172356712536788</text> a.n <text class="font-weight-bold">PT. Sekolah Anak Bangsa</text></p>
                        </div>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="file" name="bukti_transfer">
                            </div>
                            <div class="mt-3 d-flex">
                                <button type="submit" class="btn btn-danger font-weight-bold mt-3 d-inline-block mr-2"><i class="far fa-paper-plane mr-2"></i> Kirim</button>
                                <a href="#" class="btn btn-warning font-weight-bold mt-3 d-inline-block"><i class="far fa-window-close mr-2"></i> Batal</a>
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