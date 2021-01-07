<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Cloud Inventory</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/img/Icon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/fontawesome-free/css/all.min.css">
    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vanilla-opl/css/slicknav.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vanilla-opl/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vanilla-opl/css/owl.theme.css">
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vanilla-opl/css/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vanilla-opl/css/slick-theme.css">
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vanilla-opl/css/animate.css">
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vanilla-opl/css/main.css">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vanilla-opl/css/responsive.css">

</head>

<body>

    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar indigo">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="icon-menu"></span>
                        <span class="icon-menu"></span>
                        <span class="icon-menu"></span>
                    </button>
                    <a href="<?= base_url('home'); ?>" class="navbar-brand">Cloud Inventory</a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="navbar-nav mr-auto w-100 justify-content-right clearfix">
                        <li class="nav-item active">
                            <a class="nav-link" href="#hero-area">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">
                                Kelebihan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pricing">
                                Layanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">
                                Kontak
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/login'); ?>">
                                Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/registration'); ?>">
                                Daftar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Mobile Menu Start -->
            <ul class="mobile-menu navbar-nav">
                <li>
                    <a class="page-scroll" href="#hero-area">
                        Home
                    </a>
                </li>
                <li>
                    <a class="page-scroll" href="#services">
                        Kelebihan
                    </a>
                </li>
                <li>
                    <a class="page-scroll" href="#pricing">
                        Layanan
                    </a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">
                        Kontak
                    </a>
                </li>
                <li>
                    <a class="page-scroll" href="<?= base_url('auth/login'); ?>">
                        Masuk
                    </a>
                </li>
                <li>
                    <a class="page-scroll" href="<?= base_url('auth/registration'); ?>">
                        Daftar
                    </a>
                </li>
            </ul>
            <!-- Mobile Menu End -->

        </nav>
        <!-- Navbar End -->

        <!-- Awal Section Home -->
        <div id="hero-area" class="hero-area-bg">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="contents text-center">
                            <h2 class="head-title wow fadeInUp">Kelola Inventaris Barang<br>Perusahaan Anda Disini</h2>
                            <h6>Daftarkan perusahaan anda ke layanan kami lalu kelola inventaris barang anda di mana pun<br>tanpa memikirkan biaya pembangunan server & biaya perbaikan sistem</h6>
                        </div>
                        <div class="header-button wow fadeInUp text-center" data-wow-delay="0.3s">
                            <h5><a href="<?= base_url('auth/registration'); ?>" class="btn btn-common">Daftar Sekarang</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Section Home -->

    </header>
    <!-- Header Area wrapper End -->

    <!-- Awal Section Kelebihan -->
    <section id="services" class="section-padding">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title wow fadeInDown" data-wow-delay="0.3s">Kelebihan</h2>
            </div>
            <div class="row">
                <!-- Services item -->
                <div class="col-md-6 col-lg-4 col-xs-12">
                    <div class="services-item wow fadeInRight" data-wow-delay="0.3s">
                        <div class="icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="services-content">
                            <h6>Dapat Diakses Dimana Saja</h6>
                            <p>Layanan kami dapat diakses dimana saja cukup dengan terkoneksi di internet maka anda dapat menggunakan layanan kami</p>
                        </div>
                    </div>
                </div>
                <!-- Services item -->
                <div class="col-md-6 col-lg-4 col-xs-12">
                    <div class="services-item wow fadeInRight" data-wow-delay="0.6s">
                        <div class="icon">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <div class="services-content">
                            <h6>Dapat Menghemat Biaya</h6>
                            <p>Dapat menghemat biaya anda karena anda tidak perlu lagi memikirkan biaya pembuatan dan perbaikan sistem</p>
                        </div>
                    </div>
                </div>
                <!-- Services item -->
                <div class="col-md-6 col-lg-4 col-xs-12">
                    <div class="services-item wow fadeInRight" data-wow-delay="0.9s">
                        <div class="icon">
                            <i class="fas fa-server"></i>
                        </div>
                        <div class="services-content">
                            <h6>Tidak Perlu Membangun Server</h6>
                            <p>Anda tidak perlu lagi membangun server untuk sistem untuk kelola inventaris barang perusahaan anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Section Kelebihan -->

    <!-- Awal Section Paket Layanan -->
    <section id="pricing" class="section-padding">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title wow fadeInDown" data-wow-delay="0.3s">Paket Layanan</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="table wow fadeInLeft" data-wow-delay="0.3s">
                        <div class="title">
                            <h3><?= $paket_satu['Nama']; ?></h3>
                        </div>
                        <div class="pricing-header">
                            <p class="price-value"><?= rupiah($paket_satu['Harga']); ?><span>/Bulan</span></p>
                        </div>
                        <ul class="description">
                            <li><?= $paket_satu['JumlahBarang']; ?> Data Barang<br><?= $paket_satu['JumlahKaryawan']; ?> Akun Karyawan<br><?= $paket_satu['Keterangan']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-12 active">
                    <div class="table wow fadeInUp" data-wow-delay="0.3s">
                        <div class="title">
                            <h3><?= $paket_dua['Nama']; ?></h3>
                        </div>
                        <div class="pricing-header">
                            <p class="price-value"><?= rupiah($paket_dua['Harga']); ?><span>/Bulan</span></p>
                        </div>
                        <ul class="description">
                            <li><?= $paket_dua['JumlahBarang']; ?> Data Barang<br><?= $paket_dua['JumlahKaryawan']; ?> Akun Karyawan<br><?= $paket_dua['Keterangan']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="table wow fadeInRight" data-wow-delay="0.3s">
                        <div class="title">
                            <h3><?= $paket_tiga['Nama']; ?></h3>
                        </div>
                        <div class="pricing-header">
                            <p class="price-value"><?= rupiah($paket_tiga['Harga']); ?><span>/Bulan</span></p>
                        </div>
                        <ul class="description">
                            <li><?= $paket_tiga['JumlahBarang']; ?> Data Barang<br><?= $paket_tiga['JumlahKaryawan']; ?> Akun Karyawan<br><?= $paket_tiga['Keterangan']; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Section Paket Layanan -->

    <!-- Awal Section Kontak -->
    <section id="contact" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header text-center">
                        <h2 class="section-title wow fadeInDown" data-wow-delay="0.3s">Kontak</h2>
                    </div>
                </div>
            </div>
            <div class="row contact-form-area wow fadeInUp" data-wow-delay="0.4s">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="contact-right-area wow fadeIn">
                        <div class="contact-right">
                            <div class="single-contact">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <p><?= $kontak['Alamat']; ?></p>
                            </div>
                            <div class="single-contact">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <p><?= $kontak['Email']; ?></p>
                            </div>
                            <div class="single-contact">
                                <div class="contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <p><?= $kontak['NomorTelepon']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Section Kontak -->

    <section id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Copyright &copy; Cloud Inventory <?= date('Y'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Go to Top Link -->
    <a href="#" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('assets'); ?>/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vanilla-opl/js/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vanilla-opl/js/slick.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vanilla-opl/js/wow.js"></script>
    <script src="<?= base_url('assets'); ?>/vanilla-opl/js/jquery.nav.js"></script>
    <script src="<?= base_url('assets'); ?>/vanilla-opl/js/scrolling-nav.js"></script>
    <script src="<?= base_url('assets'); ?>/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vanilla-opl/js/jquery.slicknav.js"></script>
    <script src="<?= base_url('assets'); ?>/vanilla-opl/js/scrolling-nav.js"></script>
    <script src="<?= base_url('assets'); ?>/vanilla-opl/js/main.js"></script>
</body>

</html>