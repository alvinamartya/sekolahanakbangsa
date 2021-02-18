<hr>
    <!-- Section Subscription -->
    <section class="subscription bg-white my-5 d-flex justify-content-center align-items-center">
        <div class="d-flex align-items-center flex-column">
            <h3 class="text-center font-weight-bold">Jadilah bagian dari kami</h3>
            <p class="text-center">Tunggu apa lagi! Mari bantu saudara-saudara kita yang membutuhkan</p>
            <div class="d-flex mt-3">
                <a href="#" class="btn btn-danger mr-4">Jadi Relawan</a>
                <a href="#" class="btn btn-outline-danger">Jadi Donatur</a>
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
            <p class="text-center mb-0">&copy; 2021 Sekolah Anak Bangsa</p>
        </div>
    </footer>



    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/owl.carousel.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/home-script.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.priceformat.min.js') ?>"></script>

    <script>
        $('.priceformat').priceFormat({
                prefix: 'Rp',
                centsLimit: 0,
                thousandsSeparator: '.'
        });
    </script>

</body>

</html>
